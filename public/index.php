<?php
session_start();
require '../config/config.php';

// Sanitize and validate input
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['login'])) {
    $email = sanitize_input($_POST["email"]);
    $password = sanitize_input($_POST["password"]);

    // Check if the user exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Password is correct, start a session
                $_SESSION['user'] = $user; // Store user details in session
                $_SESSION['message'] = "Login successful!";
                header("Location: ../pages/dashboard.php");
                exit();
            } else {
                // Password is incorrect
                $_SESSION['message'] = "Invalid email or password.";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        } else {
            // No user found with that email
            $_SESSION['message'] = "Invalid email.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    } else {
        // SQL statement preparation failed
        $_SESSION['message'] = "Database error: " . $conn->error;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Insurance System</title>
    <!-- favicon -->
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <main class="container-fluid py-5">
        <div class="container p-5">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="text-center">
                            <?php
                            if (isset($_SESSION['message'])) {
                                echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
                                unset($_SESSION['message']);
                            } ?>
                        </div>
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" class="shadow-lg p-4 rounded-3" method="post">
                            <div class="mb-5">
                                <h2 class="text-center header">Log in with your details</h2>
                                <p class="text-center text-sm gray-800">Enter your appropriate details</p>
                            </div>
                            <div class="mb-3">
                                <input type="email" placeholder="Email" class="form-control input-field" name="email" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" placeholder="Password" class="form-control input-field" name="password" required>
                            </div>
                            <button type="submit" name="login" class="btn-submit text-white w-100">Log in</button>
                            <p class="text-center mt-3">Don't have an account? <a href="../scripts/register.php">Register</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <p class="text-center text-sm gray-800">Car Insurance System &copy; 2025 <a href="../pages/queries.php">Execute!</a></p>
        </div>
    </main>


    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>