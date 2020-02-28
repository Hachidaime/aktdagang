<div align="center" style="margin-bottom:15px;"><strong>Periode {$bulan_options[$periode.bulan]} {$periode.tahun}</strong></div>
<table width="100%" style="font-size:12px;">
    <thead>
        <tr>
            <th width="85px">Tanggal</th>
            <th width="100px">Kode<br>Pembantu</th>
            <th width="75px">BKM<br>BKK</th>
            <th width="*">Uraian</th>
            <th width="75px">Akun<br>Debit</th>
            <th width="75px">Akun<br>Kredit</th>
            <th width="120px">Kas<br>Debit</th>
            <th width="120px">Kas<br>Kredit</th>
            <th width="120px">Saldo</th>
        </tr>
    </thead>
    <tbody>
        {section name=a loop=$list}
        <tr>
            <td align="center"><a href="javascript:void(0);" onclick="Edit('{$class}', {$list[a].id})">{"%02d"|sprintf:$list[a].tanggal}-{$bulan3_options[$periode.bulan]}-{$periode.tahun|replace:'20':''}</a></td>
            <td>{$list[a].kode_pembantu}</td>
            <td>{$list[a].bukti}</td>
            <td>{$list[a].uraian}</td>
            <td align="center">{$akun_options[$list[a].akun_d]|default:'-'}</td>
            <td align="center">{$akun_options[$list[a].akun_k]|default:'-'}</td>
            <td align="right">{$list[a].kas_d}</td>
            <td align="right">{$list[a].kas_k|default:'-'}</td>
            <td align="right">{$list[a].saldo_formated}</td>
        </tr>
        {/section}
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
        </tr>
    </tbody>
</table>