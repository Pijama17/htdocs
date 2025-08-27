<?php
// includes/db_connect.php
$host = 'localhost';
$db   = 'gymtiger';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
    
    function getDBConnection() {
        global $conn;
        return $conn; 
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage()); 
}
?>