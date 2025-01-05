<?php
session_start();
require '../config/config.php';

// Ensure the user is logged in before accessing the page
if (!isset($_SESSION['user'])) {
    $_SESSION['message'] = "You must log in to renew a policy.";
    header("Location: ../login.php");
    exit();
}

// Fetch the current user’s policies from the database
$user_id = $_SESSION['user']['id'];  // Get user ID from session
$sql = "SELECT * FROM policies WHERE id= ?";  // Ensure 'user_id' exists in the table
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$policies = $stmt->get_result();
$stmt->close();

// Handle policy renewal on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $policy_id = intval($_POST['policy_id']);
    $renew_date = date("Y-m-d", strtotime('+1 year'));  // Renew the policy for one more year

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
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (you can include your sidebar here) -->
            <?php include '../includes/sidebar.php'; ?>

            <!-- Main Content -->
            <div class="col-md-9 ms-sm-auto col-lg-10 px-4 py-5">
                <h2 class="mb-4 text-center">Renew Policy</h2>
                
                <!-- Display Session Message -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
