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
$clientes_list = new clientes_list();

// Run the page
$clientes_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$clientes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$clientes_list->isExport()) { ?>
<script>
var fclienteslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fclienteslist = currentForm = new ew.Form("fclienteslist", "list");
	fclienteslist.formKeyCountName = '<?php echo $clientes_list->FormKeyCountName ?>';
	loadjs.done("fclienteslist");
});
var fclienteslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fclienteslistsrch = currentSearchForm = new ew.Form("fclienteslistsrch");

	// Dynamic selection lists
	// Filters

	fclienteslistsrch.filterList = <?php echo $clientes_list->getFilterList() ?>;
	loadjs.done("fclienteslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$clientes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($clientes_list->TotalRecords > 0 && $clientes_list->ExportOptions->visible()) { ?>
<?php $clientes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($clientes_list->ImportOptions->visible()) { ?>
<?php $clientes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($clientes_list->SearchOptions->visible()) { ?>
<?php $clientes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($clientes_list->FilterOptions->visible()) { ?>
<?php $clientes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$clientes_list->renderOtherOptions();
?>
<?php if (!$clientes_list->isExport() && !$clientes->CurrentAction) { ?>
<form name="fclienteslistsrch" id="fclienteslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fclienteslistsrch-search-panel" class="<?php echo $clientes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="clientes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $clientes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($clientes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($clientes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $clientes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($clientes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($clientes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($clientes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($clientes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $clientes_list->showPageHeader(); ?>
<?php
$clientes_list->showMessage();
?>
<?php if ($clientes_list->TotalRecords > 0 || $clientes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($clientes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> clientes">
<form name="fclienteslist" id="fclienteslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="clientes">
<div id="gmp_clientes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($clientes_list->TotalRecords > 0 || $clientes_list->isGridEdit()) { ?>
<table id="tbl_clienteslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$clientes->RowType = ROWTYPE_HEADER;

// Render list options
$clientes_list->renderListOptions();

// Render list options (header, left)
$clientes_list->ListOptions->render("header", "left");
?>
<?php if ($clientes_list->idclientes->Visible) { // idclientes ?>
	<?php if ($clientes_list->SortUrl($clientes_list->idclientes) == "") { ?>
		<th data-name="idclientes" class="<?php echo $clientes_list->idclientes->headerCellClass() ?>"><div id="elh_clientes_idclientes" class="clientes_idclientes"><div class="ew-table-header-caption"><?php echo $clientes_list->idclientes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idclientes" class="<?php echo $clientes_list->idclientes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $clientes_list->SortUrl($clientes_list->idclientes) ?>', 1);"><div id="elh_clientes_idclientes" class="clientes_idclientes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes_list->idclientes->caption() ?></span><span class="ew-table-header-sort"><?php if ($clientes_list->idclientes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($clientes_list->idclientes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes_list->nome->Visible) { // nome ?>
	<?php if ($clientes_list->SortUrl($clientes_list->nome) == "") { ?>
		<th data-name="nome" class="<?php echo $clientes_list->nome->headerCellClass() ?>"><div id="elh_clientes_nome" class="clientes_nome"><div class="ew-table-header-caption"><?php echo $clientes_list->nome->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome" class="<?php echo $clientes_list->nome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $clientes_list->SortUrl($clientes_list->nome) ?>', 1);"><div id="elh_clientes_nome" class="clientes_nome">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes_list->nome->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes_list->nome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($clientes_list->nome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes_list->cpf->Visible) { // cpf ?>
	<?php if ($clientes_list->SortUrl($clientes_list->cpf) == "") { ?>
		<th data-name="cpf" class="<?php echo $clientes_list->cpf->headerCellClass() ?>"><div id="elh_clientes_cpf" class="clientes_cpf"><div class="ew-table-header-caption"><?php echo $clientes_list->cpf->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cpf" class="<?php echo $clientes_list->cpf->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $clientes_list->SortUrl($clientes_list->cpf) ?>', 1);"><div id="elh_clientes_cpf" class="clientes_cpf">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes_list->cpf->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes_list->cpf->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($clientes_list->cpf->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes_list->rg->Visible) { // rg ?>
	<?php if ($clientes_list->SortUrl($clientes_list->rg) == "") { ?>
		<th data-name="rg" class="<?php echo $clientes_list->rg->headerCellClass() ?>"><div id="elh_clientes_rg" class="clientes_rg"><div class="ew-table-header-caption"><?php echo $clientes_list->rg->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rg" class="<?php echo $clientes_list->rg->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $clientes_list->SortUrl($clientes_list->rg) ?>', 1);"><div id="elh_clientes_rg" class="clientes_rg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes_list->rg->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes_list->rg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($clientes_list->rg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes_list->telefonefixo->Visible) { // telefonefixo ?>
	<?php if ($clientes_list->SortUrl($clientes_list->telefonefixo) == "") { ?>
		<th data-name="telefonefixo" class="<?php echo $clientes_list->telefonefixo->headerCellClass() ?>"><div id="elh_clientes_telefonefixo" class="clientes_telefonefixo"><div class="ew-table-header-caption"><?php echo $clientes_list->telefonefixo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefonefixo" class="<?php echo $clientes_list->telefonefixo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $clientes_list->SortUrl($clientes_list->telefonefixo) ?>', 1);"><div id="elh_clientes_telefonefixo" class="clientes_telefonefixo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes_list->telefonefixo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes_list->telefonefixo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($clientes_list->telefonefixo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes_list->celularwhatsapp->Visible) { // celularwhatsapp ?>
	<?php if ($clientes_list->SortUrl($clientes_list->celularwhatsapp) == "") { ?>
		<th data-name="celularwhatsapp" class="<?php echo $clientes_list->celularwhatsapp->headerCellClass() ?>"><div id="elh_clientes_celularwhatsapp" class="clientes_celularwhatsapp"><div class="ew-table-header-caption"><?php echo $clientes_list->celularwhatsapp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="celularwhatsapp" class="<?php echo $clientes_list->celularwhatsapp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $clientes_list->SortUrl($clientes_list->celularwhatsapp) ?>', 1);"><div id="elh_clientes_celularwhatsapp" class="clientes_celularwhatsapp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes_list->celularwhatsapp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes_list->celularwhatsapp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($clientes_list->celularwhatsapp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes_list->endereco->Visible) { // endereco ?>
	<?php if ($clientes_list->SortUrl($clientes_list->endereco) == "") { ?>
		<th data-name="endereco" class="<?php echo $clientes_list->endereco->headerCellClass() ?>"><div id="elh_clientes_endereco" class="clientes_endereco"><div class="ew-table-header-caption"><?php echo $clientes_list->endereco->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="endereco" class="<?php echo $clientes_list->endereco->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $clientes_list->SortUrl($clientes_list->endereco) ?>', 1);"><div id="elh_clientes_endereco" class="clientes_endereco">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes_list->endereco->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes_list->endereco->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($clientes_list->endereco->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes_list->numero->Visible) { // numero ?>
	<?php if ($clientes_list->SortUrl($clientes_list->numero) == "") { ?>
		<th data-name="numero" class="<?php echo $clientes_list->numero->headerCellClass() ?>"><div id="elh_clientes_numero" class="clientes_numero"><div class="ew-table-header-caption"><?php echo $clientes_list->numero->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="numero" class="<?php echo $clientes_list->numero->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $clientes_list->SortUrl($clientes_list->numero) ?>', 1);"><div id="elh_clientes_numero" class="clientes_numero">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes_list->numero->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes_list->numero->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($clientes_list->numero->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes_list->bairro->Visible) { // bairro ?>
	<?php if ($clientes_list->SortUrl($clientes_list->bairro) == "") { ?>
		<th data-name="bairro" class="<?php echo $clientes_list->bairro->headerCellClass() ?>"><div id="elh_clientes_bairro" class="clientes_bairro"><div class="ew-table-header-caption"><?php echo $clientes_list->bairro->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bairro" class="<?php echo $clientes_list->bairro->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $clientes_list->SortUrl($clientes_list->bairro) ?>', 1);"><div id="elh_clientes_bairro" class="clientes_bairro">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes_list->bairro->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes_list->bairro->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($clientes_list->bairro->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes_list->complemento->Visible) { // complemento ?>
	<?php if ($clientes_list->SortUrl($clientes_list->complemento) == "") { ?>
		<th data-name="complemento" class="<?php echo $clientes_list->complemento->headerCellClass() ?>"><div id="elh_clientes_complemento" class="clientes_complemento"><div class="ew-table-header-caption"><?php echo $clientes_list->complemento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="complemento" class="<?php echo $clientes_list->complemento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $clientes_list->SortUrl($clientes_list->complemento) ?>', 1);"><div id="elh_clientes_complemento" class="clientes_complemento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes_list->complemento->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes_list->complemento->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($clientes_list->complemento->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes_list->cep->Visible) { // cep ?>
	<?php if ($clientes_list->SortUrl($clientes_list->cep) == "") { ?>
		<th data-name="cep" class="<?php echo $clientes_list->cep->headerCellClass() ?>"><div id="elh_clientes_cep" class="clientes_cep"><div class="ew-table-header-caption"><?php echo $clientes_list->cep->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cep" class="<?php echo $clientes_list->cep->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $clientes_list->SortUrl($clientes_list->cep) ?>', 1);"><div id="elh_clientes_cep" class="clientes_cep">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes_list->cep->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes_list->cep->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($clientes_list->cep->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($clientes_list->_email->Visible) { // email ?>
	<?php if ($clientes_list->SortUrl($clientes_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $clientes_list->_email->headerCellClass() ?>"><div id="elh_clientes__email" class="clientes__email"><div class="ew-table-header-caption"><?php echo $clientes_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $clientes_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $clientes_list->SortUrl($clientes_list->_email) ?>', 1);"><div id="elh_clientes__email" class="clientes__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $clientes_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($clientes_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($clientes_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$clientes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($clientes_list->ExportAll && $clientes_list->isExport()) {
	$clientes_list->StopRecord = $clientes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($clientes_list->TotalRecords > $clientes_list->StartRecord + $clientes_list->DisplayRecords - 1)
		$clientes_list->StopRecord = $clientes_list->StartRecord + $clientes_list->DisplayRecords - 1;
	else
		$clientes_list->StopRecord = $clientes_list->TotalRecords;
}
$clientes_list->RecordCount = $clientes_list->StartRecord - 1;
if ($clientes_list->Recordset && !$clientes_list->Recordset->EOF) {
	$clientes_list->Recordset->moveFirst();
	$selectLimit = $clientes_list->UseSelectLimit;
	if (!$selectLimit && $clientes_list->StartRecord > 1)
		$clientes_list->Recordset->move($clientes_list->StartRecord - 1);
} elseif (!$clientes->AllowAddDeleteRow && $clientes_list->StopRecord == 0) {
	$clientes_list->StopRecord = $clientes->GridAddRowCount;
}

// Initialize aggregate
$clientes->RowType = ROWTYPE_AGGREGATEINIT;
$clientes->resetAttributes();
$clientes_list->renderRow();
while ($clientes_list->RecordCount < $clientes_list->StopRecord) {
	$clientes_list->RecordCount++;
	if ($clientes_list->RecordCount >= $clientes_list->StartRecord) {
		$clientes_list->RowCount++;

		// Set up key count
		$clientes_list->KeyCount = $clientes_list->RowIndex;

		// Init row class and style
		$clientes->resetAttributes();
		$clientes->CssClass = "";
		if ($clientes_list->isGridAdd()) {
		} else {
			$clientes_list->loadRowValues($clientes_list->Recordset); // Load row values
		}
		$clientes->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$clientes->RowAttrs->merge(["data-rowindex" => $clientes_list->RowCount, "id" => "r" . $clientes_list->RowCount . "_clientes", "data-rowtype" => $clientes->RowType]);

		// Render row
		$clientes_list->renderRow();

		// Render list options
		$clientes_list->renderListOptions();
?>
	<tr <?php echo $clientes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$clientes_list->ListOptions->render("body", "left", $clientes_list->RowCount);
?>
	<?php if ($clientes_list->idclientes->Visible) { // idclientes ?>
		<td data-name="idclientes" <?php echo $clientes_list->idclientes->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCount ?>_clientes_idclientes">
<span<?php echo $clientes_list->idclientes->viewAttributes() ?>><?php echo $clientes_list->idclientes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes_list->nome->Visible) { // nome ?>
		<td data-name="nome" <?php echo $clientes_list->nome->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCount ?>_clientes_nome">
<span<?php echo $clientes_list->nome->viewAttributes() ?>><?php echo $clientes_list->nome->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes_list->cpf->Visible) { // cpf ?>
		<td data-name="cpf" <?php echo $clientes_list->cpf->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCount ?>_clientes_cpf">
<span<?php echo $clientes_list->cpf->viewAttributes() ?>><?php echo $clientes_list->cpf->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes_list->rg->Visible) { // rg ?>
		<td data-name="rg" <?php echo $clientes_list->rg->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCount ?>_clientes_rg">
<span<?php echo $clientes_list->rg->viewAttributes() ?>><?php echo $clientes_list->rg->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes_list->telefonefixo->Visible) { // telefonefixo ?>
		<td data-name="telefonefixo" <?php echo $clientes_list->telefonefixo->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCount ?>_clientes_telefonefixo">
<span<?php echo $clientes_list->telefonefixo->viewAttributes() ?>><?php echo $clientes_list->telefonefixo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes_list->celularwhatsapp->Visible) { // celularwhatsapp ?>
		<td data-name="celularwhatsapp" <?php echo $clientes_list->celularwhatsapp->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCount ?>_clientes_celularwhatsapp">
<span<?php echo $clientes_list->celularwhatsapp->viewAttributes() ?>><?php echo $clientes_list->celularwhatsapp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes_list->endereco->Visible) { // endereco ?>
		<td data-name="endereco" <?php echo $clientes_list->endereco->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCount ?>_clientes_endereco">
<span<?php echo $clientes_list->endereco->viewAttributes() ?>><?php echo $clientes_list->endereco->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes_list->numero->Visible) { // numero ?>
		<td data-name="numero" <?php echo $clientes_list->numero->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCount ?>_clientes_numero">
<span<?php echo $clientes_list->numero->viewAttributes() ?>><?php echo $clientes_list->numero->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes_list->bairro->Visible) { // bairro ?>
		<td data-name="bairro" <?php echo $clientes_list->bairro->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCount ?>_clientes_bairro">
<span<?php echo $clientes_list->bairro->viewAttributes() ?>><?php echo $clientes_list->bairro->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes_list->complemento->Visible) { // complemento ?>
		<td data-name="complemento" <?php echo $clientes_list->complemento->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCount ?>_clientes_complemento">
<span<?php echo $clientes_list->complemento->viewAttributes() ?>><?php echo $clientes_list->complemento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes_list->cep->Visible) { // cep ?>
		<td data-name="cep" <?php echo $clientes_list->cep->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCount ?>_clientes_cep">
<span<?php echo $clientes_list->cep->viewAttributes() ?>><?php echo $clientes_list->cep->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($clientes_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $clientes_list->_email->cellAttributes() ?>>
<span id="el<?php echo $clientes_list->RowCount ?>_clientes__email">
<span<?php echo $clientes_list->_email->viewAttributes() ?>><?php echo $clientes_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$clientes_list->ListOptions->render("body", "right", $clientes_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$clientes_list->isGridAdd())
		$clientes_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$clientes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($clientes_list->Recordset)
	$clientes_list->Recordset->Close();
?>
<?php if (!$clientes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$clientes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $clientes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $clientes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($clientes_list->TotalRecords == 0 && !$clientes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $clientes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$clientes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$clientes_list->isExport()) { ?>
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
$clientes_list->terminate();
?>