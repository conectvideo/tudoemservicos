<?php
namespace PHPMaker2020\project1;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($profissionais_grid))
	$profissionais_grid = new profissionais_grid();

// Run the page
$profissionais_grid->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$profissionais_grid->Page_Render();
?>
<?php if (!$profissionais_grid->isExport()) { ?>
<script>
var fprofissionaisgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fprofissionaisgrid = new ew.Form("fprofissionaisgrid", "grid");
	fprofissionaisgrid.formKeyCountName = '<?php echo $profissionais_grid->FormKeyCountName ?>';

	// Validate form
	fprofissionaisgrid.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($profissionais_grid->idprofissionais->Required) { ?>
				elm = this.getElements("x" + infix + "_idprofissionais");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profissionais_grid->idprofissionais->caption(), $profissionais_grid->idprofissionais->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($profissionais_grid->nome->Required) { ?>
				elm = this.getElements("x" + infix + "_nome");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profissionais_grid->nome->caption(), $profissionais_grid->nome->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($profissionais_grid->telefone->Required) { ?>
				elm = this.getElements("x" + infix + "_telefone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profissionais_grid->telefone->caption(), $profissionais_grid->telefone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($profissionais_grid->whatsapp->Required) { ?>
				elm = this.getElements("x" + infix + "_whatsapp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profissionais_grid->whatsapp->caption(), $profissionais_grid->whatsapp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($profissionais_grid->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profissionais_grid->_email->caption(), $profissionais_grid->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($profissionais_grid->idarea->Required) { ?>
				elm = this.getElements("x" + infix + "_idarea");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profissionais_grid->idarea->caption(), $profissionais_grid->idarea->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_idarea");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($profissionais_grid->idarea->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fprofissionaisgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "nome", false)) return false;
		if (ew.valueChanged(fobj, infix, "telefone", false)) return false;
		if (ew.valueChanged(fobj, infix, "whatsapp", false)) return false;
		if (ew.valueChanged(fobj, infix, "_email", false)) return false;
		if (ew.valueChanged(fobj, infix, "idarea", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fprofissionaisgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprofissionaisgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fprofissionaisgrid");
});
</script>
<?php } ?>
<?php
$profissionais_grid->renderOtherOptions();
?>
<?php if ($profissionais_grid->TotalRecords > 0 || $profissionais->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($profissionais_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> profissionais">
<div id="fprofissionaisgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_profissionais" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_profissionaisgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$profissionais->RowType = ROWTYPE_HEADER;

// Render list options
$profissionais_grid->renderListOptions();

// Render list options (header, left)
$profissionais_grid->ListOptions->render("header", "left");
?>
<?php if ($profissionais_grid->idprofissionais->Visible) { // idprofissionais ?>
	<?php if ($profissionais_grid->SortUrl($profissionais_grid->idprofissionais) == "") { ?>
		<th data-name="idprofissionais" class="<?php echo $profissionais_grid->idprofissionais->headerCellClass() ?>"><div id="elh_profissionais_idprofissionais" class="profissionais_idprofissionais"><div class="ew-table-header-caption"><?php echo $profissionais_grid->idprofissionais->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idprofissionais" class="<?php echo $profissionais_grid->idprofissionais->headerCellClass() ?>"><div><div id="elh_profissionais_idprofissionais" class="profissionais_idprofissionais">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profissionais_grid->idprofissionais->caption() ?></span><span class="ew-table-header-sort"><?php if ($profissionais_grid->idprofissionais->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($profissionais_grid->idprofissionais->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profissionais_grid->nome->Visible) { // nome ?>
	<?php if ($profissionais_grid->SortUrl($profissionais_grid->nome) == "") { ?>
		<th data-name="nome" class="<?php echo $profissionais_grid->nome->headerCellClass() ?>"><div id="elh_profissionais_nome" class="profissionais_nome"><div class="ew-table-header-caption"><?php echo $profissionais_grid->nome->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome" class="<?php echo $profissionais_grid->nome->headerCellClass() ?>"><div><div id="elh_profissionais_nome" class="profissionais_nome">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profissionais_grid->nome->caption() ?></span><span class="ew-table-header-sort"><?php if ($profissionais_grid->nome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($profissionais_grid->nome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profissionais_grid->telefone->Visible) { // telefone ?>
	<?php if ($profissionais_grid->SortUrl($profissionais_grid->telefone) == "") { ?>
		<th data-name="telefone" class="<?php echo $profissionais_grid->telefone->headerCellClass() ?>"><div id="elh_profissionais_telefone" class="profissionais_telefone"><div class="ew-table-header-caption"><?php echo $profissionais_grid->telefone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefone" class="<?php echo $profissionais_grid->telefone->headerCellClass() ?>"><div><div id="elh_profissionais_telefone" class="profissionais_telefone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profissionais_grid->telefone->caption() ?></span><span class="ew-table-header-sort"><?php if ($profissionais_grid->telefone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($profissionais_grid->telefone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profissionais_grid->whatsapp->Visible) { // whatsapp ?>
	<?php if ($profissionais_grid->SortUrl($profissionais_grid->whatsapp) == "") { ?>
		<th data-name="whatsapp" class="<?php echo $profissionais_grid->whatsapp->headerCellClass() ?>"><div id="elh_profissionais_whatsapp" class="profissionais_whatsapp"><div class="ew-table-header-caption"><?php echo $profissionais_grid->whatsapp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="whatsapp" class="<?php echo $profissionais_grid->whatsapp->headerCellClass() ?>"><div><div id="elh_profissionais_whatsapp" class="profissionais_whatsapp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profissionais_grid->whatsapp->caption() ?></span><span class="ew-table-header-sort"><?php if ($profissionais_grid->whatsapp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($profissionais_grid->whatsapp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profissionais_grid->_email->Visible) { // email ?>
	<?php if ($profissionais_grid->SortUrl($profissionais_grid->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $profissionais_grid->_email->headerCellClass() ?>"><div id="elh_profissionais__email" class="profissionais__email"><div class="ew-table-header-caption"><?php echo $profissionais_grid->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $profissionais_grid->_email->headerCellClass() ?>"><div><div id="elh_profissionais__email" class="profissionais__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profissionais_grid->_email->caption() ?></span><span class="ew-table-header-sort"><?php if ($profissionais_grid->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($profissionais_grid->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profissionais_grid->idarea->Visible) { // idarea ?>
	<?php if ($profissionais_grid->SortUrl($profissionais_grid->idarea) == "") { ?>
		<th data-name="idarea" class="<?php echo $profissionais_grid->idarea->headerCellClass() ?>"><div id="elh_profissionais_idarea" class="profissionais_idarea"><div class="ew-table-header-caption"><?php echo $profissionais_grid->idarea->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idarea" class="<?php echo $profissionais_grid->idarea->headerCellClass() ?>"><div><div id="elh_profissionais_idarea" class="profissionais_idarea">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profissionais_grid->idarea->caption() ?></span><span class="ew-table-header-sort"><?php if ($profissionais_grid->idarea->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($profissionais_grid->idarea->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$profissionais_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$profissionais_grid->StartRecord = 1;
$profissionais_grid->StopRecord = $profissionais_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($profissionais->isConfirm() || $profissionais_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($profissionais_grid->FormKeyCountName) && ($profissionais_grid->isGridAdd() || $profissionais_grid->isGridEdit() || $profissionais->isConfirm())) {
		$profissionais_grid->KeyCount = $CurrentForm->getValue($profissionais_grid->FormKeyCountName);
		$profissionais_grid->StopRecord = $profissionais_grid->StartRecord + $profissionais_grid->KeyCount - 1;
	}
}
$profissionais_grid->RecordCount = $profissionais_grid->StartRecord - 1;
if ($profissionais_grid->Recordset && !$profissionais_grid->Recordset->EOF) {
	$profissionais_grid->Recordset->moveFirst();
	$selectLimit = $profissionais_grid->UseSelectLimit;
	if (!$selectLimit && $profissionais_grid->StartRecord > 1)
		$profissionais_grid->Recordset->move($profissionais_grid->StartRecord - 1);
} elseif (!$profissionais->AllowAddDeleteRow && $profissionais_grid->StopRecord == 0) {
	$profissionais_grid->StopRecord = $profissionais->GridAddRowCount;
}

// Initialize aggregate
$profissionais->RowType = ROWTYPE_AGGREGATEINIT;
$profissionais->resetAttributes();
$profissionais_grid->renderRow();
if ($profissionais_grid->isGridAdd())
	$profissionais_grid->RowIndex = 0;
if ($profissionais_grid->isGridEdit())
	$profissionais_grid->RowIndex = 0;
while ($profissionais_grid->RecordCount < $profissionais_grid->StopRecord) {
	$profissionais_grid->RecordCount++;
	if ($profissionais_grid->RecordCount >= $profissionais_grid->StartRecord) {
		$profissionais_grid->RowCount++;
		if ($profissionais_grid->isGridAdd() || $profissionais_grid->isGridEdit() || $profissionais->isConfirm()) {
			$profissionais_grid->RowIndex++;
			$CurrentForm->Index = $profissionais_grid->RowIndex;
			if ($CurrentForm->hasValue($profissionais_grid->FormActionName) && ($profissionais->isConfirm() || $profissionais_grid->EventCancelled))
				$profissionais_grid->RowAction = strval($CurrentForm->getValue($profissionais_grid->FormActionName));
			elseif ($profissionais_grid->isGridAdd())
				$profissionais_grid->RowAction = "insert";
			else
				$profissionais_grid->RowAction = "";
		}

		// Set up key count
		$profissionais_grid->KeyCount = $profissionais_grid->RowIndex;

		// Init row class and style
		$profissionais->resetAttributes();
		$profissionais->CssClass = "";
		if ($profissionais_grid->isGridAdd()) {
			if ($profissionais->CurrentMode == "copy") {
				$profissionais_grid->loadRowValues($profissionais_grid->Recordset); // Load row values
				$profissionais_grid->setRecordKey($profissionais_grid->RowOldKey, $profissionais_grid->Recordset); // Set old record key
			} else {
				$profissionais_grid->loadRowValues(); // Load default values
				$profissionais_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$profissionais_grid->loadRowValues($profissionais_grid->Recordset); // Load row values
		}
		$profissionais->RowType = ROWTYPE_VIEW; // Render view
		if ($profissionais_grid->isGridAdd()) // Grid add
			$profissionais->RowType = ROWTYPE_ADD; // Render add
		if ($profissionais_grid->isGridAdd() && $profissionais->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$profissionais_grid->restoreCurrentRowFormValues($profissionais_grid->RowIndex); // Restore form values
		if ($profissionais_grid->isGridEdit()) { // Grid edit
			if ($profissionais->EventCancelled)
				$profissionais_grid->restoreCurrentRowFormValues($profissionais_grid->RowIndex); // Restore form values
			if ($profissionais_grid->RowAction == "insert")
				$profissionais->RowType = ROWTYPE_ADD; // Render add
			else
				$profissionais->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($profissionais_grid->isGridEdit() && ($profissionais->RowType == ROWTYPE_EDIT || $profissionais->RowType == ROWTYPE_ADD) && $profissionais->EventCancelled) // Update failed
			$profissionais_grid->restoreCurrentRowFormValues($profissionais_grid->RowIndex); // Restore form values
		if ($profissionais->RowType == ROWTYPE_EDIT) // Edit row
			$profissionais_grid->EditRowCount++;
		if ($profissionais->isConfirm()) // Confirm row
			$profissionais_grid->restoreCurrentRowFormValues($profissionais_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$profissionais->RowAttrs->merge(["data-rowindex" => $profissionais_grid->RowCount, "id" => "r" . $profissionais_grid->RowCount . "_profissionais", "data-rowtype" => $profissionais->RowType]);

		// Render row
		$profissionais_grid->renderRow();

		// Render list options
		$profissionais_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($profissionais_grid->RowAction != "delete" && $profissionais_grid->RowAction != "insertdelete" && !($profissionais_grid->RowAction == "insert" && $profissionais->isConfirm() && $profissionais_grid->emptyRow())) {
?>
	<tr <?php echo $profissionais->rowAttributes() ?>>
<?php

// Render list options (body, left)
$profissionais_grid->ListOptions->render("body", "left", $profissionais_grid->RowCount);
?>
	<?php if ($profissionais_grid->idprofissionais->Visible) { // idprofissionais ?>
		<td data-name="idprofissionais" <?php echo $profissionais_grid->idprofissionais->cellAttributes() ?>>
<?php if ($profissionais->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_idprofissionais" class="form-group"></span>
<input type="hidden" data-table="profissionais" data-field="x_idprofissionais" name="o<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" id="o<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" value="<?php echo HtmlEncode($profissionais_grid->idprofissionais->OldValue) ?>">
<?php } ?>
<?php if ($profissionais->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_idprofissionais" class="form-group">
<span<?php echo $profissionais_grid->idprofissionais->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($profissionais_grid->idprofissionais->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="profissionais" data-field="x_idprofissionais" name="x<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" id="x<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" value="<?php echo HtmlEncode($profissionais_grid->idprofissionais->CurrentValue) ?>">
<?php } ?>
<?php if ($profissionais->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_idprofissionais">
<span<?php echo $profissionais_grid->idprofissionais->viewAttributes() ?>><?php echo $profissionais_grid->idprofissionais->getViewValue() ?></span>
</span>
<?php if (!$profissionais->isConfirm()) { ?>
<input type="hidden" data-table="profissionais" data-field="x_idprofissionais" name="x<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" id="x<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" value="<?php echo HtmlEncode($profissionais_grid->idprofissionais->FormValue) ?>">
<input type="hidden" data-table="profissionais" data-field="x_idprofissionais" name="o<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" id="o<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" value="<?php echo HtmlEncode($profissionais_grid->idprofissionais->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="profissionais" data-field="x_idprofissionais" name="fprofissionaisgrid$x<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" id="fprofissionaisgrid$x<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" value="<?php echo HtmlEncode($profissionais_grid->idprofissionais->FormValue) ?>">
<input type="hidden" data-table="profissionais" data-field="x_idprofissionais" name="fprofissionaisgrid$o<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" id="fprofissionaisgrid$o<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" value="<?php echo HtmlEncode($profissionais_grid->idprofissionais->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($profissionais_grid->nome->Visible) { // nome ?>
		<td data-name="nome" <?php echo $profissionais_grid->nome->cellAttributes() ?>>
<?php if ($profissionais->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_nome" class="form-group">
<input type="text" data-table="profissionais" data-field="x_nome" name="x<?php echo $profissionais_grid->RowIndex ?>_nome" id="x<?php echo $profissionais_grid->RowIndex ?>_nome" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($profissionais_grid->nome->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->nome->EditValue ?>"<?php echo $profissionais_grid->nome->editAttributes() ?>>
</span>
<input type="hidden" data-table="profissionais" data-field="x_nome" name="o<?php echo $profissionais_grid->RowIndex ?>_nome" id="o<?php echo $profissionais_grid->RowIndex ?>_nome" value="<?php echo HtmlEncode($profissionais_grid->nome->OldValue) ?>">
<?php } ?>
<?php if ($profissionais->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_nome" class="form-group">
<input type="text" data-table="profissionais" data-field="x_nome" name="x<?php echo $profissionais_grid->RowIndex ?>_nome" id="x<?php echo $profissionais_grid->RowIndex ?>_nome" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($profissionais_grid->nome->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->nome->EditValue ?>"<?php echo $profissionais_grid->nome->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($profissionais->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_nome">
<span<?php echo $profissionais_grid->nome->viewAttributes() ?>><?php echo $profissionais_grid->nome->getViewValue() ?></span>
</span>
<?php if (!$profissionais->isConfirm()) { ?>
<input type="hidden" data-table="profissionais" data-field="x_nome" name="x<?php echo $profissionais_grid->RowIndex ?>_nome" id="x<?php echo $profissionais_grid->RowIndex ?>_nome" value="<?php echo HtmlEncode($profissionais_grid->nome->FormValue) ?>">
<input type="hidden" data-table="profissionais" data-field="x_nome" name="o<?php echo $profissionais_grid->RowIndex ?>_nome" id="o<?php echo $profissionais_grid->RowIndex ?>_nome" value="<?php echo HtmlEncode($profissionais_grid->nome->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="profissionais" data-field="x_nome" name="fprofissionaisgrid$x<?php echo $profissionais_grid->RowIndex ?>_nome" id="fprofissionaisgrid$x<?php echo $profissionais_grid->RowIndex ?>_nome" value="<?php echo HtmlEncode($profissionais_grid->nome->FormValue) ?>">
<input type="hidden" data-table="profissionais" data-field="x_nome" name="fprofissionaisgrid$o<?php echo $profissionais_grid->RowIndex ?>_nome" id="fprofissionaisgrid$o<?php echo $profissionais_grid->RowIndex ?>_nome" value="<?php echo HtmlEncode($profissionais_grid->nome->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($profissionais_grid->telefone->Visible) { // telefone ?>
		<td data-name="telefone" <?php echo $profissionais_grid->telefone->cellAttributes() ?>>
<?php if ($profissionais->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_telefone" class="form-group">
<input type="text" data-table="profissionais" data-field="x_telefone" name="x<?php echo $profissionais_grid->RowIndex ?>_telefone" id="x<?php echo $profissionais_grid->RowIndex ?>_telefone" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($profissionais_grid->telefone->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->telefone->EditValue ?>"<?php echo $profissionais_grid->telefone->editAttributes() ?>>
</span>
<input type="hidden" data-table="profissionais" data-field="x_telefone" name="o<?php echo $profissionais_grid->RowIndex ?>_telefone" id="o<?php echo $profissionais_grid->RowIndex ?>_telefone" value="<?php echo HtmlEncode($profissionais_grid->telefone->OldValue) ?>">
<?php } ?>
<?php if ($profissionais->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_telefone" class="form-group">
<input type="text" data-table="profissionais" data-field="x_telefone" name="x<?php echo $profissionais_grid->RowIndex ?>_telefone" id="x<?php echo $profissionais_grid->RowIndex ?>_telefone" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($profissionais_grid->telefone->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->telefone->EditValue ?>"<?php echo $profissionais_grid->telefone->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($profissionais->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_telefone">
<span<?php echo $profissionais_grid->telefone->viewAttributes() ?>><?php echo $profissionais_grid->telefone->getViewValue() ?></span>
</span>
<?php if (!$profissionais->isConfirm()) { ?>
<input type="hidden" data-table="profissionais" data-field="x_telefone" name="x<?php echo $profissionais_grid->RowIndex ?>_telefone" id="x<?php echo $profissionais_grid->RowIndex ?>_telefone" value="<?php echo HtmlEncode($profissionais_grid->telefone->FormValue) ?>">
<input type="hidden" data-table="profissionais" data-field="x_telefone" name="o<?php echo $profissionais_grid->RowIndex ?>_telefone" id="o<?php echo $profissionais_grid->RowIndex ?>_telefone" value="<?php echo HtmlEncode($profissionais_grid->telefone->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="profissionais" data-field="x_telefone" name="fprofissionaisgrid$x<?php echo $profissionais_grid->RowIndex ?>_telefone" id="fprofissionaisgrid$x<?php echo $profissionais_grid->RowIndex ?>_telefone" value="<?php echo HtmlEncode($profissionais_grid->telefone->FormValue) ?>">
<input type="hidden" data-table="profissionais" data-field="x_telefone" name="fprofissionaisgrid$o<?php echo $profissionais_grid->RowIndex ?>_telefone" id="fprofissionaisgrid$o<?php echo $profissionais_grid->RowIndex ?>_telefone" value="<?php echo HtmlEncode($profissionais_grid->telefone->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($profissionais_grid->whatsapp->Visible) { // whatsapp ?>
		<td data-name="whatsapp" <?php echo $profissionais_grid->whatsapp->cellAttributes() ?>>
<?php if ($profissionais->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_whatsapp" class="form-group">
<input type="text" data-table="profissionais" data-field="x_whatsapp" name="x<?php echo $profissionais_grid->RowIndex ?>_whatsapp" id="x<?php echo $profissionais_grid->RowIndex ?>_whatsapp" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($profissionais_grid->whatsapp->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->whatsapp->EditValue ?>"<?php echo $profissionais_grid->whatsapp->editAttributes() ?>>
</span>
<input type="hidden" data-table="profissionais" data-field="x_whatsapp" name="o<?php echo $profissionais_grid->RowIndex ?>_whatsapp" id="o<?php echo $profissionais_grid->RowIndex ?>_whatsapp" value="<?php echo HtmlEncode($profissionais_grid->whatsapp->OldValue) ?>">
<?php } ?>
<?php if ($profissionais->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_whatsapp" class="form-group">
<input type="text" data-table="profissionais" data-field="x_whatsapp" name="x<?php echo $profissionais_grid->RowIndex ?>_whatsapp" id="x<?php echo $profissionais_grid->RowIndex ?>_whatsapp" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($profissionais_grid->whatsapp->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->whatsapp->EditValue ?>"<?php echo $profissionais_grid->whatsapp->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($profissionais->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_whatsapp">
<span<?php echo $profissionais_grid->whatsapp->viewAttributes() ?>><?php echo $profissionais_grid->whatsapp->getViewValue() ?></span>
</span>
<?php if (!$profissionais->isConfirm()) { ?>
<input type="hidden" data-table="profissionais" data-field="x_whatsapp" name="x<?php echo $profissionais_grid->RowIndex ?>_whatsapp" id="x<?php echo $profissionais_grid->RowIndex ?>_whatsapp" value="<?php echo HtmlEncode($profissionais_grid->whatsapp->FormValue) ?>">
<input type="hidden" data-table="profissionais" data-field="x_whatsapp" name="o<?php echo $profissionais_grid->RowIndex ?>_whatsapp" id="o<?php echo $profissionais_grid->RowIndex ?>_whatsapp" value="<?php echo HtmlEncode($profissionais_grid->whatsapp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="profissionais" data-field="x_whatsapp" name="fprofissionaisgrid$x<?php echo $profissionais_grid->RowIndex ?>_whatsapp" id="fprofissionaisgrid$x<?php echo $profissionais_grid->RowIndex ?>_whatsapp" value="<?php echo HtmlEncode($profissionais_grid->whatsapp->FormValue) ?>">
<input type="hidden" data-table="profissionais" data-field="x_whatsapp" name="fprofissionaisgrid$o<?php echo $profissionais_grid->RowIndex ?>_whatsapp" id="fprofissionaisgrid$o<?php echo $profissionais_grid->RowIndex ?>_whatsapp" value="<?php echo HtmlEncode($profissionais_grid->whatsapp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($profissionais_grid->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $profissionais_grid->_email->cellAttributes() ?>>
<?php if ($profissionais->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais__email" class="form-group">
<input type="text" data-table="profissionais" data-field="x__email" name="x<?php echo $profissionais_grid->RowIndex ?>__email" id="x<?php echo $profissionais_grid->RowIndex ?>__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($profissionais_grid->_email->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->_email->EditValue ?>"<?php echo $profissionais_grid->_email->editAttributes() ?>>
</span>
<input type="hidden" data-table="profissionais" data-field="x__email" name="o<?php echo $profissionais_grid->RowIndex ?>__email" id="o<?php echo $profissionais_grid->RowIndex ?>__email" value="<?php echo HtmlEncode($profissionais_grid->_email->OldValue) ?>">
<?php } ?>
<?php if ($profissionais->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais__email" class="form-group">
<input type="text" data-table="profissionais" data-field="x__email" name="x<?php echo $profissionais_grid->RowIndex ?>__email" id="x<?php echo $profissionais_grid->RowIndex ?>__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($profissionais_grid->_email->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->_email->EditValue ?>"<?php echo $profissionais_grid->_email->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($profissionais->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais__email">
<span<?php echo $profissionais_grid->_email->viewAttributes() ?>><?php echo $profissionais_grid->_email->getViewValue() ?></span>
</span>
<?php if (!$profissionais->isConfirm()) { ?>
<input type="hidden" data-table="profissionais" data-field="x__email" name="x<?php echo $profissionais_grid->RowIndex ?>__email" id="x<?php echo $profissionais_grid->RowIndex ?>__email" value="<?php echo HtmlEncode($profissionais_grid->_email->FormValue) ?>">
<input type="hidden" data-table="profissionais" data-field="x__email" name="o<?php echo $profissionais_grid->RowIndex ?>__email" id="o<?php echo $profissionais_grid->RowIndex ?>__email" value="<?php echo HtmlEncode($profissionais_grid->_email->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="profissionais" data-field="x__email" name="fprofissionaisgrid$x<?php echo $profissionais_grid->RowIndex ?>__email" id="fprofissionaisgrid$x<?php echo $profissionais_grid->RowIndex ?>__email" value="<?php echo HtmlEncode($profissionais_grid->_email->FormValue) ?>">
<input type="hidden" data-table="profissionais" data-field="x__email" name="fprofissionaisgrid$o<?php echo $profissionais_grid->RowIndex ?>__email" id="fprofissionaisgrid$o<?php echo $profissionais_grid->RowIndex ?>__email" value="<?php echo HtmlEncode($profissionais_grid->_email->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($profissionais_grid->idarea->Visible) { // idarea ?>
		<td data-name="idarea" <?php echo $profissionais_grid->idarea->cellAttributes() ?>>
<?php if ($profissionais->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($profissionais_grid->idarea->getSessionValue() != "") { ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_idarea" class="form-group">
<span<?php echo $profissionais_grid->idarea->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($profissionais_grid->idarea->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $profissionais_grid->RowIndex ?>_idarea" name="x<?php echo $profissionais_grid->RowIndex ?>_idarea" value="<?php echo HtmlEncode($profissionais_grid->idarea->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_idarea" class="form-group">
<input type="text" data-table="profissionais" data-field="x_idarea" name="x<?php echo $profissionais_grid->RowIndex ?>_idarea" id="x<?php echo $profissionais_grid->RowIndex ?>_idarea" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($profissionais_grid->idarea->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->idarea->EditValue ?>"<?php echo $profissionais_grid->idarea->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="profissionais" data-field="x_idarea" name="o<?php echo $profissionais_grid->RowIndex ?>_idarea" id="o<?php echo $profissionais_grid->RowIndex ?>_idarea" value="<?php echo HtmlEncode($profissionais_grid->idarea->OldValue) ?>">
<?php } ?>
<?php if ($profissionais->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($profissionais_grid->idarea->getSessionValue() != "") { ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_idarea" class="form-group">
<span<?php echo $profissionais_grid->idarea->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($profissionais_grid->idarea->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $profissionais_grid->RowIndex ?>_idarea" name="x<?php echo $profissionais_grid->RowIndex ?>_idarea" value="<?php echo HtmlEncode($profissionais_grid->idarea->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_idarea" class="form-group">
<input type="text" data-table="profissionais" data-field="x_idarea" name="x<?php echo $profissionais_grid->RowIndex ?>_idarea" id="x<?php echo $profissionais_grid->RowIndex ?>_idarea" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($profissionais_grid->idarea->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->idarea->EditValue ?>"<?php echo $profissionais_grid->idarea->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($profissionais->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $profissionais_grid->RowCount ?>_profissionais_idarea">
<span<?php echo $profissionais_grid->idarea->viewAttributes() ?>><?php echo $profissionais_grid->idarea->getViewValue() ?></span>
</span>
<?php if (!$profissionais->isConfirm()) { ?>
<input type="hidden" data-table="profissionais" data-field="x_idarea" name="x<?php echo $profissionais_grid->RowIndex ?>_idarea" id="x<?php echo $profissionais_grid->RowIndex ?>_idarea" value="<?php echo HtmlEncode($profissionais_grid->idarea->FormValue) ?>">
<input type="hidden" data-table="profissionais" data-field="x_idarea" name="o<?php echo $profissionais_grid->RowIndex ?>_idarea" id="o<?php echo $profissionais_grid->RowIndex ?>_idarea" value="<?php echo HtmlEncode($profissionais_grid->idarea->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="profissionais" data-field="x_idarea" name="fprofissionaisgrid$x<?php echo $profissionais_grid->RowIndex ?>_idarea" id="fprofissionaisgrid$x<?php echo $profissionais_grid->RowIndex ?>_idarea" value="<?php echo HtmlEncode($profissionais_grid->idarea->FormValue) ?>">
<input type="hidden" data-table="profissionais" data-field="x_idarea" name="fprofissionaisgrid$o<?php echo $profissionais_grid->RowIndex ?>_idarea" id="fprofissionaisgrid$o<?php echo $profissionais_grid->RowIndex ?>_idarea" value="<?php echo HtmlEncode($profissionais_grid->idarea->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$profissionais_grid->ListOptions->render("body", "right", $profissionais_grid->RowCount);
?>
	</tr>
<?php if ($profissionais->RowType == ROWTYPE_ADD || $profissionais->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fprofissionaisgrid", "load"], function() {
	fprofissionaisgrid.updateLists(<?php echo $profissionais_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$profissionais_grid->isGridAdd() || $profissionais->CurrentMode == "copy")
		if (!$profissionais_grid->Recordset->EOF)
			$profissionais_grid->Recordset->moveNext();
}
?>
<?php
	if ($profissionais->CurrentMode == "add" || $profissionais->CurrentMode == "copy" || $profissionais->CurrentMode == "edit") {
		$profissionais_grid->RowIndex = '$rowindex$';
		$profissionais_grid->loadRowValues();

		// Set row properties
		$profissionais->resetAttributes();
		$profissionais->RowAttrs->merge(["data-rowindex" => $profissionais_grid->RowIndex, "id" => "r0_profissionais", "data-rowtype" => ROWTYPE_ADD]);
		$profissionais->RowAttrs->appendClass("ew-template");
		$profissionais->RowType = ROWTYPE_ADD;

		// Render row
		$profissionais_grid->renderRow();

		// Render list options
		$profissionais_grid->renderListOptions();
		$profissionais_grid->StartRowCount = 0;
?>
	<tr <?php echo $profissionais->rowAttributes() ?>>
<?php

// Render list options (body, left)
$profissionais_grid->ListOptions->render("body", "left", $profissionais_grid->RowIndex);
?>
	<?php if ($profissionais_grid->idprofissionais->Visible) { // idprofissionais ?>
		<td data-name="idprofissionais">
<?php if (!$profissionais->isConfirm()) { ?>
<span id="el$rowindex$_profissionais_idprofissionais" class="form-group profissionais_idprofissionais"></span>
<?php } else { ?>
<span id="el$rowindex$_profissionais_idprofissionais" class="form-group profissionais_idprofissionais">
<span<?php echo $profissionais_grid->idprofissionais->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($profissionais_grid->idprofissionais->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="profissionais" data-field="x_idprofissionais" name="x<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" id="x<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" value="<?php echo HtmlEncode($profissionais_grid->idprofissionais->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="profissionais" data-field="x_idprofissionais" name="o<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" id="o<?php echo $profissionais_grid->RowIndex ?>_idprofissionais" value="<?php echo HtmlEncode($profissionais_grid->idprofissionais->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($profissionais_grid->nome->Visible) { // nome ?>
		<td data-name="nome">
<?php if (!$profissionais->isConfirm()) { ?>
<span id="el$rowindex$_profissionais_nome" class="form-group profissionais_nome">
<input type="text" data-table="profissionais" data-field="x_nome" name="x<?php echo $profissionais_grid->RowIndex ?>_nome" id="x<?php echo $profissionais_grid->RowIndex ?>_nome" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($profissionais_grid->nome->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->nome->EditValue ?>"<?php echo $profissionais_grid->nome->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_profissionais_nome" class="form-group profissionais_nome">
<span<?php echo $profissionais_grid->nome->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($profissionais_grid->nome->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="profissionais" data-field="x_nome" name="x<?php echo $profissionais_grid->RowIndex ?>_nome" id="x<?php echo $profissionais_grid->RowIndex ?>_nome" value="<?php echo HtmlEncode($profissionais_grid->nome->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="profissionais" data-field="x_nome" name="o<?php echo $profissionais_grid->RowIndex ?>_nome" id="o<?php echo $profissionais_grid->RowIndex ?>_nome" value="<?php echo HtmlEncode($profissionais_grid->nome->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($profissionais_grid->telefone->Visible) { // telefone ?>
		<td data-name="telefone">
<?php if (!$profissionais->isConfirm()) { ?>
<span id="el$rowindex$_profissionais_telefone" class="form-group profissionais_telefone">
<input type="text" data-table="profissionais" data-field="x_telefone" name="x<?php echo $profissionais_grid->RowIndex ?>_telefone" id="x<?php echo $profissionais_grid->RowIndex ?>_telefone" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($profissionais_grid->telefone->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->telefone->EditValue ?>"<?php echo $profissionais_grid->telefone->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_profissionais_telefone" class="form-group profissionais_telefone">
<span<?php echo $profissionais_grid->telefone->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($profissionais_grid->telefone->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="profissionais" data-field="x_telefone" name="x<?php echo $profissionais_grid->RowIndex ?>_telefone" id="x<?php echo $profissionais_grid->RowIndex ?>_telefone" value="<?php echo HtmlEncode($profissionais_grid->telefone->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="profissionais" data-field="x_telefone" name="o<?php echo $profissionais_grid->RowIndex ?>_telefone" id="o<?php echo $profissionais_grid->RowIndex ?>_telefone" value="<?php echo HtmlEncode($profissionais_grid->telefone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($profissionais_grid->whatsapp->Visible) { // whatsapp ?>
		<td data-name="whatsapp">
<?php if (!$profissionais->isConfirm()) { ?>
<span id="el$rowindex$_profissionais_whatsapp" class="form-group profissionais_whatsapp">
<input type="text" data-table="profissionais" data-field="x_whatsapp" name="x<?php echo $profissionais_grid->RowIndex ?>_whatsapp" id="x<?php echo $profissionais_grid->RowIndex ?>_whatsapp" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($profissionais_grid->whatsapp->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->whatsapp->EditValue ?>"<?php echo $profissionais_grid->whatsapp->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_profissionais_whatsapp" class="form-group profissionais_whatsapp">
<span<?php echo $profissionais_grid->whatsapp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($profissionais_grid->whatsapp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="profissionais" data-field="x_whatsapp" name="x<?php echo $profissionais_grid->RowIndex ?>_whatsapp" id="x<?php echo $profissionais_grid->RowIndex ?>_whatsapp" value="<?php echo HtmlEncode($profissionais_grid->whatsapp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="profissionais" data-field="x_whatsapp" name="o<?php echo $profissionais_grid->RowIndex ?>_whatsapp" id="o<?php echo $profissionais_grid->RowIndex ?>_whatsapp" value="<?php echo HtmlEncode($profissionais_grid->whatsapp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($profissionais_grid->_email->Visible) { // email ?>
		<td data-name="_email">
<?php if (!$profissionais->isConfirm()) { ?>
<span id="el$rowindex$_profissionais__email" class="form-group profissionais__email">
<input type="text" data-table="profissionais" data-field="x__email" name="x<?php echo $profissionais_grid->RowIndex ?>__email" id="x<?php echo $profissionais_grid->RowIndex ?>__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($profissionais_grid->_email->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->_email->EditValue ?>"<?php echo $profissionais_grid->_email->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_profissionais__email" class="form-group profissionais__email">
<span<?php echo $profissionais_grid->_email->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($profissionais_grid->_email->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="profissionais" data-field="x__email" name="x<?php echo $profissionais_grid->RowIndex ?>__email" id="x<?php echo $profissionais_grid->RowIndex ?>__email" value="<?php echo HtmlEncode($profissionais_grid->_email->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="profissionais" data-field="x__email" name="o<?php echo $profissionais_grid->RowIndex ?>__email" id="o<?php echo $profissionais_grid->RowIndex ?>__email" value="<?php echo HtmlEncode($profissionais_grid->_email->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($profissionais_grid->idarea->Visible) { // idarea ?>
		<td data-name="idarea">
<?php if (!$profissionais->isConfirm()) { ?>
<?php if ($profissionais_grid->idarea->getSessionValue() != "") { ?>
<span id="el$rowindex$_profissionais_idarea" class="form-group profissionais_idarea">
<span<?php echo $profissionais_grid->idarea->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($profissionais_grid->idarea->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $profissionais_grid->RowIndex ?>_idarea" name="x<?php echo $profissionais_grid->RowIndex ?>_idarea" value="<?php echo HtmlEncode($profissionais_grid->idarea->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_profissionais_idarea" class="form-group profissionais_idarea">
<input type="text" data-table="profissionais" data-field="x_idarea" name="x<?php echo $profissionais_grid->RowIndex ?>_idarea" id="x<?php echo $profissionais_grid->RowIndex ?>_idarea" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($profissionais_grid->idarea->getPlaceHolder()) ?>" value="<?php echo $profissionais_grid->idarea->EditValue ?>"<?php echo $profissionais_grid->idarea->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_profissionais_idarea" class="form-group profissionais_idarea">
<span<?php echo $profissionais_grid->idarea->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($profissionais_grid->idarea->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="profissionais" data-field="x_idarea" name="x<?php echo $profissionais_grid->RowIndex ?>_idarea" id="x<?php echo $profissionais_grid->RowIndex ?>_idarea" value="<?php echo HtmlEncode($profissionais_grid->idarea->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="profissionais" data-field="x_idarea" name="o<?php echo $profissionais_grid->RowIndex ?>_idarea" id="o<?php echo $profissionais_grid->RowIndex ?>_idarea" value="<?php echo HtmlEncode($profissionais_grid->idarea->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$profissionais_grid->ListOptions->render("body", "right", $profissionais_grid->RowIndex);
?>
<script>
loadjs.ready(["fprofissionaisgrid", "load"], function() {
	fprofissionaisgrid.updateLists(<?php echo $profissionais_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($profissionais->CurrentMode == "add" || $profissionais->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $profissionais_grid->FormKeyCountName ?>" id="<?php echo $profissionais_grid->FormKeyCountName ?>" value="<?php echo $profissionais_grid->KeyCount ?>">
<?php echo $profissionais_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($profissionais->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $profissionais_grid->FormKeyCountName ?>" id="<?php echo $profissionais_grid->FormKeyCountName ?>" value="<?php echo $profissionais_grid->KeyCount ?>">
<?php echo $profissionais_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($profissionais->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fprofissionaisgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($profissionais_grid->Recordset)
	$profissionais_grid->Recordset->Close();
?>
<?php if ($profissionais_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $profissionais_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($profissionais_grid->TotalRecords == 0 && !$profissionais->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $profissionais_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$profissionais_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$profissionais_grid->terminate();
?>