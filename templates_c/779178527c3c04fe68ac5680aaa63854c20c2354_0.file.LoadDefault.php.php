<?php /* Smarty version 3.1.27, created on 2019-09-21 23:46:03
         compiled from "/var/www/html/aktdagang/templates/Bank/LoadDefault.php" */ ?>
<?php
/*%%SmartyHeaderCode:18743256815d8653cba37311_53853538%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '779178527c3c04fe68ac5680aaa63854c20c2354' => 
    array (
      0 => '/var/www/html/aktdagang/templates/Bank/LoadDefault.php',
      1 => 1554546071,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18743256815d8653cba37311_53853538',
  'variables' => 
  array (
    'AddNew' => 0,
    'class' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5d8653cba45f92_52279087',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5d8653cba45f92_52279087')) {
function content_5d8653cba45f92_52279087 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '18743256815d8653cba37311_53853538';
?>
<div>
    <?php echo $_smarty_tpl->tpl_vars['AddNew']->value;?>

</div>
<div class="search-wrapper"></div>

<?php echo '<script'; ?>
>
    search();
    function search(){
        var url = "ajax.php?class=<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
&method=LoadSearch";
        var data = "keyword="+$('input[name=keyword]').val();
        $.ajax({
            url : url,
            data : data,
            type : "POST",
            dataType : "json",
            data : data,
            success : function(reply){
                $('.search-wrapper').html(reply);
            }
        });
    }
<?php echo '</script'; ?>
>
<?php }
}
?>