<?php

$type = $_SESSION['type'];

include './includes/svg.php'

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="./styles/navbar.css">
  <title>Document</title>
</head>

<body>
  <div class="navbar">

    <div class="navbar__logo">
      <img src="" alt="">
      <h2>DashClient</h2>
    </div>

    <?php if ($type === 'admin') : ?>
    <div class="navbar__create">
      <a href=""><img src="./assets/imgs/add-projetct.svg" alt="">Criar novo projeto</a>
    </div>
    <?php endif; ?>

    <ul class="navbar__list ">
      <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/Login/dashboard.php") ? "active" : ""; ?>">
        <?php svgDashboard() ?>
        <a href="dashboard.php">Dashboard</a>
      </li>

      <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/Login/project.php") ? "active" : ""; ?>">
        <?php svgProject() ?>
        <a href="">Projetos</a>
      </li>

      <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/Login/view_tasks.php") ? "active" : ""; ?>">
        <?php svgTask() ?>
        <a href="view_tasks.php">Task</a>
      </li>

      <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/Login/view_users.php") ? "active" : ""; ?>">
        <?php svgUser() ?>
        <a href="view_users.php">Usuários</a>
      </li>

      <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/Login/register.php") ? "active" : ""; ?>">
        <?php svgUser() ?>
        <a href="register.php">Criar novo cliente</a>
      </li>
    </ul>
  </div>
</body>

</html>