<?php
// Iniciar sesión si no está iniciada
session_start();

// Establecer conexión fuera del if para que esté disponible en todo el script
$conn = new mysqli("localhost", "root", "", "vulnerable_db");

// Verificar errores de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Vulnerabilidad XSS almacenado
if(isset($_POST['comment'])){
    $comment = $_POST['comment'];
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : 'Anónimo';
    
    // No sanitización intencional
    $query = "INSERT INTO comments (user, comment) VALUES ('$user', '$comment')";
    $conn->query($query);
}

$comments = $conn->query("SELECT * FROM comments ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
     <header>
        <h1>Tacos Tommy's</h1>
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
<head>
    <title>Comentarios Vulnerables</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="comments-section">
        <h2>Deja tu comentario</h2>
        
        <form method="POST">
            <textarea name="comment" placeholder="Escribe tu comentario..." required></textarea>
            <button type="submit">Publicar</button>
        </form>
        
        <div class="comments-list">
            <h3>Comentarios recientes</h3>
            <?php 
            if ($comments && $comments->num_rows > 0): 
                while($row = $comments->fetch_assoc()): ?>
                    <div class="comment">
                        <strong><?= htmlspecialchars($row['user']) ?></strong>
                        <p><?= $row['comment'] ?></p> <script> alert("XSS en proceso") </script> 
                    </div>
                <?php endwhile; 
            else: ?>
                <p>No hay comentarios aún.</p>
            <?php endif; ?>
        </div>
    </div>
                <script>
        fetch("comments.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "comment=%3Cscript%3Ealert('XSS%20en%20comentarios!')%3C%2Fscript%3E"
        });
    </script>
</body>
</html>