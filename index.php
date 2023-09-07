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
      $_SESSION['user_id'] = $row['id']; // Correção: Definir user_id na sessão
      $_SESSION['username'] = $username;
      $_SESSION['type'] = $row['type'];
      header("Location: dashboard.php");
      exit();
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
  <link rel="stylesheet" type="text/css" href="./styles/login.css">
</head>

<body>
  <div class="login">

    <div class="login__form">
      <div class="login__inputs">
        <h2>Login</h2>
        <form method="post" action="">
          <label class="login__label" for="username">Email</label><br>
          <div class="flex login__input">
            <input type="text" name="username" placeholder="email@email.com" required>
            <span>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="Frame" clip-path="url(#clip0_6_1284)">
                  <path id="Vector" d="M3 3H21C21.2652 3 21.5196 3.10536 21.7071 3.29289C21.8946 3.48043 22 3.73478 22 4V20C22 20.2652 21.8946 20.5196 21.7071 20.7071C21.5196 20.8946 21.2652 21 21 21H3C2.73478 21 2.48043 20.8946 2.29289 20.7071C2.10536 20.5196 2 20.2652 2 20V4C2 3.73478 2.10536 3.48043 2.29289 3.29289C2.48043 3.10536 2.73478 3 3 3ZM20 7.238L12.072 14.338L4 7.216V19H20V7.238ZM4.511 5L12.061 11.662L19.502 5H4.511Z" fill="white" />
                </g>
                <defs>
                  <clipPath id="clip0_6_1284">
                    <rect width="24" height="24" fill="white" />
                  </clipPath>
                </defs>
              </svg>
            </span><br>
          </div>

          <label class="login__label" for="username">Senha</label><br>
          <div class="flex login__input">
            <input type="password" name="password" placeholder="Senha" required>
            <span>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="Frame" clip-path="url(#clip0_6_1293)">
                  <path id="Vector" d="M19 10H20C20.2652 10 20.5196 10.1054 20.7071 10.2929C20.8946 10.4804 21 10.7348 21 11V21C21 21.2652 20.8946 21.5196 20.7071 21.7071C20.5196 21.8946 20.2652 22 20 22H4C3.73478 22 3.48043 21.8946 3.29289 21.7071C3.10536 21.5196 3 21.2652 3 21V11C3 10.7348 3.10536 10.4804 3.29289 10.2929C3.48043 10.1054 3.73478 10 4 10H5V9C5 8.08075 5.18106 7.1705 5.53284 6.32122C5.88463 5.47194 6.40024 4.70026 7.05025 4.05025C7.70026 3.40024 8.47194 2.88463 9.32122 2.53284C10.1705 2.18106 11.0807 2 12 2C12.9193 2 13.8295 2.18106 14.6788 2.53284C15.5281 2.88463 16.2997 3.40024 16.9497 4.05025C17.5998 4.70026 18.1154 5.47194 18.4672 6.32122C18.8189 7.1705 19 8.08075 19 9V10ZM5 12V20H19V12H5ZM11 14H13V18H11V14ZM17 10V9C17 7.67392 16.4732 6.40215 15.5355 5.46447C14.5979 4.52678 13.3261 4 12 4C10.6739 4 9.40215 4.52678 8.46447 5.46447C7.52678 6.40215 7 7.67392 7 9V10H17Z" fill="white" />
                </g>
                <defs>
                  <clipPath id="clip0_6_1293">
                    <rect width="24" height="24" fill="white" />
                  </clipPath>
                </defs>
              </svg>
            </span>
            <br>
          </div>
          <span style="color: red; margin-bottom: 10px"><?php echo $error; ?><br></span>
          <input type="submit" name="login" value="Entrar" class="login__entrar">
        </form>
      </div>
    </div>

    <div class="login__img">
      <img src="./assets/imgs/login-img.png" alt="">
    </div>
  </div>
</body>

</html>