

<?php

$db_host = "localhost";
$db_name = "logindb";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

return $conn;
?>
