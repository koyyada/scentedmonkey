<?php
//die('no issues');
$db = mysqli_connect('localhost','root','scentedPa55word!','data')
or die('Error connecting to MySQL server.');

//$sql = "select stock.qty, stock.company, k.api_key, k.api_password, k.url, pro.product_id, pro.variant_id, pro.skuFrom 3PL_Merchant_Stock_Update stockINNER JOIN 3PL_Merchant_Product_Details pro ON stock.sku=pro.skuINNER JOIN 3PL_Merchant_App_Details k ON stock.company = k.company";
$alldata=array();
$appdetails=array();

$directory="../pub/media/import/images";
$files = scandir($directory);
foreach($files as $key=>$name){
    if($name !="." && $name!=".."){
        $act_name = str_replace('larger.png','',$name);
        $sql = "SELECT itemId FROM csvdata where SKU='".$act_name."'";
        $result = mysqli_query($db, $sql);
        $approw = mysqli_fetch_assoc($result);
        $oldName = $name;
        $newName = $approw['itemId'].'.png';
        echo $set = rename("$directory/$oldName","$directory/$newName");
        echo '<br />';
    }
    //$newName = strtolower($name);
    //rename("$directory/$oldName","$directory/$newName");
  }
?>