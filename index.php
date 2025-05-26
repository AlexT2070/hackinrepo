<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema Vulnerable - Inicio</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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

    <main>
        <section>
            <h2>Últimas Noticias</h2>
            <div id="news">
                <!-- Vulnerabilidad XSS almacenado aquí -->
                <?php include 'includes/get_news.php'; ?>
            </div>
        </section>
    </main>

</body>
</html>