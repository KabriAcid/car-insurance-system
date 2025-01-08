<?php
session_start();
require '../config.php';

// Ensure the user is logged in before accessing the page
if (!isset($_SESSION['user'])) {
    $_SESSION['message'] = "You must log in to renew a policy.";
    header("Location: ../login.php");
    exit();
}

// Fetch the current user’s policies from the database
$user_id = $_SESSION['user']['id']; // Get user ID from session
$sql = "SELECT * FROM policies WHERE id= ?"; // Ensure 'user_id' exists in the table
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$policies = $stmt->get_result();
$stmt->close();

// Handle policy renewal on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $policy_id = intval($_POST['policy_id']);
    $renew_date = date("Y-m-d", strtotime('+1 year')); // Renew the policy for one more year

    // Update the policy with the new renewal date
    $update_sql = "UPDATE policies SET renewal_date = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $renew_date, $policy_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Policy renewed successfully!";
        header("Location: dashboard.php"); // Redirect to dashboard after success
        exit();
    } else {
        $_SESSION['message'] = "Error renewing policy: " . $stmt->error;
        header("Location: renew_policy.php"); // Stay on the renewal page if error occurs
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renew Policy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>

<body>
    <?php include '../includes/sidebar.php'; ?>

    <div class="main-content container-fluid py-5 bg-light">
        <div class="container p-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-4">
                        <h2 class="header">Renew Policies</h2>
                        <p class="text-sm text-muted">Browse and apply for an insurance policy below.</p>
                    </div>
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo '<div class="alert alert-info">' . htmlspecialchars($_SESSION['message']) . '</div>';
                        unset($_SESSION['message']);
                    }
                    ?>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="card">
                            <div class="card-header">
                                <h5>Select Policy to Renew</h5>
                            </div>
                            <div class="card-body">
                                <p>Choose one of your available policies to renew.</p>

                                <!-- Dropdown to select a policy -->
                                <div class="mb-3">
                                    <label for="policy_id" class="form-label">Select Policy</label>
                                    <select name="policy_id" id="policy_id" class="form-select" required>
                                        <option value="" disabled selected>Select a policy</option>
                                        <?php
                                        if ($policies->num_rows > 0) {
                                            while ($policy = $policies->fetch_assoc()) {
                                                echo "<option value='" . htmlspecialchars($policy['id']) . "'>";
                                                echo htmlspecialchars($policy['name']) . " - Renewal Date: " . htmlspecialchars($policy['renewal_date']);
                                                echo "</option>";
                                            }
                                        } else {
                                            echo "<option value='' >No available policies to renew</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Renew Policy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php';
    // Six random digit number for transaction reference
    $tx_ref = 'PAY_ID' . rand(100000, 999999);
    require '../scripts/keys.php';
    ?>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script>
        function makePayment(premium) {
            FlutterwaveCheckout({
                public_key: "<?php echo $public_key; ?>",
                tx_ref: "<?php echo $tx_ref; ?>",
                amount: premium,
                currency: "NGN",
                payment_options: "card, ussd",
                redirect_url: "../scripts/redirect.php",
                customer: {
                    email: "<?php echo $user['email']; ?>",
                    phone_number: "<?php echo $user['phone_number']; ?>",
                    name: "<?php echo $user['first_name'] . ' ' . $user['last_name']; ?>"
                },
                callback: function(data) {
                    console.log(data);
                },
                customizations: {
                    title: "Payment for Car Insurance App",
                    description: "Payment for available policies",
                    logo: "public/favicon.png"
                },
            });
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>