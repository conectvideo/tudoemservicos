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
$areas_view = new areas_view();

// Run the page
$areas_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$areas_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$areas_view->isExport()) { ?>
<script>
var fareasview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fareasview = currentForm = new ew.Form("fareasview", "view");
	loadjs.done("fareasview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$areas_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $areas_view->ExportOptions->render("body") ?>
<?php $areas_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $areas_view->showPageHeader(); ?>
<?php
$areas_view->showMessage();
?>
<form name="fareasview" id="fareasview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="areas">
<input type="hidden" name="modal" value="<?php echo (int)$areas_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($areas_view->idareas->Visible) { // idareas ?>
	<tr id="r_idareas">
		<td class="<?php echo $areas_view->TableLeftColumnClass ?>"><span id="elh_areas_idareas"><?php echo $areas_view->idareas->caption() ?></span></td>
		<td data-name="idareas" <?php echo $areas_view->idareas->cellAttributes() ?>>
<span id="el_areas_idareas">
<span<?php echo $areas_view->idareas->viewAttributes() ?>><?php echo $areas_view->idareas->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($areas_view->areadescricao->Visible) { // areadescricao ?>
	<tr id="r_areadescricao">
		<td class="<?php echo $areas_view->TableLeftColumnClass ?>"><span id="elh_areas_areadescricao"><?php echo $areas_view->areadescricao->caption() ?></span></td>
		<td data-name="areadescricao" <?php echo $areas_view->areadescricao->cellAttributes() ?>>
<span id="el_areas_areadescricao">
<span<?php echo $areas_view->areadescricao->viewAttributes() ?>><?php echo $areas_view->areadescricao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("profissionais", explode(",", $areas->getCurrentDetailTable())) && $profissionais->DetailView) {
?>
<?php if ($areas->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("profissionais", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "profissionaisgrid.php" ?>
<?php } ?>
</form>
<?php
$areas_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$areas_view->isExport()) { ?>
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
$areas_view->terminate();
?>