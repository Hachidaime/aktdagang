<table width="100%">
    <thead>
        <tr>
            <th width="*">Periode</th>
            <th width="100px">Aktif</th>
            <th width="100px">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        {section name=a loop=$list}
        <tr>
            <td>{$bulan_options[$list[a].bulan]} {$list[a].tahun}</td>
            <td align="center">
                <input type="radio" name="periode_id" value="{$list[a].id}" {$list[a].checked} onclick="Activate();" />
            </td>
            <td align="center"><button type="button" onclick="Edit('{$class}', {$list[a].id})">Ubah</button></td>
        </tr>
        {/section}
    </tbody>
</table>