<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$type = $_SESSION['type'];
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
        <a href="logout.php">Sair</a>
    </div>
</body>

</html>