<?php
if(isset($_GET['query'])){
    $conn = new mysqli("localhost", "root", "", "vulnerable_db");
    $query = $_GET['query'];
    
    // Vulnerabilidad SQLi en búsqueda
    $result = $conn->query("SELECT * FROM products WHERE name LIKE '%$query%'");
}
?>

<!DOCTYPE html>
<html>
<head>
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
    <title>Búsqueda Vulnerable</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="search-page">
        <h2>Buscar Productos</h2>
        <form method="GET">
            <input type="text" name="query" placeholder="Buscar..." required>
            <button type="submit">Buscar</button>
        </form>
        
        <?php if(isset($result)): ?>
        <div class="search-results">
            <h3>Resultados para: <?= $_GET['query'] ?></h3> <!-- XSS reflejado aquí -->
            
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="product">
                <h4><?= $row['name'] ?></h4>
                <p><?= $row['description'] ?></p>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>