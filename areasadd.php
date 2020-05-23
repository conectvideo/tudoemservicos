<?php
namespace PHPMaker2020\project1;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$areas_add = new areas_add();

// Run the page
$areas_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$areas_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fareasadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fareasadd = currentForm = new ew.Form("fareasadd", "add");

	// Validate form
	fareasadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($areas_add->areadescricao->Required) { ?>
				elm = this.getElements("x" + infix + "_areadescricao");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $areas_add->areadescricao->caption(), $areas_add->areadescricao->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fareasadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fareasadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fareasadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $areas_add->showPageHeader(); ?>
<?php
$areas_add->showMessage();
?>
<form name="fareasadd" id="fareasadd" class="<?php echo $areas_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="areas">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$areas_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($areas_add->areadescricao->Visible) { // areadescricao ?>
	<div id="r_areadescricao" class="form-group row">
		<label id="elh_areas_areadescricao" for="x_areadescricao" class="<?php echo $areas_add->LeftColumnClass ?>"><?php echo $areas_add->areadescricao->caption() ?><?php echo $areas_add->areadescricao->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $areas_add->RightColumnClass ?>"><div <?php echo $areas_add->areadescricao->cellAttributes() ?>>
<span id="el_areas_areadescricao">
<input type="text" data-table="areas" data-field="x_areadescricao" name="x_areadescricao" id="x_areadescricao" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($areas_add->areadescricao->getPlaceHolder()) ?>" value="<?php echo $areas_add->areadescricao->EditValue ?>"<?php echo $areas_add->areadescricao->editAttributes() ?>>
</span>
<?php echo $areas_add->areadescricao->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("profissionais", explode(",", $areas->getCurrentDetailTable())) && $profissionais->DetailAdd) {
?>
<?php if ($areas->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("profissionais", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "profissionaisgrid.php" ?>
<?php } ?>
<?php if (!$areas_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $areas_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $areas_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$areas_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$areas_add->terminate();
?>