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
    <link rel="stylesheet" type="text/css" href="./styles/dashboard.css">
</head>

<body>
    <div class="flex">
        <?php include "./navbar.php" ?>
        <div class="dash">
            <div class="header">
                <h2 class="header__title">Dashboard</h2>

                <div class="header__info">
                    <img src="./assets/imgs/user-perfil.webp" alt="">
                    <div>
                        <h3><?php echo $username; ?></h3>
                        <h4><?php echo $type ?></h4>
                    </div>
                </div>
            </div>


            <p>Esta é a página do seu painel de controle.</p>

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
    </div>
</body>

</html>