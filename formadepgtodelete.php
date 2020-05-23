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
$formadepgto_delete = new formadepgto_delete();

// Run the page
$formadepgto_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$formadepgto_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fformadepgtodelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fformadepgtodelete = currentForm = new ew.Form("fformadepgtodelete", "delete");
	loadjs.done("fformadepgtodelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $formadepgto_delete->showPageHeader(); ?>
<?php
$formadepgto_delete->showMessage();
?>
<form name="fformadepgtodelete" id="fformadepgtodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="formadepgto">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($formadepgto_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($formadepgto_delete->idformadepgto->Visible) { // idformadepgto ?>
		<th class="<?php echo $formadepgto_delete->idformadepgto->headerCellClass() ?>"><span id="elh_formadepgto_idformadepgto" class="formadepgto_idformadepgto"><?php echo $formadepgto_delete->idformadepgto->caption() ?></span></th>
<?php } ?>
<?php if ($formadepgto_delete->formadepgto->Visible) { // formadepgto ?>
		<th class="<?php echo $formadepgto_delete->formadepgto->headerCellClass() ?>"><span id="elh_formadepgto_formadepgto" class="formadepgto_formadepgto"><?php echo $formadepgto_delete->formadepgto->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$formadepgto_delete->RecordCount = 0;
$i = 0;
while (!$formadepgto_delete->Recordset->EOF) {
	$formadepgto_delete->RecordCount++;
	$formadepgto_delete->RowCount++;

	// Set row properties
	$formadepgto->resetAttributes();
	$formadepgto->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$formadepgto_delete->loadRowValues($formadepgto_delete->Recordset);

	// Render row
	$formadepgto_delete->renderRow();
?>
	<tr <?php echo $formadepgto->rowAttributes() ?>>
<?php if ($formadepgto_delete->idformadepgto->Visible) { // idformadepgto ?>
		<td <?php echo $formadepgto_delete->idformadepgto->cellAttributes() ?>>
<span id="el<?php echo $formadepgto_delete->RowCount ?>_formadepgto_idformadepgto" class="formadepgto_idformadepgto">
<span<?php echo $formadepgto_delete->idformadepgto->viewAttributes() ?>><?php echo $formadepgto_delete->idformadepgto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($formadepgto_delete->formadepgto->Visible) { // formadepgto ?>
		<td <?php echo $formadepgto_delete->formadepgto->cellAttributes() ?>>
<span id="el<?php echo $formadepgto_delete->RowCount ?>_formadepgto_formadepgto" class="formadepgto_formadepgto">
<span<?php echo $formadepgto_delete->formadepgto->viewAttributes() ?>><?php echo $formadepgto_delete->formadepgto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$formadepgto_delete->Recordset->moveNext();
}
$formadepgto_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $formadepgto_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$formadepgto_delete->showPageFooter();
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
$formadepgto_delete->terminate();
?>