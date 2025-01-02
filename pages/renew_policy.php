<?php
session_start();
require '../config/config.php';

// Ensure the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

// Fetch user information
$user_id = $_SESSION['user']['id'];
$sql = "SELECT * FROM policies WHERE user_id = ?"; // Assuming there's a relation between policies and users
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the user's policy details
if ($result->num_rows > 0) {
    $policy = $result->fetch_assoc();
} else {
    $_SESSION['message'] = "No policies found for your account.";
    header("Location: dashboard.php");
    exit();
}

// Renew policy logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $renew_date = date("Y-m-d", strtotime('+1 year'));  // Renew the policy for one more year

    // Update the policy with the new renewal date
    $update_sql = "UPDATE policies SET renewal_date = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $renew_date, $policy['id']);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Policy renewed successfully!";
    } else {
        $_SESSION['message'] = "Error renewing policy: " . $stmt->error;
    }

    header("Location: renew_policy.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renew Policy</title>
    <!-- favicon -->
    <link rel="icon" href="../public/favicon.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>

<body>
<?php
include '../includes/sidebar.php';

?>
    <main class="container-fluid py-5 bg-light">
        <div class="container p-5">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="header">Renew Your Policy</h2>

                    <?php
                    if (isset($_SESSION['message'])) {
                        echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
                        unset($_SESSION['message']);
                    }
                    ?>

                    <form method="POST" action="renew_policy.php">
                        <div class="mb-3">
                            <label for="policy_name" class="form-label">Policy Name</label>
                            <input type="text" class="form-control" id="policy_name" name="policy_name" value="<?= htmlspecialchars($policy['name']) ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="policy_premium" class="form-label">Policy Premium</label>
                            <input type="text" class="form-control" id="policy_premium" name="policy_premium" value="$<?= htmlspecialchars($policy['premium']) ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="renewal_date" class="form-label">Current Renewal Date</label>
                            <input type="text" class="form-control" id="renewal_date" name="renewal_date" value="<?= htmlspecialchars($policy['renewal_date']) ?>" disabled>
                        </div>

                        <button type="submit" class="btn btn-primary">Renew Policy</button>
                    </form>

                </div>
            </div>
        </div>
    </main>
    <?php
include '../includes/footer.php';
?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
