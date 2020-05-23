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
$formadepgto_view = new formadepgto_view();

// Run the page
$formadepgto_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$formadepgto_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$formadepgto_view->isExport()) { ?>
<script>
var fformadepgtoview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fformadepgtoview = currentForm = new ew.Form("fformadepgtoview", "view");
	loadjs.done("fformadepgtoview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$formadepgto_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $formadepgto_view->ExportOptions->render("body") ?>
<?php $formadepgto_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $formadepgto_view->showPageHeader(); ?>
<?php
$formadepgto_view->showMessage();
?>
<form name="fformadepgtoview" id="fformadepgtoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="formadepgto">
<input type="hidden" name="modal" value="<?php echo (int)$formadepgto_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($formadepgto_view->idformadepgto->Visible) { // idformadepgto ?>
	<tr id="r_idformadepgto">
		<td class="<?php echo $formadepgto_view->TableLeftColumnClass ?>"><span id="elh_formadepgto_idformadepgto"><?php echo $formadepgto_view->idformadepgto->caption() ?></span></td>
		<td data-name="idformadepgto" <?php echo $formadepgto_view->idformadepgto->cellAttributes() ?>>
<span id="el_formadepgto_idformadepgto">
<span<?php echo $formadepgto_view->idformadepgto->viewAttributes() ?>><?php echo $formadepgto_view->idformadepgto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($formadepgto_view->formadepgto->Visible) { // formadepgto ?>
	<tr id="r_formadepgto">
		<td class="<?php echo $formadepgto_view->TableLeftColumnClass ?>"><span id="elh_formadepgto_formadepgto"><?php echo $formadepgto_view->formadepgto->caption() ?></span></td>
		<td data-name="formadepgto" <?php echo $formadepgto_view->formadepgto->cellAttributes() ?>>
<span id="el_formadepgto_formadepgto">
<span<?php echo $formadepgto_view->formadepgto->viewAttributes() ?>><?php echo $formadepgto_view->formadepgto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$formadepgto_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$formadepgto_view->isExport()) { ?>
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
$formadepgto_view->terminate();
?>