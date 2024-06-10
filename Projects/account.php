<?php
session_start();
include('server/connection.php');

// Redirect to login if not logged in
if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header('location: login.php');
    exit;
}

// Password change logic
if (isset($_POST['change_password'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $user_email = $_SESSION['user_email'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match";
        header("location: account.php");
        exit();
    }

    // Check password length
    if (strlen($password) < 6) {
        $_SESSION['error'] = "Passwords must be at least 6 characters";
        header("location: account.php");
        exit();
    }

    // Update password if no errors
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
    $stmt->bind_param('ss', $hashed_password, $user_email);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Password has been updated successfully";
    } else {
        $_SESSION['error'] = "Could not update password";
    }
    header("location: account.php");
    exit();
}


//get orders
if(isset($_SESSION['logged_in'])){
  $user_id=$_SESSION['user_id'];
  $stmt= $conn->prepare("SELECT * FROM orders WHERE user_id=? ");
  $stmt->bind_param('i',$user_id);
$stmt->execute();
$orders=$stmt->get_result();
}
?>


<?php include('layouts/header.php')?>



<!--Account-->
<section class="my-5 py-5">
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <p class="text-center" style="color:green">
                <?php if (isset($_GET['register_success'])) {
                    echo htmlspecialchars($_GET['register_success']);
                } ?>
            </p>
            <p class="text-center" style="color:green">
                <?php if (isset($_GET['login_success'])) {
                    echo htmlspecialchars($_GET['login_success']);
                } ?>
            </p>

            <h3 class="fw-bold">Account Info</h3>
            <hr class="mx-auto">
            <div class="account-info">
                <p> Name <span> <?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : ''; ?> </span></p>
                <p> Email <span> <?php echo isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : ''; ?> </span></p>
                <p><a href="#orders" id="orders-btn">Your Orders</a></p>
                <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-12 col-sm-12">
            <form id="account-form" method="POST" action="account.php">
                <p class="text-center" style="color:red">
                    <?php if (isset($_SESSION['error'])) {
                        echo htmlspecialchars($_SESSION['error']);
                        unset($_SESSION['error']);
                    } ?>
                </p>
                <p class="text-center" style="color:green">
                    <?php if (isset($_SESSION['message'])) {
                        echo htmlspecialchars($_SESSION['message']);
                        unset($_SESSION['message']);
                    } ?>
                </p>
                <h3>Change Password</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="account-password" name="password" placeholder="Password">
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="account-password-confirm" name="confirm-password" placeholder="Confirm Password">
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn">
                </div>
            </form>
        </div>
    </div>
</section>

<!--Orders-->

<section id="orders" class="orders container my-5 py-3">
  <div class="container mt-2">
      <h2 class="font-weight-bold text-center">Your Orders</h2>
      <hr class="mx-auto">
  </div>

  <table class="mt-5 pt-5">
      <tr>
          <th>Order id</th>
          <th>Order cost</th>
          <th>Order Status</th>
          <th>Order date</th>
          <th>Order details</th>
      </tr>

      <?php while ($row = $orders->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $row['order_id']; ?></td>
        <td><?php echo $row['order_cost']; ?></td>
        <td><?php echo $row['order_status']; ?></td>
        <td><?php echo $row['order_date']; ?></td>
        <td>
        <form action="order_details.php" method="POST"> 
        <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status"/>
  <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>"/>
  <input class="btn order-details-btn" type="submit" value="Details"/>
</form>
      </td>
      </tr>
      <?php } ?>
  </table>
</section>























                     <!--Navbar aproximate location-->
          <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
  <div class="container">
    <img class="logo" src="assets/imgs/logo.png">
    <h2 class="brand">Perfect Comfort</h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse nav-buttons ms-auto" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="shop.php">Shop</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="https://www.bassettfurniture.com/blog">Blog</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact Us</a>
        </li>

        <li class="nav-item">
          <a href="checkout.php"><i class= "fa fa-user"></i> </a>
          <a href="cart.php" style="padding: 10px;"><i class="fa fa-shopping-bag"></i></a>
        </li>

        </li>
        
      </ul>
     
    </div>
  </div>
</nav>

<?php include('layouts/footer.php')?>