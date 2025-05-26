<?php
session_start();

// Endpoint vulnerable a fuerza bruta
if(isset($_GET['username']) && isset($_GET['password'])){
    $conn = new mysqli("localhost", "root", "", "vulnerable_db");
    
    $username = $_GET['username'];
    $password = $_GET['password'];
    
    // Consulta vulnerable
    $result = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if($result->num_rows > 0){
        echo "SUCCESS";
    } else {
        echo "FAILURE";
    }
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login API Vulnerable</title>
</head>
<body>
    <h2>Endpoint vulnerable a fuerza bruta</h2>
    <p>Ejemplo de uso: brute_force_vulnerable.php?username=admin&password=123</p>
</body>
</html>