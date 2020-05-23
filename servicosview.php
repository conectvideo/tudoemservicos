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
$servicos_view = new servicos_view();

// Run the page
$servicos_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$servicos_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$servicos_view->isExport()) { ?>
<script>
var fservicosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fservicosview = currentForm = new ew.Form("fservicosview", "view");
	loadjs.done("fservicosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$servicos_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $servicos_view->ExportOptions->render("body") ?>
<?php $servicos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $servicos_view->showPageHeader(); ?>
<?php
$servicos_view->showMessage();
?>
<form name="fservicosview" id="fservicosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="servicos">
<input type="hidden" name="modal" value="<?php echo (int)$servicos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($servicos_view->idservicos->Visible) { // idservicos ?>
	<tr id="r_idservicos">
		<td class="<?php echo $servicos_view->TableLeftColumnClass ?>"><span id="elh_servicos_idservicos"><?php echo $servicos_view->idservicos->caption() ?></span></td>
		<td data-name="idservicos" <?php echo $servicos_view->idservicos->cellAttributes() ?>>
<span id="el_servicos_idservicos">
<span<?php echo $servicos_view->idservicos->viewAttributes() ?>><?php echo $servicos_view->idservicos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($servicos_view->servicos->Visible) { // servicos ?>
	<tr id="r_servicos">
		<td class="<?php echo $servicos_view->TableLeftColumnClass ?>"><span id="elh_servicos_servicos"><?php echo $servicos_view->servicos->caption() ?></span></td>
		<td data-name="servicos" <?php echo $servicos_view->servicos->cellAttributes() ?>>
<span id="el_servicos_servicos">
<span<?php echo $servicos_view->servicos->viewAttributes() ?>><?php echo $servicos_view->servicos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($servicos_view->idarea->Visible) { // idarea ?>
	<tr id="r_idarea">
		<td class="<?php echo $servicos_view->TableLeftColumnClass ?>"><span id="elh_servicos_idarea"><?php echo $servicos_view->idarea->caption() ?></span></td>
		<td data-name="idarea" <?php echo $servicos_view->idarea->cellAttributes() ?>>
<span id="el_servicos_idarea">
<span<?php echo $servicos_view->idarea->viewAttributes() ?>><?php echo $servicos_view->idarea->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($servicos_view->valor->Visible) { // valor ?>
	<tr id="r_valor">
		<td class="<?php echo $servicos_view->TableLeftColumnClass ?>"><span id="elh_servicos_valor"><?php echo $servicos_view->valor->caption() ?></span></td>
		<td data-name="valor" <?php echo $servicos_view->valor->cellAttributes() ?>>
<span id="el_servicos_valor">
<span<?php echo $servicos_view->valor->viewAttributes() ?>><?php echo $servicos_view->valor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$servicos_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$servicos_view->isExport()) { ?>
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
$servicos_view->terminate();
?>