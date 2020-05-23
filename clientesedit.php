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
$clientes_edit = new clientes_edit();

// Run the page
$clientes_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$clientes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclientesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fclientesedit = currentForm = new ew.Form("fclientesedit", "edit");

	// Validate form
	fclientesedit.validate = function() {
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
			<?php if ($clientes_edit->idclientes->Required) { ?>
				elm = this.getElements("x" + infix + "_idclientes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_edit->idclientes->caption(), $clientes_edit->idclientes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_edit->nome->Required) { ?>
				elm = this.getElements("x" + infix + "_nome");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_edit->nome->caption(), $clientes_edit->nome->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_edit->cpf->Required) { ?>
				elm = this.getElements("x" + infix + "_cpf");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_edit->cpf->caption(), $clientes_edit->cpf->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_edit->rg->Required) { ?>
				elm = this.getElements("x" + infix + "_rg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_edit->rg->caption(), $clientes_edit->rg->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_edit->telefonefixo->Required) { ?>
				elm = this.getElements("x" + infix + "_telefonefixo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_edit->telefonefixo->caption(), $clientes_edit->telefonefixo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_edit->celularwhatsapp->Required) { ?>
				elm = this.getElements("x" + infix + "_celularwhatsapp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_edit->celularwhatsapp->caption(), $clientes_edit->celularwhatsapp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_edit->endereco->Required) { ?>
				elm = this.getElements("x" + infix + "_endereco");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_edit->endereco->caption(), $clientes_edit->endereco->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_edit->numero->Required) { ?>
				elm = this.getElements("x" + infix + "_numero");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_edit->numero->caption(), $clientes_edit->numero->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_edit->bairro->Required) { ?>
				elm = this.getElements("x" + infix + "_bairro");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_edit->bairro->caption(), $clientes_edit->bairro->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_edit->complemento->Required) { ?>
				elm = this.getElements("x" + infix + "_complemento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_edit->complemento->caption(), $clientes_edit->complemento->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_edit->cep->Required) { ?>
				elm = this.getElements("x" + infix + "_cep");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_edit->cep->caption(), $clientes_edit->cep->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_edit->_email->caption(), $clientes_edit->_email->RequiredErrorMessage)) ?>");
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
	fclientesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fclientesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fclientesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $clientes_edit->showPageHeader(); ?>
<?php
$clientes_edit->showMessage();
?>
<form name="fclientesedit" id="fclientesedit" class="<?php echo $clientes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="clientes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$clientes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($clientes_edit->idclientes->Visible) { // idclientes ?>
	<div id="r_idclientes" class="form-group row">
		<label id="elh_clientes_idclientes" class="<?php echo $clientes_edit->LeftColumnClass ?>"><?php echo $clientes_edit->idclientes->caption() ?><?php echo $clientes_edit->idclientes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_edit->RightColumnClass ?>"><div <?php echo $clientes_edit->idclientes->cellAttributes() ?>>
<span id="el_clientes_idclientes">
<span<?php echo $clientes_edit->idclientes->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($clientes_edit->idclientes->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="clientes" data-field="x_idclientes" name="x_idclientes" id="x_idclientes" value="<?php echo HtmlEncode($clientes_edit->idclientes->CurrentValue) ?>">
<?php echo $clientes_edit->idclientes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_edit->nome->Visible) { // nome ?>
	<div id="r_nome" class="form-group row">
		<label id="elh_clientes_nome" for="x_nome" class="<?php echo $clientes_edit->LeftColumnClass ?>"><?php echo $clientes_edit->nome->caption() ?><?php echo $clientes_edit->nome->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_edit->RightColumnClass ?>"><div <?php echo $clientes_edit->nome->cellAttributes() ?>>
<span id="el_clientes_nome">
<input type="text" data-table="clientes" data-field="x_nome" name="x_nome" id="x_nome" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($clientes_edit->nome->getPlaceHolder()) ?>" value="<?php echo $clientes_edit->nome->EditValue ?>"<?php echo $clientes_edit->nome->editAttributes() ?>>
</span>
<?php echo $clientes_edit->nome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_edit->cpf->Visible) { // cpf ?>
	<div id="r_cpf" class="form-group row">
		<label id="elh_clientes_cpf" for="x_cpf" class="<?php echo $clientes_edit->LeftColumnClass ?>"><?php echo $clientes_edit->cpf->caption() ?><?php echo $clientes_edit->cpf->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_edit->RightColumnClass ?>"><div <?php echo $clientes_edit->cpf->cellAttributes() ?>>
<span id="el_clientes_cpf">
<input type="text" data-table="clientes" data-field="x_cpf" name="x_cpf" id="x_cpf" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($clientes_edit->cpf->getPlaceHolder()) ?>" value="<?php echo $clientes_edit->cpf->EditValue ?>"<?php echo $clientes_edit->cpf->editAttributes() ?>>
</span>
<?php echo $clientes_edit->cpf->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_edit->rg->Visible) { // rg ?>
	<div id="r_rg" class="form-group row">
		<label id="elh_clientes_rg" for="x_rg" class="<?php echo $clientes_edit->LeftColumnClass ?>"><?php echo $clientes_edit->rg->caption() ?><?php echo $clientes_edit->rg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_edit->RightColumnClass ?>"><div <?php echo $clientes_edit->rg->cellAttributes() ?>>
<span id="el_clientes_rg">
<input type="text" data-table="clientes" data-field="x_rg" name="x_rg" id="x_rg" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($clientes_edit->rg->getPlaceHolder()) ?>" value="<?php echo $clientes_edit->rg->EditValue ?>"<?php echo $clientes_edit->rg->editAttributes() ?>>
</span>
<?php echo $clientes_edit->rg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_edit->telefonefixo->Visible) { // telefonefixo ?>
	<div id="r_telefonefixo" class="form-group row">
		<label id="elh_clientes_telefonefixo" for="x_telefonefixo" class="<?php echo $clientes_edit->LeftColumnClass ?>"><?php echo $clientes_edit->telefonefixo->caption() ?><?php echo $clientes_edit->telefonefixo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_edit->RightColumnClass ?>"><div <?php echo $clientes_edit->telefonefixo->cellAttributes() ?>>
<span id="el_clientes_telefonefixo">
<input type="text" data-table="clientes" data-field="x_telefonefixo" name="x_telefonefixo" id="x_telefonefixo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($clientes_edit->telefonefixo->getPlaceHolder()) ?>" value="<?php echo $clientes_edit->telefonefixo->EditValue ?>"<?php echo $clientes_edit->telefonefixo->editAttributes() ?>>
</span>
<?php echo $clientes_edit->telefonefixo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_edit->celularwhatsapp->Visible) { // celularwhatsapp ?>
	<div id="r_celularwhatsapp" class="form-group row">
		<label id="elh_clientes_celularwhatsapp" for="x_celularwhatsapp" class="<?php echo $clientes_edit->LeftColumnClass ?>"><?php echo $clientes_edit->celularwhatsapp->caption() ?><?php echo $clientes_edit->celularwhatsapp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_edit->RightColumnClass ?>"><div <?php echo $clientes_edit->celularwhatsapp->cellAttributes() ?>>
<span id="el_clientes_celularwhatsapp">
<input type="text" data-table="clientes" data-field="x_celularwhatsapp" name="x_celularwhatsapp" id="x_celularwhatsapp" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($clientes_edit->celularwhatsapp->getPlaceHolder()) ?>" value="<?php echo $clientes_edit->celularwhatsapp->EditValue ?>"<?php echo $clientes_edit->celularwhatsapp->editAttributes() ?>>
</span>
<?php echo $clientes_edit->celularwhatsapp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_edit->endereco->Visible) { // endereco ?>
	<div id="r_endereco" class="form-group row">
		<label id="elh_clientes_endereco" for="x_endereco" class="<?php echo $clientes_edit->LeftColumnClass ?>"><?php echo $clientes_edit->endereco->caption() ?><?php echo $clientes_edit->endereco->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_edit->RightColumnClass ?>"><div <?php echo $clientes_edit->endereco->cellAttributes() ?>>
<span id="el_clientes_endereco">
<input type="text" data-table="clientes" data-field="x_endereco" name="x_endereco" id="x_endereco" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($clientes_edit->endereco->getPlaceHolder()) ?>" value="<?php echo $clientes_edit->endereco->EditValue ?>"<?php echo $clientes_edit->endereco->editAttributes() ?>>
</span>
<?php echo $clientes_edit->endereco->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_edit->numero->Visible) { // numero ?>
	<div id="r_numero" class="form-group row">
		<label id="elh_clientes_numero" for="x_numero" class="<?php echo $clientes_edit->LeftColumnClass ?>"><?php echo $clientes_edit->numero->caption() ?><?php echo $clientes_edit->numero->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_edit->RightColumnClass ?>"><div <?php echo $clientes_edit->numero->cellAttributes() ?>>
<span id="el_clientes_numero">
<input type="text" data-table="clientes" data-field="x_numero" name="x_numero" id="x_numero" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($clientes_edit->numero->getPlaceHolder()) ?>" value="<?php echo $clientes_edit->numero->EditValue ?>"<?php echo $clientes_edit->numero->editAttributes() ?>>
</span>
<?php echo $clientes_edit->numero->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_edit->bairro->Visible) { // bairro ?>
	<div id="r_bairro" class="form-group row">
		<label id="elh_clientes_bairro" for="x_bairro" class="<?php echo $clientes_edit->LeftColumnClass ?>"><?php echo $clientes_edit->bairro->caption() ?><?php echo $clientes_edit->bairro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_edit->RightColumnClass ?>"><div <?php echo $clientes_edit->bairro->cellAttributes() ?>>
<span id="el_clientes_bairro">
<input type="text" data-table="clientes" data-field="x_bairro" name="x_bairro" id="x_bairro" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($clientes_edit->bairro->getPlaceHolder()) ?>" value="<?php echo $clientes_edit->bairro->EditValue ?>"<?php echo $clientes_edit->bairro->editAttributes() ?>>
</span>
<?php echo $clientes_edit->bairro->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_edit->complemento->Visible) { // complemento ?>
	<div id="r_complemento" class="form-group row">
		<label id="elh_clientes_complemento" for="x_complemento" class="<?php echo $clientes_edit->LeftColumnClass ?>"><?php echo $clientes_edit->complemento->caption() ?><?php echo $clientes_edit->complemento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_edit->RightColumnClass ?>"><div <?php echo $clientes_edit->complemento->cellAttributes() ?>>
<span id="el_clientes_complemento">
<input type="text" data-table="clientes" data-field="x_complemento" name="x_complemento" id="x_complemento" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($clientes_edit->complemento->getPlaceHolder()) ?>" value="<?php echo $clientes_edit->complemento->EditValue ?>"<?php echo $clientes_edit->complemento->editAttributes() ?>>
</span>
<?php echo $clientes_edit->complemento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_edit->cep->Visible) { // cep ?>
	<div id="r_cep" class="form-group row">
		<label id="elh_clientes_cep" for="x_cep" class="<?php echo $clientes_edit->LeftColumnClass ?>"><?php echo $clientes_edit->cep->caption() ?><?php echo $clientes_edit->cep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_edit->RightColumnClass ?>"><div <?php echo $clientes_edit->cep->cellAttributes() ?>>
<span id="el_clientes_cep">
<input type="text" data-table="clientes" data-field="x_cep" name="x_cep" id="x_cep" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($clientes_edit->cep->getPlaceHolder()) ?>" value="<?php echo $clientes_edit->cep->EditValue ?>"<?php echo $clientes_edit->cep->editAttributes() ?>>
</span>
<?php echo $clientes_edit->cep->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_clientes__email" for="x__email" class="<?php echo $clientes_edit->LeftColumnClass ?>"><?php echo $clientes_edit->_email->caption() ?><?php echo $clientes_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_edit->RightColumnClass ?>"><div <?php echo $clientes_edit->_email->cellAttributes() ?>>
<span id="el_clientes__email">
<input type="text" data-table="clientes" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($clientes_edit->_email->getPlaceHolder()) ?>" value="<?php echo $clientes_edit->_email->EditValue ?>"<?php echo $clientes_edit->_email->editAttributes() ?>>
</span>
<?php echo $clientes_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$clientes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $clientes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $clientes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$clientes_edit->showPageFooter();
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
$clientes_edit->terminate();
?>