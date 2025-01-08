<?php
session_start();
require '../config.php';

// Fetch current user details from the session
if (!isset($_SESSION['user'])) {
    header("Location: logout.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
$sql = "SELECT first_name, last_name, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    $_SESSION['message'] = "User not found.";
    header("Location: dashboard.php");
    exit();
}

// Update profile logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Check if password is not empty, then hash it
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $update_sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssssi", $first_name, $last_name, $email, $password, $user_id);
    } else {
        // Only update name and email if password is not provided
        $update_sql = "UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("sssi", $first_name, $last_name, $email, $user_id);
    }

    if ($stmt->execute()) {
        $_SESSION['user']['first_name'] = $first_name;
        $_SESSION['user']['last_name'] = $last_name;
        $_SESSION['user']['email'] = $email;
        $_SESSION['message'] = "Profile updated successfully!";
    } else {
        $_SESSION['message'] = "Error updating profile: " . $stmt->error;
    }

    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- favicon -->
    <link rel="icon" href="../public/favicon.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <style>
        /* Ensure the footer stays at the bottom */
        body {
            margin-left: 250px;
            /* Adjust this value according to the sidebar width */
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
                    <h2 class="header">User Profile</h2>

                    <?php
                    if (isset($_SESSION['message'])) {
                        echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
                        unset($_SESSION['message']);
                    }
                    ?>

                    <form method="POST" action="profile.php">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password (Leave empty to keep current password)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Profile</button>
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