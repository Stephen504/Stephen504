

<?php
include('connection.php');

$stmt= $conn->prepare("SELECT * FROM products LIMIT 5");
$stmt->execute();
$featured_products= $stmt->get_result();
 ?>