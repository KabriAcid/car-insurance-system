<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Car Insurance System</title>
    <!-- favicon -->
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <style>
        .pagination-text {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <main class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="col-lg-9">
                        <div class="text-center">
                            <?php
                            if (isset($_SESSION['message'])) {
                                echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
                                unset($_SESSION['message']);
                            } ?>
                        </div>
                        <form class="shadow-lg p-4 rounded-3" method="post" action="process.php">
                            <!-- Personal Information -->
                            <div id="registration-form">
                                <div class="card p-3 mb-3 shadow-md border-0 bg-light">
                                    <div class="">
                                        <h5>Personal Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <input type="text" name="first_name" placeholder="First Name" class="input-field form-control" required>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <input type="text" name="last_name" placeholder="Last Name" class="input-field form-control" required>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <input type="date" name="date_of_birth" placeholder="Date of Birth" class="input-field form-control" required>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <input type="text" name="address" placeholder="Address" class="input-field form-control" required>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <input type="email" name="email" placeholder="Email" class="input-field form-control" required>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <input type="tel" name="phone_number" placeholder="Phone Number" class="input-field form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Vehicle Information -->
                                <div class="card p-3 mb-3 shadow-md border-0 bg-light">
                                    <div class="">
                                        <h5>Vehicle Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <input type="text" name="make" placeholder="Make" class="input-field form-control" required>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <input type="text" name="model" placeholder="Model" class="input-field form-control" required>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <input type="text" name="year_of_manufacture" placeholder="Year of Manufacture" class="input-field form-control" required>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <input type="text" name="vin" placeholder="Vehicle Identification Number (VIN)" class="input-field form-control" required>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <input type="text" name="license_plate_number" placeholder="License Plate Number" class="input-field form-control" required>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <input type="number" name="current_mileage" placeholder="Current Mileage" class="input-field form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Driving Information -->
                                <div class="card p-3 mb-3 shadow-md border-0 bg-light">
                                    <div class="">
                                        <h5>Driving Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <input type="text" name="drivers_license_number" placeholder="Driver's License Number" class="input-field form-control" required>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <input type="text" name="driving_experience" placeholder="Driving Experience (Years)" class="input-field form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="d-flex justify-content-between">
                                    <button type="button" id="back-button" class="btn btn-secondary d-none">Back</button>
                                    <button type="button" id="next-button" class="btn btn-primary">Next</button>
                                </div>
                            </div>

                            <!-- Password Form -->
                            <div id="password-form" class="p-4 d-none">
                                <div class="card mb-3 border-0 bg-light">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <input type="password" name="password" placeholder="Password" class="input-field form-control" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <input type="password" name="confirm_password" placeholder="Confirm Password" class="input-field form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-center mt-3">Already have an account? <a href="../public/index.php">Log in</a></p>
                                </div>
                                <!-- Navigation Buttons -->
                                <div class="d-flex justify-content-between">
                                    <button type="button" id="back-button-pwd" class="btn btn-secondary">Back</button>
                                    <button type="submit" name="register" class="btn-submit text-light">Submit</button>
                                </div>
                            </div>
                        </form>


                        <!-- Pagination Text -->
                        <div id="pagination-text" class="pagination-text">
                            <h6 style="font-weight: 700;">1/2</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap js -->
    <script>
        const totalSteps = 2;
        let currentStep = 1;

        function updatePaginationText() {
            document.getElementById('pagination-text').textContent = currentStep + '/' + totalSteps;
        }

        document.getElementById('next-button').addEventListener('click', function() {
            if (currentStep === 1) {
                document.getElementById('registration-form').classList.add('d-none');
                document.getElementById('password-form').classList.remove('d-none');
                document.getElementById('back-button').classList.add('d-none');
                currentStep++;
                updatePaginationText();
            }
        });

        document.getElementById('back-button').addEventListener('click', function() {
            if (currentStep === 2) {
                document.getElementById('password-form').classList.add('d-none');
                document.getElementById('registration-form').classList.remove('d-none');
                document.getElementById('back-button').classList.add('d-none');
                currentStep--;
                updatePaginationText();
            }
        });

        document.getElementById('back-button-pwd').addEventListener('click', function() {
            if (currentStep === 2) {
                document.getElementById('password-form').classList.add('d-none');
                document.getElementById('registration-form').classList.remove('d-none');
                currentStep--;
                updatePaginationText();
            }
        });

        updatePaginationText();
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>