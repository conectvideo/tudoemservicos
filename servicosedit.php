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
$servicos_edit = new servicos_edit();

// Run the page
$servicos_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$servicos_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fservicosedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fservicosedit = currentForm = new ew.Form("fservicosedit", "edit");

	// Validate form
	fservicosedit.validate = function() {
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
			<?php if ($servicos_edit->idservicos->Required) { ?>
				elm = this.getElements("x" + infix + "_idservicos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $servicos_edit->idservicos->caption(), $servicos_edit->idservicos->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($servicos_edit->servicos->Required) { ?>
				elm = this.getElements("x" + infix + "_servicos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $servicos_edit->servicos->caption(), $servicos_edit->servicos->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($servicos_edit->idarea->Required) { ?>
				elm = this.getElements("x" + infix + "_idarea");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $servicos_edit->idarea->caption(), $servicos_edit->idarea->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_idarea");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($servicos_edit->idarea->errorMessage()) ?>");
			<?php if ($servicos_edit->valor->Required) { ?>
				elm = this.getElements("x" + infix + "_valor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $servicos_edit->valor->caption(), $servicos_edit->valor->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_valor");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($servicos_edit->valor->errorMessage()) ?>");

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
	fservicosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fservicosedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fservicosedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $servicos_edit->showPageHeader(); ?>
<?php
$servicos_edit->showMessage();
?>
<form name="fservicosedit" id="fservicosedit" class="<?php echo $servicos_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="servicos">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$servicos_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($servicos_edit->idservicos->Visible) { // idservicos ?>
	<div id="r_idservicos" class="form-group row">
		<label id="elh_servicos_idservicos" class="<?php echo $servicos_edit->LeftColumnClass ?>"><?php echo $servicos_edit->idservicos->caption() ?><?php echo $servicos_edit->idservicos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $servicos_edit->RightColumnClass ?>"><div <?php echo $servicos_edit->idservicos->cellAttributes() ?>>
<span id="el_servicos_idservicos">
<span<?php echo $servicos_edit->idservicos->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($servicos_edit->idservicos->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="servicos" data-field="x_idservicos" name="x_idservicos" id="x_idservicos" value="<?php echo HtmlEncode($servicos_edit->idservicos->CurrentValue) ?>">
<?php echo $servicos_edit->idservicos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($servicos_edit->servicos->Visible) { // servicos ?>
	<div id="r_servicos" class="form-group row">
		<label id="elh_servicos_servicos" for="x_servicos" class="<?php echo $servicos_edit->LeftColumnClass ?>"><?php echo $servicos_edit->servicos->caption() ?><?php echo $servicos_edit->servicos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $servicos_edit->RightColumnClass ?>"><div <?php echo $servicos_edit->servicos->cellAttributes() ?>>
<span id="el_servicos_servicos">
<input type="text" data-table="servicos" data-field="x_servicos" name="x_servicos" id="x_servicos" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($servicos_edit->servicos->getPlaceHolder()) ?>" value="<?php echo $servicos_edit->servicos->EditValue ?>"<?php echo $servicos_edit->servicos->editAttributes() ?>>
</span>
<?php echo $servicos_edit->servicos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($servicos_edit->idarea->Visible) { // idarea ?>
	<div id="r_idarea" class="form-group row">
		<label id="elh_servicos_idarea" for="x_idarea" class="<?php echo $servicos_edit->LeftColumnClass ?>"><?php echo $servicos_edit->idarea->caption() ?><?php echo $servicos_edit->idarea->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $servicos_edit->RightColumnClass ?>"><div <?php echo $servicos_edit->idarea->cellAttributes() ?>>
<span id="el_servicos_idarea">
<input type="text" data-table="servicos" data-field="x_idarea" name="x_idarea" id="x_idarea" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($servicos_edit->idarea->getPlaceHolder()) ?>" value="<?php echo $servicos_edit->idarea->EditValue ?>"<?php echo $servicos_edit->idarea->editAttributes() ?>>
</span>
<?php echo $servicos_edit->idarea->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($servicos_edit->valor->Visible) { // valor ?>
	<div id="r_valor" class="form-group row">
		<label id="elh_servicos_valor" for="x_valor" class="<?php echo $servicos_edit->LeftColumnClass ?>"><?php echo $servicos_edit->valor->caption() ?><?php echo $servicos_edit->valor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $servicos_edit->RightColumnClass ?>"><div <?php echo $servicos_edit->valor->cellAttributes() ?>>
<span id="el_servicos_valor">
<input type="text" data-table="servicos" data-field="x_valor" name="x_valor" id="x_valor" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($servicos_edit->valor->getPlaceHolder()) ?>" value="<?php echo $servicos_edit->valor->EditValue ?>"<?php echo $servicos_edit->valor->editAttributes() ?>>
</span>
<?php echo $servicos_edit->valor->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$servicos_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $servicos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $servicos_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$servicos_edit->showPageFooter();
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
$servicos_edit->terminate();
?>