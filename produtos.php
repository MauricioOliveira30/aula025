<?php
include "conexao.php";
include "menu.php";

try {
    $sql = "SELECT * FROM tblprodutos";
    $qry = $con->query($sql);
    $produtos = $qry->fetchALL(PDO::FETCH_OBJ);
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
    <h1>Produtos cadastrados</h1>
    <hr>

    <div class="container">
        <a href="frmprodutos.php" class="btn btn-primary">Novo</a>
        <table class="table table-success table-striped table-hover">
            <tr>
                <th>idproduto</th>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th colspan="2">Ações</th>
            </tr>
            </thead>

            <tbody>
                <?php foreach ($produtos as $p) { ?>
                    <tr>
                        <th><?php echo $p->idprodutos ?></th>
                        <th><?php echo $p->produtos ?></th>
                        <th><?php echo $p->preco ?></th>
                        <th><?php echo $p->qtd ?></th>
                        <th>
                            <a href="frmprodutos.php?idprodutos=<?php echo $p->idprodutos ?>">

                                <img src="./img/editar.png" alt="">
                            </a>
                        </th>

                        <th>
                            <a href="frmprodutos.php?op=del&idprodutos=<?php echo $p->idprodutos ?>">

                                <img src="./img/excluir.png" alt="">
                            </a>
                        </th>

                    </tr>
                <?php } ?>
            </tbody>


        </table>
    </div>

    <?php

    include "rodape.php";
    ?>