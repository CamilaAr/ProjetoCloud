<?php

 
try {
    $host = 'localhost';
    $dbname = 's3db';
    $conn = new PDO("mysql:host=$host;dbname=$dbname", "root", "root");
    echo "Conectado a $dbname em $host com sucesso.";
} catch (PDOException $pe) {
    die("Não foi possível se conectar ao banco de dados $dbname :" . $pe->getMessage());
}
/* copia para inserção
$numero = 1;
$texto = "ola";

$consulta = "INSERT INTO teste (numero, texto) VALUES (?,?)";
$stmt= $conn->prepare($consulta);
$stmt->execute([$numero, $texto]);

*/
//copia para select
$ACCESS_CODE = "1234567";
$stmt = "SELECT * FROM s3Files WHERE accessCode='$ACCESS_CODE'";
$result = $conn->query( $stmt ); 
while($rows = $result->fetch()) {
    $keyPath = $rows['s3FilePath'];
   echo $rows['s3FilePath'];
  }
  echo $keyPath;

//print_r( $rows );



?>