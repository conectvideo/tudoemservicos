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
$areas2_list = new areas2_list();

// Run the page
$areas2_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$areas2_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$areas2_list->isExport()) { ?>
<script>
var fareas2list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fareas2list = currentForm = new ew.Form("fareas2list", "list");
	fareas2list.formKeyCountName = '<?php echo $areas2_list->FormKeyCountName ?>';
	loadjs.done("fareas2list");
});
var fareas2listsrch;
loadjs.ready("head", function() {

	// Form object for search
	fareas2listsrch = currentSearchForm = new ew.Form("fareas2listsrch");

	// Dynamic selection lists
	// Filters

	fareas2listsrch.filterList = <?php echo $areas2_list->getFilterList() ?>;
	loadjs.done("fareas2listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$areas2_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($areas2_list->TotalRecords > 0 && $areas2_list->ExportOptions->visible()) { ?>
<?php $areas2_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($areas2_list->ImportOptions->visible()) { ?>
<?php $areas2_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($areas2_list->SearchOptions->visible()) { ?>
<?php $areas2_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($areas2_list->FilterOptions->visible()) { ?>
<?php $areas2_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$areas2_list->renderOtherOptions();
?>
<?php if (!$areas2_list->isExport() && !$areas2->CurrentAction) { ?>
<form name="fareas2listsrch" id="fareas2listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fareas2listsrch-search-panel" class="<?php echo $areas2_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="areas2">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $areas2_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($areas2_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($areas2_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $areas2_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($areas2_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($areas2_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($areas2_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($areas2_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $areas2_list->showPageHeader(); ?>
<?php
$areas2_list->showMessage();
?>
<?php if ($areas2_list->TotalRecords > 0 || $areas2->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($areas2_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> areas2">
<form name="fareas2list" id="fareas2list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="areas2">
<div id="gmp_areas2" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($areas2_list->TotalRecords > 0 || $areas2_list->isGridEdit()) { ?>
<table id="tbl_areas2list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$areas2->RowType = ROWTYPE_HEADER;

// Render list options
$areas2_list->renderListOptions();

// Render list options (header, left)
$areas2_list->ListOptions->render("header", "left");
?>
<?php if ($areas2_list->idareas->Visible) { // idareas ?>
	<?php if ($areas2_list->SortUrl($areas2_list->idareas) == "") { ?>
		<th data-name="idareas" class="<?php echo $areas2_list->idareas->headerCellClass() ?>"><div id="elh_areas2_idareas" class="areas2_idareas"><div class="ew-table-header-caption"><?php echo $areas2_list->idareas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idareas" class="<?php echo $areas2_list->idareas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $areas2_list->SortUrl($areas2_list->idareas) ?>', 1);"><div id="elh_areas2_idareas" class="areas2_idareas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $areas2_list->idareas->caption() ?></span><span class="ew-table-header-sort"><?php if ($areas2_list->idareas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($areas2_list->idareas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($areas2_list->areadescricao->Visible) { // areadescricao ?>
	<?php if ($areas2_list->SortUrl($areas2_list->areadescricao) == "") { ?>
		<th data-name="areadescricao" class="<?php echo $areas2_list->areadescricao->headerCellClass() ?>"><div id="elh_areas2_areadescricao" class="areas2_areadescricao"><div class="ew-table-header-caption"><?php echo $areas2_list->areadescricao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="areadescricao" class="<?php echo $areas2_list->areadescricao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $areas2_list->SortUrl($areas2_list->areadescricao) ?>', 1);"><div id="elh_areas2_areadescricao" class="areas2_areadescricao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $areas2_list->areadescricao->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($areas2_list->areadescricao->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($areas2_list->areadescricao->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$areas2_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($areas2_list->ExportAll && $areas2_list->isExport()) {
	$areas2_list->StopRecord = $areas2_list->TotalRecords;
} else {

	// Set the last record to display
	if ($areas2_list->TotalRecords > $areas2_list->StartRecord + $areas2_list->DisplayRecords - 1)
		$areas2_list->StopRecord = $areas2_list->StartRecord + $areas2_list->DisplayRecords - 1;
	else
		$areas2_list->StopRecord = $areas2_list->TotalRecords;
}
$areas2_list->RecordCount = $areas2_list->StartRecord - 1;
if ($areas2_list->Recordset && !$areas2_list->Recordset->EOF) {
	$areas2_list->Recordset->moveFirst();
	$selectLimit = $areas2_list->UseSelectLimit;
	if (!$selectLimit && $areas2_list->StartRecord > 1)
		$areas2_list->Recordset->move($areas2_list->StartRecord - 1);
} elseif (!$areas2->AllowAddDeleteRow && $areas2_list->StopRecord == 0) {
	$areas2_list->StopRecord = $areas2->GridAddRowCount;
}

// Initialize aggregate
$areas2->RowType = ROWTYPE_AGGREGATEINIT;
$areas2->resetAttributes();
$areas2_list->renderRow();
while ($areas2_list->RecordCount < $areas2_list->StopRecord) {
	$areas2_list->RecordCount++;
	if ($areas2_list->RecordCount >= $areas2_list->StartRecord) {
		$areas2_list->RowCount++;

		// Set up key count
		$areas2_list->KeyCount = $areas2_list->RowIndex;

		// Init row class and style
		$areas2->resetAttributes();
		$areas2->CssClass = "";
		if ($areas2_list->isGridAdd()) {
		} else {
			$areas2_list->loadRowValues($areas2_list->Recordset); // Load row values
		}
		$areas2->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$areas2->RowAttrs->merge(["data-rowindex" => $areas2_list->RowCount, "id" => "r" . $areas2_list->RowCount . "_areas2", "data-rowtype" => $areas2->RowType]);

		// Render row
		$areas2_list->renderRow();

		// Render list options
		$areas2_list->renderListOptions();
?>
	<tr <?php echo $areas2->rowAttributes() ?>>
<?php

// Render list options (body, left)
$areas2_list->ListOptions->render("body", "left", $areas2_list->RowCount);
?>
	<?php if ($areas2_list->idareas->Visible) { // idareas ?>
		<td data-name="idareas" <?php echo $areas2_list->idareas->cellAttributes() ?>>
<span id="el<?php echo $areas2_list->RowCount ?>_areas2_idareas">
<span<?php echo $areas2_list->idareas->viewAttributes() ?>><?php echo $areas2_list->idareas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($areas2_list->areadescricao->Visible) { // areadescricao ?>
		<td data-name="areadescricao" <?php echo $areas2_list->areadescricao->cellAttributes() ?>>
<span id="el<?php echo $areas2_list->RowCount ?>_areas2_areadescricao">
<span<?php echo $areas2_list->areadescricao->viewAttributes() ?>><?php echo $areas2_list->areadescricao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$areas2_list->ListOptions->render("body", "right", $areas2_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$areas2_list->isGridAdd())
		$areas2_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$areas2->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($areas2_list->Recordset)
	$areas2_list->Recordset->Close();
?>
<?php if (!$areas2_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$areas2_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $areas2_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $areas2_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($areas2_list->TotalRecords == 0 && !$areas2->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $areas2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$areas2_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$areas2_list->isExport()) { ?>
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
$areas2_list->terminate();
?>