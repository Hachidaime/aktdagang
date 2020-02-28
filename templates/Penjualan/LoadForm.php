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
            <td>BPB</td>
            <td><input type="text" name="bpb" value="" /></td>
        </tr>
        <tr>
            <td>Uraian</td>
            <td><input type="text" name="uraian" value="" /></td>
        </tr>
        <tr>
            <td>Akun DB Pembelian</td>
            <td>
                <select name="akun_d_pembelian">
                    <option value="0">&nbsp;</option>
                    {foreach from=$akun key=k item=v}
                    <option value="{$v.id}">{$v.nomor}&nbsp;&nbsp;&nbsp;{$v.nama}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td>Akun KR Pembelian</td>
            <td>
                <select name="akun_k_pembelian">
                    <option value="0">&nbsp;</option>
                    {foreach from=$akun key=k item=v}
                    <option value="{$v.id}">{$v.nomor}&nbsp;&nbsp;&nbsp;{$v.nama}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td>Pembelian</td>
            <td><input type="text" name="pembelian" value="" /></td>
        </tr>
        <tr>
            <td>Akun DB Potongan</td>
            <td>
                <select name="akun_d_potongan">
                    <option value="0">&nbsp;</option>
                    {foreach from=$akun key=k item=v}
                    <option value="{$v.id}">{$v.nomor}&nbsp;&nbsp;&nbsp;{$v.nama}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td>Akun KR Potongan</td>
            <td>
                <select name="akun_k_potongan">
                    <option value="0">&nbsp;</option>
                    {foreach from=$akun key=k item=v}
                    <option value="{$v.id}">{$v.nomor}&nbsp;&nbsp;&nbsp;{$v.nama}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td>Potongan</td>
            <td><input type="text" name="potongan" value="" /></td>
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
                $('input[name=bpb]').val(reply.bpb);
                $('input[name=uraian]').val(reply.uraian);
                $('select[name=akun_d_pembelian]').val(reply.akun_d_pembelian);
                $('select[name=akun_k_pembelian]').val(reply.akun_k_pembelian);
                $('input[name=pembelian]').val(reply.pembelian);
                $('select[name=akun_d_potongan]').val(reply.akun_d_potongan);
                $('select[name=akun_k_potongan]').val(reply.akun_k_potongan);
                $('input[name=potongan]').val(reply.potongan);
                
            }
        });
    }
</script>
{/literal}