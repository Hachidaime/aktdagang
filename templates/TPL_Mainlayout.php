<html>
<head>
<meta charset="utf-8">
<title>{$PROJECT_NAME}</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
<link rel="stylesheet" href="assets/css/jquery-ui.css">
<link rel="stylesheet" href="assets/css/jquery-ui.theme.css">
<link rel="stylesheet" href="assets/css/custom.css">
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery-ui.js"></script>

<style>
    .ui-menu {
    width: 200px;
  }
</style>
</head>
<body>
<table width="100%">
    <tr>
        <td colspan="2" align="center"><strong>{$PROJECT_NAME}</strong></td>
    </tr>
    <tr>
        <td width="202px" valign="top" rowspan="2">
            <ul id="menu">
              <li>
                <div onclick="GoMenu('Dashboard');">Dashboard</div>
              </li>
              <li>
                <div onclick="GoMenu('Akun');">Akun</div>
              </li>
              <li>
                <div onclick="GoMenu('Periode');">Periode</div>
              </li>
              <li>
                <div onclick="GoMenu('Kas');">Kas</div>
              </li>
              <li>
                <div onclick="GoMenu('Bank');">Bank</div>
              </li>
              <li>
                <div onclick="GoMenu('Pembelian');">Pembelian</div>
              </li>
              <li>
                <div onclick="GoMenu('Penjualan');">Penjualan</div>
              </li>
              <li>
                <div onclick="UserLogout();">Keluar</div>
              </li>
            </ul>
        </td>
        <td valign="top" height="20px" align="center" style="color:#fff; background-color:#000">
            <strong>{$PageTitle}</strong>
        </td>
    </tr>
    <tr>
        <td valign="top"><div>{$content}</div></td>
    </tr>
</table>

<script>
$( function() {
    $( "#menu" ).menu();
//    $( ".datepicker" ).datepicker();
    $( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy', firstDay: 1 });
} );
function GoMenu(param){
    window.location.href = 'index.php?class='+param+'&method=LoadDefault';
}
function AddNew(param){
    window.location.href = 'index.php?class='+param+'&method=LoadForm';
}
function Edit(param,id){
    window.location.href = 'index.php?class='+param+'&method=LoadForm&id='+id;
}
function UserLogout(){
	var url = 'ajax.php?class=User&method=UserLogout';
	var data = "";
	
	$.ajax({
		url : url,
		type : "POST",
		dataType : "json",
		data : data,
		success : function(reply){
			if(reply.result > 0){
				alert("Logout Success");
				location.reload();
			}
			else{
				alert("Logout Failed");
			}
		}
	});
}

</script>

<script>
</script>
</body>
</html>