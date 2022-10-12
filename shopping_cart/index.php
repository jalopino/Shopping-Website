<?php include ("header.php") ?>
<?php
session_start();
$txt_id = "";
$txt_category_id = "";
$txt_color = "";
$txt_dimensions = "";
$txt_description = "";
$txt_price = "";
$txt_product_name = "";
$txt_image = "";
$txt_qty = "";
$sql_prod = "";

if (empty($_GET["search"])) {
		$sql_prod = "
		SELECT 
			pr.ID,
			pr.category_id,
			pr.color,
			pr.description,
			pr.dimensions,
			pr.price,
			pr.product_name,
			pr.product_image,
			pr.qty
		FROM
			products AS pr
		JOIN
			categories AS ca ON ca.ID = pr.category_id
		ORDER BY pr.product_name ASC";
} else {
	$sql_prod = "
	SELECT 
		pr.ID,
		pr.category_id,
		pr.color,
		pr.dimensions,
		pr.description,
		pr.price,
		pr.product_name,
		pr.product_image,
		pr.qty
	FROM
		products AS pr
	JOIN
		categories AS ca ON ca.ID = pr.category_id
	WHERE pr.product_name LIKE ?
	ORDER BY pr.product_name ASC";
}
?>
	<div class = "container-fluid">
		<div class = "row">
			<div class = "col-sm-12 text-center"></div>
		</div>
		<?php if (!empty($_SESSION['ID'])) { ?>
		<div class="row">
			<div class="col-sm-12 text-end"><?php include("navigation.php") ?></div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-end">
				Welcome <?php echo @$_SESSION['first_name'] ?> to your dashboard
			</div>
		</div>
		<?php } ?>
			<div class = "row mt-3">
				<div class="row">
					<div class="input-group">
						<input type="text" id="TxtSearch" class="form-control rounded" placeholder="Search" aria-label="Search">
						<button type="button" id="BtnSearch" class="btn btn-outline primary">Search</button>
					</div>
				</div>
				<?php if (empty($_SESSION['ID'])) { ?>
				<div class="row">
					<div class="col-sm-12 text-end">
						<?php include("main_navigation.php"); ?>
					</div>
				</div>
				<?php } ?>
				<div class="row mt-3">
					<div class="col-sm-<?php echo (!empty($_SESSION['ID']))? "12" : "8"; ?>">
						<!-- Start -->
						<div class="row">
						<?php
					if ($prod_check = mysqli_prepare($conn, $sql_prod)) {
						if (!empty($_GET['search'])) {
							mysqli_stmt_bind_param($prod_check, "s", $search_value);
							$search_value = $_GET['search'];
						}
       					mysqli_stmt_execute($prod_check);
        				mysqli_stmt_bind_result($prod_check, $ID, $category_id, $color, $description, $dimensions, $price, $product_name, $product_image, $qty);
						$ctr = 1;
        					while(mysqli_stmt_fetch($prod_check)) {
								?>
									<div class="col-sm-3 <?php echo ($ctr > 4) ? "my-3" : ""; ?>">
										<div class="card">
											<div class="card-header">
												<a href="product.details.php?product_id=<?php echo $ID ?>"><?php echo $product_name ?></a>
											</div>
											<div class="card-body">
												<?php if (!empty($product_image)) { ?>
													<a href="product.details.php?product_id=<?php echo $ID ?>">
														<img src="uploads/<?php echo $product_image ?>" class="img-fluid" />
													</a>
												<?php } ?>
											</div>
											<div class="card-footer" style="font-size: 12px">Price: <?php echo $price ?> | Remaining: <?php echo $qty ?></div>
										</div>
									</div>
								<?php
								$ctr++;
        					}
   						 }
					?>
					</div>
					<!-- End -->
					</div>
					<?php if (empty($_SESSION['ID'])) { ?>
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
									<input type="password" id="Password" class="form-control rounded" placeholder="Password" />
								</div>
								<div class="form-group py-1">
									<button id="BtnLogin" class="btn btn-primary btn-block">Login</button>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
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

<?php include ("footer.php") ?>