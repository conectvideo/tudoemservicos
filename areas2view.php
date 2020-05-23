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
$areas2_view = new areas2_view();

// Run the page
$areas2_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$areas2_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$areas2_view->isExport()) { ?>
<script>
var fareas2view, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fareas2view = currentForm = new ew.Form("fareas2view", "view");
	loadjs.done("fareas2view");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$areas2_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $areas2_view->ExportOptions->render("body") ?>
<?php $areas2_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $areas2_view->showPageHeader(); ?>
<?php
$areas2_view->showMessage();
?>
<form name="fareas2view" id="fareas2view" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="areas2">
<input type="hidden" name="modal" value="<?php echo (int)$areas2_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($areas2_view->idareas->Visible) { // idareas ?>
	<tr id="r_idareas">
		<td class="<?php echo $areas2_view->TableLeftColumnClass ?>"><span id="elh_areas2_idareas"><?php echo $areas2_view->idareas->caption() ?></span></td>
		<td data-name="idareas" <?php echo $areas2_view->idareas->cellAttributes() ?>>
<span id="el_areas2_idareas">
<span<?php echo $areas2_view->idareas->viewAttributes() ?>><?php echo $areas2_view->idareas->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($areas2_view->areadescricao->Visible) { // areadescricao ?>
	<tr id="r_areadescricao">
		<td class="<?php echo $areas2_view->TableLeftColumnClass ?>"><span id="elh_areas2_areadescricao"><?php echo $areas2_view->areadescricao->caption() ?></span></td>
		<td data-name="areadescricao" <?php echo $areas2_view->areadescricao->cellAttributes() ?>>
<span id="el_areas2_areadescricao">
<span<?php echo $areas2_view->areadescricao->viewAttributes() ?>><?php echo $areas2_view->areadescricao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$areas2_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$areas2_view->isExport()) { ?>
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
$areas2_view->terminate();
?>