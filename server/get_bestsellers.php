<?php 
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='best_sellers' LIMIT 4");
$stmt->execute();
$best_sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
