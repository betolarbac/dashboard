<?php
session_start();
require_once './includes/db.php';

$msg = "";

if ($_SESSION['type'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

function getUserName($user_id)
{
    global $conn;
    $user_query = "SELECT username FROM users WHERE id = '$user_id'";
    $user_result = $conn->query($user_query);
    $user_row = $user_result->fetch_assoc();
    return $user_row['username'];
}

if (isset($_GET['filter_client']) && !empty($_GET['filter_client'])) {
    $filter_client_id = $_GET['filter_client'];
    $filter_sql = "WHERE assigned_user_id = '$filter_client_id'";
} else {
    $filter_sql = "";
}


$sql = "SELECT * FROM task $filter_sql";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Visualizar Tasks</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
</head>

<body>
    <div class="users">
        <h2>Lista de Tasks</h2>
        <form method="get">
            <label for="filter_client">Filtrar por Cliente:</label>
            <select id="filter_client" name="filter_client">
                <option value="">Todos</option>
                <?php
                $client_query = "SELECT DISTINCT assigned_user_id FROM task";
                $client_result = $conn->query($client_query);
                while ($client_row = $client_result->fetch_assoc()) {
                    $client_name = getUserName($client_row['assigned_user_id']);
                    echo "<option value='" . $client_row['assigned_user_id'] . "'>$client_name</option>";
                }
                ?>
            </select>
            <input type="submit" value="Filtrar">
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>task</th>
                <th>Descrição</th>
                <th>status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['assigned_user_id'] ? getUserName($row['assigned_user_id']) : 'Nenhum'; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td class="<?php echo strtolower($row['status']); ?>">
                        <?php echo str_replace("_", " ", $row['status']) ?>
                    </td>
                    <td><a href="edit_task.php?id=<?php echo $row['id']; ?>">Editar Status</a></td>

                </tr>
            <?php endwhile; ?>
        </table>
        <a href="dashboard.php">Voltar ao Painel de Controle</a>
    </div>
</body>

</html>