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
$areas2_edit = new areas2_edit();

// Run the page
$areas2_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$areas2_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fareas2edit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fareas2edit = currentForm = new ew.Form("fareas2edit", "edit");

	// Validate form
	fareas2edit.validate = function() {
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
			<?php if ($areas2_edit->idareas->Required) { ?>
				elm = this.getElements("x" + infix + "_idareas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $areas2_edit->idareas->caption(), $areas2_edit->idareas->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($areas2_edit->areadescricao->Required) { ?>
				elm = this.getElements("x" + infix + "_areadescricao");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $areas2_edit->areadescricao->caption(), $areas2_edit->areadescricao->RequiredErrorMessage)) ?>");
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
	fareas2edit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fareas2edit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fareas2edit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $areas2_edit->showPageHeader(); ?>
<?php
$areas2_edit->showMessage();
?>
<form name="fareas2edit" id="fareas2edit" class="<?php echo $areas2_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="areas2">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$areas2_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($areas2_edit->idareas->Visible) { // idareas ?>
	<div id="r_idareas" class="form-group row">
		<label id="elh_areas2_idareas" class="<?php echo $areas2_edit->LeftColumnClass ?>"><?php echo $areas2_edit->idareas->caption() ?><?php echo $areas2_edit->idareas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $areas2_edit->RightColumnClass ?>"><div <?php echo $areas2_edit->idareas->cellAttributes() ?>>
<span id="el_areas2_idareas">
<span<?php echo $areas2_edit->idareas->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($areas2_edit->idareas->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="areas2" data-field="x_idareas" name="x_idareas" id="x_idareas" value="<?php echo HtmlEncode($areas2_edit->idareas->CurrentValue) ?>">
<?php echo $areas2_edit->idareas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($areas2_edit->areadescricao->Visible) { // areadescricao ?>
	<div id="r_areadescricao" class="form-group row">
		<label id="elh_areas2_areadescricao" for="x_areadescricao" class="<?php echo $areas2_edit->LeftColumnClass ?>"><?php echo $areas2_edit->areadescricao->caption() ?><?php echo $areas2_edit->areadescricao->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $areas2_edit->RightColumnClass ?>"><div <?php echo $areas2_edit->areadescricao->cellAttributes() ?>>
<span id="el_areas2_areadescricao">
<input type="text" data-table="areas2" data-field="x_areadescricao" name="x_areadescricao" id="x_areadescricao" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($areas2_edit->areadescricao->getPlaceHolder()) ?>" value="<?php echo $areas2_edit->areadescricao->EditValue ?>"<?php echo $areas2_edit->areadescricao->editAttributes() ?>>
</span>
<?php echo $areas2_edit->areadescricao->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$areas2_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $areas2_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $areas2_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$areas2_edit->showPageFooter();
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
$areas2_edit->terminate();
?>