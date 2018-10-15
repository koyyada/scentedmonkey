<?php
require("connection.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$sql = "CREATE TABLE IF NOT EXISTS testcontributed (
    id INT(16) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    iteamID VARCHAR(20) NOT NULL,
    contributed INT(20) NOT NULL
    )";
    if (mysqli_query($conn, $sql)) {
        echo "Table  created successfully";
    } 
    else {
        echo "Error creating table: ";
    }
$query="SELECT * FROM csvdata  WHERE contributed=1";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) 
{
    $csvdata ='<table class="table table-bordered">
    <tr>
    <th>itemID</th>
    <th>contributed</th>
    </tr>
    ';   
$csvdata.= '<tr>

<td>'.$row['itemID'].'</td>
<td>'.$row['contributed'].'</td>
</tr>
';
$csvdata .= '</table>';

$first = "SELECT * FROM testcontributed WHERE itemID='".$row['itemID']."'";

$query_1= mysqli_query($conn, $first);

$row_1= mysqli_fetch_assoc($query_1);
 

if(empty($row_1)) 
{
    
echo $sql = "INSERT INTO testcontributed (itemID,contributed) VALUES ('".$row['itemID']."','".$row['contributed']."')";
$result_1= mysqli_query($conn, $sql);
echo $result;
}
if(!empty($row_1))
{
 echo $sql_1="UPDATE testcontributed SET itemID ='".$row['itemID']."',.contributed ='".$row['contributed']."'";
echo $result_2= mysqli_query($conn, $sql_1); 
}
die;
}
?>
