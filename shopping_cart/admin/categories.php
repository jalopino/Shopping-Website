<?php
include("admin.header.php");
if (!file_exists("../connect.php")){
	echo "Unable to locate <strong>connect.php</strong>";
	exit();
}
include("../connect.php");
$txt_id = ""; 
$txt_category = ""; 
$txt_description = ""; 
if (@$_GET["action"] == "update") {
    $sql_cat = "SELECT ID, category, description FROM categories WHERE ID = ?";
    if ($cat_check = mysqli_prepare($conn, $sql_cat)){
	    mysqli_stmt_bind_param($cat_check, "i", $id);
	    $id = $_GET['id'];
	    mysqli_stmt_execute($cat_check);
	    mysqli_stmt_bind_result($cat_check, $ID, $category, $description);
	    while (mysqli_stmt_fetch($cat_check)) {
            $txt_id = $ID; 
            $txt_category = $category; 
            $txt_description = $description; 
        }
	}
}

echo $txt_id;

?>
<div class = "container my-1 border">
		<div class = "row p-2">
			<div class = "col-sm-12"><?php include("navigation.php") ?></div>
		</div>
    </div>
    
    <div class = "container border">
        <div class = "row p-2">
            <div class="col-sm-12">
                <h3>Categories</h3>
            </div>
		</div>
        <div class = "row p-2">
            <div class="col-sm-5">
                <div class="form-group">
				    <label>Category *</label>
				    <input value="<?php echo $txt_category; ?>" type="text" id="category" class="form-control rounded" placeholder="Category" />
			    </div> 
            </div>
            <div class="col-sm-7">
                <div class="form-group">
				    <label>Description</label>
				    <input value="<?php echo $txt_description; ?>" type="text" id="description" class="form-control rounded" placeholder="Description" />
			    </div> 
            </div>
        </div>
        <div class="row p-2">
            <div class="col-sm-2">
                <div class="form-group">
                    <input type="hidden" value="<?php echo $txt_id ?>" id="id">
                    <button id="BtnAddCategory" class="btn btn-warning btn-block">Save Category</button>
			    </div> 
            </div>
        </div>
        <div class="row p-2">
            <div class="col-sm-12">
                <table border="1" class="table table-striped">
                    <thead>
                        <tr>
                            <td width="15%">Action</td>
                            <td width="40%">Category</td>
                            <td width="45%">Description</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $ctr = 0; ?>
                        <?php $sql_category = "SELECT * FROM categories ORDER BY category ASC"; ?>
                        <?php $qry_category = mysqli_query($conn, $sql_category); ?>
                        <?php while($get_category = mysqli_fetch_array($qry_category)) { ?>
                        <?php $ctr++; ?>
                        <tr>
                            <td>
                                <a href="process.category.php?action=delete&id=<?php echo $get_category["ID"] ?>">Delete</a> /
                                <a href="categories.php?action=update&id=<?php echo $get_category["ID"] ?>">Update</a>
                            </td>
                            <td><?php echo $get_category["category"] ?></td>
                            <td><?php echo $get_category["description"] ?></td>
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
    <script language="javascript">
        $('#BtnAddCategory').on('click', function() {
            var alertNotice = "Fields marked with * are required fields";
			
			var txtCategory = $("#category").val();
			var txtDescription = $("#description").val();
            var txtID = $("#id").val();
			
			if(txtCategory == null || txtCategory == ""){
				alert(alertNotice);
				$("#category").focus();
			} else {
				//
				//
				$.post("process.category.php",{
					category: txtCategory,
					description: txtDescription,
                    id: txtID
				}, function(data, status){
					if (status == "success"){
						window.location = "categories.php";
					}
				})
			}
        });
    </script>
<?php
include("admin.footer.php");
?>