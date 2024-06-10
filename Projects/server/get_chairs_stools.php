

<?php
include('connection.php');

$stmt= $conn->prepare("SELECT * FROM products WHERE product_category='chairs' LIMIT 5");
$stmt->execute();
$chairs_products= $stmt->get_result();
 ?>