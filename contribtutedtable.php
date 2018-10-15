<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("connection.php");
while (contributed==1)
{
    
 $query="SELECT * FROM csvdata WHERE contributed=1";
$result = mysqli_query($conn, $query);
$csvdata = '<table class="table table-bordered">
<tr>
<th>itemID</th>
<th>contributed</th>
</tr>
';
$row = mysqli_fetch_assoc($result);
$csvdata.= '<tr>
<td>'.$row['contributed'].'</td>
<td>'.$row['itemID'].'</td>
</tr>
';
}
?>