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
$clientes_add = new clientes_add();

// Run the page
$clientes_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$clientes_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclientesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fclientesadd = currentForm = new ew.Form("fclientesadd", "add");

	// Validate form
	fclientesadd.validate = function() {
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
			<?php if ($clientes_add->nome->Required) { ?>
				elm = this.getElements("x" + infix + "_nome");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_add->nome->caption(), $clientes_add->nome->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_add->cpf->Required) { ?>
				elm = this.getElements("x" + infix + "_cpf");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_add->cpf->caption(), $clientes_add->cpf->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_add->rg->Required) { ?>
				elm = this.getElements("x" + infix + "_rg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_add->rg->caption(), $clientes_add->rg->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_add->telefonefixo->Required) { ?>
				elm = this.getElements("x" + infix + "_telefonefixo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_add->telefonefixo->caption(), $clientes_add->telefonefixo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_add->celularwhatsapp->Required) { ?>
				elm = this.getElements("x" + infix + "_celularwhatsapp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_add->celularwhatsapp->caption(), $clientes_add->celularwhatsapp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_add->endereco->Required) { ?>
				elm = this.getElements("x" + infix + "_endereco");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_add->endereco->caption(), $clientes_add->endereco->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_add->numero->Required) { ?>
				elm = this.getElements("x" + infix + "_numero");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_add->numero->caption(), $clientes_add->numero->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_add->bairro->Required) { ?>
				elm = this.getElements("x" + infix + "_bairro");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_add->bairro->caption(), $clientes_add->bairro->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_add->complemento->Required) { ?>
				elm = this.getElements("x" + infix + "_complemento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_add->complemento->caption(), $clientes_add->complemento->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_add->cep->Required) { ?>
				elm = this.getElements("x" + infix + "_cep");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_add->cep->caption(), $clientes_add->cep->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($clientes_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $clientes_add->_email->caption(), $clientes_add->_email->RequiredErrorMessage)) ?>");
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
	fclientesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fclientesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fclientesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $clientes_add->showPageHeader(); ?>
<?php
$clientes_add->showMessage();
?>
<form name="fclientesadd" id="fclientesadd" class="<?php echo $clientes_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="clientes">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$clientes_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($clientes_add->nome->Visible) { // nome ?>
	<div id="r_nome" class="form-group row">
		<label id="elh_clientes_nome" for="x_nome" class="<?php echo $clientes_add->LeftColumnClass ?>"><?php echo $clientes_add->nome->caption() ?><?php echo $clientes_add->nome->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_add->RightColumnClass ?>"><div <?php echo $clientes_add->nome->cellAttributes() ?>>
<span id="el_clientes_nome">
<input type="text" data-table="clientes" data-field="x_nome" name="x_nome" id="x_nome" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($clientes_add->nome->getPlaceHolder()) ?>" value="<?php echo $clientes_add->nome->EditValue ?>"<?php echo $clientes_add->nome->editAttributes() ?>>
</span>
<?php echo $clientes_add->nome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_add->cpf->Visible) { // cpf ?>
	<div id="r_cpf" class="form-group row">
		<label id="elh_clientes_cpf" for="x_cpf" class="<?php echo $clientes_add->LeftColumnClass ?>"><?php echo $clientes_add->cpf->caption() ?><?php echo $clientes_add->cpf->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_add->RightColumnClass ?>"><div <?php echo $clientes_add->cpf->cellAttributes() ?>>
<span id="el_clientes_cpf">
<input type="text" data-table="clientes" data-field="x_cpf" name="x_cpf" id="x_cpf" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($clientes_add->cpf->getPlaceHolder()) ?>" value="<?php echo $clientes_add->cpf->EditValue ?>"<?php echo $clientes_add->cpf->editAttributes() ?>>
</span>
<?php echo $clientes_add->cpf->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_add->rg->Visible) { // rg ?>
	<div id="r_rg" class="form-group row">
		<label id="elh_clientes_rg" for="x_rg" class="<?php echo $clientes_add->LeftColumnClass ?>"><?php echo $clientes_add->rg->caption() ?><?php echo $clientes_add->rg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_add->RightColumnClass ?>"><div <?php echo $clientes_add->rg->cellAttributes() ?>>
<span id="el_clientes_rg">
<input type="text" data-table="clientes" data-field="x_rg" name="x_rg" id="x_rg" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($clientes_add->rg->getPlaceHolder()) ?>" value="<?php echo $clientes_add->rg->EditValue ?>"<?php echo $clientes_add->rg->editAttributes() ?>>
</span>
<?php echo $clientes_add->rg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_add->telefonefixo->Visible) { // telefonefixo ?>
	<div id="r_telefonefixo" class="form-group row">
		<label id="elh_clientes_telefonefixo" for="x_telefonefixo" class="<?php echo $clientes_add->LeftColumnClass ?>"><?php echo $clientes_add->telefonefixo->caption() ?><?php echo $clientes_add->telefonefixo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_add->RightColumnClass ?>"><div <?php echo $clientes_add->telefonefixo->cellAttributes() ?>>
<span id="el_clientes_telefonefixo">
<input type="text" data-table="clientes" data-field="x_telefonefixo" name="x_telefonefixo" id="x_telefonefixo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($clientes_add->telefonefixo->getPlaceHolder()) ?>" value="<?php echo $clientes_add->telefonefixo->EditValue ?>"<?php echo $clientes_add->telefonefixo->editAttributes() ?>>
</span>
<?php echo $clientes_add->telefonefixo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_add->celularwhatsapp->Visible) { // celularwhatsapp ?>
	<div id="r_celularwhatsapp" class="form-group row">
		<label id="elh_clientes_celularwhatsapp" for="x_celularwhatsapp" class="<?php echo $clientes_add->LeftColumnClass ?>"><?php echo $clientes_add->celularwhatsapp->caption() ?><?php echo $clientes_add->celularwhatsapp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_add->RightColumnClass ?>"><div <?php echo $clientes_add->celularwhatsapp->cellAttributes() ?>>
<span id="el_clientes_celularwhatsapp">
<input type="text" data-table="clientes" data-field="x_celularwhatsapp" name="x_celularwhatsapp" id="x_celularwhatsapp" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($clientes_add->celularwhatsapp->getPlaceHolder()) ?>" value="<?php echo $clientes_add->celularwhatsapp->EditValue ?>"<?php echo $clientes_add->celularwhatsapp->editAttributes() ?>>
</span>
<?php echo $clientes_add->celularwhatsapp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_add->endereco->Visible) { // endereco ?>
	<div id="r_endereco" class="form-group row">
		<label id="elh_clientes_endereco" for="x_endereco" class="<?php echo $clientes_add->LeftColumnClass ?>"><?php echo $clientes_add->endereco->caption() ?><?php echo $clientes_add->endereco->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_add->RightColumnClass ?>"><div <?php echo $clientes_add->endereco->cellAttributes() ?>>
<span id="el_clientes_endereco">
<input type="text" data-table="clientes" data-field="x_endereco" name="x_endereco" id="x_endereco" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($clientes_add->endereco->getPlaceHolder()) ?>" value="<?php echo $clientes_add->endereco->EditValue ?>"<?php echo $clientes_add->endereco->editAttributes() ?>>
</span>
<?php echo $clientes_add->endereco->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_add->numero->Visible) { // numero ?>
	<div id="r_numero" class="form-group row">
		<label id="elh_clientes_numero" for="x_numero" class="<?php echo $clientes_add->LeftColumnClass ?>"><?php echo $clientes_add->numero->caption() ?><?php echo $clientes_add->numero->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_add->RightColumnClass ?>"><div <?php echo $clientes_add->numero->cellAttributes() ?>>
<span id="el_clientes_numero">
<input type="text" data-table="clientes" data-field="x_numero" name="x_numero" id="x_numero" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($clientes_add->numero->getPlaceHolder()) ?>" value="<?php echo $clientes_add->numero->EditValue ?>"<?php echo $clientes_add->numero->editAttributes() ?>>
</span>
<?php echo $clientes_add->numero->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_add->bairro->Visible) { // bairro ?>
	<div id="r_bairro" class="form-group row">
		<label id="elh_clientes_bairro" for="x_bairro" class="<?php echo $clientes_add->LeftColumnClass ?>"><?php echo $clientes_add->bairro->caption() ?><?php echo $clientes_add->bairro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_add->RightColumnClass ?>"><div <?php echo $clientes_add->bairro->cellAttributes() ?>>
<span id="el_clientes_bairro">
<input type="text" data-table="clientes" data-field="x_bairro" name="x_bairro" id="x_bairro" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($clientes_add->bairro->getPlaceHolder()) ?>" value="<?php echo $clientes_add->bairro->EditValue ?>"<?php echo $clientes_add->bairro->editAttributes() ?>>
</span>
<?php echo $clientes_add->bairro->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_add->complemento->Visible) { // complemento ?>
	<div id="r_complemento" class="form-group row">
		<label id="elh_clientes_complemento" for="x_complemento" class="<?php echo $clientes_add->LeftColumnClass ?>"><?php echo $clientes_add->complemento->caption() ?><?php echo $clientes_add->complemento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_add->RightColumnClass ?>"><div <?php echo $clientes_add->complemento->cellAttributes() ?>>
<span id="el_clientes_complemento">
<input type="text" data-table="clientes" data-field="x_complemento" name="x_complemento" id="x_complemento" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($clientes_add->complemento->getPlaceHolder()) ?>" value="<?php echo $clientes_add->complemento->EditValue ?>"<?php echo $clientes_add->complemento->editAttributes() ?>>
</span>
<?php echo $clientes_add->complemento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_add->cep->Visible) { // cep ?>
	<div id="r_cep" class="form-group row">
		<label id="elh_clientes_cep" for="x_cep" class="<?php echo $clientes_add->LeftColumnClass ?>"><?php echo $clientes_add->cep->caption() ?><?php echo $clientes_add->cep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_add->RightColumnClass ?>"><div <?php echo $clientes_add->cep->cellAttributes() ?>>
<span id="el_clientes_cep">
<input type="text" data-table="clientes" data-field="x_cep" name="x_cep" id="x_cep" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($clientes_add->cep->getPlaceHolder()) ?>" value="<?php echo $clientes_add->cep->EditValue ?>"<?php echo $clientes_add->cep->editAttributes() ?>>
</span>
<?php echo $clientes_add->cep->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($clientes_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_clientes__email" for="x__email" class="<?php echo $clientes_add->LeftColumnClass ?>"><?php echo $clientes_add->_email->caption() ?><?php echo $clientes_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $clientes_add->RightColumnClass ?>"><div <?php echo $clientes_add->_email->cellAttributes() ?>>
<span id="el_clientes__email">
<input type="text" data-table="clientes" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($clientes_add->_email->getPlaceHolder()) ?>" value="<?php echo $clientes_add->_email->EditValue ?>"<?php echo $clientes_add->_email->editAttributes() ?>>
</span>
<?php echo $clientes_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$clientes_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $clientes_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $clientes_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$clientes_add->showPageFooter();
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
$clientes_add->terminate();
?>