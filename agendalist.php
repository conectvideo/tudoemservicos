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
$agenda_list = new agenda_list();

// Run the page
$agenda_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agenda_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$agenda_list->isExport()) { ?>
<script>
var fagendalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fagendalist = currentForm = new ew.Form("fagendalist", "list");
	fagendalist.formKeyCountName = '<?php echo $agenda_list->FormKeyCountName ?>';
	loadjs.done("fagendalist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$agenda_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($agenda_list->TotalRecords > 0 && $agenda_list->ExportOptions->visible()) { ?>
<?php $agenda_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($agenda_list->ImportOptions->visible()) { ?>
<?php $agenda_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$agenda_list->renderOtherOptions();
?>
<?php $agenda_list->showPageHeader(); ?>
<?php
$agenda_list->showMessage();
?>
<?php if ($agenda_list->TotalRecords > 0 || $agenda->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($agenda_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> agenda">
<form name="fagendalist" id="fagendalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agenda">
<div id="gmp_agenda" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($agenda_list->TotalRecords > 0 || $agenda_list->isGridEdit()) { ?>
<table id="tbl_agendalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$agenda->RowType = ROWTYPE_HEADER;

// Render list options
$agenda_list->renderListOptions();

// Render list options (header, left)
$agenda_list->ListOptions->render("header", "left");
?>
<?php if ($agenda_list->idagenda->Visible) { // idagenda ?>
	<?php if ($agenda_list->SortUrl($agenda_list->idagenda) == "") { ?>
		<th data-name="idagenda" class="<?php echo $agenda_list->idagenda->headerCellClass() ?>"><div id="elh_agenda_idagenda" class="agenda_idagenda"><div class="ew-table-header-caption"><?php echo $agenda_list->idagenda->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idagenda" class="<?php echo $agenda_list->idagenda->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_list->SortUrl($agenda_list->idagenda) ?>', 1);"><div id="elh_agenda_idagenda" class="agenda_idagenda">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_list->idagenda->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_list->idagenda->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_list->idagenda->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_list->datainicio->Visible) { // datainicio ?>
	<?php if ($agenda_list->SortUrl($agenda_list->datainicio) == "") { ?>
		<th data-name="datainicio" class="<?php echo $agenda_list->datainicio->headerCellClass() ?>"><div id="elh_agenda_datainicio" class="agenda_datainicio"><div class="ew-table-header-caption"><?php echo $agenda_list->datainicio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="datainicio" class="<?php echo $agenda_list->datainicio->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_list->SortUrl($agenda_list->datainicio) ?>', 1);"><div id="elh_agenda_datainicio" class="agenda_datainicio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_list->datainicio->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_list->datainicio->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_list->datainicio->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_list->datafinal->Visible) { // datafinal ?>
	<?php if ($agenda_list->SortUrl($agenda_list->datafinal) == "") { ?>
		<th data-name="datafinal" class="<?php echo $agenda_list->datafinal->headerCellClass() ?>"><div id="elh_agenda_datafinal" class="agenda_datafinal"><div class="ew-table-header-caption"><?php echo $agenda_list->datafinal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="datafinal" class="<?php echo $agenda_list->datafinal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_list->SortUrl($agenda_list->datafinal) ?>', 1);"><div id="elh_agenda_datafinal" class="agenda_datafinal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_list->datafinal->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_list->datafinal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_list->datafinal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_list->idprofissional->Visible) { // idprofissional ?>
	<?php if ($agenda_list->SortUrl($agenda_list->idprofissional) == "") { ?>
		<th data-name="idprofissional" class="<?php echo $agenda_list->idprofissional->headerCellClass() ?>"><div id="elh_agenda_idprofissional" class="agenda_idprofissional"><div class="ew-table-header-caption"><?php echo $agenda_list->idprofissional->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idprofissional" class="<?php echo $agenda_list->idprofissional->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_list->SortUrl($agenda_list->idprofissional) ?>', 1);"><div id="elh_agenda_idprofissional" class="agenda_idprofissional">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_list->idprofissional->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_list->idprofissional->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_list->idprofissional->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_list->idcliente->Visible) { // idcliente ?>
	<?php if ($agenda_list->SortUrl($agenda_list->idcliente) == "") { ?>
		<th data-name="idcliente" class="<?php echo $agenda_list->idcliente->headerCellClass() ?>"><div id="elh_agenda_idcliente" class="agenda_idcliente"><div class="ew-table-header-caption"><?php echo $agenda_list->idcliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idcliente" class="<?php echo $agenda_list->idcliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_list->SortUrl($agenda_list->idcliente) ?>', 1);"><div id="elh_agenda_idcliente" class="agenda_idcliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_list->idcliente->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_list->idcliente->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_list->idcliente->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_list->idservico->Visible) { // idservico ?>
	<?php if ($agenda_list->SortUrl($agenda_list->idservico) == "") { ?>
		<th data-name="idservico" class="<?php echo $agenda_list->idservico->headerCellClass() ?>"><div id="elh_agenda_idservico" class="agenda_idservico"><div class="ew-table-header-caption"><?php echo $agenda_list->idservico->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idservico" class="<?php echo $agenda_list->idservico->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_list->SortUrl($agenda_list->idservico) ?>', 1);"><div id="elh_agenda_idservico" class="agenda_idservico">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_list->idservico->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_list->idservico->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_list->idservico->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$agenda_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($agenda_list->ExportAll && $agenda_list->isExport()) {
	$agenda_list->StopRecord = $agenda_list->TotalRecords;
} else {

	// Set the last record to display
	if ($agenda_list->TotalRecords > $agenda_list->StartRecord + $agenda_list->DisplayRecords - 1)
		$agenda_list->StopRecord = $agenda_list->StartRecord + $agenda_list->DisplayRecords - 1;
	else
		$agenda_list->StopRecord = $agenda_list->TotalRecords;
}
$agenda_list->RecordCount = $agenda_list->StartRecord - 1;
if ($agenda_list->Recordset && !$agenda_list->Recordset->EOF) {
	$agenda_list->Recordset->moveFirst();
	$selectLimit = $agenda_list->UseSelectLimit;
	if (!$selectLimit && $agenda_list->StartRecord > 1)
		$agenda_list->Recordset->move($agenda_list->StartRecord - 1);
} elseif (!$agenda->AllowAddDeleteRow && $agenda_list->StopRecord == 0) {
	$agenda_list->StopRecord = $agenda->GridAddRowCount;
}

// Initialize aggregate
$agenda->RowType = ROWTYPE_AGGREGATEINIT;
$agenda->resetAttributes();
$agenda_list->renderRow();
while ($agenda_list->RecordCount < $agenda_list->StopRecord) {
	$agenda_list->RecordCount++;
	if ($agenda_list->RecordCount >= $agenda_list->StartRecord) {
		$agenda_list->RowCount++;

		// Set up key count
		$agenda_list->KeyCount = $agenda_list->RowIndex;

		// Init row class and style
		$agenda->resetAttributes();
		$agenda->CssClass = "";
		if ($agenda_list->isGridAdd()) {
		} else {
			$agenda_list->loadRowValues($agenda_list->Recordset); // Load row values
		}
		$agenda->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$agenda->RowAttrs->merge(["data-rowindex" => $agenda_list->RowCount, "id" => "r" . $agenda_list->RowCount . "_agenda", "data-rowtype" => $agenda->RowType]);

		// Render row
		$agenda_list->renderRow();

		// Render list options
		$agenda_list->renderListOptions();
?>
	<tr <?php echo $agenda->rowAttributes() ?>>
<?php

// Render list options (body, left)
$agenda_list->ListOptions->render("body", "left", $agenda_list->RowCount);
?>
	<?php if ($agenda_list->idagenda->Visible) { // idagenda ?>
		<td data-name="idagenda" <?php echo $agenda_list->idagenda->cellAttributes() ?>>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_idagenda">
<span<?php echo $agenda_list->idagenda->viewAttributes() ?>><?php echo $agenda_list->idagenda->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($agenda_list->datainicio->Visible) { // datainicio ?>
		<td data-name="datainicio" <?php echo $agenda_list->datainicio->cellAttributes() ?>>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_datainicio">
<span<?php echo $agenda_list->datainicio->viewAttributes() ?>><?php echo $agenda_list->datainicio->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($agenda_list->datafinal->Visible) { // datafinal ?>
		<td data-name="datafinal" <?php echo $agenda_list->datafinal->cellAttributes() ?>>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_datafinal">
<span<?php echo $agenda_list->datafinal->viewAttributes() ?>><?php echo $agenda_list->datafinal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($agenda_list->idprofissional->Visible) { // idprofissional ?>
		<td data-name="idprofissional" <?php echo $agenda_list->idprofissional->cellAttributes() ?>>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_idprofissional">
<span<?php echo $agenda_list->idprofissional->viewAttributes() ?>><?php echo $agenda_list->idprofissional->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($agenda_list->idcliente->Visible) { // idcliente ?>
		<td data-name="idcliente" <?php echo $agenda_list->idcliente->cellAttributes() ?>>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_idcliente">
<span<?php echo $agenda_list->idcliente->viewAttributes() ?>><?php echo $agenda_list->idcliente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($agenda_list->idservico->Visible) { // idservico ?>
		<td data-name="idservico" <?php echo $agenda_list->idservico->cellAttributes() ?>>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_idservico">
<span<?php echo $agenda_list->idservico->viewAttributes() ?>><?php echo $agenda_list->idservico->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$agenda_list->ListOptions->render("body", "right", $agenda_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$agenda_list->isGridAdd())
		$agenda_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$agenda->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($agenda_list->Recordset)
	$agenda_list->Recordset->Close();
?>
<?php if (!$agenda_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$agenda_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $agenda_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $agenda_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($agenda_list->TotalRecords == 0 && !$agenda->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $agenda_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$agenda_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$agenda_list->isExport()) { ?>
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
$agenda_list->terminate();
?>