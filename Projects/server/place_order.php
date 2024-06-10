<?php
include('connection.php');
session_start();

//if user is not logged in
if(!isset($_SESSION['logged_in'])){
    header('location:/checkout.php?message=Please login/register to place an order');

}else{


    if(isset($_POST['place_order'])){


    
        // 1. get user information and store it in the databse
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = $_SESSION['total'];
        $order_status = 'not paid';
        $user_id = $_SESSION['user_id'];
        $order_date=date('Y-m-d H:i:s');
        
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("isiisss", $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
        
        $stmt_status=$stmt->execute();
        if(!$stmt_status){
            header('location: index.php');
        }
        
        $order_id= $stmt->insert_id;
        
        
        
        
        
        
        // 2. get product from cart (from a session)  store it in the databse
        foreach($_SESSION['cart'] as $key => $value){
        
            $product = $_SESSION['cart'][$key];
            $product_id = $product['product_id'];
            $product_name= $product['product_name'];
            $product_image = $product['product_image'];
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity'];
            $order_date = date('Y-m-d H:i:s'); // assuming you want the current date and time
        
            $stmt1 = $conn->prepare("INSERT INTO order_items(order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt1 === false) {
                die('prepare() failed: ' . htmlspecialchars($conn->error));
            }
            $rc = $stmt1->bind_param("iissiiis", $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
            if ($rc === false) {
                die('bind_param() failed: ' . htmlspecialchars($stmt1->error));
            }
            if ($stmt1->execute() === false) {
                die('execute() failed: ' . htmlspecialchars($stmt1->error));
            }
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        //3. issue new order and Store order info in the databse
        
        //4. Store each single item in order_items database
        
        //5. Remove everthing from cart
        
        //6. Alert user if everything is fine or issue ocured
        header('location: ../payment.php?order_status=order placed succesfully');
        }
}



?>
