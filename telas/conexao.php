<?php 
$localhost = "localhost";
$username = "root";
$password = "";
$database = "banco2";

$conn = new mysqli($localhost, $username, $password, $database);
if($conn->connect_error){
    echo "falha na conexao";
}else{
    echo "conectado";
}

?>