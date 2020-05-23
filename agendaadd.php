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
$agenda_add = new agenda_add();

// Run the page
$agenda_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agenda_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fagendaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fagendaadd = currentForm = new ew.Form("fagendaadd", "add");

	// Validate form
	fagendaadd.validate = function() {
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
			<?php if ($agenda_add->datainicio->Required) { ?>
				elm = this.getElements("x" + infix + "_datainicio");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_add->datainicio->caption(), $agenda_add->datainicio->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_datainicio");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($agenda_add->datainicio->errorMessage()) ?>");
			<?php if ($agenda_add->datafinal->Required) { ?>
				elm = this.getElements("x" + infix + "_datafinal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_add->datafinal->caption(), $agenda_add->datafinal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_datafinal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($agenda_add->datafinal->errorMessage()) ?>");
			<?php if ($agenda_add->idprofissional->Required) { ?>
				elm = this.getElements("x" + infix + "_idprofissional");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_add->idprofissional->caption(), $agenda_add->idprofissional->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_idprofissional");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($agenda_add->idprofissional->errorMessage()) ?>");
			<?php if ($agenda_add->idcliente->Required) { ?>
				elm = this.getElements("x" + infix + "_idcliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_add->idcliente->caption(), $agenda_add->idcliente->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_idcliente");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($agenda_add->idcliente->errorMessage()) ?>");
			<?php if ($agenda_add->idservico->Required) { ?>
				elm = this.getElements("x" + infix + "_idservico");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_add->idservico->caption(), $agenda_add->idservico->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_idservico");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($agenda_add->idservico->errorMessage()) ?>");

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
	fagendaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fagendaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fagendaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $agenda_add->showPageHeader(); ?>
<?php
$agenda_add->showMessage();
?>
<form name="fagendaadd" id="fagendaadd" class="<?php echo $agenda_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agenda">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$agenda_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($agenda_add->datainicio->Visible) { // datainicio ?>
	<div id="r_datainicio" class="form-group row">
		<label id="elh_agenda_datainicio" for="x_datainicio" class="<?php echo $agenda_add->LeftColumnClass ?>"><?php echo $agenda_add->datainicio->caption() ?><?php echo $agenda_add->datainicio->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_add->RightColumnClass ?>"><div <?php echo $agenda_add->datainicio->cellAttributes() ?>>
<span id="el_agenda_datainicio">
<input type="text" data-table="agenda" data-field="x_datainicio" name="x_datainicio" id="x_datainicio" maxlength="19" placeholder="<?php echo HtmlEncode($agenda_add->datainicio->getPlaceHolder()) ?>" value="<?php echo $agenda_add->datainicio->EditValue ?>"<?php echo $agenda_add->datainicio->editAttributes() ?>>
</span>
<?php echo $agenda_add->datainicio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_add->datafinal->Visible) { // datafinal ?>
	<div id="r_datafinal" class="form-group row">
		<label id="elh_agenda_datafinal" for="x_datafinal" class="<?php echo $agenda_add->LeftColumnClass ?>"><?php echo $agenda_add->datafinal->caption() ?><?php echo $agenda_add->datafinal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_add->RightColumnClass ?>"><div <?php echo $agenda_add->datafinal->cellAttributes() ?>>
<span id="el_agenda_datafinal">
<input type="text" data-table="agenda" data-field="x_datafinal" name="x_datafinal" id="x_datafinal" maxlength="19" placeholder="<?php echo HtmlEncode($agenda_add->datafinal->getPlaceHolder()) ?>" value="<?php echo $agenda_add->datafinal->EditValue ?>"<?php echo $agenda_add->datafinal->editAttributes() ?>>
</span>
<?php echo $agenda_add->datafinal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_add->idprofissional->Visible) { // idprofissional ?>
	<div id="r_idprofissional" class="form-group row">
		<label id="elh_agenda_idprofissional" for="x_idprofissional" class="<?php echo $agenda_add->LeftColumnClass ?>"><?php echo $agenda_add->idprofissional->caption() ?><?php echo $agenda_add->idprofissional->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_add->RightColumnClass ?>"><div <?php echo $agenda_add->idprofissional->cellAttributes() ?>>
<span id="el_agenda_idprofissional">
<input type="text" data-table="agenda" data-field="x_idprofissional" name="x_idprofissional" id="x_idprofissional" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($agenda_add->idprofissional->getPlaceHolder()) ?>" value="<?php echo $agenda_add->idprofissional->EditValue ?>"<?php echo $agenda_add->idprofissional->editAttributes() ?>>
</span>
<?php echo $agenda_add->idprofissional->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_add->idcliente->Visible) { // idcliente ?>
	<div id="r_idcliente" class="form-group row">
		<label id="elh_agenda_idcliente" for="x_idcliente" class="<?php echo $agenda_add->LeftColumnClass ?>"><?php echo $agenda_add->idcliente->caption() ?><?php echo $agenda_add->idcliente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_add->RightColumnClass ?>"><div <?php echo $agenda_add->idcliente->cellAttributes() ?>>
<span id="el_agenda_idcliente">
<input type="text" data-table="agenda" data-field="x_idcliente" name="x_idcliente" id="x_idcliente" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($agenda_add->idcliente->getPlaceHolder()) ?>" value="<?php echo $agenda_add->idcliente->EditValue ?>"<?php echo $agenda_add->idcliente->editAttributes() ?>>
</span>
<?php echo $agenda_add->idcliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_add->idservico->Visible) { // idservico ?>
	<div id="r_idservico" class="form-group row">
		<label id="elh_agenda_idservico" for="x_idservico" class="<?php echo $agenda_add->LeftColumnClass ?>"><?php echo $agenda_add->idservico->caption() ?><?php echo $agenda_add->idservico->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_add->RightColumnClass ?>"><div <?php echo $agenda_add->idservico->cellAttributes() ?>>
<span id="el_agenda_idservico">
<input type="text" data-table="agenda" data-field="x_idservico" name="x_idservico" id="x_idservico" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($agenda_add->idservico->getPlaceHolder()) ?>" value="<?php echo $agenda_add->idservico->EditValue ?>"<?php echo $agenda_add->idservico->editAttributes() ?>>
</span>
<?php echo $agenda_add->idservico->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$agenda_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $agenda_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $agenda_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$agenda_add->showPageFooter();
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
$agenda_add->terminate();
?>