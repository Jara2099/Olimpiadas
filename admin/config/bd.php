<?php
$host = "localhost";
$dbname = "whitewings"; 
$usuario = "root";  
$clave = "";   
$conn = new mysqli($host, $usuario, $clave, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $clave);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

define('BASE_PATH', __DIR__ . '/../')



?>
