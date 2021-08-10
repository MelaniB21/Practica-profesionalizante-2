<link rel="stylesheet" href="style.css">
<form method="post" action="" name="signin-form">
    <div class="form-element">
        <label>Usuario</label>
        <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form-element">
        <label>Contraseña</label>
        <input type="password" name="password" required />
    </div>
    <button type="submit" name="login" value="login">Iniciar sesion</button>
</form>
<button onclick="location.href='register.php'">No tienes cuenta para acceder? </button>
<?php
 
include('config.php');
session_start();
 
if (isset($_POST['login'])) {
 
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $query = $connection->prepare("SELECT * FROM users WHERE USERNAME=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();
 
    $result = $query->fetch(PDO::FETCH_ASSOC);
 
    if (!$result) {
        echo '<p class="error">Usuario o contraseña incorrecta!</p>';
    } else {
        if (password_verify($password, $result['password'])) {
            $_SESSION['user_id'] = $result['id'];
            echo '<p class="success">Se ha logeado con exito!</p>';
        } else {
            echo '<p class="error">Usuario o contraseña incorrecta!</p>';
        }
    }
}
 
?>