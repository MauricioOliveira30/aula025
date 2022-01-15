<?php
include "menu.php";
$idprodutos= isset($_GET["idprodutos"]) ? $_GET["idprodutos"] : null;
$op = isset($_GET["op"]) ? $_GET["op"] : null;
try {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdrevisao";
    $con = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $senha);

    if ($op == "del") {
        $sql = "delete from tblprodutos where idprodutos= :idprodutos";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idprodutos", $idprodutos);
        $stmt->execute();
        header("Location:produtos.php");
    }
    if ($idprodutos) {
        $sql = "Select *  from tblprodutos where idprodutos= :idprodutos";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idprodutos", $idprodutos);
        $stmt->execute();
        $produtos = $stmt->fetch(PDO::FETCH_OBJ);
    }



    if ($_POST) {
        if ($_POST["idprodutos"]) {
            $sql = "UPDATE tblprodutos set produtos=:produtos, preco=:preco,qtd=:qtd WHERE idprodutos=:idprodutos";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":produtos", $_POST["produtos"]);
            $stmt->bindValue(":preco", $_POST["preco"]);
            $stmt->bindValue(":qtd", $_POST["qtd"]);
            $stmt->bindValue(":idprodutos", $_POST["idprodutos"]);
            $stmt->execute();
        } else {
            $sql = "INSERT INTO tblprodutos(produtos,preco,qtd) values(:produtos,:preco,:qtd)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":produtos", $_POST["produtos"]);
            $stmt->bindValue(":preco", $_POST["preco"]);
            $stmt->bindValue(":qtd", $_POST["qtd"]);

            $stmt->execute();
        }
        header("Location:produtos.php");
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
    <h1>Cadastro de Produtos</h1>
    <hr>
    <div class="container">
        <form method="post">
            Produto <input type="text" name="produtos" value="<?php echo isset($produtos) ? $produtos->produtos : null ?>"><br>
            Preço<input type="text" name="preco" value="<?php echo isset($produtos) ? $produtos->preco : null ?>"><br>
            Quantidade<input type="text" name="qtd" value="<?php echo isset($produtos) ? $produtos->qtd : null ?>"><br>
            <input type="hidden" name="idprodutos" value="<?php echo isset($produtos) ? $produtos->idprodutos : null ?>">
            <input type="submit" value="Cadastrar" class="btn btn-warning">

        </form>
    </div>

    <?php

    include "rodape.php";
    ?>