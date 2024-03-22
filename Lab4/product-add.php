<?php
require_once("config/product.class.php");
require_once('config/category.class.php');

if (isset($_POST["btnsubmit"])) {
    // Get values from the form
    $productName = $_POST["txtname"];
    $cateID = $_POST["txtcateid"];
    $price = $_POST["txtprice"];
    $quantity = $_POST["txtquantity"];
    $description = $_POST["txtdesc"];
    $picture = $_FILES["txtpic"];

    // Initialize the product object
    $newProduct = new Product($productName, $cateID, $price, $quantity, $description, $picture);
    $loi = array();
    $loi_str="";
    // Save to the database
    $result = $newProduct->save($loi);

    if (!$result) {
        // Error in query execution
        // header("Location: product-add.php?status=failure");
        foreach($loi as $item) $loi_str = $loi_str.$item."<br/>";
    } else {
        header("Location: product-add.php?status=inserted");
    }
}

require 'header.php';

if (isset($_GET["status"])) {
    if ($_GET["status"] == 'inserted') {
        echo "<h2>Add successful product.</h2>";
    } else {
        echo "<h2>Add failed product.</h2>";
    }
}
?>

<!-- Form for adding products -->
<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="lbltitle">
            <label>Product's name</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtname" value="<?php echo isset($_POST["txtname"]) ? $_POST["txtname"] : "" ?>">
        </div>
    </div>

    <div class="row">
        <div class="lbltitle">
            <label>Product Description</label>
        </div>
        <div class="lblinput">
            <textarea name="txtdesc" cols="21" rows="10"><?php echo isset($_POST["txtdesc"]) ? $_POST["txtdesc"] : "" ?></textarea>
        </div>
    </div>

    <div class="row">
        <div class="lbltitle">
            <label>The number of products</label>
        </div>
        <div class="lblinput">
            <input type="number" name="txtquantity" value="<?php echo isset($_POST["txtquantity"]) ? $_POST["txtquantity"] : "" ?>">
        </div>
    </div>

    <div class="row">
        <div class="lbltitle">
            <label>Product price</label>
        </div>
        <div class="lblinput">
            <input type="number" name="txtprice" value="<?php echo isset($_POST["txtprice"]) ? $_POST["txtprice"] : "" ?>">
        </div>
    </div>

    <div class="row">
        <div class="lbltitle">
            <label>Product Type</label>
        </div>
        <div class="lblinput">
            <select name="txtcateid">
                <option value="" selected>-- Select type --</option>
                <?php $cates = Category::list_category() ?>
                <?php foreach ($cates as $item) { ?>
                    <option value="<?php echo $item['CateID'] ?>"><?php echo $item['CategoryName'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="lbltitle">
            <label>Url Image</label>
        </div>
        <div class="lblinput">
        <input type="file" name="txtpic" accept=".png,.gif,.jpg,.jpeg">
        </div>
    </div>

    <div class="row">
        <div class="lbltitle">
            Click more
        </div>
        <div class="submit">
            <button type="submit" name="btnsubmit">Add Product</button>
        </div>
    </div>
</form>

<?php require 'footer.php'; ?>
