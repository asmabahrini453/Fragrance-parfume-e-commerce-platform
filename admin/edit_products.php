<?php
include('header_admin.php');

if (isset($_GET['product_id'])) {
    // get the product ID from the query string
    $product_id = $_GET['product_id'];

    // prepare the SQL statement and bind the parameter
    $stmt = $conn->prepare("SELECT * FROM products  WHERE product_id = ?");
    $stmt->bindParam(1, $product_id, PDO::PARAM_INT);
    $stmt->execute();

    // fetch the product from the result set
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
} else if (isset($_POST['edit_product'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_category = $_POST['product_category'];


    $stmt = $conn->prepare("UPDATE products SET product_name=?,  product_price=?,product_description=?, product_category=? WHERE product_id=?");
    $stmt->bindParam(1, $product_name, PDO::PARAM_STR);
    $stmt->bindParam(2, $product_price, PDO::PARAM_INT);
    $stmt->bindParam(2, $product_description, PDO::PARAM_INT);
    $stmt->bindParam(2, $product_category, PDO::PARAM_INT);
    $stmt->bindParam(2, $product_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('location: products.php?edit_success_message=Product has been updated successfully!');
        exit;
    } else {
        header('location: products.php?edit_failure_message=Try again!');        exit;
    }
} else {
    header('location: products.php');
    exit;
}
?>

<div class="container-fluid">
    <div class="row" style="min-height: 1000px;">
        <?php include('side_bar.php'); ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                    </div>
                </div>
            </div>

            <h2>Edit Products</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form action="edit_products.php" id="edit-product-form" method="POST">
                        <?php if ($product) { ?>
                            <p style="color:red;"><?php if (isset($_GET['error'])) {
                                                        echo $_GET['error'];
                                                    } ?></p>
                            <div class="form-group my-2">
                                <label>Product name</label>
                                <input type="text" id="product_name" value="<?php echo $product['product_name']; ?>" name="product_name"/>
                            </div>
                            <div class="form-group my-2">
                                <label>Product Price</label>
                                <input type="text" id="product_price" value="<?php echo $product['product_price']; ?>" name="product_price"/>
                            </div>

                            <div class="form-group my-2">
                                <label>Product Description</label>
                                <input type="text" id="product_description" value="<?php echo $product['product_description']; ?>" name="product_description"/>
                            </div>

                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

                            <div class="form-group my-2">
                                <label>Product Category</label>
                                <select name="product_category" class="form-select" required>
                                    <option value="perfume" <?php if ($product['product_category'] == 'perfume') {
                                                                    echo "selected";
                                                                } ?>>Perfume</option>
                                    
                                    
                                    <option value="best_sellers" <?php if ($product['product_category'] == 'product_category') {
                                                                    echo "selected";
                                                                } ?>>Best Sellers</option>
                                </select>
                            </div>
                            

                        <div class="form-group mt-2">
                            <input type="submit" class="btn btn-primary"  name="edit_product" value="Edit">
                        </div>
                    <?php } else { ?>
                        <p>No product has been edited.</p>
                    <?php } ?>
                </form>
            </div>
        </div>
    </main>
</div>
<?php include('footer_admin.php'); ?>

