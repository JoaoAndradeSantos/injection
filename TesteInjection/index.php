<?php
include('conexao.php');

if(isset($_POST['RM']) || isset($_POST['Senha'])){
    if(strlen($_POST['RM']) == 0){
        echo "<span style='color:black;'>Preencha seu RM</span>";
    }
    else if(strlen($_POST['Senha']) == 0) {
        echo "<span style='color:black;'>Preencha sua senha</span";
    }else{
        $RM = $_POST['RM'];
        $Senha = $_POST['Senha'];

        $sql_code = "SELECT * FROM usuarios where RM='$RM' AND Senha='$Senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha no codigo sql: ".$mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1){
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)){
                session_start();
            }

            $_SESSION['RM'] = $usuario['RM'];
            $_SESSION['Senha'] = $usuario['Senha'];

            header("Location:painel.php");
        }else{
            echo "<span style='color:black;'>Login ou senha incorretos<span>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
</head> 
<body
    <div class="position-absolute top-50 start-50 translate-middle text-center">
    <h1 class="h1 mb-3 font-weight-normal font-family:Arial" >Login</h1>
    <form action="" method="POST">
        <input type="text" class="form-control" placeholder="Matrícula" name="RM">
        <br>
        <input type="password" class="form-control" placeholder="Senha" name="Senha">
        <br>
        <button type="submit" class="btn btn-info btn-dark">Entrar</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</div>
</body>
</html>