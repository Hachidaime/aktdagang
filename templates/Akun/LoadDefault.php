<div>
    {$AddNew}
    <input type="text" name="keyword" placeholder="Keyword" />
    <button type="button" class="ui-button ui-widget" id="btn-search" title="Search" onclick="search()"><span class="ui-icon ui-icon-search"></span></button>
</div>
<div class="search-wrapper"></div>
{literal}
<script>
    search();
    function search(){
        var url = "{/literal}ajax.php?class={$class}&method=LoadSearch{literal}";
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
</script>
{/literal}