<?php
    session_start();
    include('config.php');
    if (isset($_POST['login'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $query = $connection->prepare("SELECT * FROM user WHERE name=:name");
        $query->bindParam("name", $name, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '<p class="error">Неверные пароль или имя пользователя!</p>';
        } else {
            if (password_verify($password, $result['password'])) {
                $_SESSION['user_id'] = $result['user_id'];
                echo '<p class="success">Поздравляем, вы прошли авторизацию!</p>';
                header("Location: курсач2/Спецпредложения.html");
                exit();
            } else {
                echo '<p class="error"> Неверные пароль или имя пользователя!</p>';
            }
        }
    }
?>

</script>
<div class="main-container">
<form method="post" action="" name="signin-form">
  <div class="form-element">
    <label>Имя</label>
    <input type="text" name="name" pattern="[a-zA-Z0-9]+" required />
  </div>
  <div class="form-element">
    <label>Пароль</label>
    <input type="password" name="password" required />
  </div>
  <button type="submit" name="login" value="login">Войти</button>
</div>
  
</form>
<style>
      .main-container {
    position: relative;
    width: 1440px;
    height: 1024px;
    margin: 0 auto;
    left: -340;
    background: linear-gradient(rgb(255, 255, 255), rgb(157, 255, 220));
    background-size: cover;
    overflow: hidden;
      }
    * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body {
    margin: 50px auto;
    text-align: center;
    width: 800px;
}
h1 {
    font-family: 'Passion One';
    font-size: 2rem;
    text-transform: uppercase;
}
label {
    width: 150px;
    display: inline-block;
    text-align: left;
    font-size: 1.5rem;
    font-family: 'Lato';
}
input {
    background: rgb(150, 255, 223);
    border: 2px solid #ccc;
    font-size: 1.5rem;
    font-weight: 100;
    font-family: 'Lato';
    padding: 10px;
}
form {
    margin: 25px auto;
    padding: 20px;
    border: 5px solid #ccc;
    width: 600px;
    background: rgb(217, 217, 217);
    border-radius: 11px;
}
div.form-element {
    margin: 20px 0;
}
button {
    margin: 0px;
    padding: 10px;
    font-size: 1.5rem;
    font-family: 'Lato';
    font-weight: 100;
    background: Aquamarine;
    color: white;
    border: none;
    z-index: 20;
}
p.success,
p.error {
    color: white;
    font-family: lato;
    background: yellowgreen;
    display: inline-block;
    padding: 2px 10px;
}
p.error {
    background: orangered;
}
    </style>