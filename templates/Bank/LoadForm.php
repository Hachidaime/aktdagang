<div align="center" style="margin-bottom:15px;">
    <strong>Periode {$bulan_options[$periode.bulan]} {$periode.tahun}</strong>
</div>
<div align="center">
<form id="myForm">
    <input type="hidden" name="id" value="{$id}" />
    <span id="msg-wrapper"></span>
    <table width="600px" >
        <tr>
            <td width="25%">Tanggal</td>
            <td width="*">
                <select name="tanggal">
                <option value="0">&nbsp;</option>
                {html_options options=$periode.list_tgl}
                </select>
            </td>
        </tr>
        <tr>
            <td>Kode Pembantu</td>
            <td><input type="text" name="kode_pembantu" value="" /></td>
        </tr>
        <tr>
            <td>Dokumen</td>
            <td><input type="text" name="dokumen" value="" /></td>
        </tr>
        <tr>
            <td>Uraian</td>
            <td><input type="text" name="uraian" value="" /></td>
        </tr>
        <tr>
            <td>Akun Debit</td>
            <td>
                <select name="akun_d">
                    <option value="0">&nbsp;</option>
                    {foreach from=$akun key=k item=v}
                    <option value="{$v.id}">{$v.nomor}&nbsp;&nbsp;&nbsp;{$v.nama}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td>Akun Kredit</td>
            <td>
                <select name="akun_k">
                    <option value="0">&nbsp;</option>
                    {foreach from=$akun key=k item=v}
                    <option value="{$v.id}">{$v.nomor}&nbsp;&nbsp;&nbsp;{$v.nama}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td>Kas Debit</td>
            <td><input type="text" name="kas_d" value="" /></td>
        </tr>
        <tr>
            <td>Kas Kredit</td>
            <td><input type="text" name="kas_k" value="" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <button type="button" class="ui-button ui-widget" onclick="Submit();">Submit</button>
                <button type="reset" class="ui-button ui-widget">Reset</button>
                <button type="button" class="ui-button ui-widget" onclick="GoMenu('{$class}');">Cancel</button>
            </td>
        </tr>
    </table>
</form>
</div>

{literal}
<script>
    Detail();
    function Submit(){
        var url = "{/literal}ajax.php?class={$class}&method=Submit{literal}";
        var data = $('#myForm').serialize();
        $.ajax({
            url : url,
            type : "POST",
            data : data, 
            dataType : "json",
            data : data,
            success : function(reply){
                console.log(reply);
                if(reply.error > 0){
                    $('#msg-wrapper').html(reply.msg);
                }
                else{
                    alert(reply.msg);
                    GoMenu('{/literal}{$class}{literal}');
                }
            }
        })
    }
    
    function Detail(){
        var url = "{/literal}ajax.php?class={$class}&method=Detail{literal}";
        var data = "id="+$('input[name=id]').val();
        $.ajax({
            url : url,
            type : "POST",
            data : data, 
            dataType : "json",
            data : data,
            success : function(reply){
                $('select[name=tanggal]').val(reply.tanggal);
                $('input[name=kode_pembantu]').val(reply.kode_pembantu);
                $('input[name=dokumen]').val(reply.bukti);
                $('input[name=uraian]').val(reply.uraian);
                $('select[name=akun_d]').val(reply.akun_d);
                $('select[name=akun_k]').val(reply.akun_k);
                $('input[name=kas_d]').val(reply.kas_d);
                $('input[name=kas_k]').val(reply.kas_k);
                
            }
        });
    }
</script>
{/literal}