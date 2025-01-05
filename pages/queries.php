<?php
require '../config/config.php';

$sql = "ALTER TABLE users ADD COLUMN role ENUM('user', 'admin') DEFAULT 'user',
INSERT INTO users (name, email, password, role) 
VALUES ('Admin User', 'admin123@gmail.com', MD5('password123'), 'admin');

";

if ($conn->query($sql)) {
?>
    <script>
        alert('Database Modified Successfully')
    </script>
<?php
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
