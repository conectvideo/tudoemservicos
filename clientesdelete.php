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
$clientes_delete = new clientes_delete();

// Run the page
$clientes_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$clientes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclientesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fclientesdelete = currentForm = new ew.Form("fclientesdelete", "delete");
	loadjs.done("fclientesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $clientes_delete->showPageHeader(); ?>
<?php
$clientes_delete->showMessage();
?>
<form name="fclientesdelete" id="fclientesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="clientes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($clientes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($clientes_delete->idclientes->Visible) { // idclientes ?>
		<th class="<?php echo $clientes_delete->idclientes->headerCellClass() ?>"><span id="elh_clientes_idclientes" class="clientes_idclientes"><?php echo $clientes_delete->idclientes->caption() ?></span></th>
<?php } ?>
<?php if ($clientes_delete->nome->Visible) { // nome ?>
		<th class="<?php echo $clientes_delete->nome->headerCellClass() ?>"><span id="elh_clientes_nome" class="clientes_nome"><?php echo $clientes_delete->nome->caption() ?></span></th>
<?php } ?>
<?php if ($clientes_delete->cpf->Visible) { // cpf ?>
		<th class="<?php echo $clientes_delete->cpf->headerCellClass() ?>"><span id="elh_clientes_cpf" class="clientes_cpf"><?php echo $clientes_delete->cpf->caption() ?></span></th>
<?php } ?>
<?php if ($clientes_delete->rg->Visible) { // rg ?>
		<th class="<?php echo $clientes_delete->rg->headerCellClass() ?>"><span id="elh_clientes_rg" class="clientes_rg"><?php echo $clientes_delete->rg->caption() ?></span></th>
<?php } ?>
<?php if ($clientes_delete->telefonefixo->Visible) { // telefonefixo ?>
		<th class="<?php echo $clientes_delete->telefonefixo->headerCellClass() ?>"><span id="elh_clientes_telefonefixo" class="clientes_telefonefixo"><?php echo $clientes_delete->telefonefixo->caption() ?></span></th>
<?php } ?>
<?php if ($clientes_delete->celularwhatsapp->Visible) { // celularwhatsapp ?>
		<th class="<?php echo $clientes_delete->celularwhatsapp->headerCellClass() ?>"><span id="elh_clientes_celularwhatsapp" class="clientes_celularwhatsapp"><?php echo $clientes_delete->celularwhatsapp->caption() ?></span></th>
<?php } ?>
<?php if ($clientes_delete->endereco->Visible) { // endereco ?>
		<th class="<?php echo $clientes_delete->endereco->headerCellClass() ?>"><span id="elh_clientes_endereco" class="clientes_endereco"><?php echo $clientes_delete->endereco->caption() ?></span></th>
<?php } ?>
<?php if ($clientes_delete->numero->Visible) { // numero ?>
		<th class="<?php echo $clientes_delete->numero->headerCellClass() ?>"><span id="elh_clientes_numero" class="clientes_numero"><?php echo $clientes_delete->numero->caption() ?></span></th>
<?php } ?>
<?php if ($clientes_delete->bairro->Visible) { // bairro ?>
		<th class="<?php echo $clientes_delete->bairro->headerCellClass() ?>"><span id="elh_clientes_bairro" class="clientes_bairro"><?php echo $clientes_delete->bairro->caption() ?></span></th>
<?php } ?>
<?php if ($clientes_delete->complemento->Visible) { // complemento ?>
		<th class="<?php echo $clientes_delete->complemento->headerCellClass() ?>"><span id="elh_clientes_complemento" class="clientes_complemento"><?php echo $clientes_delete->complemento->caption() ?></span></th>
<?php } ?>
<?php if ($clientes_delete->cep->Visible) { // cep ?>
		<th class="<?php echo $clientes_delete->cep->headerCellClass() ?>"><span id="elh_clientes_cep" class="clientes_cep"><?php echo $clientes_delete->cep->caption() ?></span></th>
<?php } ?>
<?php if ($clientes_delete->_email->Visible) { // email ?>
		<th class="<?php echo $clientes_delete->_email->headerCellClass() ?>"><span id="elh_clientes__email" class="clientes__email"><?php echo $clientes_delete->_email->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$clientes_delete->RecordCount = 0;
$i = 0;
while (!$clientes_delete->Recordset->EOF) {
	$clientes_delete->RecordCount++;
	$clientes_delete->RowCount++;

	// Set row properties
	$clientes->resetAttributes();
	$clientes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$clientes_delete->loadRowValues($clientes_delete->Recordset);

	// Render row
	$clientes_delete->renderRow();
?>
	<tr <?php echo $clientes->rowAttributes() ?>>
<?php if ($clientes_delete->idclientes->Visible) { // idclientes ?>
		<td <?php echo $clientes_delete->idclientes->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCount ?>_clientes_idclientes" class="clientes_idclientes">
<span<?php echo $clientes_delete->idclientes->viewAttributes() ?>><?php echo $clientes_delete->idclientes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes_delete->nome->Visible) { // nome ?>
		<td <?php echo $clientes_delete->nome->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCount ?>_clientes_nome" class="clientes_nome">
<span<?php echo $clientes_delete->nome->viewAttributes() ?>><?php echo $clientes_delete->nome->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes_delete->cpf->Visible) { // cpf ?>
		<td <?php echo $clientes_delete->cpf->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCount ?>_clientes_cpf" class="clientes_cpf">
<span<?php echo $clientes_delete->cpf->viewAttributes() ?>><?php echo $clientes_delete->cpf->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes_delete->rg->Visible) { // rg ?>
		<td <?php echo $clientes_delete->rg->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCount ?>_clientes_rg" class="clientes_rg">
<span<?php echo $clientes_delete->rg->viewAttributes() ?>><?php echo $clientes_delete->rg->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes_delete->telefonefixo->Visible) { // telefonefixo ?>
		<td <?php echo $clientes_delete->telefonefixo->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCount ?>_clientes_telefonefixo" class="clientes_telefonefixo">
<span<?php echo $clientes_delete->telefonefixo->viewAttributes() ?>><?php echo $clientes_delete->telefonefixo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes_delete->celularwhatsapp->Visible) { // celularwhatsapp ?>
		<td <?php echo $clientes_delete->celularwhatsapp->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCount ?>_clientes_celularwhatsapp" class="clientes_celularwhatsapp">
<span<?php echo $clientes_delete->celularwhatsapp->viewAttributes() ?>><?php echo $clientes_delete->celularwhatsapp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes_delete->endereco->Visible) { // endereco ?>
		<td <?php echo $clientes_delete->endereco->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCount ?>_clientes_endereco" class="clientes_endereco">
<span<?php echo $clientes_delete->endereco->viewAttributes() ?>><?php echo $clientes_delete->endereco->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes_delete->numero->Visible) { // numero ?>
		<td <?php echo $clientes_delete->numero->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCount ?>_clientes_numero" class="clientes_numero">
<span<?php echo $clientes_delete->numero->viewAttributes() ?>><?php echo $clientes_delete->numero->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes_delete->bairro->Visible) { // bairro ?>
		<td <?php echo $clientes_delete->bairro->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCount ?>_clientes_bairro" class="clientes_bairro">
<span<?php echo $clientes_delete->bairro->viewAttributes() ?>><?php echo $clientes_delete->bairro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes_delete->complemento->Visible) { // complemento ?>
		<td <?php echo $clientes_delete->complemento->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCount ?>_clientes_complemento" class="clientes_complemento">
<span<?php echo $clientes_delete->complemento->viewAttributes() ?>><?php echo $clientes_delete->complemento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes_delete->cep->Visible) { // cep ?>
		<td <?php echo $clientes_delete->cep->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCount ?>_clientes_cep" class="clientes_cep">
<span<?php echo $clientes_delete->cep->viewAttributes() ?>><?php echo $clientes_delete->cep->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($clientes_delete->_email->Visible) { // email ?>
		<td <?php echo $clientes_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $clientes_delete->RowCount ?>_clientes__email" class="clientes__email">
<span<?php echo $clientes_delete->_email->viewAttributes() ?>><?php echo $clientes_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$clientes_delete->Recordset->moveNext();
}
$clientes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $clientes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$clientes_delete->showPageFooter();
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
$clientes_delete->terminate();
?>