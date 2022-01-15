<?php
include "menu.php";
$idvendas = isset($_GET["idvendas"]) ? $_GET["idvendas"] : null;
$op = isset($_GET["op"]) ? $_GET["op"] : null;
try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdrevisao";
    $con = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $senha);

    if ($op == "del") {
        $sql = "delete from tblvendas where idvendas= :idvendas";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idvendas", $idvendas);
        $stmt->execute();
        header("Location:vendas.php");
    }
    if ($idvendas) {
        $sql = "Select *  from tblvendas where idvendas= :idvendas";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idvendas", $idvendas);
        $stmt->execute();
        $vendas = $stmt->fetch(PDO::FETCH_OBJ);
    }



    if ($_POST) {
        if ($_POST["idvendas"]) {
            $sql = "UPDATE tblvendas set vendas=:vendas, valor=:valor,qtd=:qtd WHERE idvendas=:idvendas";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":vendas", $_POST["vendas"]);
            $stmt->bindValue(":valor", $_POST["valor"]);
            $stmt->bindValue(":qtd", $_POST["qtd"]);
            $stmt->bindValue(":idvendas", $_POST["idvendas"]);
            $stmt->execute();
        } else {
            $sql = "INSERT INTO tblvendas(vendas,valor,qtd) values(:vendas,:valor,:qtd)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":vendas", $_POST["vendas"]);
            $stmt->bindValue(":valor", $_POST["valor"]);
            $stmt->bindValue(":qtd", $_POST["qtd"]);

            $stmt->execute();
        }
        header("Location:vendas.php");
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
    <h1>Cadastro de Vendas</h1>
    <hr>
    <div class="container">
        <form method="post">
            Venda <input type="text" name="vendas" value="<?php echo isset($vendas) ? $vendas->vendas : null ?>"><br>
            Valor<input type="text" name="valor" value="<?php echo isset($vendas) ? $vendas->valor : null ?>"><br>
            Quantidade<input type="number" name="qtd" value="<?php echo isset($vendas) ? $vendas->qtd : null ?>"><br>
            <input type="hidden" name="idvendas" value="<?php echo isset($vendas) ? $vendas->idvendas : null ?>">
            <input type="submit" value="Cadastrar" class="btn btn-warning">

        </form>
    </div>

    <?php

    include "rodape.php";
    ?>