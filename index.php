<?php
session_start();
if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die("Error: Token CSRF inválido.");
        }
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Tu email a sido cambiado a: " . $email;
        } else {
                echo "El Email insertado no es valido";
        }
}
?>
<style>
    .form{
            background-color: rgb(226, 225, 225);
            border-radius: 10px;
            margin-right: 70%;

    }
    input{
        margin-left: 4%;
    }
    label{
        margin-left: 2%;
    }
    button{
        margin-left: 25%;
        margin-top: 5%;
        padding-left: 15%;
        padding-right: 15%;
        padding-top: 2% ;
        padding-bottom: 2%;
        border-radius: 5px;
    }
</style>

<div class="form">
    <h4>Cambio de correo electronico:</h4>
        <form method="post">
        <label for="email">Nuevo Email:</label>
        <input type="text" size="40" name="email">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <br>
        <button type="submit">Enviar</button>
        </form>
        <br>
</div>