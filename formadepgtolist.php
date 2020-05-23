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
$formadepgto_list = new formadepgto_list();

// Run the page
$formadepgto_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$formadepgto_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$formadepgto_list->isExport()) { ?>
<script>
var fformadepgtolist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fformadepgtolist = currentForm = new ew.Form("fformadepgtolist", "list");
	fformadepgtolist.formKeyCountName = '<?php echo $formadepgto_list->FormKeyCountName ?>';
	loadjs.done("fformadepgtolist");
});
var fformadepgtolistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fformadepgtolistsrch = currentSearchForm = new ew.Form("fformadepgtolistsrch");

	// Dynamic selection lists
	// Filters

	fformadepgtolistsrch.filterList = <?php echo $formadepgto_list->getFilterList() ?>;
	loadjs.done("fformadepgtolistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$formadepgto_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($formadepgto_list->TotalRecords > 0 && $formadepgto_list->ExportOptions->visible()) { ?>
<?php $formadepgto_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($formadepgto_list->ImportOptions->visible()) { ?>
<?php $formadepgto_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($formadepgto_list->SearchOptions->visible()) { ?>
<?php $formadepgto_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($formadepgto_list->FilterOptions->visible()) { ?>
<?php $formadepgto_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$formadepgto_list->renderOtherOptions();
?>
<?php if (!$formadepgto_list->isExport() && !$formadepgto->CurrentAction) { ?>
<form name="fformadepgtolistsrch" id="fformadepgtolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fformadepgtolistsrch-search-panel" class="<?php echo $formadepgto_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="formadepgto">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $formadepgto_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($formadepgto_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($formadepgto_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $formadepgto_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($formadepgto_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($formadepgto_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($formadepgto_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($formadepgto_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $formadepgto_list->showPageHeader(); ?>
<?php
$formadepgto_list->showMessage();
?>
<?php if ($formadepgto_list->TotalRecords > 0 || $formadepgto->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($formadepgto_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> formadepgto">
<form name="fformadepgtolist" id="fformadepgtolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="formadepgto">
<div id="gmp_formadepgto" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($formadepgto_list->TotalRecords > 0 || $formadepgto_list->isGridEdit()) { ?>
<table id="tbl_formadepgtolist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$formadepgto->RowType = ROWTYPE_HEADER;

// Render list options
$formadepgto_list->renderListOptions();

// Render list options (header, left)
$formadepgto_list->ListOptions->render("header", "left");
?>
<?php if ($formadepgto_list->idformadepgto->Visible) { // idformadepgto ?>
	<?php if ($formadepgto_list->SortUrl($formadepgto_list->idformadepgto) == "") { ?>
		<th data-name="idformadepgto" class="<?php echo $formadepgto_list->idformadepgto->headerCellClass() ?>"><div id="elh_formadepgto_idformadepgto" class="formadepgto_idformadepgto"><div class="ew-table-header-caption"><?php echo $formadepgto_list->idformadepgto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idformadepgto" class="<?php echo $formadepgto_list->idformadepgto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $formadepgto_list->SortUrl($formadepgto_list->idformadepgto) ?>', 1);"><div id="elh_formadepgto_idformadepgto" class="formadepgto_idformadepgto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $formadepgto_list->idformadepgto->caption() ?></span><span class="ew-table-header-sort"><?php if ($formadepgto_list->idformadepgto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($formadepgto_list->idformadepgto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($formadepgto_list->formadepgto->Visible) { // formadepgto ?>
	<?php if ($formadepgto_list->SortUrl($formadepgto_list->formadepgto) == "") { ?>
		<th data-name="formadepgto" class="<?php echo $formadepgto_list->formadepgto->headerCellClass() ?>"><div id="elh_formadepgto_formadepgto" class="formadepgto_formadepgto"><div class="ew-table-header-caption"><?php echo $formadepgto_list->formadepgto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="formadepgto" class="<?php echo $formadepgto_list->formadepgto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $formadepgto_list->SortUrl($formadepgto_list->formadepgto) ?>', 1);"><div id="elh_formadepgto_formadepgto" class="formadepgto_formadepgto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $formadepgto_list->formadepgto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($formadepgto_list->formadepgto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($formadepgto_list->formadepgto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$formadepgto_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($formadepgto_list->ExportAll && $formadepgto_list->isExport()) {
	$formadepgto_list->StopRecord = $formadepgto_list->TotalRecords;
} else {

	// Set the last record to display
	if ($formadepgto_list->TotalRecords > $formadepgto_list->StartRecord + $formadepgto_list->DisplayRecords - 1)
		$formadepgto_list->StopRecord = $formadepgto_list->StartRecord + $formadepgto_list->DisplayRecords - 1;
	else
		$formadepgto_list->StopRecord = $formadepgto_list->TotalRecords;
}
$formadepgto_list->RecordCount = $formadepgto_list->StartRecord - 1;
if ($formadepgto_list->Recordset && !$formadepgto_list->Recordset->EOF) {
	$formadepgto_list->Recordset->moveFirst();
	$selectLimit = $formadepgto_list->UseSelectLimit;
	if (!$selectLimit && $formadepgto_list->StartRecord > 1)
		$formadepgto_list->Recordset->move($formadepgto_list->StartRecord - 1);
} elseif (!$formadepgto->AllowAddDeleteRow && $formadepgto_list->StopRecord == 0) {
	$formadepgto_list->StopRecord = $formadepgto->GridAddRowCount;
}

// Initialize aggregate
$formadepgto->RowType = ROWTYPE_AGGREGATEINIT;
$formadepgto->resetAttributes();
$formadepgto_list->renderRow();
while ($formadepgto_list->RecordCount < $formadepgto_list->StopRecord) {
	$formadepgto_list->RecordCount++;
	if ($formadepgto_list->RecordCount >= $formadepgto_list->StartRecord) {
		$formadepgto_list->RowCount++;

		// Set up key count
		$formadepgto_list->KeyCount = $formadepgto_list->RowIndex;

		// Init row class and style
		$formadepgto->resetAttributes();
		$formadepgto->CssClass = "";
		if ($formadepgto_list->isGridAdd()) {
		} else {
			$formadepgto_list->loadRowValues($formadepgto_list->Recordset); // Load row values
		}
		$formadepgto->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$formadepgto->RowAttrs->merge(["data-rowindex" => $formadepgto_list->RowCount, "id" => "r" . $formadepgto_list->RowCount . "_formadepgto", "data-rowtype" => $formadepgto->RowType]);

		// Render row
		$formadepgto_list->renderRow();

		// Render list options
		$formadepgto_list->renderListOptions();
?>
	<tr <?php echo $formadepgto->rowAttributes() ?>>
<?php

// Render list options (body, left)
$formadepgto_list->ListOptions->render("body", "left", $formadepgto_list->RowCount);
?>
	<?php if ($formadepgto_list->idformadepgto->Visible) { // idformadepgto ?>
		<td data-name="idformadepgto" <?php echo $formadepgto_list->idformadepgto->cellAttributes() ?>>
<span id="el<?php echo $formadepgto_list->RowCount ?>_formadepgto_idformadepgto">
<span<?php echo $formadepgto_list->idformadepgto->viewAttributes() ?>><?php echo $formadepgto_list->idformadepgto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($formadepgto_list->formadepgto->Visible) { // formadepgto ?>
		<td data-name="formadepgto" <?php echo $formadepgto_list->formadepgto->cellAttributes() ?>>
<span id="el<?php echo $formadepgto_list->RowCount ?>_formadepgto_formadepgto">
<span<?php echo $formadepgto_list->formadepgto->viewAttributes() ?>><?php echo $formadepgto_list->formadepgto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$formadepgto_list->ListOptions->render("body", "right", $formadepgto_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$formadepgto_list->isGridAdd())
		$formadepgto_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$formadepgto->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($formadepgto_list->Recordset)
	$formadepgto_list->Recordset->Close();
?>
<?php if (!$formadepgto_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$formadepgto_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $formadepgto_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $formadepgto_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($formadepgto_list->TotalRecords == 0 && !$formadepgto->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $formadepgto_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$formadepgto_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$formadepgto_list->isExport()) { ?>
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
$formadepgto_list->terminate();
?>