<?php
session_start();
require '../config/config.php';

// Fetch the purchase policy from the database
$sql = "SELECT * FROM purchase_policy ORDER BY created_at DESC LIMIT 1"; // Only fetching the latest policy
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $policy = $result->fetch_assoc();
} else {
    $policy = null;
    $_SESSION['message'] = "No purchase policy found.";
}

// Display a message if there's a session message
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Policy</title>
    <!-- favicon -->
    <link rel="icon" href="../public/favicon.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <style>
        /* Ensure the footer stays at the bottom */
        body {
            margin-left: 250px; /* Adjust this value according to the sidebar width */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        /* Additional styles for content */
        .container-fluid {
            padding-left: 20px;
        }

        .header {
            font-size: 2rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
<?php
include '../includes/sidebar.php';
?>
    <main class="container-fluid py-5 bg-light">
        <div class="container p-5">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="header">Purchase Policy</h2>

                    <?php if ($policy): ?>
                        <h4 class="my-4"><?= htmlspecialchars($policy['title']) ?></h4>
                        <p><?= nl2br(htmlspecialchars($policy['content'])) ?></p>
                    <?php else: ?>
                        <p>No purchase policy available at the moment.</p>
                    <?php endif; ?>
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
