<?php
require '../config.php';
require '../config.php';


$sql = "CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    transaction_id VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    currency VARCHAR(10) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    status VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";

if ($conn->query($sql)) {
?>
    <script>
        alert('Database Modified Successfully')
    </script>
<?php
} else {
?>
    <script>
        alert('Duplicate Operation: Already exists!')
    </script>
<?php
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
