<?php
session_start();
require_once './includes/db.php';

if ($_SESSION['type'] !== 'admin') {
  header("Location: dashboard.php");
  exit();
}

if (isset($_GET['id'])) {
  $task_id = $_GET['id'];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_status = $_POST['new_status'];

    $sql = "UPDATE task SET status = '$new_status' WHERE id = '$task_id'";
    if ($conn->query($sql) === TRUE) {
      $_SESSION['edit_status_message'] = "Status da tarefa atualizado com sucesso!";
    } else {
      $_SESSION['edit_status_message'] = "Erro ao atualizar status da tarefa: " . $conn->error;
    }

    header("Location: view_tasks.php");
    exit();
  }

  $sql = "SELECT * FROM task WHERE id = '$task_id'";
  $result = $conn->query($sql);
  $task_data = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Editar Status da Tarefa</title>
  <link rel="stylesheet" type="text/css" href="./styles/style.css">
</head>

<body>
  <div class="register">
    <h2>Editar Status da Tarefa</h2>
    <?php if (isset($_SESSION['edit_status_message'])) : ?>
      <p><?php echo $_SESSION['edit_status_message']; ?></p>
      <?php unset($_SESSION['edit_status_message']); ?>
    <?php endif; ?>
    <div class="form">
      <form method="post">
        <label for="new_status">Novo Status:</label>
        <select id="new_status" name="new_status">
          <option value="Em_Progesso" <?php if ($task_data['status'] === 'Em_Progesso') echo 'selected'; ?>>
            Em Progesso</option>
          <option value="Concluída" <?php if ($task_data['status'] === 'Concluída') echo 'selected'; ?>>
            Concluída
          </option>
        </select>
        <input type="submit" value="Salvar Alterações">
      </form>
    </div>
    <a href="view_tasks.php">Voltar à Lista de Tarefas</a>
  </div>
</body>

</html>