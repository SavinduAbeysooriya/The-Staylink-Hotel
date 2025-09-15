<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<?php if ($isLoggedIn): ?>
    <div class="container">
        <h2 class="text-center mb-4">Payment</h2>
        <form id="paymentForm">
            <div class="form-group">
                <label for="card_number">Card Number:</label>
                <input type="text" class="form-control" id="card_number" name="card_number" required>
            </div>
            <div class="form-group">
                <label for="expiry_date">Expiry Date:</label>
                <input type="month" class="form-control" id="expiry_date" name="expiry_date" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" class="form-control" id="cvv" name="cvv" required>
            </div>
            <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
    </div>

    <script>
        $('#paymentForm').on('submit', function(event) {
            event.preventDefault();
            
            // AJAX call to process the payment
            $.ajax({
                url: 'processes/process_payment.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    let result = JSON.parse(response);
                    
                    if (result.success) {
                        // Display success alert with a message
                        Swal.fire({
                            icon: 'success',
                            title: 'Payment Successful',
                            text: result.message,
                        }).then(() => {
                            // Optionally, reset the form or navigate to a "thank you" page
                            $('#paymentForm')[0].reset();
                        });
                    } else {
                        // Display error alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Payment Failed',
                            text: result.message,
                        });
                    }
                },
                error: function() {
                    // Handle AJAX error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while processing your payment. Please try again.',
                    });
                }
            });
        });
    </script>
<?php else: ?>
    <div class="alert alert-warning" role="alert">
        Please <a href="login.php">log in</a> to proceed with payment.
    </div>
<?php endif; ?>
</body>
</html>
