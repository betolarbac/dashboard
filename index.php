<?php
session_start();
require_once 'includes/db.php';

$error = "";

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['type'] = $row['type'];
            header("Location: dashboard.php");
        } else {
            $error = "Senha incorreta!";
        }
    } else {
        $error = "Usuário não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
</head>

<body>
    <div class="login">
        <h2>Login</h2>
        <div class="form">
            <form method="post" action="">
                <input type="text" name="username" placeholder="Nome de usuário" required><br>
                <input type="password" name="password" placeholder="Senha" required><br>
                <span style="color: red; margin-bottom: 10px"><?php echo $error; ?><br></span>
                <input type="submit" name="login" value="Entrar">
            </form>
        </div>
    </div>
</body>

</html>