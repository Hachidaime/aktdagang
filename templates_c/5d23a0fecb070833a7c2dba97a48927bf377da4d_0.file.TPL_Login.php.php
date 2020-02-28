<?php /* Smarty version 3.1.27, created on 2019-09-24 01:45:05
         compiled from "/var/www/html/aktdagang/templates/TPL_Login.php" */ ?>
<?php
/*%%SmartyHeaderCode:12999687965d8912b1447698_81531058%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d23a0fecb070833a7c2dba97a48927bf377da4d' => 
    array (
      0 => '/var/www/html/aktdagang/templates/TPL_Login.php',
      1 => 1553609336,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12999687965d8912b1447698_81531058',
  'variables' => 
  array (
    'PROJECT_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5d8912b146ad50_98277043',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5d8912b146ad50_98277043')) {
function content_5d8912b146ad50_98277043 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '12999687965d8912b1447698_81531058';
?>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $_smarty_tpl->tpl_vars['PROJECT_NAME']->value;?>
</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
</head>
<body>
<form id="myForm">
<input type="text" name="user_name" placeholder="Username">
<input type="password" name="user_password" placeholder="Password">
<button type="button" onclick="CheckLogin();">Submit</button>
</form>
<?php echo '<script'; ?>
 src="assets/js/jquery.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
function CheckLogin(){
	var url = 'ajax.php?class=User&method=UserLogin';
	var data = $('#myForm').serialize();

	$.ajax({
		url : url,
		type : "POST",
		dataType : "json",
		data : data,
		success : function(reply){
			console.log(reply);
			console.log(reply.error);
			if(reply.error > 0){
				var msg = '';
				$.each(reply.message, function(key,value) {
					msg += value;
				});
				// $('.error-message').html(msg);
				alert(msg);
			}
			else{
				$('.error-message').html('');
				// alert(reply.message);
				window.location.href = "index.php";
			}
		}
	});
}
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
?>