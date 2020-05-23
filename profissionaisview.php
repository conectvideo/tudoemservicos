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
$profissionais_view = new profissionais_view();

// Run the page
$profissionais_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$profissionais_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$profissionais_view->isExport()) { ?>
<script>
var fprofissionaisview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fprofissionaisview = currentForm = new ew.Form("fprofissionaisview", "view");
	loadjs.done("fprofissionaisview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$profissionais_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $profissionais_view->ExportOptions->render("body") ?>
<?php $profissionais_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $profissionais_view->showPageHeader(); ?>
<?php
$profissionais_view->showMessage();
?>
<form name="fprofissionaisview" id="fprofissionaisview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="profissionais">
<input type="hidden" name="modal" value="<?php echo (int)$profissionais_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($profissionais_view->idprofissionais->Visible) { // idprofissionais ?>
	<tr id="r_idprofissionais">
		<td class="<?php echo $profissionais_view->TableLeftColumnClass ?>"><span id="elh_profissionais_idprofissionais"><?php echo $profissionais_view->idprofissionais->caption() ?></span></td>
		<td data-name="idprofissionais" <?php echo $profissionais_view->idprofissionais->cellAttributes() ?>>
<span id="el_profissionais_idprofissionais">
<span<?php echo $profissionais_view->idprofissionais->viewAttributes() ?>><?php echo $profissionais_view->idprofissionais->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profissionais_view->nome->Visible) { // nome ?>
	<tr id="r_nome">
		<td class="<?php echo $profissionais_view->TableLeftColumnClass ?>"><span id="elh_profissionais_nome"><?php echo $profissionais_view->nome->caption() ?></span></td>
		<td data-name="nome" <?php echo $profissionais_view->nome->cellAttributes() ?>>
<span id="el_profissionais_nome">
<span<?php echo $profissionais_view->nome->viewAttributes() ?>><?php echo $profissionais_view->nome->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profissionais_view->telefone->Visible) { // telefone ?>
	<tr id="r_telefone">
		<td class="<?php echo $profissionais_view->TableLeftColumnClass ?>"><span id="elh_profissionais_telefone"><?php echo $profissionais_view->telefone->caption() ?></span></td>
		<td data-name="telefone" <?php echo $profissionais_view->telefone->cellAttributes() ?>>
<span id="el_profissionais_telefone">
<span<?php echo $profissionais_view->telefone->viewAttributes() ?>><?php echo $profissionais_view->telefone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profissionais_view->whatsapp->Visible) { // whatsapp ?>
	<tr id="r_whatsapp">
		<td class="<?php echo $profissionais_view->TableLeftColumnClass ?>"><span id="elh_profissionais_whatsapp"><?php echo $profissionais_view->whatsapp->caption() ?></span></td>
		<td data-name="whatsapp" <?php echo $profissionais_view->whatsapp->cellAttributes() ?>>
<span id="el_profissionais_whatsapp">
<span<?php echo $profissionais_view->whatsapp->viewAttributes() ?>><?php echo $profissionais_view->whatsapp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profissionais_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $profissionais_view->TableLeftColumnClass ?>"><span id="elh_profissionais__email"><?php echo $profissionais_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $profissionais_view->_email->cellAttributes() ?>>
<span id="el_profissionais__email">
<span<?php echo $profissionais_view->_email->viewAttributes() ?>><?php echo $profissionais_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profissionais_view->idarea->Visible) { // idarea ?>
	<tr id="r_idarea">
		<td class="<?php echo $profissionais_view->TableLeftColumnClass ?>"><span id="elh_profissionais_idarea"><?php echo $profissionais_view->idarea->caption() ?></span></td>
		<td data-name="idarea" <?php echo $profissionais_view->idarea->cellAttributes() ?>>
<span id="el_profissionais_idarea">
<span<?php echo $profissionais_view->idarea->viewAttributes() ?>><?php echo $profissionais_view->idarea->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$profissionais_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$profissionais_view->isExport()) { ?>
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
$profissionais_view->terminate();
?>