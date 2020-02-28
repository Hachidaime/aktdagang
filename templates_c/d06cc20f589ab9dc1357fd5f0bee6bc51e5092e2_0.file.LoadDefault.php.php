<?php /* Smarty version 3.1.27, created on 2019-09-21 23:45:48
         compiled from "/var/www/html/aktdagang/templates/Periode/LoadDefault.php" */ ?>
<?php
/*%%SmartyHeaderCode:2005958975d8653bc1ae106_67205312%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd06cc20f589ab9dc1357fd5f0bee6bc51e5092e2' => 
    array (
      0 => '/var/www/html/aktdagang/templates/Periode/LoadDefault.php',
      1 => 1554469746,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2005958975d8653bc1ae106_67205312',
  'variables' => 
  array (
    'AddNew' => 0,
    'class' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5d8653bc1c4809_33576976',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5d8653bc1c4809_33576976')) {
function content_5d8653bc1c4809_33576976 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2005958975d8653bc1ae106_67205312';
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
    function Activate(){
        var url = "ajax.php?class=<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
&method=Activate";
        var data = "id="+$('input[name=periode_id]:checked').val();
        $.ajax({
            url : url,
            data : data,
            type : "POST",
            dataType : "json",
            data : data,
            success : function(reply){
                alert(reply.msg);
            }
        })
        
    }
<?php echo '</script'; ?>
>
<?php }
}
?>