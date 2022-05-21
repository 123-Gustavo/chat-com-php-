<?php
    session_start();
    include('classes/Mysql.php');
    if(isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['id'])){
        $pdo = Mysql::conectar();
        $sql = $pdo->prepare("SELECT * FROM `usuarios`");
        $sql->execute();
        $users = $sql->fetchAll();
        foreach ($users as $key => $value) {
            if(($_SESSION['email'] == $value['email']) && ($_SESSION['password'] == $value['password']) && ($_SESSION['id'] == $value['id'])){
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="mensagens">
        <?php
        
            if(isset($_POST['acao'])){
                $msg = $_POST['enviar-msg'];
                date_default_timezone_set("America/Sao_paulo");
                $data = date("d/m/Y H:i");
                $sql2 = $pdo->prepare("INSERT INTO `mensagens` VALUES (null,?,?,?)");
                $sql2->execute(array($msg,$data,$_SESSION['id']));

                
                }
                $sql3 = $pdo->prepare("SELECT * FROM `mensagens` INNER JOIN `usuarios` ON mensagens.autor_id = usuarios.id");

                $sql3->execute();
                $mensagens = $sql3->fetchAll();
                foreach ($mensagens as $key => $value) {
                    echo '<div class="msgsingle">
                    <h3>'.$value['nome'].' <span>'.$value['data'].'</span></h3>
                    <p>'.$value['mensagem'].'</p>
                </div>';
            }

        ?>
    </div>
    <div class="formularioMsg">
        <form method="post">
            <textarea name="enviar-msg" cols="30" rows="1" placeholder="Coloque sua mensagem aqui..."></textarea>
            <input type="submit" value="Enviar" name="acao">
        </form>
    </div>
</body>
</html>
<?php
            }
        }
    }else{
        header('Location: http://localhost/aula/Aula%20Php/Projetos/projeto02/login.php');
    }

?>