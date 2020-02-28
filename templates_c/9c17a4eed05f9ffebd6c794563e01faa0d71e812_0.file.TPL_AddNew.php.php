<?php /* Smarty version 3.1.27, created on 2019-09-21 23:45:39
         compiled from "/var/www/html/aktdagang/templates/TPL_AddNew.php" */ ?>
<?php
/*%%SmartyHeaderCode:2957877375d8653b3664146_52778828%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c17a4eed05f9ffebd6c794563e01faa0d71e812' => 
    array (
      0 => '/var/www/html/aktdagang/templates/TPL_AddNew.php',
      1 => 1554301653,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2957877375d8653b3664146_52778828',
  'variables' => 
  array (
    'class' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5d8653b36694f5_08397534',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5d8653b36694f5_08397534')) {
function content_5d8653b36694f5_08397534 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2957877375d8653b3664146_52778828';
?>
<button type="button" onclick="AddNew('<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
');">Tambah</button><?php }
}
?>