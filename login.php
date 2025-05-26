<?php
session_start();
if(isset($_POST['submit'])){
    $conn = new mysqli("localhost", "root", "", "vulnerable_db");
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
   
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);
    
    if($result->num_rows > 0){
        $_SESSION['user'] = $username;
        header("Location: index.php");
    } else {
        $error = "Credenciales inválidas!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Vulnerable</title>
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
    <div class="login-form">
        <h2>Iniciar Sesión</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        
        <form method="POST">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="text" name="password" placeholder="Contraseña" required>
            <button type="submit" name="submit">Login</button>
        </form>
        
        <p>¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
    </div>
</body>
</html>