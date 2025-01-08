<?php
session_start();
require '../config.php';

// Handle claim submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $policy_number = htmlspecialchars(trim($_POST['policy_number']));
    $description = htmlspecialchars(trim($_POST['description']));
    $claim_date = date("Y-m-d H:i:s");

    if (!empty($policy_number) && !empty($description)) {
        $sql = "INSERT INTO claims (user_id, policy_number, description, claim_date) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("isss", $_SESSION['user']['id'], $policy_number, $description, $claim_date);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Claim submitted successfully!";
            } else {
                $_SESSION['message'] = "Error submitting claim: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $_SESSION['message'] = "Database error: " . $conn->error;
        }
    } else {
        $_SESSION['message'] = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Claims</title>
    <!-- favicon -->
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
    </style>
</head>

<body>
    <?php include '../includes/sidebar.php'; ?>

    <div class="main-content container-fluid py-5 bg-light">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <!-- Claim Submission Section -->
                    <div class="text-center mb-4">
                        <h2 class="header">Submit a New Claim</h2>
                        <p class="text-sm text-muted">Provide details of your claim below.</p>
                    </div>
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
                        unset($_SESSION['message']);
                    }
                    ?>
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="shadow-lg p-4 rounded-3 bg-white">
                        <div class="mb-3">
                            <label for="policy_number" class="form-label">Policy Number</label>
                            <input type="text" name="policy_number" id="policy_number" class="form-control" placeholder="Enter your policy number" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Claim Description</label>
                            <textarea name="description" id="description" class="form-control" rows="5" placeholder="Describe the reason for your claim" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit Claim</button>
                    </form>
                </div>
            </div>

            <!-- Claim History Section -->
            <div class="row mt-5">
                <div class="col-md-10 mx-auto">
                    <h3 class="text-center">Your Claim History</h3>
                    <table class="table table-striped table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Policy Number</th>
                                <th>Description</th>
                                <th>Date Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT policy_number, description, claim_date FROM claims WHERE user_id = ?";
                            if ($stmt = $conn->prepare($sql)) {
                                $stmt->bind_param("i", $_SESSION['user']['id']);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['policy_number']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['claim_date']) . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3' class='text-center'>No claims found.</td></tr>";
                                }

                                $stmt->close();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>