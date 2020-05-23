<?php
namespace PHPMaker2020\project1;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_agenda", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "agendalist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_areas", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "areaslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_clientes", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "clienteslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_formadepgto", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "formadepgtolist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_profissionais", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "profissionaislist.php?cmd=resetall", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mi_servicos", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "servicoslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>