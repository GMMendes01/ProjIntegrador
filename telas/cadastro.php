<?php

include("conexao.php");

$nome=$_POST['nome'];
$sobrenome=$_POST['sobrenome'];
$email=$_POST['email'];
$senha=$_POST['senha'];

$sql="INSERT INTO cadastro(nome, sobrenome, email, senha) 
VALUES ('$nome', '$sobrenome', '$email', '$senha')";

if(mysqli_query($conn, $sql)){
    echo "\nUsuario cadastrado";
    include("navbar.html");/*inclui a pagina de pós registro (ainda nao está criada)*/ 
}else{
    echo "Erro".mysqli_connect_error($conn);
}

?>