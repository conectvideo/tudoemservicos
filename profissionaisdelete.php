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
$profissionais_delete = new profissionais_delete();

// Run the page
$profissionais_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$profissionais_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprofissionaisdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fprofissionaisdelete = currentForm = new ew.Form("fprofissionaisdelete", "delete");
	loadjs.done("fprofissionaisdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $profissionais_delete->showPageHeader(); ?>
<?php
$profissionais_delete->showMessage();
?>
<form name="fprofissionaisdelete" id="fprofissionaisdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="profissionais">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($profissionais_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($profissionais_delete->idprofissionais->Visible) { // idprofissionais ?>
		<th class="<?php echo $profissionais_delete->idprofissionais->headerCellClass() ?>"><span id="elh_profissionais_idprofissionais" class="profissionais_idprofissionais"><?php echo $profissionais_delete->idprofissionais->caption() ?></span></th>
<?php } ?>
<?php if ($profissionais_delete->nome->Visible) { // nome ?>
		<th class="<?php echo $profissionais_delete->nome->headerCellClass() ?>"><span id="elh_profissionais_nome" class="profissionais_nome"><?php echo $profissionais_delete->nome->caption() ?></span></th>
<?php } ?>
<?php if ($profissionais_delete->telefone->Visible) { // telefone ?>
		<th class="<?php echo $profissionais_delete->telefone->headerCellClass() ?>"><span id="elh_profissionais_telefone" class="profissionais_telefone"><?php echo $profissionais_delete->telefone->caption() ?></span></th>
<?php } ?>
<?php if ($profissionais_delete->whatsapp->Visible) { // whatsapp ?>
		<th class="<?php echo $profissionais_delete->whatsapp->headerCellClass() ?>"><span id="elh_profissionais_whatsapp" class="profissionais_whatsapp"><?php echo $profissionais_delete->whatsapp->caption() ?></span></th>
<?php } ?>
<?php if ($profissionais_delete->_email->Visible) { // email ?>
		<th class="<?php echo $profissionais_delete->_email->headerCellClass() ?>"><span id="elh_profissionais__email" class="profissionais__email"><?php echo $profissionais_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($profissionais_delete->idarea->Visible) { // idarea ?>
		<th class="<?php echo $profissionais_delete->idarea->headerCellClass() ?>"><span id="elh_profissionais_idarea" class="profissionais_idarea"><?php echo $profissionais_delete->idarea->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$profissionais_delete->RecordCount = 0;
$i = 0;
while (!$profissionais_delete->Recordset->EOF) {
	$profissionais_delete->RecordCount++;
	$profissionais_delete->RowCount++;

	// Set row properties
	$profissionais->resetAttributes();
	$profissionais->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$profissionais_delete->loadRowValues($profissionais_delete->Recordset);

	// Render row
	$profissionais_delete->renderRow();
?>
	<tr <?php echo $profissionais->rowAttributes() ?>>
<?php if ($profissionais_delete->idprofissionais->Visible) { // idprofissionais ?>
		<td <?php echo $profissionais_delete->idprofissionais->cellAttributes() ?>>
<span id="el<?php echo $profissionais_delete->RowCount ?>_profissionais_idprofissionais" class="profissionais_idprofissionais">
<span<?php echo $profissionais_delete->idprofissionais->viewAttributes() ?>><?php echo $profissionais_delete->idprofissionais->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($profissionais_delete->nome->Visible) { // nome ?>
		<td <?php echo $profissionais_delete->nome->cellAttributes() ?>>
<span id="el<?php echo $profissionais_delete->RowCount ?>_profissionais_nome" class="profissionais_nome">
<span<?php echo $profissionais_delete->nome->viewAttributes() ?>><?php echo $profissionais_delete->nome->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($profissionais_delete->telefone->Visible) { // telefone ?>
		<td <?php echo $profissionais_delete->telefone->cellAttributes() ?>>
<span id="el<?php echo $profissionais_delete->RowCount ?>_profissionais_telefone" class="profissionais_telefone">
<span<?php echo $profissionais_delete->telefone->viewAttributes() ?>><?php echo $profissionais_delete->telefone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($profissionais_delete->whatsapp->Visible) { // whatsapp ?>
		<td <?php echo $profissionais_delete->whatsapp->cellAttributes() ?>>
<span id="el<?php echo $profissionais_delete->RowCount ?>_profissionais_whatsapp" class="profissionais_whatsapp">
<span<?php echo $profissionais_delete->whatsapp->viewAttributes() ?>><?php echo $profissionais_delete->whatsapp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($profissionais_delete->_email->Visible) { // email ?>
		<td <?php echo $profissionais_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $profissionais_delete->RowCount ?>_profissionais__email" class="profissionais__email">
<span<?php echo $profissionais_delete->_email->viewAttributes() ?>><?php echo $profissionais_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($profissionais_delete->idarea->Visible) { // idarea ?>
		<td <?php echo $profissionais_delete->idarea->cellAttributes() ?>>
<span id="el<?php echo $profissionais_delete->RowCount ?>_profissionais_idarea" class="profissionais_idarea">
<span<?php echo $profissionais_delete->idarea->viewAttributes() ?>><?php echo $profissionais_delete->idarea->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$profissionais_delete->Recordset->moveNext();
}
$profissionais_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $profissionais_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$profissionais_delete->showPageFooter();
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
$profissionais_delete->terminate();
?>