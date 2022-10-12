<?php
include("admin.header.php");
if (!file_exists("../connect.php")){
	echo "Unable to locate <strong>connect.php</strong>";
	exit();
}
include("../connect.php");
if (isset($_POST["BtnAddImage"])) {
    $add_image = "UPDATE products SET product_image = ? WHERE ID = ?";
    if ($prod_add_image = mysqli_prepare($conn, $add_image)) {
        mysqli_stmt_bind_param($prod_add_image, "si", $product_image, $id);
        $product_image = $_FILES["image"] ["name"];
        $id = $_POST['ID'];
        mysqli_stmt_execute($prod_add_image);

        $target_path = "../uploads/";
        $target_path = $target_path.basename($_FILES["image"] ["name"]);
        if (move_uploaded_file($_FILES["image"] ["tmp_name"], $target_path)) {
            header("location: image.php?id=".$id);
            exit();
        } else {
            echo "Unable to upload file";
            exit();
        }
    }
}

$txt_id = "";
$txt_category_id = "";
$txt_color = "";
$txt_dimensions = "";
$txt_description = "";
$txt_price = "";
$txt_product_name = "";
$txt_qty = "";
$txt_image = "";

$sql_prod = "SELECT ID, category_id, color, description, dimensions, price, product_name, product_image, qty FROM products WHERE ID = ?";
if ($prod_check = mysqli_prepare($conn, $sql_prod)) {
    mysqli_stmt_bind_param($prod_check, "i", $id);
        $id = $_GET['id'];
    mysqli_stmt_execute($prod_check);
    mysqli_stmt_bind_result($prod_check, $ID, $category_id, $color, $description, $dimensions, $price, $product_name, $product_image, $qty,);
     while(mysqli_stmt_fetch($prod_check)) {
        $txt_id = $ID;
        $txt_category_id = $category_id;
        $txt_color = $color;
        $txt_description = $description;
        $txt_dimensions = $dimensions;
        $txt_price = $price;
        $txt_product_name = $product_name;
        $txt_image = $product_image;
        $txt_qty = $qty;
    }
}
?>
<div class = "container my-1 border">
	<div class = "row p-2">
		<div class = "col-sm-12"><?php include("navigation.php") ?></div>
	</div>
</div>
<div class = "container border">
    <div class="row p-2">
        <div class="col-sm-5">
            <div class="form-group">
                <label><strong>Product :</strong></label> <?php echo $txt_product_name ?>
            </div>
        </div> 
    </div>
    <div class="row p-2">
        <div class="col-sm-5">
            <form method="post" action="image.php" enctype="multipart/form-data">
            <div class="form-group">
                <label><strong>Image :</strong></label>
                <input type="file" name="image"><br />
                <input type="hidden" name="ID" value="<?php echo $txt_id ?>">
                <input type="submit" name="BtnAddImage" class="btn btn-warning btn-block" value="Add Image"></button>
            </div>
            </form>
        </div> 
    </div>
    <div class="row p-2">
        <div class="col-sm-5">
            <?php if (!empty($txt_image)) { ?>
			    <img src="../uploads/<?php echo $txt_image ?>" class="img-fluid" />
		    <?php } ?>
        </div> 
    </div>
</div>

<?php 
include("admin.footer.php");
?>