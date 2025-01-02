<?php
require '../config/config.php';

$sql = "CREATE TABLE purchase(
    id INT AUTO_INCREMENT PRIMARY KEY
)";

if ($conn->query($sql)) {
?>
    <script>
        alert('Database Modified Successfully')
    </script>
<?php
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
