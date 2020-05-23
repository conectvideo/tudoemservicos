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
$servicos_add = new servicos_add();

// Run the page
$servicos_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$servicos_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fservicosadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fservicosadd = currentForm = new ew.Form("fservicosadd", "add");

	// Validate form
	fservicosadd.validate = function() {
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
			<?php if ($servicos_add->servicos->Required) { ?>
				elm = this.getElements("x" + infix + "_servicos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $servicos_add->servicos->caption(), $servicos_add->servicos->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($servicos_add->idarea->Required) { ?>
				elm = this.getElements("x" + infix + "_idarea");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $servicos_add->idarea->caption(), $servicos_add->idarea->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_idarea");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($servicos_add->idarea->errorMessage()) ?>");
			<?php if ($servicos_add->valor->Required) { ?>
				elm = this.getElements("x" + infix + "_valor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $servicos_add->valor->caption(), $servicos_add->valor->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_valor");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($servicos_add->valor->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fservicosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fservicosadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fservicosadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $servicos_add->showPageHeader(); ?>
<?php
$servicos_add->showMessage();
?>
<form name="fservicosadd" id="fservicosadd" class="<?php echo $servicos_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="servicos">
<?php if ($servicos->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$servicos_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($servicos_add->servicos->Visible) { // servicos ?>
	<div id="r_servicos" class="form-group row">
		<label id="elh_servicos_servicos" for="x_servicos" class="<?php echo $servicos_add->LeftColumnClass ?>"><?php echo $servicos_add->servicos->caption() ?><?php echo $servicos_add->servicos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $servicos_add->RightColumnClass ?>"><div <?php echo $servicos_add->servicos->cellAttributes() ?>>
<?php if (!$servicos->isConfirm()) { ?>
<span id="el_servicos_servicos">
<input type="text" data-table="servicos" data-field="x_servicos" name="x_servicos" id="x_servicos" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($servicos_add->servicos->getPlaceHolder()) ?>" value="<?php echo $servicos_add->servicos->EditValue ?>"<?php echo $servicos_add->servicos->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_servicos_servicos">
<span<?php echo $servicos_add->servicos->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($servicos_add->servicos->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="servicos" data-field="x_servicos" name="x_servicos" id="x_servicos" value="<?php echo HtmlEncode($servicos_add->servicos->FormValue) ?>">
<?php } ?>
<?php echo $servicos_add->servicos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($servicos_add->idarea->Visible) { // idarea ?>
	<div id="r_idarea" class="form-group row">
		<label id="elh_servicos_idarea" for="x_idarea" class="<?php echo $servicos_add->LeftColumnClass ?>"><?php echo $servicos_add->idarea->caption() ?><?php echo $servicos_add->idarea->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $servicos_add->RightColumnClass ?>"><div <?php echo $servicos_add->idarea->cellAttributes() ?>>
<?php if (!$servicos->isConfirm()) { ?>
<span id="el_servicos_idarea">
<input type="text" data-table="servicos" data-field="x_idarea" name="x_idarea" id="x_idarea" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($servicos_add->idarea->getPlaceHolder()) ?>" value="<?php echo $servicos_add->idarea->EditValue ?>"<?php echo $servicos_add->idarea->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_servicos_idarea">
<span<?php echo $servicos_add->idarea->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($servicos_add->idarea->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="servicos" data-field="x_idarea" name="x_idarea" id="x_idarea" value="<?php echo HtmlEncode($servicos_add->idarea->FormValue) ?>">
<?php } ?>
<?php echo $servicos_add->idarea->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($servicos_add->valor->Visible) { // valor ?>
	<div id="r_valor" class="form-group row">
		<label id="elh_servicos_valor" for="x_valor" class="<?php echo $servicos_add->LeftColumnClass ?>"><?php echo $servicos_add->valor->caption() ?><?php echo $servicos_add->valor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $servicos_add->RightColumnClass ?>"><div <?php echo $servicos_add->valor->cellAttributes() ?>>
<?php if (!$servicos->isConfirm()) { ?>
<span id="el_servicos_valor">
<input type="text" data-table="servicos" data-field="x_valor" name="x_valor" id="x_valor" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($servicos_add->valor->getPlaceHolder()) ?>" value="<?php echo $servicos_add->valor->EditValue ?>"<?php echo $servicos_add->valor->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_servicos_valor">
<span<?php echo $servicos_add->valor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($servicos_add->valor->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="servicos" data-field="x_valor" name="x_valor" id="x_valor" value="<?php echo HtmlEncode($servicos_add->valor->FormValue) ?>">
<?php } ?>
<?php echo $servicos_add->valor->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$servicos_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $servicos_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$servicos->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $servicos_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$servicos_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$servicos_add->terminate();
?>