<?php
session_start();
include('server/connection.php');

// Define the function to calculate the total order price
function calculateTotalOrderPrice($order_details) {
    $total = 0; // Initialize total
    foreach($order_details as $row) {
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        $total += ($product_price * $product_quantity);
    }
    return $total;
}

// Check if the order ID is set in the POST request
if(isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $order_details = $stmt->get_result();

    // Check if there are order details
    if($order_details->num_rows > 0) {
        // Calculate the total order price
        $order_total_price = calculateTotalOrderPrice($order_details);
        // You can now use $total_order for further processing
    } else {
        // Redirect to the account page if there are no order details
        header('location:account.php');
        exit();
    }
} else {
    // Redirect to the account page if the order ID is not set
    header('location:account.php');
    exit();
}
?>




<?php include('layouts/header.php');?>


  <!-- Orders Detail Section -->
  <section id="orders" class="orders container my-5 py-3">
    <div class="container mt-2">
        <h2 class="font-weight-bold text-center">Your Orders</h2>
        <hr class="mx-auto">
    </div>
    <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            
        </tr>
        <?php foreach ($order_details as $row) { ?> 
          <tr>
              <td>
                <div class="product-info">
                  <img src="assets/imgs/<?php echo $row['product_image']; ?>"/>
                  <div>
                    <p class="mt-3"><?php echo $row['product_name']; ?></p> 
                  </div>
                </div>
              </td>
              <td>
                <span>R<?php echo $row['product_price']; ?></span>
              </td>
              <td>
                <span><?php echo $row['product_quantity']; ?></span>
              </td>
            
          </tr>
        <?php } ?>



    </table>

   
<?php if($order_status == "not paid"){ ?>
  <form style="float: right;" method="POST" action="payment.php">
  
    <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>"/>
    <input type="hidden" name="order_status" value="<?php echo $order_status; ?>"/>

    <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Pay Now"/>
  </form>
  <?php } ?>


  </section>

  <?php include('layouts/footer.php');?>