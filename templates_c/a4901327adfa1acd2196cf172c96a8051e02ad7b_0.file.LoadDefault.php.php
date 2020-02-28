<?php /* Smarty version 3.1.27, created on 2019-09-24 01:45:05
         compiled from "/var/www/html/aktdagang/templates/Penjualan/LoadDefault.php" */ ?>
<?php
/*%%SmartyHeaderCode:8178982585d8912b12ef8b8_23471870%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4901327adfa1acd2196cf172c96a8051e02ad7b' => 
    array (
      0 => '/var/www/html/aktdagang/templates/Penjualan/LoadDefault.php',
      1 => 1569263998,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8178982585d8912b12ef8b8_23471870',
  'variables' => 
  array (
    'AddNew' => 0,
    'class' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5d8912b143fbe2_65193775',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5d8912b143fbe2_65193775')) {
function content_5d8912b143fbe2_65193775 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '8178982585d8912b12ef8b8_23471870';
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