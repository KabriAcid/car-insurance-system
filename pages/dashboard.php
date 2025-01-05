<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- favicon -->
    <link rel="icon" href="../public/favicon.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>

<body>
    <?php include '../includes/sidebar.php'; ?>
    <main class="container-fluid py-5 bg-light">
        <div class="container p-5">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="text-center mb-4">
                            <h2 class="header">Welcome <?php echo $_SESSION['user']['first_name']; ?>.</h2>
                            <p class="text-sm text-muted">Here is where you manage your car insurance system.</p>
                        </div>
                        <?php
                        if (isset($_SESSION['message'])) {
                            echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
                            unset($_SESSION['message']);
                        }
                        ?>
                        <!-- <div class="shadow-lg p-4 rounded-3 bg-white">
                            <h3 class="text-center mb-3">User Actions</h3>
                            <ul class="list-group">
                                <li class="list-group-item"><a href="../pages/policies.php">View Policies</a></li>
                                <li class="list-group-item"><a href="../pages/claims.php">Manage Claims</a></li>
                                <li class="list-group-item"><a href="../pages/policy_applications.php">Policy Application</a></li>
                                <li class="list-group-item"><a href="../pages/profile.php">Update Profile</a></li>
                                <li class="list-group-item"><a href="#">Contact Support</a></li>
                            </ul>
                        </div> -->
                        <div class="text-center mt-4">
                            <a href="../scripts/logout.php" class="btn btn-danger">Log Out</a>
                        </div>
                    </div>
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