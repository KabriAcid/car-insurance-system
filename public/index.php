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
                    <div class="col-9 col-md-8 col-lg-6">
                        <form action="/scripts/process.php" class="shadow-lg p-4" method="post">
                            <h2 class="text-center mb-5 header">Log in with your details</h2>
                            <div class="mb-3">
                                <input type="email" placeholder="Email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" placeholder="Password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn-submit text-white w-100">Log in</button>
                            <p class="text-center mt-3">Don't have an account? <a href="/scripts/register.php">Register</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>