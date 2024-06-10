

<?php
include('connection.php');

$stmt= $conn->prepare("SELECT * FROM products WHERE product_category='camp' LIMIT 5");
$stmt->execute();
$camp_products= $stmt->get_result();
 ?>