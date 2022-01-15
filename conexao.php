<?php

/* 
preciso de 4 informações
nome do servidor
nome do usuário
senha do usuário
nome do bd
*/

$servidor = "localhost";
$usuario = "root";
$senha = "";
$bd = "bdrevisao";

try{
            //PDO("banco:host=nomedohost;dbname=nomedo bd",usuario,senha)                
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);
} catch(PDOException $e) {
    echo "Erro: ".$e->getMessage();
}


