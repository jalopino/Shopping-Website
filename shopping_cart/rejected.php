<?php
session_start();
if (!empty($SESSION['ID'])){
	header("location: login.php");
	exit();
}
include("header.php");
?>
<div class = "container-fluid">
		<div class="row">
			<div class="col-sm-12 text-end"><?php include("navigation.php") ?></div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-end">
				<h3>Rejected Orders</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-end">
			<table border="1" class="table table-striped">
                    <thead>
                        <tr>
                            <td width="35%">Product Name</td>
                            <td width="20%">Categories</td>
                            <td width="10%">Unit Price</td>
                            <td width="10%">Qty</td>
							<td width="15%">Status</td>
							<td width="10%">Total Price</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $ctr = 0; ?>
                        <?php $sql_products = "SELECT pr.*, ca.category, tr.qty, tr.total_price, tr.status
                        FROM transactions AS tr 
                        JOIN members AS me ON me.ID = tr.members_ID
						JOIN products AS pr ON pr.ID = tr.products_ID
						JOIN categories AS ca ON ca.ID = pr.category_id
                        WHERE 
                            tr.status = 2 AND
                            me.ID = ".$_SESSION["ID"];
						?>
                        <?php $qry_products = mysqli_query($conn, $sql_products); ?>
                        <?php while($get_products = mysqli_fetch_array($qry_products)) { ?>
                        <?php $ctr++; ?>
                        <tr>
                            <td><?php echo $get_products["product_name"] ?></td>
                            <td><?php echo $get_products["category"] ?></td>
                            <td class="text-end"><?php echo $get_products["price"] ?></td>
                            <td class="text-end"><?php echo $get_products["qty"] ?></td>
							<td><?php echo (($get_products["status"] == 2)? "Rejected" : "Delivered"); ?></td>
							<td class="text-end"><?php echo number_format($get_products["qty"] * $get_products["price"], 2) ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total Product Purchases : <?php echo $ctr; ?></td>
                        </tr>
                    </tfoot>
                </table>
			</div>
		</div>
</div>
<?php
include("footer.php");
?>