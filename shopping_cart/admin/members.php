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
                <h3>Registered Members</h3>
            </div>
		</div>
        <div class="row p-2">
            <div class="col-sm-12">
                <table border="1" class="table table-striped">
                    <thead>
                        <tr>
                            <td width="55%">Full Name</td>
                            <td width="45%">Email</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $ctr = 0; ?>
                        <?php $sql_category = "SELECT * FROM members ORDER BY ID ASC"; ?>
                        <?php $qry_category = mysqli_query($conn, $sql_category); ?>
                        <?php while($get_category = mysqli_fetch_array($qry_category)) { ?>
                        <?php $ctr++; ?>
                        <tr>
                            <td><?php echo $get_category["last_name"].", ".$get_category["first_name"] ?></td>
                            <td><?php echo $get_category["email_address"] ?></td>
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