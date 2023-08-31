<?php
session_start();
require_once 'includes/db.php';

if ($_SESSION['type'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

if (isset($_SESSION['delete_message'])) {
    echo "<p>" . $_SESSION['delete_message'] . "</p>";
    unset($_SESSION['delete_message']);
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
            <td><a href="delete_user.php?id=<?php echo $row['id']; ?>"
                    onclick="return confirm('Tem certeza de que deseja excluir este usuário?')">Excluir</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="dashboard.php">Voltar ao Painel de Controle</a>
</body>

</html>