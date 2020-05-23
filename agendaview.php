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
$agenda_view = new agenda_view();

// Run the page
$agenda_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agenda_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$agenda_view->isExport()) { ?>
<script>
var fagendaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fagendaview = currentForm = new ew.Form("fagendaview", "view");
	loadjs.done("fagendaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$agenda_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $agenda_view->ExportOptions->render("body") ?>
<?php $agenda_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $agenda_view->showPageHeader(); ?>
<?php
$agenda_view->showMessage();
?>
<form name="fagendaview" id="fagendaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agenda">
<input type="hidden" name="modal" value="<?php echo (int)$agenda_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($agenda_view->idagenda->Visible) { // idagenda ?>
	<tr id="r_idagenda">
		<td class="<?php echo $agenda_view->TableLeftColumnClass ?>"><span id="elh_agenda_idagenda"><?php echo $agenda_view->idagenda->caption() ?></span></td>
		<td data-name="idagenda" <?php echo $agenda_view->idagenda->cellAttributes() ?>>
<span id="el_agenda_idagenda">
<span<?php echo $agenda_view->idagenda->viewAttributes() ?>><?php echo $agenda_view->idagenda->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_view->datainicio->Visible) { // datainicio ?>
	<tr id="r_datainicio">
		<td class="<?php echo $agenda_view->TableLeftColumnClass ?>"><span id="elh_agenda_datainicio"><?php echo $agenda_view->datainicio->caption() ?></span></td>
		<td data-name="datainicio" <?php echo $agenda_view->datainicio->cellAttributes() ?>>
<span id="el_agenda_datainicio">
<span<?php echo $agenda_view->datainicio->viewAttributes() ?>><?php echo $agenda_view->datainicio->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_view->datafinal->Visible) { // datafinal ?>
	<tr id="r_datafinal">
		<td class="<?php echo $agenda_view->TableLeftColumnClass ?>"><span id="elh_agenda_datafinal"><?php echo $agenda_view->datafinal->caption() ?></span></td>
		<td data-name="datafinal" <?php echo $agenda_view->datafinal->cellAttributes() ?>>
<span id="el_agenda_datafinal">
<span<?php echo $agenda_view->datafinal->viewAttributes() ?>><?php echo $agenda_view->datafinal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_view->idprofissional->Visible) { // idprofissional ?>
	<tr id="r_idprofissional">
		<td class="<?php echo $agenda_view->TableLeftColumnClass ?>"><span id="elh_agenda_idprofissional"><?php echo $agenda_view->idprofissional->caption() ?></span></td>
		<td data-name="idprofissional" <?php echo $agenda_view->idprofissional->cellAttributes() ?>>
<span id="el_agenda_idprofissional">
<span<?php echo $agenda_view->idprofissional->viewAttributes() ?>><?php echo $agenda_view->idprofissional->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_view->idcliente->Visible) { // idcliente ?>
	<tr id="r_idcliente">
		<td class="<?php echo $agenda_view->TableLeftColumnClass ?>"><span id="elh_agenda_idcliente"><?php echo $agenda_view->idcliente->caption() ?></span></td>
		<td data-name="idcliente" <?php echo $agenda_view->idcliente->cellAttributes() ?>>
<span id="el_agenda_idcliente">
<span<?php echo $agenda_view->idcliente->viewAttributes() ?>><?php echo $agenda_view->idcliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_view->idservico->Visible) { // idservico ?>
	<tr id="r_idservico">
		<td class="<?php echo $agenda_view->TableLeftColumnClass ?>"><span id="elh_agenda_idservico"><?php echo $agenda_view->idservico->caption() ?></span></td>
		<td data-name="idservico" <?php echo $agenda_view->idservico->cellAttributes() ?>>
<span id="el_agenda_idservico">
<span<?php echo $agenda_view->idservico->viewAttributes() ?>><?php echo $agenda_view->idservico->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$agenda_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$agenda_view->isExport()) { ?>
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
$agenda_view->terminate();
?>