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
$areas_delete = new areas_delete();

// Run the page
$areas_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$areas_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fareasdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fareasdelete = currentForm = new ew.Form("fareasdelete", "delete");
	loadjs.done("fareasdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $areas_delete->showPageHeader(); ?>
<?php
$areas_delete->showMessage();
?>
<form name="fareasdelete" id="fareasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="areas">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($areas_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($areas_delete->idareas->Visible) { // idareas ?>
		<th class="<?php echo $areas_delete->idareas->headerCellClass() ?>"><span id="elh_areas_idareas" class="areas_idareas"><?php echo $areas_delete->idareas->caption() ?></span></th>
<?php } ?>
<?php if ($areas_delete->areadescricao->Visible) { // areadescricao ?>
		<th class="<?php echo $areas_delete->areadescricao->headerCellClass() ?>"><span id="elh_areas_areadescricao" class="areas_areadescricao"><?php echo $areas_delete->areadescricao->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$areas_delete->RecordCount = 0;
$i = 0;
while (!$areas_delete->Recordset->EOF) {
	$areas_delete->RecordCount++;
	$areas_delete->RowCount++;

	// Set row properties
	$areas->resetAttributes();
	$areas->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$areas_delete->loadRowValues($areas_delete->Recordset);

	// Render row
	$areas_delete->renderRow();
?>
	<tr <?php echo $areas->rowAttributes() ?>>
<?php if ($areas_delete->idareas->Visible) { // idareas ?>
		<td <?php echo $areas_delete->idareas->cellAttributes() ?>>
<span id="el<?php echo $areas_delete->RowCount ?>_areas_idareas" class="areas_idareas">
<span<?php echo $areas_delete->idareas->viewAttributes() ?>><?php echo $areas_delete->idareas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($areas_delete->areadescricao->Visible) { // areadescricao ?>
		<td <?php echo $areas_delete->areadescricao->cellAttributes() ?>>
<span id="el<?php echo $areas_delete->RowCount ?>_areas_areadescricao" class="areas_areadescricao">
<span<?php echo $areas_delete->areadescricao->viewAttributes() ?>><?php echo $areas_delete->areadescricao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$areas_delete->Recordset->moveNext();
}
$areas_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $areas_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$areas_delete->showPageFooter();
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
$areas_delete->terminate();
?>