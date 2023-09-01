<?php
session_start();
require_once './includes/db.php';
require_once './includes/taskDb.php';

$msg = "";

if ($_SESSION['type'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}


$sql = "SELECT * FROM task";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Visualizar Usuários</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
</head>

<body>
    <div class="users">
        <h2>Lista de Usuários</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>task</th>
                <th>Descrição</th>
                <th>status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td class="<?php echo strtolower($row['status']); ?>">
                    <?php echo str_replace("_", " ", $row['status']) ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="dashboard.php">Voltar ao Painel de Controle</a>
    </div>
</body>

</html>