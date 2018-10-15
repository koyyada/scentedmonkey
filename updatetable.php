<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("connection.php");
$iteamID = array("I0000001","I0000002","I0000003","I0000004","I0000005","I0000006","I0000007","I0000008","I0000009","I0000010");
 $y=0;
while ($y<count($iteamID)){
    
 $query="SELECT * FROM csvdata WHERE itemID='".$iteamID[$y]."'";

$result = mysqli_query($conn, $query);
$csvdata = '<table class="table table-bordered">
<tr>
<th>QuantityAvailable</th>
<th>Price</th>
</tr>
';
$row = mysqli_fetch_assoc($result);
$csvdata.= '<tr>
<td>'.$row['QuantityAvailable'].'</td>
<td>'.$row['Price'].'</td>
</tr>
';
$sql="UPDATE updatetable 
SET .qty ='".$row['QuantityAvailable']."',.price ='".$row['Price']."' WHERE itemID='".$iteamID[$y]."'";
$result = mysqli_query($conn,$sql);
$updatetable = '<table class="table table-bordered">
<tr>
<th>qty</th>
<th>price</th>
</tr>
';
$updatetable.= '<tr>
<td>'.$row['QuantityAvailable'].'</td>
<td>'.$row['Price'].'</td>
</tr>
';
$csvdata .= '</table>';echo $csvdata;

$y++;
} 
?>
