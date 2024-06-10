<?php
session_start();
include('server/connection.php');

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $entered_password = $_POST['password']; // Get the entered password
    $stmt = $conn->prepare('SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email=? LIMIT 1');
    $stmt->bind_param('s', $email);

    if ($stmt->execute()) {
        $stmt->bind_result($user_id, $user_name, $user_email, $hashed_password);
        $stmt->store_result();
        if ($stmt->num_rows() == 1) {
            $stmt->fetch();
            if (password_verify($entered_password, $hashed_password)) { // Verify the password
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['logged_in'] = true;

                header('location: account.php?login_success=logged in successfully');
                exit();
            } else {
                header('location: login.php?error=Incorrect password');
                exit();
            }
        } else {
            header('location: login.php?error=Could not verify account or account doesn\'t exist');
            exit();
        }
    }
} else {
    // Only show this error if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('location: login.php?error=Something went wrong. Please check your email or password');
        exit();
    }
}
?>






<?php include('layouts/header.php');?>

<!--Login-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Login</h2>
        
    </div>
    <div class="mx-auto container">
        <form id="login-form" action="login.php" method="POST">
        <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?> </p>
            <div class="form-group">
                <label>Email:</label>
                <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required/>
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required/>
            </div>

            <div class="form-group">
                
                <input type="submit" class="btn" name="login_btn" id="login-btn" value="Login">
    
            </div>

            <div class="form-group">
                <a id="register-url" href="register.php" class="btn">Don't have an account? Register</a>
            </div>
        </form>
    </div>
</section>








   
<?php include('layouts/footer.php');?>