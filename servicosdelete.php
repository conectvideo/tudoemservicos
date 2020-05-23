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
$servicos_delete = new servicos_delete();

// Run the page
$servicos_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$servicos_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fservicosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fservicosdelete = currentForm = new ew.Form("fservicosdelete", "delete");
	loadjs.done("fservicosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $servicos_delete->showPageHeader(); ?>
<?php
$servicos_delete->showMessage();
?>
<form name="fservicosdelete" id="fservicosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="servicos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($servicos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($servicos_delete->idservicos->Visible) { // idservicos ?>
		<th class="<?php echo $servicos_delete->idservicos->headerCellClass() ?>"><span id="elh_servicos_idservicos" class="servicos_idservicos"><?php echo $servicos_delete->idservicos->caption() ?></span></th>
<?php } ?>
<?php if ($servicos_delete->servicos->Visible) { // servicos ?>
		<th class="<?php echo $servicos_delete->servicos->headerCellClass() ?>"><span id="elh_servicos_servicos" class="servicos_servicos"><?php echo $servicos_delete->servicos->caption() ?></span></th>
<?php } ?>
<?php if ($servicos_delete->idarea->Visible) { // idarea ?>
		<th class="<?php echo $servicos_delete->idarea->headerCellClass() ?>"><span id="elh_servicos_idarea" class="servicos_idarea"><?php echo $servicos_delete->idarea->caption() ?></span></th>
<?php } ?>
<?php if ($servicos_delete->valor->Visible) { // valor ?>
		<th class="<?php echo $servicos_delete->valor->headerCellClass() ?>"><span id="elh_servicos_valor" class="servicos_valor"><?php echo $servicos_delete->valor->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$servicos_delete->RecordCount = 0;
$i = 0;
while (!$servicos_delete->Recordset->EOF) {
	$servicos_delete->RecordCount++;
	$servicos_delete->RowCount++;

	// Set row properties
	$servicos->resetAttributes();
	$servicos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$servicos_delete->loadRowValues($servicos_delete->Recordset);

	// Render row
	$servicos_delete->renderRow();
?>
	<tr <?php echo $servicos->rowAttributes() ?>>
<?php if ($servicos_delete->idservicos->Visible) { // idservicos ?>
		<td <?php echo $servicos_delete->idservicos->cellAttributes() ?>>
<span id="el<?php echo $servicos_delete->RowCount ?>_servicos_idservicos" class="servicos_idservicos">
<span<?php echo $servicos_delete->idservicos->viewAttributes() ?>><?php echo $servicos_delete->idservicos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($servicos_delete->servicos->Visible) { // servicos ?>
		<td <?php echo $servicos_delete->servicos->cellAttributes() ?>>
<span id="el<?php echo $servicos_delete->RowCount ?>_servicos_servicos" class="servicos_servicos">
<span<?php echo $servicos_delete->servicos->viewAttributes() ?>><?php echo $servicos_delete->servicos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($servicos_delete->idarea->Visible) { // idarea ?>
		<td <?php echo $servicos_delete->idarea->cellAttributes() ?>>
<span id="el<?php echo $servicos_delete->RowCount ?>_servicos_idarea" class="servicos_idarea">
<span<?php echo $servicos_delete->idarea->viewAttributes() ?>><?php echo $servicos_delete->idarea->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($servicos_delete->valor->Visible) { // valor ?>
		<td <?php echo $servicos_delete->valor->cellAttributes() ?>>
<span id="el<?php echo $servicos_delete->RowCount ?>_servicos_valor" class="servicos_valor">
<span<?php echo $servicos_delete->valor->viewAttributes() ?>><?php echo $servicos_delete->valor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$servicos_delete->Recordset->moveNext();
}
$servicos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $servicos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$servicos_delete->showPageFooter();
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
$servicos_delete->terminate();
?>