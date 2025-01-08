<?php
session_start();
require '../config.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['message'] = "You must log in to apply for policies.";
    header("Location: ../login.php");
    exit;
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
    <style>
        /* Flexbox layout for sidebar and main content */
        .container-fluid {
            display: flex;
            min-height: 100vh;
            padding-left: 0;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: white;
            padding-top: 50px;
            padding-right: 10px;
        }

        /* Main content styles */
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            /* Adjusting content to be beside sidebar */
            padding-top: 50px;
        }

        /* Ensure table width doesn't overflow */
        .table-responsive {
            max-width: 100%;
        }
    </style>
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
                                            <form method="POST" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">
                                                <input type="hidden" name="policy_id" value="' . htmlspecialchars($policy['id']) . '">
                                                <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                                            </form>
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

    <?php include '../includes/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>