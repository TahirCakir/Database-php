<div class="main-container">
<form method="post" action="" name="signup-form">
<div class="form-element">
<label>Имя</label>
<input type="text" name="name" pattern="[a-zA-Z0-9]+" required />
</div>
<div class="form-element">
<label>Фамилия</label>
<input type="text" name="second_name" pattern="[a-zA-Z0-9]+" required />
</div>
<div class="form-element">
<label>Почта</label>
<input type="email" name="email" required />
</div>
<div class="form-element">
<label>Телефон</label>
<input type="tel" name="phone" required />
</div>
<div class="form-element">
<label>Пароль</label>
<input type="password" name="password" required />
</div>
<button type="submit" name="register" value="register">Register</button>
</form>
</div>
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
    background: rgb(217, 217, 217);
    margin: 25px auto;
    padding: 20px;
    border: 5px solid #ccc;
    width: 500px;
    border-radius: 11px;
}
div.form-element {
    margin: 20px 0;
}
button {
    padding: 10px;
    font-size: 1.5rem;
    font-family: 'Lato';
    font-weight: 100;
    background: aquamarine;
    color: white;
    border: none;
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
    <?php
    session_start();
    include('config.php');
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $second_name = $_POST['second_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = $connection->prepare("SELECT * FROM user WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            echo '<p class="error">Этот адрес уже зарегистрирован!</p>';
        }
        if ($query->rowCount() == 0) {
            $query = $connection->prepare("INSERT INTO user(name,password,email,second_name,phone) VALUES (:name,:password_hash,:email,:second_name,:phone)");
            $query->bindParam("name", $name, PDO::PARAM_STR);
            $query->bindParam("second_name", $second_name, PDO::PARAM_STR);
            $query->bindParam("phone", $phone, PDO::PARAM_STR);
            $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $result = $query->execute();
            if ($result) {
                echo '<p class="success">Регистрация прошла успешно!</p>';
                header("Location: login.php");
                exit();
            } else {
                echo '<p class="error">Неверные данные!</p>';
            }
        }
    }
?>