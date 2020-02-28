<?php /* Smarty version 3.1.27, created on 2019-09-24 01:45:18
         compiled from "/var/www/html/aktdagang/templates/Penjualan/LoadSearch.php" */ ?>
<?php
/*%%SmartyHeaderCode:6268650875d8912be332684_28689339%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a879f64dc689f8b67db64ae38de8090ebba49c2' => 
    array (
      0 => '/var/www/html/aktdagang/templates/Penjualan/LoadSearch.php',
      1 => 1569263998,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6268650875d8912be332684_28689339',
  'variables' => 
  array (
    'periode' => 0,
    'bulan_options' => 0,
    'list' => 0,
    'class' => 0,
    'bulan3_options' => 0,
    'akun_options' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5d8912be4b6cf1_42433884',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5d8912be4b6cf1_42433884')) {
function content_5d8912be4b6cf1_42433884 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_replace')) require_once '/var/www/html/aktdagang/libs/smarty/plugins/modifier.replace.php';

$_smarty_tpl->properties['nocache_hash'] = '6268650875d8912be332684_28689339';
?>
<div align="center" style="margin-bottom:15px;"><strong>Periode <?php echo $_smarty_tpl->tpl_vars['bulan_options']->value[$_smarty_tpl->tpl_vars['periode']->value['bulan']];?>
 <?php echo $_smarty_tpl->tpl_vars['periode']->value['tahun'];?>
</strong></div>
<table width="100%" style="font-size:12px;">
    <thead>
        <tr>
            <th width="85px">Tanggal</th>
            <th width="100px">Kode<br>Pembantu</th>
            <th width="75px">BPB</th>
            <th width="*">Uraian</th>
            <th width="75px">Akun<br>DB</th>
            <th width="75px">Akun<br>KR</th>
            <th width="120px">Pembelian</th>
            <th width="75px">Akun<br>DB</th>
            <th width="75px">Akun<br>KR</th>
            <th width="120px">Potongan<br>Pembelian</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['a'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['a']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['name'] = 'a';
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['list']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['a']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['a']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['a']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['a']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['a']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['a']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['total']);
?>
        <tr>
            <td align="center"><a href="javascript:void(0);" onclick="Edit('<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
', <?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['id'];?>
)"><?php echo sprintf("%02d",$_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['tanggal']);?>
-<?php echo $_smarty_tpl->tpl_vars['bulan3_options']->value[$_smarty_tpl->tpl_vars['periode']->value['bulan']];?>
-<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['periode']->value['tahun'],'20','');?>
</a></td>
            <td><?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['kode_pembantu'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['bpb'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['uraian'];?>
</td>
            <td align="center"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['akun_options']->value[$_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['akun_d_pembelian']])===null||$tmp==='' ? '-' : $tmp);?>
</td>
            <td align="center"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['akun_options']->value[$_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['akun_k_pembelian']])===null||$tmp==='' ? '-' : $tmp);?>
</td>
            <td align="right"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['pembelian_formated'])===null||$tmp==='' ? '-' : $tmp);?>
</td>
            <td align="center"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['akun_options']->value[$_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['akun_d_potongan']])===null||$tmp==='' ? '-' : $tmp);?>
</td>
            <td align="center"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['akun_options']->value[$_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['akun_k_potongan']])===null||$tmp==='' ? '-' : $tmp);?>
</td>
            <td align="right"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['potongan_formated'])===null||$tmp==='' ? '-' : $tmp);?>
</td>
        </tr>
        <?php endfor; endif; ?>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </tbody>
</table><?php }
}
?>