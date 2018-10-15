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
echo $csvdata;
$first = "SELECT * FROM csvdata WHERE itemID='".$row['itemID']."'";
/* $query_1= mysqli_query($conn, $first);*/
$csvdata = '<table class="table table-bordered">
    <tr>
    <th>id</id>
    <th>itemID</th>
    <th>contributed</th>
    </tr>
    '; 
// $row_1= mysqli_fetch_assoc($query_1);
$csvdata.= '<tr>
<td></td>
<td>'.$row['itemID'].'</td>
<td>'.$row['contributed'].'</td>
</tr>
'; 

if(!empty($first)) 
{
$sql = "INSERT INTO testcontributed (`id`,`itemID`,`contributed`) VALUES ('$csvdata.itemID','$csvdata.contributed')";
//$result_1= mysqli_query($conn, $sql);
//$row_2 = mysqli_fetch_assoc($result_1);
$csvdata = '<table class="table table-bordered">
    <tr>
    <th>id</id>
    <th>itemID</th>
    <th>contributed</th>
    </tr>
    '; 
$csvdata.= '<tr>
<td></td>
<td>'.$row['itemID'].'</td>
<td>'.$row['contributed'].'</td>
</tr>
'; 
$csvdata .= '</table>';
echo $csvdata;
//mysqli_close($conn);
}
}
?>
