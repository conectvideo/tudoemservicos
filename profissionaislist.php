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
$profissionais_list = new profissionais_list();

// Run the page
$profissionais_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$profissionais_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$profissionais_list->isExport()) { ?>
<script>
var fprofissionaislist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fprofissionaislist = currentForm = new ew.Form("fprofissionaislist", "list");
	fprofissionaislist.formKeyCountName = '<?php echo $profissionais_list->FormKeyCountName ?>';
	loadjs.done("fprofissionaislist");
});
var fprofissionaislistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fprofissionaislistsrch = currentSearchForm = new ew.Form("fprofissionaislistsrch");

	// Dynamic selection lists
	// Filters

	fprofissionaislistsrch.filterList = <?php echo $profissionais_list->getFilterList() ?>;
	loadjs.done("fprofissionaislistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$profissionais_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($profissionais_list->TotalRecords > 0 && $profissionais_list->ExportOptions->visible()) { ?>
<?php $profissionais_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($profissionais_list->ImportOptions->visible()) { ?>
<?php $profissionais_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($profissionais_list->SearchOptions->visible()) { ?>
<?php $profissionais_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($profissionais_list->FilterOptions->visible()) { ?>
<?php $profissionais_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$profissionais_list->isExport() || Config("EXPORT_MASTER_RECORD") && $profissionais_list->isExport("print")) { ?>
<?php
if ($profissionais_list->DbMasterFilter != "" && $profissionais->getCurrentMasterTable() == "areas") {
	if ($profissionais_list->MasterRecordExists) {
		include_once "areasmaster.php";
	}
}
?>
<?php } ?>
<?php
$profissionais_list->renderOtherOptions();
?>
<?php if (!$profissionais_list->isExport() && !$profissionais->CurrentAction) { ?>
<form name="fprofissionaislistsrch" id="fprofissionaislistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fprofissionaislistsrch-search-panel" class="<?php echo $profissionais_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="profissionais">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $profissionais_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($profissionais_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($profissionais_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $profissionais_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($profissionais_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($profissionais_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($profissionais_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($profissionais_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $profissionais_list->showPageHeader(); ?>
<?php
$profissionais_list->showMessage();
?>
<?php if ($profissionais_list->TotalRecords > 0 || $profissionais->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($profissionais_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> profissionais">
<form name="fprofissionaislist" id="fprofissionaislist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="profissionais">
<?php if ($profissionais->getCurrentMasterTable() == "areas" && $profissionais->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="areas">
<input type="hidden" name="fk_idareas" value="<?php echo HtmlEncode($profissionais_list->idarea->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_profissionais" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($profissionais_list->TotalRecords > 0 || $profissionais_list->isGridEdit()) { ?>
<table id="tbl_profissionaislist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$profissionais->RowType = ROWTYPE_HEADER;

// Render list options
$profissionais_list->renderListOptions();

// Render list options (header, left)
$profissionais_list->ListOptions->render("header", "left");
?>
<?php if ($profissionais_list->idprofissionais->Visible) { // idprofissionais ?>
	<?php if ($profissionais_list->SortUrl($profissionais_list->idprofissionais) == "") { ?>
		<th data-name="idprofissionais" class="<?php echo $profissionais_list->idprofissionais->headerCellClass() ?>"><div id="elh_profissionais_idprofissionais" class="profissionais_idprofissionais"><div class="ew-table-header-caption"><?php echo $profissionais_list->idprofissionais->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idprofissionais" class="<?php echo $profissionais_list->idprofissionais->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $profissionais_list->SortUrl($profissionais_list->idprofissionais) ?>', 1);"><div id="elh_profissionais_idprofissionais" class="profissionais_idprofissionais">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profissionais_list->idprofissionais->caption() ?></span><span class="ew-table-header-sort"><?php if ($profissionais_list->idprofissionais->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($profissionais_list->idprofissionais->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profissionais_list->nome->Visible) { // nome ?>
	<?php if ($profissionais_list->SortUrl($profissionais_list->nome) == "") { ?>
		<th data-name="nome" class="<?php echo $profissionais_list->nome->headerCellClass() ?>"><div id="elh_profissionais_nome" class="profissionais_nome"><div class="ew-table-header-caption"><?php echo $profissionais_list->nome->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome" class="<?php echo $profissionais_list->nome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $profissionais_list->SortUrl($profissionais_list->nome) ?>', 1);"><div id="elh_profissionais_nome" class="profissionais_nome">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profissionais_list->nome->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($profissionais_list->nome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($profissionais_list->nome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profissionais_list->telefone->Visible) { // telefone ?>
	<?php if ($profissionais_list->SortUrl($profissionais_list->telefone) == "") { ?>
		<th data-name="telefone" class="<?php echo $profissionais_list->telefone->headerCellClass() ?>"><div id="elh_profissionais_telefone" class="profissionais_telefone"><div class="ew-table-header-caption"><?php echo $profissionais_list->telefone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefone" class="<?php echo $profissionais_list->telefone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $profissionais_list->SortUrl($profissionais_list->telefone) ?>', 1);"><div id="elh_profissionais_telefone" class="profissionais_telefone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profissionais_list->telefone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($profissionais_list->telefone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($profissionais_list->telefone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profissionais_list->whatsapp->Visible) { // whatsapp ?>
	<?php if ($profissionais_list->SortUrl($profissionais_list->whatsapp) == "") { ?>
		<th data-name="whatsapp" class="<?php echo $profissionais_list->whatsapp->headerCellClass() ?>"><div id="elh_profissionais_whatsapp" class="profissionais_whatsapp"><div class="ew-table-header-caption"><?php echo $profissionais_list->whatsapp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="whatsapp" class="<?php echo $profissionais_list->whatsapp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $profissionais_list->SortUrl($profissionais_list->whatsapp) ?>', 1);"><div id="elh_profissionais_whatsapp" class="profissionais_whatsapp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profissionais_list->whatsapp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($profissionais_list->whatsapp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($profissionais_list->whatsapp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profissionais_list->_email->Visible) { // email ?>
	<?php if ($profissionais_list->SortUrl($profissionais_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $profissionais_list->_email->headerCellClass() ?>"><div id="elh_profissionais__email" class="profissionais__email"><div class="ew-table-header-caption"><?php echo $profissionais_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $profissionais_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $profissionais_list->SortUrl($profissionais_list->_email) ?>', 1);"><div id="elh_profissionais__email" class="profissionais__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profissionais_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($profissionais_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($profissionais_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profissionais_list->idarea->Visible) { // idarea ?>
	<?php if ($profissionais_list->SortUrl($profissionais_list->idarea) == "") { ?>
		<th data-name="idarea" class="<?php echo $profissionais_list->idarea->headerCellClass() ?>"><div id="elh_profissionais_idarea" class="profissionais_idarea"><div class="ew-table-header-caption"><?php echo $profissionais_list->idarea->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idarea" class="<?php echo $profissionais_list->idarea->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $profissionais_list->SortUrl($profissionais_list->idarea) ?>', 1);"><div id="elh_profissionais_idarea" class="profissionais_idarea">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profissionais_list->idarea->caption() ?></span><span class="ew-table-header-sort"><?php if ($profissionais_list->idarea->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($profissionais_list->idarea->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$profissionais_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($profissionais_list->ExportAll && $profissionais_list->isExport()) {
	$profissionais_list->StopRecord = $profissionais_list->TotalRecords;
} else {

	// Set the last record to display
	if ($profissionais_list->TotalRecords > $profissionais_list->StartRecord + $profissionais_list->DisplayRecords - 1)
		$profissionais_list->StopRecord = $profissionais_list->StartRecord + $profissionais_list->DisplayRecords - 1;
	else
		$profissionais_list->StopRecord = $profissionais_list->TotalRecords;
}
$profissionais_list->RecordCount = $profissionais_list->StartRecord - 1;
if ($profissionais_list->Recordset && !$profissionais_list->Recordset->EOF) {
	$profissionais_list->Recordset->moveFirst();
	$selectLimit = $profissionais_list->UseSelectLimit;
	if (!$selectLimit && $profissionais_list->StartRecord > 1)
		$profissionais_list->Recordset->move($profissionais_list->StartRecord - 1);
} elseif (!$profissionais->AllowAddDeleteRow && $profissionais_list->StopRecord == 0) {
	$profissionais_list->StopRecord = $profissionais->GridAddRowCount;
}

// Initialize aggregate
$profissionais->RowType = ROWTYPE_AGGREGATEINIT;
$profissionais->resetAttributes();
$profissionais_list->renderRow();
while ($profissionais_list->RecordCount < $profissionais_list->StopRecord) {
	$profissionais_list->RecordCount++;
	if ($profissionais_list->RecordCount >= $profissionais_list->StartRecord) {
		$profissionais_list->RowCount++;

		// Set up key count
		$profissionais_list->KeyCount = $profissionais_list->RowIndex;

		// Init row class and style
		$profissionais->resetAttributes();
		$profissionais->CssClass = "";
		if ($profissionais_list->isGridAdd()) {
		} else {
			$profissionais_list->loadRowValues($profissionais_list->Recordset); // Load row values
		}
		$profissionais->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$profissionais->RowAttrs->merge(["data-rowindex" => $profissionais_list->RowCount, "id" => "r" . $profissionais_list->RowCount . "_profissionais", "data-rowtype" => $profissionais->RowType]);

		// Render row
		$profissionais_list->renderRow();

		// Render list options
		$profissionais_list->renderListOptions();
?>
	<tr <?php echo $profissionais->rowAttributes() ?>>
<?php

// Render list options (body, left)
$profissionais_list->ListOptions->render("body", "left", $profissionais_list->RowCount);
?>
	<?php if ($profissionais_list->idprofissionais->Visible) { // idprofissionais ?>
		<td data-name="idprofissionais" <?php echo $profissionais_list->idprofissionais->cellAttributes() ?>>
<span id="el<?php echo $profissionais_list->RowCount ?>_profissionais_idprofissionais">
<span<?php echo $profissionais_list->idprofissionais->viewAttributes() ?>><?php echo $profissionais_list->idprofissionais->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($profissionais_list->nome->Visible) { // nome ?>
		<td data-name="nome" <?php echo $profissionais_list->nome->cellAttributes() ?>>
<span id="el<?php echo $profissionais_list->RowCount ?>_profissionais_nome">
<span<?php echo $profissionais_list->nome->viewAttributes() ?>><?php echo $profissionais_list->nome->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($profissionais_list->telefone->Visible) { // telefone ?>
		<td data-name="telefone" <?php echo $profissionais_list->telefone->cellAttributes() ?>>
<span id="el<?php echo $profissionais_list->RowCount ?>_profissionais_telefone">
<span<?php echo $profissionais_list->telefone->viewAttributes() ?>><?php echo $profissionais_list->telefone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($profissionais_list->whatsapp->Visible) { // whatsapp ?>
		<td data-name="whatsapp" <?php echo $profissionais_list->whatsapp->cellAttributes() ?>>
<span id="el<?php echo $profissionais_list->RowCount ?>_profissionais_whatsapp">
<span<?php echo $profissionais_list->whatsapp->viewAttributes() ?>><?php echo $profissionais_list->whatsapp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($profissionais_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $profissionais_list->_email->cellAttributes() ?>>
<span id="el<?php echo $profissionais_list->RowCount ?>_profissionais__email">
<span<?php echo $profissionais_list->_email->viewAttributes() ?>><?php echo $profissionais_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($profissionais_list->idarea->Visible) { // idarea ?>
		<td data-name="idarea" <?php echo $profissionais_list->idarea->cellAttributes() ?>>
<span id="el<?php echo $profissionais_list->RowCount ?>_profissionais_idarea">
<span<?php echo $profissionais_list->idarea->viewAttributes() ?>><?php echo $profissionais_list->idarea->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$profissionais_list->ListOptions->render("body", "right", $profissionais_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$profissionais_list->isGridAdd())
		$profissionais_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$profissionais->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($profissionais_list->Recordset)
	$profissionais_list->Recordset->Close();
?>
<?php if (!$profissionais_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$profissionais_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $profissionais_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $profissionais_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($profissionais_list->TotalRecords == 0 && !$profissionais->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $profissionais_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$profissionais_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$profissionais_list->isExport()) { ?>
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
$profissionais_list->terminate();
?>