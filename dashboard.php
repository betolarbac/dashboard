<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once 'includes/db.php'; // Inclua a configuração da conexão com o banco de dados aqui

$username = $_SESSION['username'];
$type = $_SESSION['type'];

// Modificação: Buscar as tarefas relacionadas ao usuário logado
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM task WHERE assigned_user_id = '$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
</head>

<body>
    <div class="dash">
        <h2>Bem-vindo, <?php echo $username; ?>!</h2>
        <p>Esta é a página do seu painel de controle.</p>
        <?php if ($type === 'admin') : ?>
        <a href="register.php">Registro</a>
        <br />
        <a href="view_users.php">Ver Usuários</a>
        <br />
        <a href="view_tasks.php">Tasks</a>
        <br />
        <a href="create_task.php">Criar Tarefa</a>
        <br />
        <?php endif; ?>

        <!-- Exibir tarefas no dashboard -->
        <h3>Suas Tarefas:</h3>
        <?php if ($result->num_rows > 0) : ?>
        <table>
            <tr>
                <th>task</th>
                <th>Descrição</th>
                <th>status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td class="<?php echo strtolower($row['status']); ?>">
                    <?php echo str_replace("_", " ", $row['status']) ?>
                </td>
                <td><a href="edit_task.php?id=<?php echo $row['id']; ?>">Editar Status</a></td>

            </tr>
            <?php endwhile; ?>
        </table>
        <?php else : ?>
        <p>Nenhuma tarefa encontrada.</p>
        <?php endif; ?>

        <a href="logout.php">Sair</a>
    </div>
</body>

</html>