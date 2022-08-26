<?php
// Set up the database connection
$dsn = 'mysql:host=localhost;dbname=shopfigure';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    exit();
}
?>