<?php
if(isset($_POST['host'])){
    $host = $_POST['host'];
    $output = shell_exec("ping -n 4 " . $host . " 2>&1"); 
}
?>


<!DOCTYPE html>
  <header>
        <h1>Bienvenido a la pagina web de Tacos Tommy's</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="login.php">Login</a>
            <a href="register.php">Registro</a>
            <a href="comments.php">Comentarios</a>
            <a href="search.php">Buscar</a>
            <a href="ping.php">Herramienta de Red</a>
            <a href="dashboard.php">Administrar usuario</a>
        </nav>
    </header>
<html lang="en">
    <head>
        <title>Heramienta de red</title>
        <link rel="stylesheet" href="css/style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="ping-tool">
    <h2>Herramienta de Ping</h2>
    <p>Introduce una dirección IP o hostname para hacer ping</p>
    <p>Ejemplos: 
        <code>8.8.8.8</code>, 
        <code>google.com</code>, 
        <code>127.0.0.1; ls -la</code>
    </p>
    
    <form method="POST">
        <input type="text" name="host" placeholder="ej. 8.8.8.8" required>
        <button type="submit">Ejecutar Ping</button>
    </form>
    
    <?php if(isset($output)): ?>
    <div class="ping-results">
        <h3>Resultados:</h3>
        <pre><?= htmlspecialchars($output) ?></pre>
    </div>
    <?php endif; ?>
</div>
    </body>
</html>>
