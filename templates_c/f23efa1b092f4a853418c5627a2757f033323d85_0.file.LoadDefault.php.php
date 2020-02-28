<?php /* Smarty version 3.1.27, created on 2019-09-21 23:45:52
         compiled from "/var/www/html/aktdagang/templates/Kas/LoadDefault.php" */ ?>
<?php
/*%%SmartyHeaderCode:11516879295d8653c00bda79_92274697%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f23efa1b092f4a853418c5627a2757f033323d85' => 
    array (
      0 => '/var/www/html/aktdagang/templates/Kas/LoadDefault.php',
      1 => 1554474628,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11516879295d8653c00bda79_92274697',
  'variables' => 
  array (
    'AddNew' => 0,
    'class' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5d8653c0109a13_46052765',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5d8653c0109a13_46052765')) {
function content_5d8653c0109a13_46052765 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '11516879295d8653c00bda79_92274697';
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