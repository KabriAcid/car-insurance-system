<?php
session_start();
require '../config.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['message'] = "You must log in to apply for policies.";
    header("Location: ../public/index.php");
    exit;
} else {
    $user = $_SESSION['user'];
}

// Handle policy application
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $policy_id = intval($_POST['policy_id']);
    $application_date = date("Y-m-d H:i:s");

    if (!empty($policy_id)) {
        $sql = "INSERT INTO policy_applications (user_id, policy_id, application_date) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("iis", $_SESSION['user']['id'], $policy_id, $application_date);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Policy application submitted successfully!";
            } else {
                $_SESSION['message'] = "Error submitting application: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $_SESSION['message'] = "Database error: " . $conn->error;
        }
    } else {
        $_SESSION['message'] = "Invalid policy selection.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Policies</title>
    <!-- Favicon -->
    <link rel="icon" href="../public/favicon.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
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
                        <h2 class="header">Available Policies</h2>
                        <p class="text-sm text-muted">Browse and apply for an insurance policy below.</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Policy Name</th>
                                    <th>Description</th>
                                    <th>Premium</th>
                                    <th>Coverage</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch all policies
                                $sql = "SELECT id, name, description, premium, coverage FROM policies";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    while ($policy = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($policy['name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($policy['description']) . "</td>";
                                        echo "<td>₦ " . htmlspecialchars($policy['premium']) . "</td>";
                                        echo "<td>" . htmlspecialchars($policy['coverage']) . "</td>";
                                        echo '<td>
                                            <form method="POST" action="">
                                                <input type="hidden" name="policy_id" value="' . htmlspecialchars($policy['id']) . '">
                                            </form>
                                            <button type="button" class="btn btn-sm btn-primary" onclick="makePayment(' . htmlspecialchars($policy['premium']) . ')">Pay Now</button>
                                        </td>';
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>No policies available at the moment.</td></tr>";
                                }
                                $stmt->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
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