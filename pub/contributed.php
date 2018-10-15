<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$query="SELECT * FROM csvdata WHERE contributed==1";
if (!$result = mysqli_query($conn, $query)) 
{
    exit(mysqli_error($conn)); 
    }
if (mysqli_num_rows($result) > 0)
{
 $contributed=1
 $csvdata ='<table class="table table-bordered">
<tr>
<th>itemID</th>
<th>contributed</th>
</tr>
';
while ($row = mysqli_fetch_assoc($result)) {
$csvdata.= '<tr>
<td>'.$row['itemID'].'</td>
<td>'.$row['contributed'].'</td>
</tr>
';
}
}echo $csvdata;
?>