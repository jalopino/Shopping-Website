<?php include("header.php"); ?>
<div class = "container-fluid">
    <div class="row">
        <div class="col-sm-12 text-end">
            <a href="index.php">Home</a>
        </div>
    </div>
    <div class = "row mt-3 text-center">
        <div class="col-sm-8">
        </div>
        <div class="col-sm-4">
		    <div class="card">
				<div class="card-header mx-6">Login Existing Account</div>
					<div class="card-body">
						<div class="form-group">
							<label>Email Address</label>
							<input type="text" id="EmailAddress" class="form-control rounded" placeholder="Email Address" />
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="text" id="Password" class="form-control rounded" placeholder="Password" />
						</div>
						<div class="form-group py-1">
							<button id="BtnLogin" class="btn btn-primary btn-block">Login</button>
						</div>
					</div>
				</div>
            </div>
         </div>
    </div>
</div>
<script language = "javascript">
		$("#BtnSearch").on("click", function() {
			window.location = "?search=" + $("#TxtSearch").val();
		});
		$("#BtnLogin").on("click", function(){
			var alertNotice = "Fields marked with * are required fields";
			
			var email_address = $("#EmailAddress").val();
			var password = $("#Password").val();
			
			if(email_address == null || email_address == ""){
				alert(alertNotice);
				$("#EmailAddress").focus();
			}	
			else if (password == null || password == ""){
				alert(alertNotice);
				$("#Password").focus();	
			}		
			else {
				//
				//
				$.post("process.login.php",{
					email_address: email_address,
					password: password
				}, function(data, status){
					if (status == "success"){
						alert("You have successfully logged in");
						window.location = "dashboard.php";
					}
				})
			}
		});
	</script>
<?php 
include("footer.php");
?>