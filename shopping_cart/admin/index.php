<html>
    <head>
        <title>Shoppping Cart</title>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../styles/styles.css">
        <script language="javascript" src="../bootstrap/js/bootstrap.js"></script>
        <script language="javascript" src="../js/jquery.js"></script>
        </head>
    <body>
        <div class = "container-fluid">
            <div class="col-sm-12 mt-3 d-flex justify-content-center">
                <div class="card">
							<div class="card-header mx-6">Administrator Login</div>
							<div class="card-body">
								<div class="form-group">
									<label>Email Address</label>
									<input value="admin@shoppingcart.com" type="text" id="Username" class="form-control rounded" placeholder="Email Address" />
								</div>
								<div class="form-group">
									<label>Password</label>
									<input value="12345#" type="password" id="Password" class="form-control rounded" placeholder="Password" />
								</div>
							<div class="form-group py-1">
								<button id="BtnLogin" class="btn btn-primary btn-block">Login</button>
						</div>
					</div>
				</div>
            </div>
        </div>
        <script language="javascript">
           	$("#BtnLogin").on("click", function(){
			var alertNotice = "Fields marked with * are required fields";
			
			var username = $("#Username").val();
			var password = $("#Password").val();
			
			if(username == null || username == ""){
				alert(alertNotice);
				$("#Username").focus();
			}	
			else if (password == null || password == ""){
				alert(alertNotice);
				$("#Password").focus();	
			}		
			else {
				//
				//
				$.post("process.login.php",{
					uname: username,
					pword: password
				}, function(data, status){
                    alert(username);
					if (status == "success"){
						window.location = "dashboard.php";
					}
				})
			}
		});
        </script>
    </body>
</html>