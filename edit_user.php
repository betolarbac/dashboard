<?php
session_start();
include('./includes/db.php');

if ($_SESSION['type'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_username = mysqli_real_escape_string($conn, $_POST['new_username']);
        $new_type = $_POST['new_type'];

        $sql = "UPDATE users SET username = '$new_username', type = '$new_type' WHERE id = '$user_id'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['edit_message'] = "Usuário editado com sucesso!";
        } else {
            $_SESSION['edit_message'] = "Erro ao editar usuário: " . $conn->error;
        }

        header("Location: view_users.php");
        exit();
    }

    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    $result = $conn->query($sql);
    $user_data = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Editar Usuário</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
</head>

<body>
    <div class="edit">
        <h2>Editar Usuário</h2>
        <?php if (isset($_SESSION['edit_message'])) : ?>
        <p><?php echo $_SESSION['edit_message']; ?></p>
        <?php unset($_SESSION['edit_message']); ?>
        <?php endif; ?>
        <div class="form">
            <form method="post">
                <label for="new_username">Novo Nome de Usuário:</label>
                <input type="text" id="new_username" name="new_username" value="<?php echo $user_data['username']; ?>"
                    required>
                <label for="new_type">Novo Tipo:</label>
                <select id="new_type" name="new_type">
                    <option value="user" <?php if ($user_data['type'] === 'user') echo 'selected'; ?>>Usuário</option>
                    <option value="admin" <?php if ($user_data['type'] === 'admin') echo 'selected'; ?>>Administrador
                    </option>
                </select>
                <input type="submit" value="Salvar Alterações">
            </form>
        </div>
        <a href="view_users.php">Voltar à Lista de Usuários</a>
    </div>
</body>

</html>