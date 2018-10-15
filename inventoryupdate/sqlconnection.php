<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$serverName = "10.20.0.81\sqlexpress";  

/* Connect using Windows Authentication. */  
try  
{  
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=PWW", "santosh", "sa5432");  
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch(Exception $e)  
{   
  die( print_r( $e->getMessage() ) );   
} 


try {
    $pdo = new \PDO(
        sprintf(
            "dblib:host=%s;dbname=%s",
            '10.20.0.81',
            'PWW'
        ),
        'santosh',
        'sa5432'
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "There was a problem connecting. " . $e->getMessage();
}
 
die('success');
$query = "SELECT * FROM MyTable WHERE Username = :username";
 
$statement = $pdo->prepare($query);
$statement->bindValue(":username", "sanitizeduserinputusername", PDO::PARAM_STR);
$statement->execute();
 
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
 
var_dump($results);


?>