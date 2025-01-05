<?php
session_start();
require '../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        /* Adjust the left margin to make space for the sidebar */
        body {
            margin-left: 250px;
            /* Adjust this value according to the sidebar width */
            min-height: 100vh;
            /* Ensures the body takes full height */
            display: flex;
            flex-direction: column;
        }

        /* Ensure the sidebar is not covering content */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            /* Sidebar width */
            height: 100vh;
            background-color: #f8f9fa;
            z-index: 1000;
        }

        .container-fluid {
            padding-left: 20px;
            /* Additional padding for content */
            flex-grow: 1;
            /* Ensure main content takes remaining height */
        }

        .alert-info {
            margin-top: 20px;
        }

        /* Sticky footer at the bottom */
        footer {
            background-color: #f8f9fa;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .table td.payment-success {
            background-color: #d4edda;
            text-transform: uppercase;
            color: white;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <?php
    include '../includes/sidebar.php';
    ?>
    <main class="container-fluid py-5 bg-light">
        <div class="container p-5">
            <h2 class="text-center mb-4">Transactions</h2>

            <!-- Display Session Message -->
            <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="alert alert-info">' . htmlspecialchars($_SESSION['message']) . '</div>';
                unset($_SESSION['message']);
            }
            ?>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Currency</th>
                            <th>Customer Email</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // SQL query to fetch transactions
                        $sql = "SELECT 
                                    transaction_id, 
                                    amount, 
                                    currency, 
                                    customer_email, 
                                    status, 
                                    created_at 
                                FROM 
                                    transactions 
                                WHERE 
                                    customer_email = ?";

                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->bind_param("s", $_SESSION['user']['email']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            // Check if there are any results and display them
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $paymentSuccess = $row['status'] === 'paid' ? 'payment-success' : '';
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['transaction_id']) . "</td>";
                                    echo "<td>₦" . htmlspecialchars($row['amount']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['currency']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['customer_email']) . "</td>";
                                    echo "<td class='$paymentSuccess'>" . htmlspecialchars($row['status']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No transactions available at the moment.</td></tr>";
                            }
                            $stmt->close();
                        } else {
                            // Display an error message if the query fails
                            echo "<tr><td colspan='6' class='text-center text-danger'>Error fetching transactions. Please try again later.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php
    include '../includes/footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>