<?php

 
try {
    $host = 'localhost';
    $dbname = 'teste';
    $conn = new PDO("mysql:host=$host;dbname=$dbname", "root", "root");
    echo "Conectado a $dbname em $host com sucesso.";
} catch (PDOException $pe) {
    die("Não foi possível se conectar ao banco de dados $dbname :" . $pe->getMessage());
}
?>