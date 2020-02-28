<table width="100%">
    <thead>
        <tr>
            <th width="75px">No<br />Akun</th>
            <th width="*">Nama Akun</th>
            <th width="75px">Akun<br />D/K</th>
            <th width="75px">Akun<br />NR/LR</th>
            <th width="100px">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        {section name=a loop=$list}
        <tr>
            <td align="center">{$list[a].nomor}</td>
            <td>{$list[a].nama}</td>
            <td align="center">{$dk_options[$list[a].sifat]|default:'-'}</td>
            <td align="center">{$nrlr_options[$list[a].posisi]|default:'-'}</td>
            <td align="center"><button type="button" onclick="Edit('{$class}', {$list[a].id})">Ubah</button></td>
        </tr>
        {/section}
    </tbody>
</table>