<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$root = realpath(dirname(__FILE__)).'/';
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
define('DOC_ROOT', $root);
session_start();
include_once(DOC_ROOT."config.php");
include_once(DOC_ROOT."libs/adodb/adodb.inc.php");//ADODB Class File
include_once(DOC_ROOT.'libs/smarty/Smarty.class.php');
include_once(DOC_ROOT.'libs/functions.php');
//include_once(DOC_ROOT.'libs/Image_GD_Functions.php');

// die();
// use function Geodistance\kilometers;
// use Geodistance\Location;

$db = &NewADOConnection('mysqli');
$db->Connect(SQL_HOST, SQL_USER, SQL_PASSWORD, SQL_DB) or die ("Failed to connect database");
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC; // Force ADODB return ASSOC array
//$db->debug = true; // Set DB Debug Mode


$smarty = new Smarty;
$smarty->compile_check = true;
// $smarty->debugging = 1;

include_once(DOC_ROOT."Classes/modules/class.Front.php");
include_once(DOC_ROOT."Classes/modules/class.Blocks.php");

// print_r($_SESSION);
$block = new Blocks;
$smarty->assign('content', $block->LoadMainContent());


$db->Close();
$smarty->assign("t", time());
$smarty->assign($_GET);
$smarty->assign("PROJECT_NAME", PROJECT_NAME);

if($_SESSION['USER']['id'] > 0){	

	$smarty->assign('login_permission', $_SESSION['USER']['permission']);
	$smarty->assign('login_name', $_SESSION['USER']['nama']);
	$smarty->assign('sys_msg', processSysMsg()); 
	$smarty->display("TPL_Mainlayout.php");
}
else{
	$smarty->display("TPL_Login.php");
}
?>