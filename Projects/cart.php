<?php
session_start();

// Initialize cart and total if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (!isset($_SESSION['total'])) {
    $_SESSION['total'] = 0;
}

// Function to calculate total cart
function calculateTotalCart() {
    $total = 0; // Initialize total
    foreach ($_SESSION['cart'] as $product) {
        $total += $product['product_price'] * $product['product_quantity'];
    }
    $_SESSION['total'] = $total;
}

// Add product to cart
if (isset($_POST["add_to_cart"])) {
    // If user already added a product
    if (isset($_SESSION['cart'])) {
        $products_array_ids = array_column($_SESSION['cart'], "product_id");
        // If product has not been added
        if (!in_array($_POST['product_id'], $products_array_ids)) {
            $product_id = $_POST['product_id'];
            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity'],
            );
            $_SESSION['cart'][$product_id] = $product_array;
        } else {
            echo '<script>alert("Product already added to cart")</script>';
        }
    } else {
        // If this is the first product
        $product_id = $_POST['product_id'];
        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity']
        );
        $_SESSION['cart'][$product_id] = $product_array;
    }
    calculateTotalCart();
} elseif (isset($_POST['remove-product'])) {
    // Remove product from cart
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    calculateTotalCart();
} elseif (isset($_POST['edit_quantity'])) {
    // Edit product quantity
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];
    $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;
    calculateTotalCart();
}
if (empty($_SESSION['cart']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
  header('location: index.php');
  exit;
}

?>



<?php include('layouts/header.php')?>
<!--cart-->
<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bolde">Your Cart </h2>
        
    </div>

  
        <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            
        </tr>
        <?php foreach($_SESSION['cart'] as $key => $value){ ?>
    <tr>
        <td> 
            <div class="product-info"> 
                <img src="assets/imgs/<?php echo $value['product_image']; ?>"/>
                <div>
                    <p> <?php echo $value['product_name']; ?> </p>
                    <small> <span>R</span><?php echo $value['product_price']; ?></small>
                    <br>

                    <form method="POST">
                      <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                    <input type="submit" name="remove-product" class="remove-btn" value="remove"/> 
                  </form>
                    
                </div>
            </div>
        </td>
        <td>
          
          <form method="POST" action="cart.php">
            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"/>
            <input type="submit" class="edit-btn" value="edit" name="edit_quantity"/>
          </form>
          
        </td>
        <td> 
          <span>R</span>
          <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']?> </span>
        </td>
    </tr>
<?php } ?>
    </table>

    <div class="cart-total">
      <table>
        <tr>
        </tr>
           <td>Total</td>
           <td>R<?php echo $_SESSION['total']; ?>
  </tr>
      </table>
  </div>

  <div class="checkout-container">

  <form method="POST" action="checkout.php">
  <input type="submit" class="checkout-btn" value="Checkout" name="checkout"></input>
  </form>
   
</div>
</section>







    <!--Footer-->
    <?php include('layouts/footer.php')?>


     






