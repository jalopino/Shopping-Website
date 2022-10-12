<?php 
include("header.php");
session_start();

$txt_id = "";
$txt_category_id = "";
$txt_color = "";
$txt_dimensions = "";
$txt_description = "";
$txt_price = "";
$txt_product_name = "";
$txt_image= "";
$txt_qty = "";
$sql_prod = "";

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
    WHERE pr.ID = ?
    ORDER BY pr.product_name ASC";
?>
<div class = "container-fluid">
    <?php if (empty($_SESSION['ID'])) { ?>
		<div class="row">
			<div class="col-sm-12 text-end">
				<?php include("main_navigation.php"); ?>
			</div>
		</div>
	<?php } ?>
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
        <div class="col-sm-12">
            <?php
        if ($prod_check = mysqli_prepare($conn, $sql_prod)) {
						mysqli_stmt_bind_param($prod_check, "i", $search_value);
						$search_value = $_GET['product_id'];
       					mysqli_stmt_execute($prod_check);
        				mysqli_stmt_bind_result($prod_check, $ID, $category_id, $color, $description, $dimensions, $price, $product_name, $product_image, $qty);
						$ctr = 1;
        					while(mysqli_stmt_fetch($prod_check)) {
								?>
										<div class="card">
											<div class="card-header">
											    <?php echo $product_name ?>
											</div>
											<div class="card-body text-center">
                                            <?php if (!empty($product_image)) { ?>
													<img src="uploads/<?php echo $product_image ?>" class="img-fluid" />
												<?php } ?>
                                            </div>
											<div class="card-footer" style="font-size: 12px">
                                                Price: <?php echo $price ?> | Remaining: <?php echo $qty ?>
                                            </div>
										</div>
								<?php
        					}
   						 }
            ?>
         </div>
    </div>
    <?php if (!empty($_SESSION['ID'])) { ?>
    <div class="row mt-2">
        <div class="col-sm-12">
        <button id="BtnLogin" class="btn btn-warning btn-block">Add to Cart</button>
        </div>
    </div>
    <?php } ?>
    <div class="row mt-2">
        <div class="col-sm-12">
        </div>
    </div>
</div>
<script language="javascript">
    $("#BtnLogin").on("click", function() {
        window.location = "process.transactions.php?product_id=<?php echo $_GET['product_id'] ?>";
    });
</script>