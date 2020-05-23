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
$clientes_view = new clientes_view();

// Run the page
$clientes_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$clientes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$clientes_view->isExport()) { ?>
<script>
var fclientesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fclientesview = currentForm = new ew.Form("fclientesview", "view");
	loadjs.done("fclientesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$clientes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $clientes_view->ExportOptions->render("body") ?>
<?php $clientes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $clientes_view->showPageHeader(); ?>
<?php
$clientes_view->showMessage();
?>
<form name="fclientesview" id="fclientesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="clientes">
<input type="hidden" name="modal" value="<?php echo (int)$clientes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($clientes_view->idclientes->Visible) { // idclientes ?>
	<tr id="r_idclientes">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_idclientes"><?php echo $clientes_view->idclientes->caption() ?></span></td>
		<td data-name="idclientes" <?php echo $clientes_view->idclientes->cellAttributes() ?>>
<span id="el_clientes_idclientes">
<span<?php echo $clientes_view->idclientes->viewAttributes() ?>><?php echo $clientes_view->idclientes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes_view->nome->Visible) { // nome ?>
	<tr id="r_nome">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_nome"><?php echo $clientes_view->nome->caption() ?></span></td>
		<td data-name="nome" <?php echo $clientes_view->nome->cellAttributes() ?>>
<span id="el_clientes_nome">
<span<?php echo $clientes_view->nome->viewAttributes() ?>><?php echo $clientes_view->nome->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes_view->cpf->Visible) { // cpf ?>
	<tr id="r_cpf">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_cpf"><?php echo $clientes_view->cpf->caption() ?></span></td>
		<td data-name="cpf" <?php echo $clientes_view->cpf->cellAttributes() ?>>
<span id="el_clientes_cpf">
<span<?php echo $clientes_view->cpf->viewAttributes() ?>><?php echo $clientes_view->cpf->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes_view->rg->Visible) { // rg ?>
	<tr id="r_rg">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_rg"><?php echo $clientes_view->rg->caption() ?></span></td>
		<td data-name="rg" <?php echo $clientes_view->rg->cellAttributes() ?>>
<span id="el_clientes_rg">
<span<?php echo $clientes_view->rg->viewAttributes() ?>><?php echo $clientes_view->rg->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes_view->telefonefixo->Visible) { // telefonefixo ?>
	<tr id="r_telefonefixo">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_telefonefixo"><?php echo $clientes_view->telefonefixo->caption() ?></span></td>
		<td data-name="telefonefixo" <?php echo $clientes_view->telefonefixo->cellAttributes() ?>>
<span id="el_clientes_telefonefixo">
<span<?php echo $clientes_view->telefonefixo->viewAttributes() ?>><?php echo $clientes_view->telefonefixo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes_view->celularwhatsapp->Visible) { // celularwhatsapp ?>
	<tr id="r_celularwhatsapp">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_celularwhatsapp"><?php echo $clientes_view->celularwhatsapp->caption() ?></span></td>
		<td data-name="celularwhatsapp" <?php echo $clientes_view->celularwhatsapp->cellAttributes() ?>>
<span id="el_clientes_celularwhatsapp">
<span<?php echo $clientes_view->celularwhatsapp->viewAttributes() ?>><?php echo $clientes_view->celularwhatsapp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes_view->endereco->Visible) { // endereco ?>
	<tr id="r_endereco">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_endereco"><?php echo $clientes_view->endereco->caption() ?></span></td>
		<td data-name="endereco" <?php echo $clientes_view->endereco->cellAttributes() ?>>
<span id="el_clientes_endereco">
<span<?php echo $clientes_view->endereco->viewAttributes() ?>><?php echo $clientes_view->endereco->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes_view->numero->Visible) { // numero ?>
	<tr id="r_numero">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_numero"><?php echo $clientes_view->numero->caption() ?></span></td>
		<td data-name="numero" <?php echo $clientes_view->numero->cellAttributes() ?>>
<span id="el_clientes_numero">
<span<?php echo $clientes_view->numero->viewAttributes() ?>><?php echo $clientes_view->numero->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes_view->bairro->Visible) { // bairro ?>
	<tr id="r_bairro">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_bairro"><?php echo $clientes_view->bairro->caption() ?></span></td>
		<td data-name="bairro" <?php echo $clientes_view->bairro->cellAttributes() ?>>
<span id="el_clientes_bairro">
<span<?php echo $clientes_view->bairro->viewAttributes() ?>><?php echo $clientes_view->bairro->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes_view->complemento->Visible) { // complemento ?>
	<tr id="r_complemento">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_complemento"><?php echo $clientes_view->complemento->caption() ?></span></td>
		<td data-name="complemento" <?php echo $clientes_view->complemento->cellAttributes() ?>>
<span id="el_clientes_complemento">
<span<?php echo $clientes_view->complemento->viewAttributes() ?>><?php echo $clientes_view->complemento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes_view->cep->Visible) { // cep ?>
	<tr id="r_cep">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes_cep"><?php echo $clientes_view->cep->caption() ?></span></td>
		<td data-name="cep" <?php echo $clientes_view->cep->cellAttributes() ?>>
<span id="el_clientes_cep">
<span<?php echo $clientes_view->cep->viewAttributes() ?>><?php echo $clientes_view->cep->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($clientes_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $clientes_view->TableLeftColumnClass ?>"><span id="elh_clientes__email"><?php echo $clientes_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $clientes_view->_email->cellAttributes() ?>>
<span id="el_clientes__email">
<span<?php echo $clientes_view->_email->viewAttributes() ?>><?php echo $clientes_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$clientes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$clientes_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$clientes_view->terminate();
?>