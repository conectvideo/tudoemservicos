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
$areas2_delete = new areas2_delete();

// Run the page
$areas2_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$areas2_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fareas2delete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fareas2delete = currentForm = new ew.Form("fareas2delete", "delete");
	loadjs.done("fareas2delete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $areas2_delete->showPageHeader(); ?>
<?php
$areas2_delete->showMessage();
?>
<form name="fareas2delete" id="fareas2delete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="areas2">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($areas2_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($areas2_delete->idareas->Visible) { // idareas ?>
		<th class="<?php echo $areas2_delete->idareas->headerCellClass() ?>"><span id="elh_areas2_idareas" class="areas2_idareas"><?php echo $areas2_delete->idareas->caption() ?></span></th>
<?php } ?>
<?php if ($areas2_delete->areadescricao->Visible) { // areadescricao ?>
		<th class="<?php echo $areas2_delete->areadescricao->headerCellClass() ?>"><span id="elh_areas2_areadescricao" class="areas2_areadescricao"><?php echo $areas2_delete->areadescricao->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$areas2_delete->RecordCount = 0;
$i = 0;
while (!$areas2_delete->Recordset->EOF) {
	$areas2_delete->RecordCount++;
	$areas2_delete->RowCount++;

	// Set row properties
	$areas2->resetAttributes();
	$areas2->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$areas2_delete->loadRowValues($areas2_delete->Recordset);

	// Render row
	$areas2_delete->renderRow();
?>
	<tr <?php echo $areas2->rowAttributes() ?>>
<?php if ($areas2_delete->idareas->Visible) { // idareas ?>
		<td <?php echo $areas2_delete->idareas->cellAttributes() ?>>
<span id="el<?php echo $areas2_delete->RowCount ?>_areas2_idareas" class="areas2_idareas">
<span<?php echo $areas2_delete->idareas->viewAttributes() ?>><?php echo $areas2_delete->idareas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($areas2_delete->areadescricao->Visible) { // areadescricao ?>
		<td <?php echo $areas2_delete->areadescricao->cellAttributes() ?>>
<span id="el<?php echo $areas2_delete->RowCount ?>_areas2_areadescricao" class="areas2_areadescricao">
<span<?php echo $areas2_delete->areadescricao->viewAttributes() ?>><?php echo $areas2_delete->areadescricao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$areas2_delete->Recordset->moveNext();
}
$areas2_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $areas2_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$areas2_delete->showPageFooter();
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
$areas2_delete->terminate();
?>