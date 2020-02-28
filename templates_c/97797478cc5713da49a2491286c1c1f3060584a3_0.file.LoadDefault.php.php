<?php /* Smarty version 3.1.27, created on 2019-09-21 23:45:39
         compiled from "/var/www/html/aktdagang/templates/Akun/LoadDefault.php" */ ?>
<?php
/*%%SmartyHeaderCode:5101766295d8653b3778f38_07648810%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97797478cc5713da49a2491286c1c1f3060584a3' => 
    array (
      0 => '/var/www/html/aktdagang/templates/Akun/LoadDefault.php',
      1 => 1554468282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5101766295d8653b3778f38_07648810',
  'variables' => 
  array (
    'AddNew' => 0,
    'class' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5d8653b37c1587_72916256',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5d8653b37c1587_72916256')) {
function content_5d8653b37c1587_72916256 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '5101766295d8653b3778f38_07648810';
?>
<div>
    <?php echo $_smarty_tpl->tpl_vars['AddNew']->value;?>

    <input type="text" name="keyword" placeholder="Keyword" />
    <button type="button" class="ui-button ui-widget" id="btn-search" title="Search" onclick="search()"><span class="ui-icon ui-icon-search"></span></button>
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
        })
    }
<?php echo '</script'; ?>
>
<?php }
}
?>