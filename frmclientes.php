<?php
include "menu.php";
$idcliente = isset($_GET["idcliente"]) ? $_GET["idcliente"]:null;
$op = isset($_GET["op"])? $_GET["op"]:null;
try{
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdrevisao";
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);

  if($op=="del"){
    $sql = "delete from tblclientes where idclientes= :idclientes";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(":idclientes",$idcliente);
    $stmt->execute();
    header("Location:clientes.php");
  }
  if($idcliente){
    $sql = "Select *  from tblclientes where idclientes= :idclientes";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(":idclientes",$idcliente);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_OBJ);

  }



  if($_POST){
    if($_POST["idclientes"]){
      $sql = "UPDATE tblclientes set cliente=:cliente, dtcad=:dtcad,valor=:valor WHERE idclientes=:idclientes";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":cliente", $_POST["cliente"]);
      $stmt->bindValue(":dtcad", $_POST["dtcad"]);
      $stmt->bindValue(":valor", $_POST["valor"]);
      $stmt->bindValue(":idclientes", $_POST["idclientes"]);
      $stmt->execute();
    } else {
      $sql = "INSERT INTO tblclientes(cliente,dtcad,valor) values(:cliente,:dtcad,:valor)";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":cliente",$_POST["cliente"]);
      $stmt->bindValue(":dtcad",$_POST["dtcad"]);
      $stmt->bindValue(":valor",$_POST["valor"]);
      
      $stmt->execute();
      


    }
    header("Location:clientes.php");
  }




} catch(PDOException $e){
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
    <h1>Cadastro de Clientes</h1>    
    <hr>
    <div class="container">
        <form method="post">
            Cliente <input type="text" name="cliente" value="<?php echo isset($cliente) ? $cliente->cliente:null ?>"><br>
            Data Cadastro<input type="date" name="dtcad"   value="<?php echo isset($cliente) ? $cliente->dtcad:null ?>"><br>
            Valor<input type="text" name="valor"   value="<?php echo isset($cliente) ? $cliente->valor:null ?>"><br>
            <input type="hidden" name="idclientes"           value="<?php echo isset($cliente) ? $cliente->idclientes:null ?>">
            <input type="submit" value="Cadastrar" class="btn btn-warning">

        </form>
    </div>
  
  <?php 
    
    include "rodape.php";
    ?>
