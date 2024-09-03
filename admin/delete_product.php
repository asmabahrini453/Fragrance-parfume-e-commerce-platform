<?php
session_start();
include('../server/connection.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bindParam(1, $product_id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        header('location: products.php?deleted_successfully=Product has been deleted successfully');
    } else {
        header('location: products.php?deleted_failure=Could not delete product');
    }
}
?>
