<?php
if(isset($_POST['submit'])){
    $conn = new mysqli("localhost", "root", "", "vulnerable_db");
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Vulnerabilidad: Contraseñas en texto plano
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    
    if($conn->query($query)){
        $success = "Usuario registrado correctamente!";
    } else {
        $error = "Error al registrar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro Vulnerable</title>
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
    <div class="register-form">
        <h2>Registro de Usuario</h2>
        <?php 
        if(isset($success)) echo "<p class='success'>$success</p>";
        if(isset($error)) echo "<p class='error'>$error</p>";
        ?>
        
        <form method="POST">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" name="submit">Registrarse</button>
        </form>
        
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
</body>
</html>