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
$formadepgto_edit = new formadepgto_edit();

// Run the page
$formadepgto_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$formadepgto_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fformadepgtoedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fformadepgtoedit = currentForm = new ew.Form("fformadepgtoedit", "edit");

	// Validate form
	fformadepgtoedit.validate = function() {
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
			<?php if ($formadepgto_edit->idformadepgto->Required) { ?>
				elm = this.getElements("x" + infix + "_idformadepgto");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $formadepgto_edit->idformadepgto->caption(), $formadepgto_edit->idformadepgto->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($formadepgto_edit->formadepgto->Required) { ?>
				elm = this.getElements("x" + infix + "_formadepgto");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $formadepgto_edit->formadepgto->caption(), $formadepgto_edit->formadepgto->RequiredErrorMessage)) ?>");
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
	fformadepgtoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fformadepgtoedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fformadepgtoedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $formadepgto_edit->showPageHeader(); ?>
<?php
$formadepgto_edit->showMessage();
?>
<form name="fformadepgtoedit" id="fformadepgtoedit" class="<?php echo $formadepgto_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="formadepgto">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$formadepgto_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($formadepgto_edit->idformadepgto->Visible) { // idformadepgto ?>
	<div id="r_idformadepgto" class="form-group row">
		<label id="elh_formadepgto_idformadepgto" class="<?php echo $formadepgto_edit->LeftColumnClass ?>"><?php echo $formadepgto_edit->idformadepgto->caption() ?><?php echo $formadepgto_edit->idformadepgto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $formadepgto_edit->RightColumnClass ?>"><div <?php echo $formadepgto_edit->idformadepgto->cellAttributes() ?>>
<span id="el_formadepgto_idformadepgto">
<span<?php echo $formadepgto_edit->idformadepgto->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($formadepgto_edit->idformadepgto->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="formadepgto" data-field="x_idformadepgto" name="x_idformadepgto" id="x_idformadepgto" value="<?php echo HtmlEncode($formadepgto_edit->idformadepgto->CurrentValue) ?>">
<?php echo $formadepgto_edit->idformadepgto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($formadepgto_edit->formadepgto->Visible) { // formadepgto ?>
	<div id="r_formadepgto" class="form-group row">
		<label id="elh_formadepgto_formadepgto" for="x_formadepgto" class="<?php echo $formadepgto_edit->LeftColumnClass ?>"><?php echo $formadepgto_edit->formadepgto->caption() ?><?php echo $formadepgto_edit->formadepgto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $formadepgto_edit->RightColumnClass ?>"><div <?php echo $formadepgto_edit->formadepgto->cellAttributes() ?>>
<span id="el_formadepgto_formadepgto">
<input type="text" data-table="formadepgto" data-field="x_formadepgto" name="x_formadepgto" id="x_formadepgto" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($formadepgto_edit->formadepgto->getPlaceHolder()) ?>" value="<?php echo $formadepgto_edit->formadepgto->EditValue ?>"<?php echo $formadepgto_edit->formadepgto->editAttributes() ?>>
</span>
<?php echo $formadepgto_edit->formadepgto->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$formadepgto_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $formadepgto_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $formadepgto_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$formadepgto_edit->showPageFooter();
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
$formadepgto_edit->terminate();
?>