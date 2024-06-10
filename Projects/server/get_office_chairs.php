

<?php
include('connection.php');

$stmt= $conn->prepare("SELECT * FROM products WHERE product_category='office' LIMIT 5");
$stmt->execute();
$office_products= $stmt->get_result();
 ?>