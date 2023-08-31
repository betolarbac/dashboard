<?php
session_start();
require_once 'includes/db.php'; // Adicione a configuração da conexão com o banco de dados aqui

if ($_SESSION['type'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Visualizar Usuários</title>
</head>

<body>
    <h2>Lista de Usuários</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome de Usuário</th>
            <th>Tipo</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['type']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="dashboard.php">Voltar ao Painel de Controle</a>
</body>

</html>