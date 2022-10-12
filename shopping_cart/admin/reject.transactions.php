<?php
include("admin.header.php");
if (!file_exists("../connect.php")){
	echo "Unable to locate <strong>connect.php</strong>";
	exit();
}
include("../connect.php");
?>
<div class = "container my-1 border">
		<div class = "row p-2">
			<div class = "col-sm-12"><?php include("navigation.php") ?></div>
		</div>
    </div>
    
    <div class = "container border">
        <div class = "row p-2">
            <div class="col-sm-12">
                <h3>Rejected Orders</h3>
            </div>
		</div>
        <div class="row p-2">
            <div class="col-sm-12">
                <table border="1" class="table table-striped">
                    <thead>
                        <tr>
                            <td width="40%">Full Name</td>
                            <td width="20%">Email</td>
                            <td width="20%">Purchased Item</td>
                            <td width="10%">Qty</td>
                            <td width="10%">Total Price</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $ctr = 0; ?>
                        <?php $sql_category = "SELECT tr.ID, tr.qty, tr.total_price, tr.qty, pr.product_name, me.first_name, me.last_name, me.email_address 
                                                FROM transactions as tr 
                                                JOIN members AS me ON tr.members_ID = me.ID
                                                JOIN products AS pr ON tr.products_ID = pr.ID
                                                WHERE tr.status = 2"
                                                 ?>
                        <?php $qry_category = mysqli_query($conn, $sql_category); ?>
                        <?php while($get_category = mysqli_fetch_array($qry_category)) { ?>
                        <?php $ctr++; ?>
                        <tr>
                            <td><?php echo $get_category["last_name"].", ".$get_category["first_name"] ?></td>
                            <td><?php echo $get_category["email_address"] ?></td>
                            <td><?php echo $get_category["product_name"] ?></td>
                            <td class="text-end"><?php echo $get_category["qty"] ?></td>
                            <td class="text-end"><?php echo $get_category["total_price"] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total Categories : <?php echo $ctr; ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
<?php
include("admin.footer.php");
?>