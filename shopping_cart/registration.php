<?php include ("header.php") ?>
	<div class = "container-fluid">
		<div class = "row">
			<div class = "col-sm-12 text-center"></div>
		</div>
		
			<div class = "row mt-3">
				<div class="row">
					<div class="input-group">
						<input type="search" class="form-control rounded" placeholder="Search" aria-label="Search">
						<button type="button" class="btn btn-outline primary">Search</button>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 text-end">
						<?php include("main_navigation.php"); ?>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-sm-9">
						
					</div>
					<div class="col-sm-3">
						<div class="card">
							<div class="card-header">Register New Account</div>
							<div class="card-body">
								<div class="form-group">
									<label class="required">Email Address *</label>
									<input type="text" id="EmailAddress" class="form-control rounded" placeholder="Email Address" />
								</div>
								<div class="form-group">
									<label class="required">Password *</label>
									<input type="password" id="Password" class="form-control rounded" placeholder="Password" />
								</div>
								<div class="form-group">
									<label class="required">First Name *</label>
									<input type="text" id="FirstName" class="form-control rounded" placeholder="First Name" />
								</div>
								<div class="form-group">
									<label class="required">Last Name *</label>
									<input type="text" id="LastName" class="form-control rounded" placeholder="Last Name" />
								</div>
								<div class="form-group">
									<label>Contact Number</label>
									<input type="text" id="ContactNumber" class="form-control rounded" placeholder="Contact Number" />
								</div>
								<div class="form-group py-1">
									<button id="BtnLogin" class="btn btn-primary btn-block">Register</button> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
	
	<script language="javascript">
		
		$("#BtnLogin").on("click", function(){
			var alertNotice = "Fields marked with * are required fields";
			
			var email = $("#EmailAddress").val();
			var password = $("#Password").val();
			var firstName = $("#FirstName").val();
			var lastName = $("#LastName").val();
			var contactNumber = $("#ContactNumber").val();
			
			if(email == null || email == ""){
				alert(alertNotice);
				$("#EmailAddress").focus();
			}	
			else if (password == null || password == ""){
				alert(alertNotice);
				$("#Password").focus();	
			}	
			else if (firstName == null || firstName == ""){
				alert(alertNotice);
				$("#FirstName").focus();	
			}	
			else if (lastName == null || lastName == ""){
				alert(alertNotice);
				$("#LastName").focus();	
			}	
			else {

				$.post("process.registration.php",{
					email_address: email,
					password: password,
					first_name: firstName,
					last_name: lastName,
					contact_number: contactNumber
				}, function(data, status){
					if (status == "success"){
						alert("You have successfully registered");
						window.location = "index.php?p=login_first_time";
					}
				})
			}
		});
		
	</script>

<?php include ("footer.php") ?>