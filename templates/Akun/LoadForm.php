<form id="myForm">
    <input type="hidden" name="id" value="{$id}" />
    <span id="msg-wrapper"></span>
    <table width="600px" >
        <tr>
            <td width="25%">Nomor Akun</td>
            <td width="*">
                <input type="text" name="nomor" value="" />
            </td>
        </tr>
        <tr>
            <td>Nama Akun</td>
            <td><input type="text" name="nama" value="" /></td>
        </tr>
        <tr>
            <td>Akun D/K</td>
            <td>{html_radios name='sifat' options=$dk_options separator='&nbsp;'}</td>
        </tr>
        <tr>
            <td>Akun NR/LR</td>
            <td>{html_radios name='posisi' options=$nrlr_options separator='&nbsp;'}</td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="button" class="ui-button ui-widget" onclick="Submit();">Submit</button>
                <button type="reset" class="ui-button ui-widget">Reset</button>
                <button type="button" class="ui-button ui-widget" onclick="GoMenu('{$class}');">Cancel</button>
            </td>
        </tr>
    </table>
</form>

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
                console.log(reply);
                $('input[name=nomor]').val(reply.nomor);
                $('input[name=nama]').val(reply.nama);
                $('input:radio[name=sifat]').filter('[value="'+reply.sifat+'"]').prop("checked", true);
                $('input:radio[name=posisi]').filter('[value="'+reply.posisi+'"]').prop("checked", true);
                
            }
        });
    }
</script>
{/literal}