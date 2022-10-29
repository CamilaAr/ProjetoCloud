<?php
  $BUCKET_NAME = 'projetocloud';
  $IAM_KEY = '';
  $IAM_SECRET = '5u1C5uqd3GmEVyfl/';

  require './vendor/autoload.php';
  use Aws\S3\S3Client;
  use Aws\S3\Exception\S3Exception;

  // Get the access code
  $accessCode = $_GET['c'];
  //$accessCode = "1234567";
  echo $accessCode;
  $accessCode = strval($accessCode);
  $accessCode = strtoupper($accessCode);
  $accessCode = trim($accessCode);
  $accessCode = addslashes($accessCode);
  $accessCode = htmlspecialchars($accessCode);
 

  // Connect to database
  $host = 'localhost';
  $dbname = 's3db';
  $con = new PDO("mysql:host=$host;dbname=$dbname", "root", "root");
  // Verify valid access code
  $stmt = "SELECT * FROM s3Files WHERE accessCode='$accessCode'";
  $result = $con->query( $stmt );
  //$result = mysqli_query($con, "SELECT * FROM s3Files WHERE code='$accessCode'") or die("Error: Invalid request");
  //if (mysqli_num_rows($result) != 1) {
   // die("Error: Invalid access code");
  //}
  
  // Get path from db
  $keyPath = '';
  while($rows = $result->fetch()) {
    $keyPath = $rows['s3FilePath'];
   echo $rows['s3FilePath'];
  }
 

  // Get file
  try {
    $s3 = S3Client::factory(
      array(
        'credentials' => array(
          'key' => $IAM_KEY,
          'secret' => $IAM_SECRET
        ),
        'version' => 'latest',
        'region'  => 'sa-east-1'
      )
    );

    //
    $result = $s3->getObject(array(
      'Bucket' => $BUCKET_NAME,
      'Key'    => $keyPath
      
    ));


    // Display it in the browser
    
    header('Content-Disposition: filename="' . basename($keyPath) . '"');
   header("Content-Type: {$result['ContentType']}");
    echo $result->body;

  } catch (Exception $e) {
    die("Error: " . $e->getMessage());
  }
