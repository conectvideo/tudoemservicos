<?php namespace PHPMaker2020\project1; ?>
<?php

/**
 * Table class for clientes
 */
class clientes extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $idclientes;
	public $nome;
	public $cpf;
	public $rg;
	public $telefonefixo;
	public $celularwhatsapp;
	public $endereco;
	public $numero;
	public $bairro;
	public $complemento;
	public $cep;
	public $_email;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'clientes';
		$this->TableName = 'clientes';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`clientes`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// idclientes
		$this->idclientes = new DbField('clientes', 'clientes', 'x_idclientes', 'idclientes', '`idclientes`', '`idclientes`', 3, 11, -1, FALSE, '`idclientes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idclientes->IsAutoIncrement = TRUE; // Autoincrement field
		$this->idclientes->IsPrimaryKey = TRUE; // Primary key field
		$this->idclientes->Sortable = TRUE; // Allow sort
		$this->idclientes->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idclientes'] = &$this->idclientes;

		// nome
		$this->nome = new DbField('clientes', 'clientes', 'x_nome', 'nome', '`nome`', '`nome`', 200, 100, -1, FALSE, '`nome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nome->Sortable = TRUE; // Allow sort
		$this->fields['nome'] = &$this->nome;

		// cpf
		$this->cpf = new DbField('clientes', 'clientes', 'x_cpf', 'cpf', '`cpf`', '`cpf`', 200, 14, -1, FALSE, '`cpf`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cpf->Sortable = TRUE; // Allow sort
		$this->fields['cpf'] = &$this->cpf;

		// rg
		$this->rg = new DbField('clientes', 'clientes', 'x_rg', 'rg', '`rg`', '`rg`', 200, 45, -1, FALSE, '`rg`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rg->Sortable = TRUE; // Allow sort
		$this->fields['rg'] = &$this->rg;

		// telefonefixo
		$this->telefonefixo = new DbField('clientes', 'clientes', 'x_telefonefixo', 'telefonefixo', '`telefonefixo`', '`telefonefixo`', 200, 25, -1, FALSE, '`telefonefixo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telefonefixo->Sortable = TRUE; // Allow sort
		$this->fields['telefonefixo'] = &$this->telefonefixo;

		// celularwhatsapp
		$this->celularwhatsapp = new DbField('clientes', 'clientes', 'x_celularwhatsapp', 'celularwhatsapp', '`celularwhatsapp`', '`celularwhatsapp`', 200, 25, -1, FALSE, '`celularwhatsapp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->celularwhatsapp->Sortable = TRUE; // Allow sort
		$this->fields['celularwhatsapp'] = &$this->celularwhatsapp;

		// endereco
		$this->endereco = new DbField('clientes', 'clientes', 'x_endereco', 'endereco', '`endereco`', '`endereco`', 200, 45, -1, FALSE, '`endereco`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->endereco->Sortable = TRUE; // Allow sort
		$this->fields['endereco'] = &$this->endereco;

		// numero
		$this->numero = new DbField('clientes', 'clientes', 'x_numero', 'numero', '`numero`', '`numero`', 200, 45, -1, FALSE, '`numero`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->numero->Sortable = TRUE; // Allow sort
		$this->fields['numero'] = &$this->numero;

		// bairro
		$this->bairro = new DbField('clientes', 'clientes', 'x_bairro', 'bairro', '`bairro`', '`bairro`', 200, 45, -1, FALSE, '`bairro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bairro->Sortable = TRUE; // Allow sort
		$this->fields['bairro'] = &$this->bairro;

		// complemento
		$this->complemento = new DbField('clientes', 'clientes', 'x_complemento', 'complemento', '`complemento`', '`complemento`', 200, 45, -1, FALSE, '`complemento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->complemento->Sortable = TRUE; // Allow sort
		$this->fields['complemento'] = &$this->complemento;

		// cep
		$this->cep = new DbField('clientes', 'clientes', 'x_cep', 'cep', '`cep`', '`cep`', 200, 10, -1, FALSE, '`cep`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cep->Sortable = TRUE; // Allow sort
		$this->fields['cep'] = &$this->cep;

		// email
		$this->_email = new DbField('clientes', 'clientes', 'x__email', 'email', '`email`', '`email`', 200, 100, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Sortable = TRUE; // Allow sort
		$this->fields['email'] = &$this->_email;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`clientes`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter, $id = "")
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->idclientes->setDbValue($conn->insert_ID());
			$rs['idclientes'] = $this->idclientes->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('idclientes', $rs))
				AddFilter($where, QuotedName('idclientes', $this->Dbid) . '=' . QuotedValue($rs['idclientes'], $this->idclientes->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->idclientes->DbValue = $row['idclientes'];
		$this->nome->DbValue = $row['nome'];
		$this->cpf->DbValue = $row['cpf'];
		$this->rg->DbValue = $row['rg'];
		$this->telefonefixo->DbValue = $row['telefonefixo'];
		$this->celularwhatsapp->DbValue = $row['celularwhatsapp'];
		$this->endereco->DbValue = $row['endereco'];
		$this->numero->DbValue = $row['numero'];
		$this->bairro->DbValue = $row['bairro'];
		$this->complemento->DbValue = $row['complemento'];
		$this->cep->DbValue = $row['cep'];
		$this->_email->DbValue = $row['email'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`idclientes` = @idclientes@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('idclientes', $row) ? $row['idclientes'] : NULL;
		else
			$val = $this->idclientes->OldValue !== NULL ? $this->idclientes->OldValue : $this->idclientes->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@idclientes@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "clienteslist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "clientesview.php")
			return $Language->phrase("View");
		elseif ($pageName == "clientesedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "clientesadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "clienteslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("clientesview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("clientesview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "clientesadd.php?" . $this->getUrlParm($parm);
		else
			$url = "clientesadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("clientesedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("clientesadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("clientesdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "idclientes:" . JsonEncode($this->idclientes->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->idclientes->CurrentValue != NULL) {
			$url .= "idclientes=" . urlencode($this->idclientes->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("idclientes") !== NULL)
				$arKeys[] = Param("idclientes");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->idclientes->CurrentValue = $key;
			else
				$this->idclientes->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->idclientes->setDbValue($rs->fields('idclientes'));
		$this->nome->setDbValue($rs->fields('nome'));
		$this->cpf->setDbValue($rs->fields('cpf'));
		$this->rg->setDbValue($rs->fields('rg'));
		$this->telefonefixo->setDbValue($rs->fields('telefonefixo'));
		$this->celularwhatsapp->setDbValue($rs->fields('celularwhatsapp'));
		$this->endereco->setDbValue($rs->fields('endereco'));
		$this->numero->setDbValue($rs->fields('numero'));
		$this->bairro->setDbValue($rs->fields('bairro'));
		$this->complemento->setDbValue($rs->fields('complemento'));
		$this->cep->setDbValue($rs->fields('cep'));
		$this->_email->setDbValue($rs->fields('email'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// idclientes
		// nome
		// cpf
		// rg
		// telefonefixo
		// celularwhatsapp
		// endereco
		// numero
		// bairro
		// complemento
		// cep
		// email
		// idclientes

		$this->idclientes->ViewValue = $this->idclientes->CurrentValue;
		$this->idclientes->ViewCustomAttributes = "";

		// nome
		$this->nome->ViewValue = $this->nome->CurrentValue;
		$this->nome->ViewCustomAttributes = "";

		// cpf
		$this->cpf->ViewValue = $this->cpf->CurrentValue;
		$this->cpf->ViewCustomAttributes = "";

		// rg
		$this->rg->ViewValue = $this->rg->CurrentValue;
		$this->rg->ViewCustomAttributes = "";

		// telefonefixo
		$this->telefonefixo->ViewValue = $this->telefonefixo->CurrentValue;
		$this->telefonefixo->ViewCustomAttributes = "";

		// celularwhatsapp
		$this->celularwhatsapp->ViewValue = $this->celularwhatsapp->CurrentValue;
		$this->celularwhatsapp->ViewCustomAttributes = "";

		// endereco
		$this->endereco->ViewValue = $this->endereco->CurrentValue;
		$this->endereco->ViewCustomAttributes = "";

		// numero
		$this->numero->ViewValue = $this->numero->CurrentValue;
		$this->numero->ViewCustomAttributes = "";

		// bairro
		$this->bairro->ViewValue = $this->bairro->CurrentValue;
		$this->bairro->ViewCustomAttributes = "";

		// complemento
		$this->complemento->ViewValue = $this->complemento->CurrentValue;
		$this->complemento->ViewCustomAttributes = "";

		// cep
		$this->cep->ViewValue = $this->cep->CurrentValue;
		$this->cep->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// idclientes
		$this->idclientes->LinkCustomAttributes = "";
		$this->idclientes->HrefValue = "";
		$this->idclientes->TooltipValue = "";

		// nome
		$this->nome->LinkCustomAttributes = "";
		$this->nome->HrefValue = "";
		$this->nome->TooltipValue = "";

		// cpf
		$this->cpf->LinkCustomAttributes = "";
		$this->cpf->HrefValue = "";
		$this->cpf->TooltipValue = "";

		// rg
		$this->rg->LinkCustomAttributes = "";
		$this->rg->HrefValue = "";
		$this->rg->TooltipValue = "";

		// telefonefixo
		$this->telefonefixo->LinkCustomAttributes = "";
		$this->telefonefixo->HrefValue = "";
		$this->telefonefixo->TooltipValue = "";

		// celularwhatsapp
		$this->celularwhatsapp->LinkCustomAttributes = "";
		$this->celularwhatsapp->HrefValue = "";
		$this->celularwhatsapp->TooltipValue = "";

		// endereco
		$this->endereco->LinkCustomAttributes = "";
		$this->endereco->HrefValue = "";
		$this->endereco->TooltipValue = "";

		// numero
		$this->numero->LinkCustomAttributes = "";
		$this->numero->HrefValue = "";
		$this->numero->TooltipValue = "";

		// bairro
		$this->bairro->LinkCustomAttributes = "";
		$this->bairro->HrefValue = "";
		$this->bairro->TooltipValue = "";

		// complemento
		$this->complemento->LinkCustomAttributes = "";
		$this->complemento->HrefValue = "";
		$this->complemento->TooltipValue = "";

		// cep
		$this->cep->LinkCustomAttributes = "";
		$this->cep->HrefValue = "";
		$this->cep->TooltipValue = "";

		// email
		$this->_email->LinkCustomAttributes = "";
		$this->_email->HrefValue = "";
		$this->_email->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// idclientes
		$this->idclientes->EditAttrs["class"] = "form-control";
		$this->idclientes->EditCustomAttributes = "";
		$this->idclientes->EditValue = $this->idclientes->CurrentValue;
		$this->idclientes->ViewCustomAttributes = "";

		// nome
		$this->nome->EditAttrs["class"] = "form-control";
		$this->nome->EditCustomAttributes = "";
		if (!$this->nome->Raw)
			$this->nome->CurrentValue = HtmlDecode($this->nome->CurrentValue);
		$this->nome->EditValue = $this->nome->CurrentValue;
		$this->nome->PlaceHolder = RemoveHtml($this->nome->caption());

		// cpf
		$this->cpf->EditAttrs["class"] = "form-control";
		$this->cpf->EditCustomAttributes = "";
		if (!$this->cpf->Raw)
			$this->cpf->CurrentValue = HtmlDecode($this->cpf->CurrentValue);
		$this->cpf->EditValue = $this->cpf->CurrentValue;
		$this->cpf->PlaceHolder = RemoveHtml($this->cpf->caption());

		// rg
		$this->rg->EditAttrs["class"] = "form-control";
		$this->rg->EditCustomAttributes = "";
		if (!$this->rg->Raw)
			$this->rg->CurrentValue = HtmlDecode($this->rg->CurrentValue);
		$this->rg->EditValue = $this->rg->CurrentValue;
		$this->rg->PlaceHolder = RemoveHtml($this->rg->caption());

		// telefonefixo
		$this->telefonefixo->EditAttrs["class"] = "form-control";
		$this->telefonefixo->EditCustomAttributes = "";
		if (!$this->telefonefixo->Raw)
			$this->telefonefixo->CurrentValue = HtmlDecode($this->telefonefixo->CurrentValue);
		$this->telefonefixo->EditValue = $this->telefonefixo->CurrentValue;
		$this->telefonefixo->PlaceHolder = RemoveHtml($this->telefonefixo->caption());

		// celularwhatsapp
		$this->celularwhatsapp->EditAttrs["class"] = "form-control";
		$this->celularwhatsapp->EditCustomAttributes = "";
		if (!$this->celularwhatsapp->Raw)
			$this->celularwhatsapp->CurrentValue = HtmlDecode($this->celularwhatsapp->CurrentValue);
		$this->celularwhatsapp->EditValue = $this->celularwhatsapp->CurrentValue;
		$this->celularwhatsapp->PlaceHolder = RemoveHtml($this->celularwhatsapp->caption());

		// endereco
		$this->endereco->EditAttrs["class"] = "form-control";
		$this->endereco->EditCustomAttributes = "";
		if (!$this->endereco->Raw)
			$this->endereco->CurrentValue = HtmlDecode($this->endereco->CurrentValue);
		$this->endereco->EditValue = $this->endereco->CurrentValue;
		$this->endereco->PlaceHolder = RemoveHtml($this->endereco->caption());

		// numero
		$this->numero->EditAttrs["class"] = "form-control";
		$this->numero->EditCustomAttributes = "";
		if (!$this->numero->Raw)
			$this->numero->CurrentValue = HtmlDecode($this->numero->CurrentValue);
		$this->numero->EditValue = $this->numero->CurrentValue;
		$this->numero->PlaceHolder = RemoveHtml($this->numero->caption());

		// bairro
		$this->bairro->EditAttrs["class"] = "form-control";
		$this->bairro->EditCustomAttributes = "";
		if (!$this->bairro->Raw)
			$this->bairro->CurrentValue = HtmlDecode($this->bairro->CurrentValue);
		$this->bairro->EditValue = $this->bairro->CurrentValue;
		$this->bairro->PlaceHolder = RemoveHtml($this->bairro->caption());

		// complemento
		$this->complemento->EditAttrs["class"] = "form-control";
		$this->complemento->EditCustomAttributes = "";
		if (!$this->complemento->Raw)
			$this->complemento->CurrentValue = HtmlDecode($this->complemento->CurrentValue);
		$this->complemento->EditValue = $this->complemento->CurrentValue;
		$this->complemento->PlaceHolder = RemoveHtml($this->complemento->caption());

		// cep
		$this->cep->EditAttrs["class"] = "form-control";
		$this->cep->EditCustomAttributes = "";
		if (!$this->cep->Raw)
			$this->cep->CurrentValue = HtmlDecode($this->cep->CurrentValue);
		$this->cep->EditValue = $this->cep->CurrentValue;
		$this->cep->PlaceHolder = RemoveHtml($this->cep->caption());

		// email
		$this->_email->EditAttrs["class"] = "form-control";
		$this->_email->EditCustomAttributes = "";
		if (!$this->_email->Raw)
			$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
		$this->_email->EditValue = $this->_email->CurrentValue;
		$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->idclientes);
					$doc->exportCaption($this->nome);
					$doc->exportCaption($this->cpf);
					$doc->exportCaption($this->rg);
					$doc->exportCaption($this->telefonefixo);
					$doc->exportCaption($this->celularwhatsapp);
					$doc->exportCaption($this->endereco);
					$doc->exportCaption($this->numero);
					$doc->exportCaption($this->bairro);
					$doc->exportCaption($this->complemento);
					$doc->exportCaption($this->cep);
					$doc->exportCaption($this->_email);
				} else {
					$doc->exportCaption($this->idclientes);
					$doc->exportCaption($this->nome);
					$doc->exportCaption($this->cpf);
					$doc->exportCaption($this->rg);
					$doc->exportCaption($this->telefonefixo);
					$doc->exportCaption($this->celularwhatsapp);
					$doc->exportCaption($this->endereco);
					$doc->exportCaption($this->numero);
					$doc->exportCaption($this->bairro);
					$doc->exportCaption($this->complemento);
					$doc->exportCaption($this->cep);
					$doc->exportCaption($this->_email);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->idclientes);
						$doc->exportField($this->nome);
						$doc->exportField($this->cpf);
						$doc->exportField($this->rg);
						$doc->exportField($this->telefonefixo);
						$doc->exportField($this->celularwhatsapp);
						$doc->exportField($this->endereco);
						$doc->exportField($this->numero);
						$doc->exportField($this->bairro);
						$doc->exportField($this->complemento);
						$doc->exportField($this->cep);
						$doc->exportField($this->_email);
					} else {
						$doc->exportField($this->idclientes);
						$doc->exportField($this->nome);
						$doc->exportField($this->cpf);
						$doc->exportField($this->rg);
						$doc->exportField($this->telefonefixo);
						$doc->exportField($this->celularwhatsapp);
						$doc->exportField($this->endereco);
						$doc->exportField($this->numero);
						$doc->exportField($this->bairro);
						$doc->exportField($this->complemento);
						$doc->exportField($this->cep);
						$doc->exportField($this->_email);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>