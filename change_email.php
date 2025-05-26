<?php
session_start();

// Sin protección CSRF
if(isset($_POST['new_email']) && isset($_SESSION['user'])){
    $conn = new mysqli("localhost", "root", "", "vulnerable_db");
    $new_email = $_POST['new_email'];
    $username = $_SESSION['user'];
    
    // Vulnerabilidad CSRF + SQLi
    $conn->query("UPDATE users SET email = '$new_email' WHERE username = '$username'");
    $success = "Email actualizado correctamente!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cambiar Email</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="email-form">
        <h2>Cambiar Email</h2>
        <?php if(isset($success)) echo "<p class='success'>$success</p>"; ?>
        
        <!-- Formulario sin token CSRF -->
        <form method="POST">
            <input type="email" name="new_email" placeholder="Nuevo email" required>
            <button type="submit">Cambiar Email</button>
        </form>
    </div>
</body>
</html>