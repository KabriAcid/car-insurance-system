<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <div class="container">
        <div class="text-center">
            <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']);
            } ?>
        </div>
    </div>
</body>

</html>