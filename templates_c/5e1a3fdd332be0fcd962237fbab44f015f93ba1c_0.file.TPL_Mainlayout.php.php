<?php /* Smarty version 3.1.27, created on 2019-09-21 23:45:33
         compiled from "/var/www/html/aktdagang/templates/TPL_Mainlayout.php" */ ?>
<?php
/*%%SmartyHeaderCode:9427987465d8653ade10550_17863804%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e1a3fdd332be0fcd962237fbab44f015f93ba1c' => 
    array (
      0 => '/var/www/html/aktdagang/templates/TPL_Mainlayout.php',
      1 => 1569084317,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9427987465d8653ade10550_17863804',
  'variables' => 
  array (
    'PROJECT_NAME' => 0,
    'PageTitle' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5d8653ade25c91_83241486',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5d8653ade25c91_83241486')) {
function content_5d8653ade25c91_83241486 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '9427987465d8653ade10550_17863804';
?>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $_smarty_tpl->tpl_vars['PROJECT_NAME']->value;?>
</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
<link rel="stylesheet" href="assets/css/jquery-ui.css">
<link rel="stylesheet" href="assets/css/jquery-ui.theme.css">
<link rel="stylesheet" href="assets/css/custom.css">
<?php echo '<script'; ?>
 src="assets/js/jquery.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/js/jquery-ui.js"><?php echo '</script'; ?>
>

<style>
    .ui-menu {
    width: 200px;
  }
</style>
</head>
<body>
<table width="100%">
    <tr>
        <td colspan="2" align="center"><strong><?php echo $_smarty_tpl->tpl_vars['PROJECT_NAME']->value;?>
</strong></td>
    </tr>
    <tr>
        <td width="202px" valign="top" rowspan="2">
            <ul id="menu">
              <li>
                <div onclick="GoMenu('Dashboard');">Dashboard</div>
              </li>
              <li>
                <div onclick="GoMenu('Akun');">Akun</div>
              </li>
              <li>
                <div onclick="GoMenu('Periode');">Periode</div>
              </li>
              <li>
                <div onclick="GoMenu('Kas');">Kas</div>
              </li>
              <li>
                <div onclick="GoMenu('Bank');">Bank</div>
              </li>
              <li>
                <div onclick="GoMenu('Pembelian');">Pembelian</div>
              </li>
              <li>
                <div onclick="GoMenu('Penjualan');">Penjualan</div>
              </li>
              <li>
                <div onclick="UserLogout();">Keluar</div>
              </li>
            </ul>
        </td>
        <td valign="top" height="20px" align="center" style="color:#fff; background-color:#000">
            <strong><?php echo $_smarty_tpl->tpl_vars['PageTitle']->value;?>
</strong>
        </td>
    </tr>
    <tr>
        <td valign="top"><div><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</div></td>
    </tr>
</table>

<?php echo '<script'; ?>
>
$( function() {
    $( "#menu" ).menu();
//    $( ".datepicker" ).datepicker();
    $( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy', firstDay: 1 });
} );
function GoMenu(param){
    window.location.href = 'index.php?class='+param+'&method=LoadDefault';
}
function AddNew(param){
    window.location.href = 'index.php?class='+param+'&method=LoadForm';
}
function Edit(param,id){
    window.location.href = 'index.php?class='+param+'&method=LoadForm&id='+id;
}
function UserLogout(){
	var url = 'ajax.php?class=User&method=UserLogout';
	var data = "";
	
	$.ajax({
		url : url,
		type : "POST",
		dataType : "json",
		data : data,
		success : function(reply){
			if(reply.result > 0){
				alert("Logout Success");
				location.reload();
			}
			else{
				alert("Logout Failed");
			}
		}
	});
}

<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
?>