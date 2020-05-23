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
$profissionais_add = new profissionais_add();

// Run the page
$profissionais_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$profissionais_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprofissionaisadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fprofissionaisadd = currentForm = new ew.Form("fprofissionaisadd", "add");

	// Validate form
	fprofissionaisadd.validate = function() {
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
			<?php if ($profissionais_add->nome->Required) { ?>
				elm = this.getElements("x" + infix + "_nome");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profissionais_add->nome->caption(), $profissionais_add->nome->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($profissionais_add->telefone->Required) { ?>
				elm = this.getElements("x" + infix + "_telefone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profissionais_add->telefone->caption(), $profissionais_add->telefone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($profissionais_add->whatsapp->Required) { ?>
				elm = this.getElements("x" + infix + "_whatsapp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profissionais_add->whatsapp->caption(), $profissionais_add->whatsapp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($profissionais_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profissionais_add->_email->caption(), $profissionais_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($profissionais_add->idarea->Required) { ?>
				elm = this.getElements("x" + infix + "_idarea");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profissionais_add->idarea->caption(), $profissionais_add->idarea->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_idarea");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($profissionais_add->idarea->errorMessage()) ?>");

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
	fprofissionaisadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprofissionaisadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fprofissionaisadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $profissionais_add->showPageHeader(); ?>
<?php
$profissionais_add->showMessage();
?>
<form name="fprofissionaisadd" id="fprofissionaisadd" class="<?php echo $profissionais_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="profissionais">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$profissionais_add->IsModal ?>">
<?php if ($profissionais->getCurrentMasterTable() == "areas") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="areas">
<input type="hidden" name="fk_idareas" value="<?php echo HtmlEncode($profissionais_add->idarea->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($profissionais_add->nome->Visible) { // nome ?>
	<div id="r_nome" class="form-group row">
		<label id="elh_profissionais_nome" for="x_nome" class="<?php echo $profissionais_add->LeftColumnClass ?>"><?php echo $profissionais_add->nome->caption() ?><?php echo $profissionais_add->nome->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profissionais_add->RightColumnClass ?>"><div <?php echo $profissionais_add->nome->cellAttributes() ?>>
<span id="el_profissionais_nome">
<input type="text" data-table="profissionais" data-field="x_nome" name="x_nome" id="x_nome" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($profissionais_add->nome->getPlaceHolder()) ?>" value="<?php echo $profissionais_add->nome->EditValue ?>"<?php echo $profissionais_add->nome->editAttributes() ?>>
</span>
<?php echo $profissionais_add->nome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($profissionais_add->telefone->Visible) { // telefone ?>
	<div id="r_telefone" class="form-group row">
		<label id="elh_profissionais_telefone" for="x_telefone" class="<?php echo $profissionais_add->LeftColumnClass ?>"><?php echo $profissionais_add->telefone->caption() ?><?php echo $profissionais_add->telefone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profissionais_add->RightColumnClass ?>"><div <?php echo $profissionais_add->telefone->cellAttributes() ?>>
<span id="el_profissionais_telefone">
<input type="text" data-table="profissionais" data-field="x_telefone" name="x_telefone" id="x_telefone" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($profissionais_add->telefone->getPlaceHolder()) ?>" value="<?php echo $profissionais_add->telefone->EditValue ?>"<?php echo $profissionais_add->telefone->editAttributes() ?>>
</span>
<?php echo $profissionais_add->telefone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($profissionais_add->whatsapp->Visible) { // whatsapp ?>
	<div id="r_whatsapp" class="form-group row">
		<label id="elh_profissionais_whatsapp" for="x_whatsapp" class="<?php echo $profissionais_add->LeftColumnClass ?>"><?php echo $profissionais_add->whatsapp->caption() ?><?php echo $profissionais_add->whatsapp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profissionais_add->RightColumnClass ?>"><div <?php echo $profissionais_add->whatsapp->cellAttributes() ?>>
<span id="el_profissionais_whatsapp">
<input type="text" data-table="profissionais" data-field="x_whatsapp" name="x_whatsapp" id="x_whatsapp" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($profissionais_add->whatsapp->getPlaceHolder()) ?>" value="<?php echo $profissionais_add->whatsapp->EditValue ?>"<?php echo $profissionais_add->whatsapp->editAttributes() ?>>
</span>
<?php echo $profissionais_add->whatsapp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($profissionais_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_profissionais__email" for="x__email" class="<?php echo $profissionais_add->LeftColumnClass ?>"><?php echo $profissionais_add->_email->caption() ?><?php echo $profissionais_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profissionais_add->RightColumnClass ?>"><div <?php echo $profissionais_add->_email->cellAttributes() ?>>
<span id="el_profissionais__email">
<input type="text" data-table="profissionais" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($profissionais_add->_email->getPlaceHolder()) ?>" value="<?php echo $profissionais_add->_email->EditValue ?>"<?php echo $profissionais_add->_email->editAttributes() ?>>
</span>
<?php echo $profissionais_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($profissionais_add->idarea->Visible) { // idarea ?>
	<div id="r_idarea" class="form-group row">
		<label id="elh_profissionais_idarea" for="x_idarea" class="<?php echo $profissionais_add->LeftColumnClass ?>"><?php echo $profissionais_add->idarea->caption() ?><?php echo $profissionais_add->idarea->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profissionais_add->RightColumnClass ?>"><div <?php echo $profissionais_add->idarea->cellAttributes() ?>>
<?php if ($profissionais_add->idarea->getSessionValue() != "") { ?>
<span id="el_profissionais_idarea">
<span<?php echo $profissionais_add->idarea->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($profissionais_add->idarea->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_idarea" name="x_idarea" value="<?php echo HtmlEncode($profissionais_add->idarea->CurrentValue) ?>">
<?php } else { ?>
<span id="el_profissionais_idarea">
<input type="text" data-table="profissionais" data-field="x_idarea" name="x_idarea" id="x_idarea" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($profissionais_add->idarea->getPlaceHolder()) ?>" value="<?php echo $profissionais_add->idarea->EditValue ?>"<?php echo $profissionais_add->idarea->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $profissionais_add->idarea->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$profissionais_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $profissionais_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $profissionais_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$profissionais_add->showPageFooter();
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
$profissionais_add->terminate();
?>