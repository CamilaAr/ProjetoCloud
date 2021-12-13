<?php

 
try {
    $host = 'localhost';
    $dbname = 's3db';
    $conn = new PDO("mysql:host=$host;dbname=$dbname", "root", "root");
    echo "Conectado a $dbname em $host com sucesso.";
} catch (PDOException $pe) {
    die("Não foi possível se conectar ao banco de dados $dbname :" . $pe->getMessage());
}
/*
$numero = 1;
$texto = "ola";

$consulta = "INSERT INTO teste (numero, texto) VALUES (?,?)";
$stmt= $conn->prepare($consulta);
$stmt->execute([$numero, $texto]);

*/
?>