<?php

include("conexao.php");

$nome=$_POST['nome'];
$sobrenome=$_POST['sobrenome'];
$email=$_POST['email'];
$senha=$_POST['senha'];

$sql="INSERT INTO banco2(nome, sobrenome, email, senha) 
VALUES ($nome, $sobrenome, $email, $senha)";

if(mysqli_query($conn, $sql)){
    echo "Usuario conectado";
}else{
    echo "Erro".mysqli_connect_error($conn);
}

?>