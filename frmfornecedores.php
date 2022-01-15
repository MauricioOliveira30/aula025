<?php
include "menu.php";
$idfornecedores = isset($_GET["idfornecedores"]) ? $_GET["idfornecedores"] : null;
$op = isset($_GET["op"]) ? $_GET["op"] : null;
try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdrevisao";
    $con = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $senha);

    if ($op == "del") {
        $sql = "delete from tblfornecedores where idfornecedores= :idfornecedores";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idfornecedores", $idfornecedores);
        $stmt->execute();
        header("Location:fornecedores.php");
    }
    if ($idfornecedores) {
        $sql = "Select *  from tblfornecedores where idfornecedores= :idfornecedores";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idfornecedores", $idfornecedores);
        $stmt->execute();
        $fornecedores = $stmt->fetch(PDO::FETCH_OBJ);
    }



    if ($_POST) {
        if ($_POST["idfornecedores"]) {
            $sql = "UPDATE tblfornecedores set fornecedores=:fornecedores, salario=:salario,contrato=:contrato WHERE idfornecedores=:idfornecedores";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":fornecedores", $_POST["fornecedores"]);
            $stmt->bindValue("salario", $_POST["salario"]);
            $stmt->bindValue(":contratro", $_POST["contrato"]);
            $stmt->bindValue(":idfornecedores", $_POST["idfornecedores"]);
            $stmt->execute();
        } else {
            $sql = "INSERT INTO tblfornecedores(fornecedores,salario,contrato) values(:fornecedores,:salario,:contrato)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":fornecedores", $_POST["fornecedores"]);
            $stmt->bindValue(":salario", $_POST["salario"]);
            $stmt->bindValue(":contrato", $_POST["contrato"]);

            $stmt->execute();
        }
        header("Location:fornecedores.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>
<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Sistema</title>
</head>

<body>
    <h1>Cadastro de Fornecedores</h1>
    <hr>
    <div class="container">
        <form method="post">
            Fornecedor <input type="text" name="fornecedores" value="<?php echo isset($fornecedores) ? $fornecedores->fornecedores : null ?>"><br>
            Salário<input type="text" name="salario" value="<?php echo isset($fornecedores) ? $fornecedores->salario : null ?>"><br>
            Contrato<input type="text" name="contrato" value="<?php echo isset($fornecedores) ? $fornecedores->contrato : null ?>"><br>
            <input type="hidden" name="idfornecedores" value="<?php echo isset($fornecedores) ? $fornecedores->idfornecedores : null ?>">
            <input type="submit" value="Cadastrar" class="btn btn-warning">

        </form>
    </div>

    <?php

    include "rodape.php";
    ?>