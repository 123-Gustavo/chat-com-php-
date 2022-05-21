<?php
    session_start();
    include("classes/Mysql.php");
    if(isset($_POST['acao'])){
        $pdo = Mysql::conectar();
        $sql = $pdo->prepare("SELECT * FROM `usuarios`");
        $sql->execute();
        $users = $sql->fetchAll();
        foreach ($users as $key => $value) {
            if($_POST['email-login'] == $value['email'] && $_POST['password-login'] == $value['password']){
                $_SESSION['email'] = $_POST['email-login'];
                $_SESSION['password'] = $_POST['password-login'];
                $_SESSION['id'] = $value['id'];
                header('Location: http://localhost/aula/Aula%20Php/Projetos/projeto02/index.php');
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Chat</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="formulario">
        <h2>Faça login aqui</h2>
        <form method="post">
            <input type="email" name="email-login">
            <input type="password" name="password-login">
            <input type="submit" value="Enviar" name="acao">
        </form> 
    </div>
    
</body>
</html>