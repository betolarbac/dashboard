<?php
session_start();
require_once 'includes/db.php';

if ($_SESSION['type'] !== 'admin') {
  header("Location: dashboard.php");
  exit();
}

if (isset($_GET['id'])) {
  $task_id = $_GET['id'];
  $sql = "DELETE FROM task WHERE id = '$task_id'";
  if ($conn->query($sql) === TRUE) {
    $_SESSION['delete_message'] = "Usuário excluído com sucesso!";
  } else {
    $_SESSION['delete_message'] = "Erro ao excluir usuário: " . $conn->error;
  }

  header("Location: view_tasks.php");
  exit();
}