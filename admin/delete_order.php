<?php
session_start();
include('../server/connection.php');

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->bindParam(1, $order_id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        header('location: index.php?deleted_order_successfully=Order has been deleted successfully');
    } else {
        header('location: index.php?deleted_order_failure=Could not delete Order');
    }
}
?>
