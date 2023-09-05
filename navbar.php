<?php

$type = $_SESSION['type'];

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
            <button><img src="./assets/imgs/add-projetct.svg" alt="">Criar novo projeto</button>
        </div>
        <?php endif; ?>

        <ul class="navbar__list ">
            <li class="active">
                <img src="./assets/imgs/dash-icon.svg" alt="">
                <a href="">Dashboard</a>
            </li>

            <li>
                <img src="./assets/imgs/project-icon.svg" alt="">
                <a href="">Projetos</a>
            </li>

            <li>
                <img src="./assets/imgs/task-icon.svg" alt="">
                <a href="view_tasks.php">Task</a>
            </li>

            <li>
                <img src="./assets/imgs/user-icon.svg" alt="">
                <a href="view_users.php">Usuários</a>
            </li>

            <li>
                <img src="./assets/imgs/user-icon.svg" alt="">
                <a href="register.php">Criar novo cliente</a>
            </li>
        </ul>
    </div>
</body>

</html>