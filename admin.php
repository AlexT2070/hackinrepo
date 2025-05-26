<?php
// Sin verificación de sesión o roles
$conn = new mysqli("localhost", "root", "", "vulnerable_db");

// Vulnerabilidad: SQL Injection en filtros
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$query = "SELECT * FROM users " . ($filter ? "WHERE $filter" : "");
$users = $conn->query($query);

// Ejemplo de explotación: 
// admin.php?filter=1=1 UNION SELECT 1,table_name,3,4 FROM information_schema.tables
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel de Administración Inseguro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="admin-panel">
        <h2>Panel de Administración (Inseguro)</h2>
        
        <!-- Filtro vulnerable a SQLi -->
        <form method="GET">
            <input type="text" name="filter" placeholder="Filtro SQL (ej. username='admin')">
            <button type="submit">Filtrar</button>
        </form>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Contraseña (texto plano)</th>
            </tr>
            <?php while($row = $users->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['password'] ?></td> <!-- Exposición de contraseñas -->
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>