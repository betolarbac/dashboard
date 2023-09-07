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

      <div class="main">
        <?php if ($result->num_rows > 0) : ?>
          <div class="card__container">
            <?php while ($row = $result->fetch_assoc()) : ?>
              <div class="card">
                <div class="card__wrapper">
                  <div class="card__tags">
                    <span>dev</span>
                    <span>mercado</span>
                  </div>

                  <h2 class="card__title"><?php echo $row['name']; ?></h2>
                  <p class="card__paragraph"><?php echo $row['description']; ?></p>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        <?php else : ?>
          <p>Nenhuma tarefa encontrada.</p>
        <?php endif; ?>
      </div>


      <a href="logout.php">Sair</a>
    </div>
  </div>
</body>

</html>