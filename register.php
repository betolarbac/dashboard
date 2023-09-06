<?php

require_once 'includes/db.php';
session_start();

$msg = "";

if ($_SESSION['type'] !== 'admin') {
    header("Location: dashboard.php"); // Redirecionar para a página de dashboard
    exit();
}

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']); // Validação e limpeza de entrada
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $type = $_POST['type'];

    if ($_SESSION['type'] === 'admin') { // Verificação se o usuário é um administrador
        $sql = "INSERT INTO users (username, password, type) VALUES ('$username', '$password', '$type')";
        if ($conn->query($sql) === TRUE) {
            $msg = "Registro bem-sucedido!";
        } else {
            echo "Erro no registro: " . $conn->error;
        }
    } else {
        echo "Somente administradores podem registrar novos usuários.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Registro</title>
  <link rel="stylesheet" type="text/css" href="./styles/style.css">
</head>

<body>


  <div class="flex">
    <?php include "./navbar.php" ?>
    <div class="register">
      <h2>Registro</h2>
      <?php $msg; ?>
      <div class="form">
        <form method="post" action="register.php">
          <input type="text" name="username" placeholder="Nome de usuário" required><br>
          <input type="password" name="password" placeholder="Senha" required><br>
          <select name="type">
            <option value="user">Usuário</option>
            <option value="admin">Administrador</option>
          </select>
          <input type="submit" name="register" value="Registrar">
        </form>
      </div>
    </div>

  </div>
</body>

</html>