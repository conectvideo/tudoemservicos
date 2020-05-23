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
$agenda_delete = new agenda_delete();

// Run the page
$agenda_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agenda_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fagendadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fagendadelete = currentForm = new ew.Form("fagendadelete", "delete");
	loadjs.done("fagendadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $agenda_delete->showPageHeader(); ?>
<?php
$agenda_delete->showMessage();
?>
<form name="fagendadelete" id="fagendadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agenda">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($agenda_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($agenda_delete->idagenda->Visible) { // idagenda ?>
		<th class="<?php echo $agenda_delete->idagenda->headerCellClass() ?>"><span id="elh_agenda_idagenda" class="agenda_idagenda"><?php echo $agenda_delete->idagenda->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_delete->datainicio->Visible) { // datainicio ?>
		<th class="<?php echo $agenda_delete->datainicio->headerCellClass() ?>"><span id="elh_agenda_datainicio" class="agenda_datainicio"><?php echo $agenda_delete->datainicio->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_delete->datafinal->Visible) { // datafinal ?>
		<th class="<?php echo $agenda_delete->datafinal->headerCellClass() ?>"><span id="elh_agenda_datafinal" class="agenda_datafinal"><?php echo $agenda_delete->datafinal->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_delete->idprofissional->Visible) { // idprofissional ?>
		<th class="<?php echo $agenda_delete->idprofissional->headerCellClass() ?>"><span id="elh_agenda_idprofissional" class="agenda_idprofissional"><?php echo $agenda_delete->idprofissional->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_delete->idcliente->Visible) { // idcliente ?>
		<th class="<?php echo $agenda_delete->idcliente->headerCellClass() ?>"><span id="elh_agenda_idcliente" class="agenda_idcliente"><?php echo $agenda_delete->idcliente->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_delete->idservico->Visible) { // idservico ?>
		<th class="<?php echo $agenda_delete->idservico->headerCellClass() ?>"><span id="elh_agenda_idservico" class="agenda_idservico"><?php echo $agenda_delete->idservico->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$agenda_delete->RecordCount = 0;
$i = 0;
while (!$agenda_delete->Recordset->EOF) {
	$agenda_delete->RecordCount++;
	$agenda_delete->RowCount++;

	// Set row properties
	$agenda->resetAttributes();
	$agenda->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$agenda_delete->loadRowValues($agenda_delete->Recordset);

	// Render row
	$agenda_delete->renderRow();
?>
	<tr <?php echo $agenda->rowAttributes() ?>>
<?php if ($agenda_delete->idagenda->Visible) { // idagenda ?>
		<td <?php echo $agenda_delete->idagenda->cellAttributes() ?>>
<span id="el<?php echo $agenda_delete->RowCount ?>_agenda_idagenda" class="agenda_idagenda">
<span<?php echo $agenda_delete->idagenda->viewAttributes() ?>><?php echo $agenda_delete->idagenda->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_delete->datainicio->Visible) { // datainicio ?>
		<td <?php echo $agenda_delete->datainicio->cellAttributes() ?>>
<span id="el<?php echo $agenda_delete->RowCount ?>_agenda_datainicio" class="agenda_datainicio">
<span<?php echo $agenda_delete->datainicio->viewAttributes() ?>><?php echo $agenda_delete->datainicio->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_delete->datafinal->Visible) { // datafinal ?>
		<td <?php echo $agenda_delete->datafinal->cellAttributes() ?>>
<span id="el<?php echo $agenda_delete->RowCount ?>_agenda_datafinal" class="agenda_datafinal">
<span<?php echo $agenda_delete->datafinal->viewAttributes() ?>><?php echo $agenda_delete->datafinal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_delete->idprofissional->Visible) { // idprofissional ?>
		<td <?php echo $agenda_delete->idprofissional->cellAttributes() ?>>
<span id="el<?php echo $agenda_delete->RowCount ?>_agenda_idprofissional" class="agenda_idprofissional">
<span<?php echo $agenda_delete->idprofissional->viewAttributes() ?>><?php echo $agenda_delete->idprofissional->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_delete->idcliente->Visible) { // idcliente ?>
		<td <?php echo $agenda_delete->idcliente->cellAttributes() ?>>
<span id="el<?php echo $agenda_delete->RowCount ?>_agenda_idcliente" class="agenda_idcliente">
<span<?php echo $agenda_delete->idcliente->viewAttributes() ?>><?php echo $agenda_delete->idcliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_delete->idservico->Visible) { // idservico ?>
		<td <?php echo $agenda_delete->idservico->cellAttributes() ?>>
<span id="el<?php echo $agenda_delete->RowCount ?>_agenda_idservico" class="agenda_idservico">
<span<?php echo $agenda_delete->idservico->viewAttributes() ?>><?php echo $agenda_delete->idservico->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$agenda_delete->Recordset->moveNext();
}
$agenda_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $agenda_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$agenda_delete->showPageFooter();
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
$agenda_delete->terminate();
?>