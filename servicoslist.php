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
$servicos_list = new servicos_list();

// Run the page
$servicos_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$servicos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$servicos_list->isExport()) { ?>
<script>
var fservicoslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fservicoslist = currentForm = new ew.Form("fservicoslist", "list");
	fservicoslist.formKeyCountName = '<?php echo $servicos_list->FormKeyCountName ?>';
	loadjs.done("fservicoslist");
});
var fservicoslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fservicoslistsrch = currentSearchForm = new ew.Form("fservicoslistsrch");

	// Dynamic selection lists
	// Filters

	fservicoslistsrch.filterList = <?php echo $servicos_list->getFilterList() ?>;
	loadjs.done("fservicoslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$servicos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($servicos_list->TotalRecords > 0 && $servicos_list->ExportOptions->visible()) { ?>
<?php $servicos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($servicos_list->ImportOptions->visible()) { ?>
<?php $servicos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($servicos_list->SearchOptions->visible()) { ?>
<?php $servicos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($servicos_list->FilterOptions->visible()) { ?>
<?php $servicos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$servicos_list->renderOtherOptions();
?>
<?php if (!$servicos_list->isExport() && !$servicos->CurrentAction) { ?>
<form name="fservicoslistsrch" id="fservicoslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fservicoslistsrch-search-panel" class="<?php echo $servicos_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="servicos">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $servicos_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($servicos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($servicos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $servicos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($servicos_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($servicos_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($servicos_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($servicos_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $servicos_list->showPageHeader(); ?>
<?php
$servicos_list->showMessage();
?>
<?php if ($servicos_list->TotalRecords > 0 || $servicos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($servicos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> servicos">
<form name="fservicoslist" id="fservicoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="servicos">
<div id="gmp_servicos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($servicos_list->TotalRecords > 0 || $servicos_list->isGridEdit()) { ?>
<table id="tbl_servicoslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$servicos->RowType = ROWTYPE_HEADER;

// Render list options
$servicos_list->renderListOptions();

// Render list options (header, left)
$servicos_list->ListOptions->render("header", "left");
?>
<?php if ($servicos_list->idservicos->Visible) { // idservicos ?>
	<?php if ($servicos_list->SortUrl($servicos_list->idservicos) == "") { ?>
		<th data-name="idservicos" class="<?php echo $servicos_list->idservicos->headerCellClass() ?>"><div id="elh_servicos_idservicos" class="servicos_idservicos"><div class="ew-table-header-caption"><?php echo $servicos_list->idservicos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idservicos" class="<?php echo $servicos_list->idservicos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $servicos_list->SortUrl($servicos_list->idservicos) ?>', 1);"><div id="elh_servicos_idservicos" class="servicos_idservicos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $servicos_list->idservicos->caption() ?></span><span class="ew-table-header-sort"><?php if ($servicos_list->idservicos->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($servicos_list->idservicos->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($servicos_list->servicos->Visible) { // servicos ?>
	<?php if ($servicos_list->SortUrl($servicos_list->servicos) == "") { ?>
		<th data-name="servicos" class="<?php echo $servicos_list->servicos->headerCellClass() ?>"><div id="elh_servicos_servicos" class="servicos_servicos"><div class="ew-table-header-caption"><?php echo $servicos_list->servicos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="servicos" class="<?php echo $servicos_list->servicos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $servicos_list->SortUrl($servicos_list->servicos) ?>', 1);"><div id="elh_servicos_servicos" class="servicos_servicos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $servicos_list->servicos->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($servicos_list->servicos->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($servicos_list->servicos->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($servicos_list->idarea->Visible) { // idarea ?>
	<?php if ($servicos_list->SortUrl($servicos_list->idarea) == "") { ?>
		<th data-name="idarea" class="<?php echo $servicos_list->idarea->headerCellClass() ?>"><div id="elh_servicos_idarea" class="servicos_idarea"><div class="ew-table-header-caption"><?php echo $servicos_list->idarea->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idarea" class="<?php echo $servicos_list->idarea->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $servicos_list->SortUrl($servicos_list->idarea) ?>', 1);"><div id="elh_servicos_idarea" class="servicos_idarea">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $servicos_list->idarea->caption() ?></span><span class="ew-table-header-sort"><?php if ($servicos_list->idarea->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($servicos_list->idarea->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($servicos_list->valor->Visible) { // valor ?>
	<?php if ($servicos_list->SortUrl($servicos_list->valor) == "") { ?>
		<th data-name="valor" class="<?php echo $servicos_list->valor->headerCellClass() ?>"><div id="elh_servicos_valor" class="servicos_valor"><div class="ew-table-header-caption"><?php echo $servicos_list->valor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="valor" class="<?php echo $servicos_list->valor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $servicos_list->SortUrl($servicos_list->valor) ?>', 1);"><div id="elh_servicos_valor" class="servicos_valor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $servicos_list->valor->caption() ?></span><span class="ew-table-header-sort"><?php if ($servicos_list->valor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($servicos_list->valor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$servicos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($servicos_list->ExportAll && $servicos_list->isExport()) {
	$servicos_list->StopRecord = $servicos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($servicos_list->TotalRecords > $servicos_list->StartRecord + $servicos_list->DisplayRecords - 1)
		$servicos_list->StopRecord = $servicos_list->StartRecord + $servicos_list->DisplayRecords - 1;
	else
		$servicos_list->StopRecord = $servicos_list->TotalRecords;
}
$servicos_list->RecordCount = $servicos_list->StartRecord - 1;
if ($servicos_list->Recordset && !$servicos_list->Recordset->EOF) {
	$servicos_list->Recordset->moveFirst();
	$selectLimit = $servicos_list->UseSelectLimit;
	if (!$selectLimit && $servicos_list->StartRecord > 1)
		$servicos_list->Recordset->move($servicos_list->StartRecord - 1);
} elseif (!$servicos->AllowAddDeleteRow && $servicos_list->StopRecord == 0) {
	$servicos_list->StopRecord = $servicos->GridAddRowCount;
}

// Initialize aggregate
$servicos->RowType = ROWTYPE_AGGREGATEINIT;
$servicos->resetAttributes();
$servicos_list->renderRow();
while ($servicos_list->RecordCount < $servicos_list->StopRecord) {
	$servicos_list->RecordCount++;
	if ($servicos_list->RecordCount >= $servicos_list->StartRecord) {
		$servicos_list->RowCount++;

		// Set up key count
		$servicos_list->KeyCount = $servicos_list->RowIndex;

		// Init row class and style
		$servicos->resetAttributes();
		$servicos->CssClass = "";
		if ($servicos_list->isGridAdd()) {
		} else {
			$servicos_list->loadRowValues($servicos_list->Recordset); // Load row values
		}
		$servicos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$servicos->RowAttrs->merge(["data-rowindex" => $servicos_list->RowCount, "id" => "r" . $servicos_list->RowCount . "_servicos", "data-rowtype" => $servicos->RowType]);

		// Render row
		$servicos_list->renderRow();

		// Render list options
		$servicos_list->renderListOptions();
?>
	<tr <?php echo $servicos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$servicos_list->ListOptions->render("body", "left", $servicos_list->RowCount);
?>
	<?php if ($servicos_list->idservicos->Visible) { // idservicos ?>
		<td data-name="idservicos" <?php echo $servicos_list->idservicos->cellAttributes() ?>>
<span id="el<?php echo $servicos_list->RowCount ?>_servicos_idservicos">
<span<?php echo $servicos_list->idservicos->viewAttributes() ?>><?php echo $servicos_list->idservicos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($servicos_list->servicos->Visible) { // servicos ?>
		<td data-name="servicos" <?php echo $servicos_list->servicos->cellAttributes() ?>>
<span id="el<?php echo $servicos_list->RowCount ?>_servicos_servicos">
<span<?php echo $servicos_list->servicos->viewAttributes() ?>><?php echo $servicos_list->servicos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($servicos_list->idarea->Visible) { // idarea ?>
		<td data-name="idarea" <?php echo $servicos_list->idarea->cellAttributes() ?>>
<span id="el<?php echo $servicos_list->RowCount ?>_servicos_idarea">
<span<?php echo $servicos_list->idarea->viewAttributes() ?>><?php echo $servicos_list->idarea->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($servicos_list->valor->Visible) { // valor ?>
		<td data-name="valor" <?php echo $servicos_list->valor->cellAttributes() ?>>
<span id="el<?php echo $servicos_list->RowCount ?>_servicos_valor">
<span<?php echo $servicos_list->valor->viewAttributes() ?>><?php echo $servicos_list->valor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$servicos_list->ListOptions->render("body", "right", $servicos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$servicos_list->isGridAdd())
		$servicos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$servicos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($servicos_list->Recordset)
	$servicos_list->Recordset->Close();
?>
<?php if (!$servicos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$servicos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $servicos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $servicos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($servicos_list->TotalRecords == 0 && !$servicos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $servicos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$servicos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$servicos_list->isExport()) { ?>
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
$servicos_list->terminate();
?>