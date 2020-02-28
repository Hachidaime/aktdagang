<form id="myForm">
    <input type="hidden" name="id" value="{$id}" />
    <span id="msg-wrapper"></span>
    <table width="600px" >
        <tr>
            <td width="25%">Bulan</td>
            <td width="*">
                <select name="bulan">
                {html_options options=$bulan_options}
                </select>
            </td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td><input type="text" name="tahun" value="" /></td>
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
                $('select[name=bulan]').val(reply.bulan);
                $('input[name=tahun]').val(reply.tahun);
                
            }
        });
    }
</script>
{/literal}