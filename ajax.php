<?php
$root = realpath(dirname(__FILE__)).'/';
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
define('DOC_ROOT', $root);
session_start();
include_once(DOC_ROOT."config.php");
include_once(DOC_ROOT."libs/adodb/adodb.inc.php");//ADODB Class File
include_once(DOC_ROOT.'libs/smarty/Smarty.class.php');
include_once(DOC_ROOT.'libs/functions.php');

$db = &NewADOConnection('mysqli');
$db->Connect(SQL_HOST, SQL_USER, SQL_PASSWORD, SQL_DB) or die ("Failed to connect database");
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC; // Force ADODB return ASSOC array
//$db->debug = true; // Set DB Debug Mode
// $db->debug = $_SESSION[adodb_debug]; // Set DB Debug Mode

$smarty = new Smarty;
$smarty->compile_check = true;
// $smarty->debugging = DEBUG;

include_once(DOC_ROOT."Classes/modules/class.Front.php");
include_once(DOC_ROOT."Classes/modules/class.Blocks.php");

$block = new Blocks;
print $block->LoadMainContent();

$db->Close();
$smarty->assign("t", time());
$smarty->assign($_GET);
exit;
?>