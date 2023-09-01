<?php
session_start();
require_once 'includes/db.php'; // Adicione a configuração da conexão com o banco de dados aqui

if ($_SESSION['type'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_name = mysqli_real_escape_string($conn, $_POST['task_name']);
    $task_description = mysqli_real_escape_string($conn, $_POST['task_description']);
    $task_status = $_POST['task_status'];
    $assigned_user_id = $_POST['assigned_user_id'];

    $sql = "INSERT INTO task (name, description, status, assigned_user_id) VALUES ('$task_name', '$task_description', '$task_status', '$assigned_user_id')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['create_task_message'] = "Tarefa criada com sucesso!";
    } else {
        $_SESSION['create_task_message'] = "Erro ao criar tarefa: " . $conn->error;
    }

    header("Location: view_tasks.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Criar Tarefa</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
</head>

<body>
    <div class="register">
        <h2>Criar Nova Tarefa</h2>
        <?php if (isset($_SESSION['create_task_message'])) : ?>
            <p><?php echo $_SESSION['create_task_message']; ?></p>
            <?php unset($_SESSION['create_task_message']); ?>
        <?php endif; ?>
        <div class="form">
            <form method="post">
                <label for="task_name">Nome da Tarefa:</label>
                <input type="text" id="task_name" name="task_name" required>
                <label for="task_description">Descrição da Tarefa:</label>
                <textarea id="task_description" name="task_description" rows="8" cols="47" required></textarea>
                <label for="assigned_user_id">Usuário Associado:</label>
                <select id="assigned_user_id" name="assigned_user_id">
                    <option value="">Nenhum</option>
                    <?php
                    $user_query = "SELECT * FROM users";
                    $user_result = $conn->query($user_query);
                    while ($user_row = $user_result->fetch_assoc()) {
                        echo "<option value='" . $user_row['id'] . "'>" . $user_row['username'] . "</option>";
                    }
                    ?>
                </select>
                <label for="task_status">Status da Tarefa:</label>
                <select id="task_status" name="task_status">
                    <option value="Em_Progesso">Em Progresso</option>
                    <option value="Concluída">Concluída</option>
                </select>
                <input type="submit" value="Criar Tarefa">
            </form>
        </div>
        <a href="view_tasks.php">Voltar à Lista de Tarefas</a>
    </div>

</body>

</html>