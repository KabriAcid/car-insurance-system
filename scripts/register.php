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
</head>

<body>
    <main class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="col-md-8 col-lg-9">
                        <form action="/scripts/process.php" class="shadow-lg p-4 rounded-3" method="post">
                            <!-- Personal Information -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="first_name" placeholder="First Name" class="input-field form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="last_name" placeholder="Last Name" class="input-field form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="date" name="date_of_birth" placeholder="Date of Birth" class="input-field form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="address" placeholder="Address" class="input-field form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="email" name="email" placeholder="Email" class="input-field form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="tel" name="phone_number" placeholder="Phone Number" class="input-field form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Vehicle Information -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="make" placeholder="Make" class="input-field form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="model" placeholder="Model" class="input-field form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="year_of_manufacture" placeholder="Year of Manufacture" class="input-field form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="vin" placeholder="Vehicle Identification Number (VIN)" class="input-field form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="license_plate_number" placeholder="License Plate Number" class="input-field form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="number" name="current_mileage" placeholder="Current Mileage" class="input-field form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Driving Information -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="drivers_license_number" placeholder="Driver's License Number" class="input-field form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="driving_experience" placeholder="Driving Experience (Years)" class="input-field form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn-submit text-white w-100">Register</button>
                            </div>
                            <p class="text-center mt-3">Already have an account? <a href="../public/index.php">Login</a></p>
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