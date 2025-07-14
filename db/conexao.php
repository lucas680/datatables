<?php

$host = "localhost";
$port = 5432;
$dbname = "datatablesDB";
$user = "postgres";
$pass = "";

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    //echo "Conexão com o banco de dados realizada com sucesso";
} catch (PDOException $err) {
    //echo "Erro na conexão: " . $err;

}
