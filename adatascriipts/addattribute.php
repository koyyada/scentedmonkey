<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use \Magento\Framework\App\Bootstrap;
include('../app/bootstrap.php');


          // add bootstrap
          $bootstraps = Bootstrap::create(BP, $_SERVER);
          $object_Manager = $bootstraps->getObjectManager();

          $app_state = $object_Manager->get('\Magento\Framework\App\State');
          $app_state->setAreaCode('frontend');

          $set_attribute = $object_Manager->create('\Magento\Eav\Model\Config');
        //  $set_attribute = $object_Manager->create('\Magento\Eav\Model\Config');
        //  $attribute = $set_attribute->getAttribute('catalog_product', 'size');
          //$options = $attribute->getSource()->getAllOptions();
        //  echo '<pre>';
          //print_r($options);
        //  die;

//die("change this value");
$row = 0;
if (($handle = fopen("gender.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
// if($row > 0){
          $attr = $object_Manager->create('\Magento\Eav\Model\Entity\Attribute');

          $attribute = $attr->load(139);

          $value['option'] = array($data[0],$data[0]);
          $result = array('value' => $value);
          //print_r($result);
          //die;
          $attribute->setData('option',$result);
          $attribute->save();
            	// get id of product

          echo "<br />Value saved :: ".$data[0]."\n";
       // }
          $row++;
          //  echo $data[$c] . "<br />\n";
      //  }
    }
    fclose($handle);
}




?>
