<?php session_start();
require '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Policy Applications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
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
    </style>
</head>

<body> <?php include '../includes/sidebar.php'; ?> <main class="container-fluid py-5 bg-light">
        <div class="container p-5">
            <h2 class="text-center mb-4">Policy Applications</h2>
            <?php if (isset($_SESSION['message'])) {
                echo '<div class="alert alert-info">' . htmlspecialchars($_SESSION['message']) . '</div>';
                unset($_SESSION['message']);
            } ?> <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Application ID</th>
                            <th>User Email</th>
                            <th>Policy Name</th>
                            <th>Policy Premium</th>
                            <th>Application Date</th>
                        </tr>
                    </thead>
                    <tbody> <?php
                            //  SQL query to fetch policy applications 
                            $sql = "SELECT pa.id AS application_id, u.email AS user_email, p.name AS policy_name, p.premium AS policy_premium, pa.application_date FROM policy_applications pa INNER JOIN users u ON pa.id = u.id INNER JOIN policies p ON pa.policy_id = p.id";
                            //  Execute the query
                            if ($result = $conn->query($sql)) {
                                //  Check if there are any results and display them
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['application_id']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['user_email']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['policy_name']) . "</td>";
                                        echo "<td>₦" . htmlspecialchars($row['policy_premium']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['application_date']) . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>No applications available at the moment.</td></tr>";
                                }
                            } else {
                                //  Display an error message if the query fails
                                echo "<tr><td colspan='5' class='text-center text-danger'>Error fetching applications. Please try again later.</td></tr>";
                            }
                            ?> </tbody>
                </table>
            </div>
        </div>
    </main> <?php include '../includes/footer.php'; ?> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>