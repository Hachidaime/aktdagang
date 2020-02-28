<html>
<head>
<meta charset="utf-8">
<title>{$PROJECT_NAME}</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
</head>
<body>
<form id="myForm">
<input type="text" name="user_name" placeholder="Username">
<input type="password" name="user_password" placeholder="Password">
<button type="button" onclick="CheckLogin();">Submit</button>
</form>
<script src="assets/js/jquery.js"></script>
<script>
function CheckLogin(){
	var url = 'ajax.php?class=User&method=UserLogin';
	var data = $('#myForm').serialize();

	$.ajax({
		url : url,
		type : "POST",
		dataType : "json",
		data : data,
		success : function(reply){
			console.log(reply);
			console.log(reply.error);
			if(reply.error > 0){
				var msg = '';
				$.each(reply.message, function(key,value) {
					msg += value;
				});
				// $('.error-message').html(msg);
				alert(msg);
			}
			else{
				$('.error-message').html('');
				// alert(reply.message);
				window.location.href = "index.php";
			}
		}
	});
}
</script>
</body>
</html>