<?php

    
$row = 0;
if (($handle = fopen("leftover_new.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
//die;
        //if($row > 0){
        $url="../pub/media/import/images/notpresent/comingsoon.png";
        //echo $file = file_get_contents($url, true);
        if($contents = file_get_contents($url, true)){
            //echo 'here';
             $save_path="../pub/media/import/images/notpresent/".$data[0].'.png';
            file_put_contents($save_path,$contents);    
        }else{
            echo $data[0];
            echo '<br />';
            
        }
        //if($row==2) die;      
        $row++;
       
    }
}
echo 'successfully updated';
?>
