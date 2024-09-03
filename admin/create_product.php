<?php
include('../server/connection.php');

if (isset($_POST['create_product'])) {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];

    $image = $_FILES['product_image']['tmp_name'];
    $image_name = $product_name . "1.jpg";
    move_uploaded_file($image, "../assets/imgs/" . $image_name);

    $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, product_price, product_image, product_category)
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $product_name, PDO::PARAM_STR);
    $stmt->bindParam(2, $product_description, PDO::PARAM_STR);
    $stmt->bindParam(3, $product_price, PDO::PARAM_INT);
    $stmt->bindParam(4, $image_name, PDO::PARAM_STR);
    $stmt->bindParam(5, $product_category, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header('location: products.php?product_created=Product has been created successfully');
        exit();
    } else {
        header('location: products.php?product_failed=Try again!');
        exit();
    }
}
?>
