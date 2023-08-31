<?php

require_once 'includes/db.php';
session_start();

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']); // Validação e limpeza de entrada
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $type = $_POST['type'];

    if ($_SESSION['type'] === 'admin') { // Verificação se o usuário é um administrador
        $sql = "INSERT INTO users (username, password, type) VALUES ('$username', '$password', '$type')";
        if ($conn->query($sql) === TRUE) {
            echo "Registro bem-sucedido!";
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
</head>

<body>
    <h2>Registro</h2>
    <form method="post" action="register.php">
        <input type="text" name="username" placeholder="Nome de usuário" required><br>
        <input type="password" name="password" placeholder="Senha" required><br>
        <select name="type">
            <option value="user">Usuário</option>
            <option value="admin">Administrador</option>
        </select>
        <input type="submit" name="register" value="Registrar">
    </form>
</body>

</html>