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
$areas_list = new areas_list();

// Run the page
$areas_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$areas_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$areas_list->isExport()) { ?>
<script>
var fareaslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fareaslist = currentForm = new ew.Form("fareaslist", "list");
	fareaslist.formKeyCountName = '<?php echo $areas_list->FormKeyCountName ?>';
	loadjs.done("fareaslist");
});
var fareaslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fareaslistsrch = currentSearchForm = new ew.Form("fareaslistsrch");

	// Dynamic selection lists
	// Filters

	fareaslistsrch.filterList = <?php echo $areas_list->getFilterList() ?>;
	loadjs.done("fareaslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$areas_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($areas_list->TotalRecords > 0 && $areas_list->ExportOptions->visible()) { ?>
<?php $areas_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($areas_list->ImportOptions->visible()) { ?>
<?php $areas_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($areas_list->SearchOptions->visible()) { ?>
<?php $areas_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($areas_list->FilterOptions->visible()) { ?>
<?php $areas_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$areas_list->renderOtherOptions();
?>
<?php if (!$areas_list->isExport() && !$areas->CurrentAction) { ?>
<form name="fareaslistsrch" id="fareaslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fareaslistsrch-search-panel" class="<?php echo $areas_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="areas">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $areas_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($areas_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($areas_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $areas_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($areas_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($areas_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($areas_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($areas_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $areas_list->showPageHeader(); ?>
<?php
$areas_list->showMessage();
?>
<?php if ($areas_list->TotalRecords > 0 || $areas->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($areas_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> areas">
<form name="fareaslist" id="fareaslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="areas">
<div id="gmp_areas" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($areas_list->TotalRecords > 0 || $areas_list->isGridEdit()) { ?>
<table id="tbl_areaslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$areas->RowType = ROWTYPE_HEADER;

// Render list options
$areas_list->renderListOptions();

// Render list options (header, left)
$areas_list->ListOptions->render("header", "left");
?>
<?php if ($areas_list->idareas->Visible) { // idareas ?>
	<?php if ($areas_list->SortUrl($areas_list->idareas) == "") { ?>
		<th data-name="idareas" class="<?php echo $areas_list->idareas->headerCellClass() ?>"><div id="elh_areas_idareas" class="areas_idareas"><div class="ew-table-header-caption"><?php echo $areas_list->idareas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idareas" class="<?php echo $areas_list->idareas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $areas_list->SortUrl($areas_list->idareas) ?>', 1);"><div id="elh_areas_idareas" class="areas_idareas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $areas_list->idareas->caption() ?></span><span class="ew-table-header-sort"><?php if ($areas_list->idareas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($areas_list->idareas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($areas_list->areadescricao->Visible) { // areadescricao ?>
	<?php if ($areas_list->SortUrl($areas_list->areadescricao) == "") { ?>
		<th data-name="areadescricao" class="<?php echo $areas_list->areadescricao->headerCellClass() ?>"><div id="elh_areas_areadescricao" class="areas_areadescricao"><div class="ew-table-header-caption"><?php echo $areas_list->areadescricao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="areadescricao" class="<?php echo $areas_list->areadescricao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $areas_list->SortUrl($areas_list->areadescricao) ?>', 1);"><div id="elh_areas_areadescricao" class="areas_areadescricao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $areas_list->areadescricao->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($areas_list->areadescricao->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($areas_list->areadescricao->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$areas_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($areas_list->ExportAll && $areas_list->isExport()) {
	$areas_list->StopRecord = $areas_list->TotalRecords;
} else {

	// Set the last record to display
	if ($areas_list->TotalRecords > $areas_list->StartRecord + $areas_list->DisplayRecords - 1)
		$areas_list->StopRecord = $areas_list->StartRecord + $areas_list->DisplayRecords - 1;
	else
		$areas_list->StopRecord = $areas_list->TotalRecords;
}
$areas_list->RecordCount = $areas_list->StartRecord - 1;
if ($areas_list->Recordset && !$areas_list->Recordset->EOF) {
	$areas_list->Recordset->moveFirst();
	$selectLimit = $areas_list->UseSelectLimit;
	if (!$selectLimit && $areas_list->StartRecord > 1)
		$areas_list->Recordset->move($areas_list->StartRecord - 1);
} elseif (!$areas->AllowAddDeleteRow && $areas_list->StopRecord == 0) {
	$areas_list->StopRecord = $areas->GridAddRowCount;
}

// Initialize aggregate
$areas->RowType = ROWTYPE_AGGREGATEINIT;
$areas->resetAttributes();
$areas_list->renderRow();
while ($areas_list->RecordCount < $areas_list->StopRecord) {
	$areas_list->RecordCount++;
	if ($areas_list->RecordCount >= $areas_list->StartRecord) {
		$areas_list->RowCount++;

		// Set up key count
		$areas_list->KeyCount = $areas_list->RowIndex;

		// Init row class and style
		$areas->resetAttributes();
		$areas->CssClass = "";
		if ($areas_list->isGridAdd()) {
		} else {
			$areas_list->loadRowValues($areas_list->Recordset); // Load row values
		}
		$areas->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$areas->RowAttrs->merge(["data-rowindex" => $areas_list->RowCount, "id" => "r" . $areas_list->RowCount . "_areas", "data-rowtype" => $areas->RowType]);

		// Render row
		$areas_list->renderRow();

		// Render list options
		$areas_list->renderListOptions();
?>
	<tr <?php echo $areas->rowAttributes() ?>>
<?php

// Render list options (body, left)
$areas_list->ListOptions->render("body", "left", $areas_list->RowCount);
?>
	<?php if ($areas_list->idareas->Visible) { // idareas ?>
		<td data-name="idareas" <?php echo $areas_list->idareas->cellAttributes() ?>>
<span id="el<?php echo $areas_list->RowCount ?>_areas_idareas">
<span<?php echo $areas_list->idareas->viewAttributes() ?>><?php echo $areas_list->idareas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($areas_list->areadescricao->Visible) { // areadescricao ?>
		<td data-name="areadescricao" <?php echo $areas_list->areadescricao->cellAttributes() ?>>
<span id="el<?php echo $areas_list->RowCount ?>_areas_areadescricao">
<span<?php echo $areas_list->areadescricao->viewAttributes() ?>><?php echo $areas_list->areadescricao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$areas_list->ListOptions->render("body", "right", $areas_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$areas_list->isGridAdd())
		$areas_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$areas->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($areas_list->Recordset)
	$areas_list->Recordset->Close();
?>
<?php if (!$areas_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$areas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $areas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $areas_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($areas_list->TotalRecords == 0 && !$areas->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $areas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$areas_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$areas_list->isExport()) { ?>
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
$areas_list->terminate();
?>