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
$areas_edit = new areas_edit();

// Run the page
$areas_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$areas_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fareasedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fareasedit = currentForm = new ew.Form("fareasedit", "edit");

	// Validate form
	fareasedit.validate = function() {
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
			<?php if ($areas_edit->idareas->Required) { ?>
				elm = this.getElements("x" + infix + "_idareas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $areas_edit->idareas->caption(), $areas_edit->idareas->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($areas_edit->areadescricao->Required) { ?>
				elm = this.getElements("x" + infix + "_areadescricao");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $areas_edit->areadescricao->caption(), $areas_edit->areadescricao->RequiredErrorMessage)) ?>");
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
	fareasedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fareasedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fareasedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $areas_edit->showPageHeader(); ?>
<?php
$areas_edit->showMessage();
?>
<form name="fareasedit" id="fareasedit" class="<?php echo $areas_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="areas">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$areas_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($areas_edit->idareas->Visible) { // idareas ?>
	<div id="r_idareas" class="form-group row">
		<label id="elh_areas_idareas" class="<?php echo $areas_edit->LeftColumnClass ?>"><?php echo $areas_edit->idareas->caption() ?><?php echo $areas_edit->idareas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $areas_edit->RightColumnClass ?>"><div <?php echo $areas_edit->idareas->cellAttributes() ?>>
<span id="el_areas_idareas">
<span<?php echo $areas_edit->idareas->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($areas_edit->idareas->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="areas" data-field="x_idareas" name="x_idareas" id="x_idareas" value="<?php echo HtmlEncode($areas_edit->idareas->CurrentValue) ?>">
<?php echo $areas_edit->idareas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($areas_edit->areadescricao->Visible) { // areadescricao ?>
	<div id="r_areadescricao" class="form-group row">
		<label id="elh_areas_areadescricao" for="x_areadescricao" class="<?php echo $areas_edit->LeftColumnClass ?>"><?php echo $areas_edit->areadescricao->caption() ?><?php echo $areas_edit->areadescricao->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $areas_edit->RightColumnClass ?>"><div <?php echo $areas_edit->areadescricao->cellAttributes() ?>>
<span id="el_areas_areadescricao">
<input type="text" data-table="areas" data-field="x_areadescricao" name="x_areadescricao" id="x_areadescricao" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($areas_edit->areadescricao->getPlaceHolder()) ?>" value="<?php echo $areas_edit->areadescricao->EditValue ?>"<?php echo $areas_edit->areadescricao->editAttributes() ?>>
</span>
<?php echo $areas_edit->areadescricao->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("profissionais", explode(",", $areas->getCurrentDetailTable())) && $profissionais->DetailEdit) {
?>
<?php if ($areas->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("profissionais", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "profissionaisgrid.php" ?>
<?php } ?>
<?php if (!$areas_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $areas_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $areas_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$areas_edit->showPageFooter();
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
$areas_edit->terminate();
?>