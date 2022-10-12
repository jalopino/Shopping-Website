<?php
include("admin.header.php");
if (!file_exists("../connect.php")){
	echo "Unable to locate <strong>connect.php</strong>";
	exit();
}
include("../connect.php");
$txt_id = "";
$txt_category_id = "";
$txt_color = "";
$txt_dimensions = "";
$txt_description = "";
$txt_price = "";
$txt_product_name = "";
$txt_qty = "";

if (@$_GET["action"] == "update") {
    $sql_prod = "SELECT ID, category_id, color, description, dimensions, price, product_name, qty FROM products WHERE ID = ?";
    if ($prod_check = mysqli_prepare($conn, $sql_prod)) {
        mysqli_stmt_bind_param($prod_check, "i", $id);
            $id = $_GET['id'];
        mysqli_stmt_execute($prod_check);
        mysqli_stmt_bind_result($prod_check, $ID, $category_id, $color, $description, $dimensions, $price, $product_name, $qty);
        while(mysqli_stmt_fetch($prod_check)) {
            $txt_id = $ID;
            $txt_category_id = $category_id;
            $txt_color = $color;
            $txt_description = $description;
            $txt_dimensions = $dimensions;
            $txt_price = $price;
            $txt_product_name = $product_name;
            $txt_qty = $qty;
        }
    }
}

?>

<div class = "container my-1 border">
		<div class = "row p-2">
			<div class = "col-sm-12"><?php include("navigation.php") ?></div>
		</div>
    </div>
    <div class = "container border">
        <div class = "row p-2">
            <div class="col-sm-12">
                <h3>Products</h3>
            </div>
		</div>
        <div class = "row p-2">
            <div class="col-sm-5">
                <div class="form-group">
				    <label>Category *</label>
				    <select id="category_id" class="form-control rounded" placeholder="Category">
                        <?php $sql_category = "SELECT * FROM categories ORDER BY category ASC"; ?>
                        <?php $qry_category = mysqli_query($conn, $sql_category); ?>
                        <?php while($get_category = mysqli_fetch_array($qry_category)) { ?>
                        <option value="<?php echo $get_category["ID"] ?>"><?php echo $get_category["category"] ?></option>
                        <?php } ?>
                    </select>
                    <a href="categories.php">Add new category</a>
			    </div> 
            </div>
            <div class="col-sm-7">
                <div class="form-group">
				    <label>Product *</label>
				    <input value="<?php echo $txt_product_name ?>" type="text" id="product_name" class="form-control rounded" placeholder="Product" />
			    </div> 
            </div>
        </div>
        <div class = "row p-2">
            <div class="col-sm-4">
                <div class="form-group">
				    <label>Price *</label>
				    <input type="text" id="price" class="form-control rounded" placeholder="0.00"/>
			    </div> 
            </div>
            <div class="col-sm-4">
                <div class="form-group">
				    <label>Color</label>
				    <input type="text" id="color" class="form-control rounded" placeholder="Color" />
			    </div> 
            </div>
            <div class="col-sm-4">
                <div class="form-group">
				    <label>Dimensions</label>
				    <input type="text" id="dimensions" class="form-control rounded" placeholder="Dimensions"/>
			    </div> 
            </div>
        </div>
        <div class = "row p-2">
            <div class="col-sm-4">
                <div class="form-group">
				    <label>Qty *</label>
				    <input type="text" id="qty" class="form-control rounded" placeholder="0"/>
			    </div> 
            </div>
            <div class="col-sm-8">
                <div class="form-group">
				    <label>Description</label>
				    <input type="text" id="description" class="form-control rounded" placeholder="Description"/>
			    </div> 
            </div>

        </div>
        <div class="row p-2">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="hidden" value="<?php echo $txt_id ?>" id="id">
                    <button id="BtnAddProducts" class="btn btn-warning btn-block">Save Product Details</button>
			    </div> 
            </div>
            <div class="col-sm-6">
                <div class="form-group text-end">
                        <a href="products.php" class="btn btn-secondary btn-block">Add New Product</a>
			    </div> 
            </div>
        </div>
        <div class="row p-2">
            <div class="col-sm-12">
            <table border="1" class="table table-striped">
                    <thead>
                        <tr>
                            <td width="15%">Action</td>
                            <td width="35%">Product Name</td>
                            <td width="20%">Categories</td>
                            <td width="15%">Price</td>
                            <td width="15%">Qty</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $ctr = 0; ?>
                        <?php $sql_products = "SELECT pr.* , ca.category 
                        FROM products AS pr 
                        JOIN categories AS ca 
                        ON ca.ID = pr.category_ID 
                        ORDER BY pr.product_name ASC"; ?>
                        <?php $qry_products = mysqli_query($conn, $sql_products); ?>
                        <?php while($get_products = mysqli_fetch_array($qry_products)) { ?>
                        <?php $ctr++; ?>
                        <tr>
                            <td>
                                <a href="process.product.php?action=delete&id=<?php echo $get_products["ID"] ?>">Delete</a> /
                                <a href="products.php?action=update&id=<?php echo $get_products["ID"] ?>">Update</a> /
                                <a href="image.php?id=<?php echo $get_products["ID"]?>">Image</a>
                            </td>
                            <td><?php echo $get_products["product_name"] ?></td>
                            <td><?php echo $get_products["category"] ?></td>
                            <td class="text-end"><?php echo $get_products["price"] ?></td>
                            <td class="text-end"><?php echo $get_products["qty"] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total Product Inventory : <?php echo $ctr; ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <script language="javascript">
        $('#BtnAddProducts').on('click', function(){
            var alertNotice = "Fields marked with * are required fields";
			
			var txtCategoryID = $("#category_id").val();
			var txtProductName = $("#product_name").val();
            var txtPrice = $("#price").val();
            var txtColor = $("#color").val();
            var txtDimensions = $("#dimensions").val();
            var txtQty = $("#qty").val();
            var txtDescription = $("#description").val();
            var txtID = $("#id").val();
			
			if(txtCategoryID == null || txtCategoryID == ""){
				alert(alertNotice);
				$("#category_id").focus();
			}
            else if(txtProductName == null || txtProductName == ""){
				alert(alertNotice);
				$("#product_name").focus();
			} 
            else if(txtPrice == null || txtPrice == ""){
				alert(alertNotice);
				$("#price").focus();
			}
            else if(txtQty == null || txtQty == ""){
				alert(alertNotice);
				$("#qty").focus();
			}  else {
				//
				//
				$.post("process.product.php",{
					category_id: txtCategoryID,
					product_name: txtProductName,
                    price: txtPrice,
                    color: txtColor,
                    dimensions: txtDimensions,
                    description: txtDescription,
                    qty: txtQty,
                    id: txtID
				}, function(data, status){
					if (status == "success"){
						window.location = "products.php";
					}
				})
			}
        });
    </script>
<?php
include("admin.footer.php");
?>