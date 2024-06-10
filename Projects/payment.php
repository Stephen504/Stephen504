<?php
session_start();
if(isset($_POST['order_pay_btn'])){
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
}
?>

<?php include('layouts/header.php'); ?>
<!-- Payment -->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="font-weight-bold">Payment</h2>
    </div>

   <!-- Only display the order status if it's not 'not paid' -->
    <?php if (isset($_POST['order_status']) && $_POST['order_status'] !== "not paid") { ?>
        <p><?php echo $_POST['order_status']; ?></p>
    <?php } ?>


    <div class="mx-auto container text-center">
        <p>Total Payment: R<?php if (isset($_SESSION['total']) && $_SESSION['total'] != 0) { echo $_SESSION['total']; } ?></p>

        <!-- PayPal Button Container -->
        <div id="paypal-button-container"></div>
        <p id="result-message"></p>
    </div>

 
</div>
</section>

<!-- Include the PayPal JavaScript SDK -->
<script
    src="https://www.paypal.com/sdk/js?client-id=AcZrfx98DetBqTHbX_rlC9cqINNKzn4BiiW87mUUxUOA50UTXnD50b4ENsNcoAfhRzX7kbtd6GEuiBid&currency=USD"
    data-sdk-integration-source="button-factory"></script>
<script>
paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '<?php echo $_SESSION['total']; ?>' // Use the total amount from session
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            // Show a success message to the buyer
            document.getElementById('result-message').innerText = 'Transaction completed by ' + details.payer.name.given_name;

            // OPTIONAL: Call your server to save the transaction
            return fetch('paypal-transaction-complete.php', {
                method: 'post',
                headers: {
                    'content-type': 'application/json'
                },
                body: JSON.stringify({
                    orderID: data.orderID
                })
            });
        });
    }
}).render('#paypal-button-container');
</script>

<?php include('layouts/footer.php'); ?>
