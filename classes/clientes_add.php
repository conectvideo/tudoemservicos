<?php
namespace PHPMaker2020\project1;

/**
 * Page class
 */
class clientes_add extends clientes
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{A004BB51-6011-47F7-9C22-37FF3884C079}";

	// Table name
	public $TableName = 'clientes';

	// Page object name
	public $PageObjName = "clientes_add";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (clientes)
		if (!isset($GLOBALS["clientes"]) || get_class($GLOBALS["clientes"]) == PROJECT_NAMESPACE . "clientes") {
			$GLOBALS["clientes"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["clientes"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'clientes');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $clientes;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($clientes);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "clientesview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['idclientes'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->idclientes->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->idclientes->Visible = FALSE;
		$this->nome->setVisibility();
		$this->cpf->setVisibility();
		$this->rg->setVisibility();
		$this->telefonefixo->setVisibility();
		$this->celularwhatsapp->setVisibility();
		$this->endereco->setVisibility();
		$this->numero->setVisibility();
		$this->bairro->setVisibility();
		$this->complemento->setVisibility();
		$this->cep->setVisibility();
		$this->_email->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("idclientes") !== NULL) {
				$this->idclientes->setQueryStringValue(Get("idclientes"));
				$this->setKey("idclientes", $this->idclientes->CurrentValue); // Set up key
			} else {
				$this->setKey("idclientes", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("clienteslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "clienteslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "clientesview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->idclientes->CurrentValue = NULL;
		$this->idclientes->OldValue = $this->idclientes->CurrentValue;
		$this->nome->CurrentValue = NULL;
		$this->nome->OldValue = $this->nome->CurrentValue;
		$this->cpf->CurrentValue = NULL;
		$this->cpf->OldValue = $this->cpf->CurrentValue;
		$this->rg->CurrentValue = NULL;
		$this->rg->OldValue = $this->rg->CurrentValue;
		$this->telefonefixo->CurrentValue = NULL;
		$this->telefonefixo->OldValue = $this->telefonefixo->CurrentValue;
		$this->celularwhatsapp->CurrentValue = NULL;
		$this->celularwhatsapp->OldValue = $this->celularwhatsapp->CurrentValue;
		$this->endereco->CurrentValue = NULL;
		$this->endereco->OldValue = $this->endereco->CurrentValue;
		$this->numero->CurrentValue = NULL;
		$this->numero->OldValue = $this->numero->CurrentValue;
		$this->bairro->CurrentValue = NULL;
		$this->bairro->OldValue = $this->bairro->CurrentValue;
		$this->complemento->CurrentValue = NULL;
		$this->complemento->OldValue = $this->complemento->CurrentValue;
		$this->cep->CurrentValue = NULL;
		$this->cep->OldValue = $this->cep->CurrentValue;
		$this->_email->CurrentValue = NULL;
		$this->_email->OldValue = $this->_email->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'nome' first before field var 'x_nome'
		$val = $CurrentForm->hasValue("nome") ? $CurrentForm->getValue("nome") : $CurrentForm->getValue("x_nome");
		if (!$this->nome->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nome->Visible = FALSE; // Disable update for API request
			else
				$this->nome->setFormValue($val);
		}

		// Check field name 'cpf' first before field var 'x_cpf'
		$val = $CurrentForm->hasValue("cpf") ? $CurrentForm->getValue("cpf") : $CurrentForm->getValue("x_cpf");
		if (!$this->cpf->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cpf->Visible = FALSE; // Disable update for API request
			else
				$this->cpf->setFormValue($val);
		}

		// Check field name 'rg' first before field var 'x_rg'
		$val = $CurrentForm->hasValue("rg") ? $CurrentForm->getValue("rg") : $CurrentForm->getValue("x_rg");
		if (!$this->rg->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->rg->Visible = FALSE; // Disable update for API request
			else
				$this->rg->setFormValue($val);
		}

		// Check field name 'telefonefixo' first before field var 'x_telefonefixo'
		$val = $CurrentForm->hasValue("telefonefixo") ? $CurrentForm->getValue("telefonefixo") : $CurrentForm->getValue("x_telefonefixo");
		if (!$this->telefonefixo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->telefonefixo->Visible = FALSE; // Disable update for API request
			else
				$this->telefonefixo->setFormValue($val);
		}

		// Check field name 'celularwhatsapp' first before field var 'x_celularwhatsapp'
		$val = $CurrentForm->hasValue("celularwhatsapp") ? $CurrentForm->getValue("celularwhatsapp") : $CurrentForm->getValue("x_celularwhatsapp");
		if (!$this->celularwhatsapp->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->celularwhatsapp->Visible = FALSE; // Disable update for API request
			else
				$this->celularwhatsapp->setFormValue($val);
		}

		// Check field name 'endereco' first before field var 'x_endereco'
		$val = $CurrentForm->hasValue("endereco") ? $CurrentForm->getValue("endereco") : $CurrentForm->getValue("x_endereco");
		if (!$this->endereco->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->endereco->Visible = FALSE; // Disable update for API request
			else
				$this->endereco->setFormValue($val);
		}

		// Check field name 'numero' first before field var 'x_numero'
		$val = $CurrentForm->hasValue("numero") ? $CurrentForm->getValue("numero") : $CurrentForm->getValue("x_numero");
		if (!$this->numero->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->numero->Visible = FALSE; // Disable update for API request
			else
				$this->numero->setFormValue($val);
		}

		// Check field name 'bairro' first before field var 'x_bairro'
		$val = $CurrentForm->hasValue("bairro") ? $CurrentForm->getValue("bairro") : $CurrentForm->getValue("x_bairro");
		if (!$this->bairro->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->bairro->Visible = FALSE; // Disable update for API request
			else
				$this->bairro->setFormValue($val);
		}

		// Check field name 'complemento' first before field var 'x_complemento'
		$val = $CurrentForm->hasValue("complemento") ? $CurrentForm->getValue("complemento") : $CurrentForm->getValue("x_complemento");
		if (!$this->complemento->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->complemento->Visible = FALSE; // Disable update for API request
			else
				$this->complemento->setFormValue($val);
		}

		// Check field name 'cep' first before field var 'x_cep'
		$val = $CurrentForm->hasValue("cep") ? $CurrentForm->getValue("cep") : $CurrentForm->getValue("x_cep");
		if (!$this->cep->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cep->Visible = FALSE; // Disable update for API request
			else
				$this->cep->setFormValue($val);
		}

		// Check field name 'email' first before field var 'x__email'
		$val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
		if (!$this->_email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_email->Visible = FALSE; // Disable update for API request
			else
				$this->_email->setFormValue($val);
		}

		// Check field name 'idclientes' first before field var 'x_idclientes'
		$val = $CurrentForm->hasValue("idclientes") ? $CurrentForm->getValue("idclientes") : $CurrentForm->getValue("x_idclientes");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->nome->CurrentValue = $this->nome->FormValue;
		$this->cpf->CurrentValue = $this->cpf->FormValue;
		$this->rg->CurrentValue = $this->rg->FormValue;
		$this->telefonefixo->CurrentValue = $this->telefonefixo->FormValue;
		$this->celularwhatsapp->CurrentValue = $this->celularwhatsapp->FormValue;
		$this->endereco->CurrentValue = $this->endereco->FormValue;
		$this->numero->CurrentValue = $this->numero->FormValue;
		$this->bairro->CurrentValue = $this->bairro->FormValue;
		$this->complemento->CurrentValue = $this->complemento->FormValue;
		$this->cep->CurrentValue = $this->cep->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->idclientes->setDbValue($row['idclientes']);
		$this->nome->setDbValue($row['nome']);
		$this->cpf->setDbValue($row['cpf']);
		$this->rg->setDbValue($row['rg']);
		$this->telefonefixo->setDbValue($row['telefonefixo']);
		$this->celularwhatsapp->setDbValue($row['celularwhatsapp']);
		$this->endereco->setDbValue($row['endereco']);
		$this->numero->setDbValue($row['numero']);
		$this->bairro->setDbValue($row['bairro']);
		$this->complemento->setDbValue($row['complemento']);
		$this->cep->setDbValue($row['cep']);
		$this->_email->setDbValue($row['email']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['idclientes'] = $this->idclientes->CurrentValue;
		$row['nome'] = $this->nome->CurrentValue;
		$row['cpf'] = $this->cpf->CurrentValue;
		$row['rg'] = $this->rg->CurrentValue;
		$row['telefonefixo'] = $this->telefonefixo->CurrentValue;
		$row['celularwhatsapp'] = $this->celularwhatsapp->CurrentValue;
		$row['endereco'] = $this->endereco->CurrentValue;
		$row['numero'] = $this->numero->CurrentValue;
		$row['bairro'] = $this->bairro->CurrentValue;
		$row['complemento'] = $this->complemento->CurrentValue;
		$row['cep'] = $this->cep->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("idclientes")) != "")
			$this->idclientes->OldValue = $this->getKey("idclientes"); // idclientes
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// nome
			$this->nome->EditAttrs["class"] = "form-control";
			$this->nome->EditCustomAttributes = "";
			if (!$this->nome->Raw)
				$this->nome->CurrentValue = HtmlDecode($this->nome->CurrentValue);
			$this->nome->EditValue = HtmlEncode($this->nome->CurrentValue);
			$this->nome->PlaceHolder = RemoveHtml($this->nome->caption());

			// cpf
			$this->cpf->EditAttrs["class"] = "form-control";
			$this->cpf->EditCustomAttributes = "";
			if (!$this->cpf->Raw)
				$this->cpf->CurrentValue = HtmlDecode($this->cpf->CurrentValue);
			$this->cpf->EditValue = HtmlEncode($this->cpf->CurrentValue);
			$this->cpf->PlaceHolder = RemoveHtml($this->cpf->caption());

			// rg
			$this->rg->EditAttrs["class"] = "form-control";
			$this->rg->EditCustomAttributes = "";
			if (!$this->rg->Raw)
				$this->rg->CurrentValue = HtmlDecode($this->rg->CurrentValue);
			$this->rg->EditValue = HtmlEncode($this->rg->CurrentValue);
			$this->rg->PlaceHolder = RemoveHtml($this->rg->caption());

			// telefonefixo
			$this->telefonefixo->EditAttrs["class"] = "form-control";
			$this->telefonefixo->EditCustomAttributes = "";
			if (!$this->telefonefixo->Raw)
				$this->telefonefixo->CurrentValue = HtmlDecode($this->telefonefixo->CurrentValue);
			$this->telefonefixo->EditValue = HtmlEncode($this->telefonefixo->CurrentValue);
			$this->telefonefixo->PlaceHolder = RemoveHtml($this->telefonefixo->caption());

			// celularwhatsapp
			$this->celularwhatsapp->EditAttrs["class"] = "form-control";
			$this->celularwhatsapp->EditCustomAttributes = "";
			if (!$this->celularwhatsapp->Raw)
				$this->celularwhatsapp->CurrentValue = HtmlDecode($this->celularwhatsapp->CurrentValue);
			$this->celularwhatsapp->EditValue = HtmlEncode($this->celularwhatsapp->CurrentValue);
			$this->celularwhatsapp->PlaceHolder = RemoveHtml($this->celularwhatsapp->caption());

			// endereco
			$this->endereco->EditAttrs["class"] = "form-control";
			$this->endereco->EditCustomAttributes = "";
			if (!$this->endereco->Raw)
				$this->endereco->CurrentValue = HtmlDecode($this->endereco->CurrentValue);
			$this->endereco->EditValue = HtmlEncode($this->endereco->CurrentValue);
			$this->endereco->PlaceHolder = RemoveHtml($this->endereco->caption());

			// numero
			$this->numero->EditAttrs["class"] = "form-control";
			$this->numero->EditCustomAttributes = "";
			if (!$this->numero->Raw)
				$this->numero->CurrentValue = HtmlDecode($this->numero->CurrentValue);
			$this->numero->EditValue = HtmlEncode($this->numero->CurrentValue);
			$this->numero->PlaceHolder = RemoveHtml($this->numero->caption());

			// bairro
			$this->bairro->EditAttrs["class"] = "form-control";
			$this->bairro->EditCustomAttributes = "";
			if (!$this->bairro->Raw)
				$this->bairro->CurrentValue = HtmlDecode($this->bairro->CurrentValue);
			$this->bairro->EditValue = HtmlEncode($this->bairro->CurrentValue);
			$this->bairro->PlaceHolder = RemoveHtml($this->bairro->caption());

			// complemento
			$this->complemento->EditAttrs["class"] = "form-control";
			$this->complemento->EditCustomAttributes = "";
			if (!$this->complemento->Raw)
				$this->complemento->CurrentValue = HtmlDecode($this->complemento->CurrentValue);
			$this->complemento->EditValue = HtmlEncode($this->complemento->CurrentValue);
			$this->complemento->PlaceHolder = RemoveHtml($this->complemento->caption());

			// cep
			$this->cep->EditAttrs["class"] = "form-control";
			$this->cep->EditCustomAttributes = "";
			if (!$this->cep->Raw)
				$this->cep->CurrentValue = HtmlDecode($this->cep->CurrentValue);
			$this->cep->EditValue = HtmlEncode($this->cep->CurrentValue);
			$this->cep->PlaceHolder = RemoveHtml($this->cep->caption());

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			if (!$this->_email->Raw)
				$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
			$this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

			// Add refer script
			// nome

			$this->nome->LinkCustomAttributes = "";
			$this->nome->HrefValue = "";

			// cpf
			$this->cpf->LinkCustomAttributes = "";
			$this->cpf->HrefValue = "";

			// rg
			$this->rg->LinkCustomAttributes = "";
			$this->rg->HrefValue = "";

			// telefonefixo
			$this->telefonefixo->LinkCustomAttributes = "";
			$this->telefonefixo->HrefValue = "";

			// celularwhatsapp
			$this->celularwhatsapp->LinkCustomAttributes = "";
			$this->celularwhatsapp->HrefValue = "";

			// endereco
			$this->endereco->LinkCustomAttributes = "";
			$this->endereco->HrefValue = "";

			// numero
			$this->numero->LinkCustomAttributes = "";
			$this->numero->HrefValue = "";

			// bairro
			$this->bairro->LinkCustomAttributes = "";
			$this->bairro->HrefValue = "";

			// complemento
			$this->complemento->LinkCustomAttributes = "";
			$this->complemento->HrefValue = "";

			// cep
			$this->cep->LinkCustomAttributes = "";
			$this->cep->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->nome->Required) {
			if (!$this->nome->IsDetailKey && $this->nome->FormValue != NULL && $this->nome->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nome->caption(), $this->nome->RequiredErrorMessage));
			}
		}
		if ($this->cpf->Required) {
			if (!$this->cpf->IsDetailKey && $this->cpf->FormValue != NULL && $this->cpf->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cpf->caption(), $this->cpf->RequiredErrorMessage));
			}
		}
		if ($this->rg->Required) {
			if (!$this->rg->IsDetailKey && $this->rg->FormValue != NULL && $this->rg->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->rg->caption(), $this->rg->RequiredErrorMessage));
			}
		}
		if ($this->telefonefixo->Required) {
			if (!$this->telefonefixo->IsDetailKey && $this->telefonefixo->FormValue != NULL && $this->telefonefixo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telefonefixo->caption(), $this->telefonefixo->RequiredErrorMessage));
			}
		}
		if ($this->celularwhatsapp->Required) {
			if (!$this->celularwhatsapp->IsDetailKey && $this->celularwhatsapp->FormValue != NULL && $this->celularwhatsapp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->celularwhatsapp->caption(), $this->celularwhatsapp->RequiredErrorMessage));
			}
		}
		if ($this->endereco->Required) {
			if (!$this->endereco->IsDetailKey && $this->endereco->FormValue != NULL && $this->endereco->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->endereco->caption(), $this->endereco->RequiredErrorMessage));
			}
		}
		if ($this->numero->Required) {
			if (!$this->numero->IsDetailKey && $this->numero->FormValue != NULL && $this->numero->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->numero->caption(), $this->numero->RequiredErrorMessage));
			}
		}
		if ($this->bairro->Required) {
			if (!$this->bairro->IsDetailKey && $this->bairro->FormValue != NULL && $this->bairro->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->bairro->caption(), $this->bairro->RequiredErrorMessage));
			}
		}
		if ($this->complemento->Required) {
			if (!$this->complemento->IsDetailKey && $this->complemento->FormValue != NULL && $this->complemento->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->complemento->caption(), $this->complemento->RequiredErrorMessage));
			}
		}
		if ($this->cep->Required) {
			if (!$this->cep->IsDetailKey && $this->cep->FormValue != NULL && $this->cep->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cep->caption(), $this->cep->RequiredErrorMessage));
			}
		}
		if ($this->_email->Required) {
			if (!$this->_email->IsDetailKey && $this->_email->FormValue != NULL && $this->_email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// nome
		$this->nome->setDbValueDef($rsnew, $this->nome->CurrentValue, NULL, FALSE);

		// cpf
		$this->cpf->setDbValueDef($rsnew, $this->cpf->CurrentValue, NULL, FALSE);

		// rg
		$this->rg->setDbValueDef($rsnew, $this->rg->CurrentValue, NULL, FALSE);

		// telefonefixo
		$this->telefonefixo->setDbValueDef($rsnew, $this->telefonefixo->CurrentValue, NULL, FALSE);

		// celularwhatsapp
		$this->celularwhatsapp->setDbValueDef($rsnew, $this->celularwhatsapp->CurrentValue, NULL, FALSE);

		// endereco
		$this->endereco->setDbValueDef($rsnew, $this->endereco->CurrentValue, NULL, FALSE);

		// numero
		$this->numero->setDbValueDef($rsnew, $this->numero->CurrentValue, NULL, FALSE);

		// bairro
		$this->bairro->setDbValueDef($rsnew, $this->bairro->CurrentValue, NULL, FALSE);

		// complemento
		$this->complemento->setDbValueDef($rsnew, $this->complemento->CurrentValue, NULL, FALSE);

		// cep
		$this->cep->setDbValueDef($rsnew, $this->cep->CurrentValue, NULL, FALSE);

		// email
		$this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("clienteslist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>