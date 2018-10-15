<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database Connection
require("db_connection.php");

// get csvdata
$query = "SELECT * FROM contributed";
if (!$result = mysqli_query($conn, $query)) { 
    exit(mysqli_error($conn));
}

$csvdata = array(); 
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) { 

        $Designer = $Gender =  $size=  $UPC = $Type = $visibility= $pwwsku="";
        $itemID = $row['itemID'];
        
        //$visibility = ($row['contributed'] > 0) ? "Not Visible Individually" : "Catalog, Search";
        $visibility = "Catalog, Search";
        // if($row['contributed'] > 0){
        //     $visibility = "Not Visible Individually";
        // }else{
        //     $visibility = "Catalog, Search";
        // }

        $Designer = ($row['Designer']!="") ? "designer=".$row['Designer'] : "";
        // if($row['Designer']!=""){      
        //   $Designer ="designer=".$row['Designer'];
        // }
        $Gender = ($row['Gender']!="") ? ",gender=".$row['Gender'] : "";
        // if($row['Gender']!=""){ 
        //   $Gender =",gender=".$row['Gender'];
        // }
        //$size = ($row['Size']!="") ? ",size=".$row['Size'] : "";
        // if($row['Size']!=""){ 
        //   $size =",size=".$row['Size'];
        // }
        $UPC = ($row['UPC']!="") ? ",upc=".$row['UPC'] : "";
        // if($row['UPC']!=""){ 
        //   $UPC =",upc=".$row['UPC'];
        // }
        $Type = ($row['Type']!="") ? ",type=".$row['Type'] : "";
        // if($row['Type']!=""){ 
        //   $Type =",type=".$row['Type'];
        // }  
        $pwwsku = ($row['SKU']!="") ? ",pwwsku=".$row['SKU'] : "";

        /*if($row['SKU']!=""){ 
          $pwwsku =",pwwsku=".$row['SKU'];
        } */
        $product_attributes =$Designer.$size.$Type.$Gender.$UPC.$pwwsku;

        $status = ($row['Price']>0) ? 1 : 0;
        /*if($row['Price']>0){
           $status=1;
        }else{
            $status=0;
        } */
        $out_of_stock_qty = ($row['QuantityAvailable']>0) ? 0 : 1;
        /*if($row['QuantityAvailable']>0){
            $out_of_stock_qty=0;
        }else{
            $out_of_stock_qty=1;
        }*/
        
        $image = str_replace("-c", "", $row['itemID']);
        $csvdata[]= array(
        'itemID' => $row['itemID'],
        'store_view_code' => "",
        'attribute_set_code'=> "Default",
        'product_type' => "configurable",
        'categories' => "Default Category/".$row['Category'],
        'product_websites' => "base",
        'Name' => $row['Name'],
        'Description' => $row['Description'],
        'short_description'=> $row['Description'],
        'weight' => "1",
        'product_online' => $status,
        'tax_class_name' => "Taxable Goods",
        'visibility' => $visibility,
        'Price' => $row['Price'],
        'special_price'=> "",
        'special_price_from_date'=> "",   
        'special_price_to_date' => "",
        'url_key' => $row['itemID'],
        'meta_title'=> "",
        'meta_keywords' => "",
        'meta_description' => "",
        'base_image' => "images/".$image.".png",
        'base_image_label' => "",
        'small_image' => "images/".$image.".png",
        'small_image_label'=> "",
        'thumbnail_image' => "images/".$image.".png",
        'thumbnail_image_label' => "",
        'swatch_image' => "",
        'swatch_image_label' => "",
        'created_at' => "",
        'updated_at' => "",
        'new_from_date' => "",
        'new_to_date' => "",
        'display_product_options_in' => "Block after Info Column",
        'map_price' => "",
        'msrp_price' => "",
        'map_enabled' => "",
        'gift_message_available' => "",
        'custom_design' => "",
        'custom_design_from' => "",
        'custom_design_to' => "",
        'custom_layout_update' => "",
        'page_layout' => "",
        'product_options_container' => "",
        'msrp_display_actual_price_type' => "",
        'country_of_manufacture' => "",
        'additional_attributes' => $product_attributes,
        'qty' => $row['QuantityAvailable'],
        'out_of_stock_qty'=> $out_of_stock_qty,
        'use_config_min_qty' => "1",
        'is_qty_decimal' => "0",
        'allow_backorders' => "0",
        'use_config_backorders'=> "1",
        'min_cart_qty' => "1",
        'use_config_min_sale_qty'=> "1",
        'max_cart_qty'=> "0",
        'use_config_max_sale_qty' => "1",
        'is_in_stock'=> "1",
        'notify_on_stock_below'=> "",
        'use_config_notify_stock_qty' => "1",
        'manage_stock' => "0",
        'use_config_manage_stock' => "0",
        'use_config_qty_increments' => "1",
        'qty_increments' => "1",
        'use_config_enable_qty_inc'=> "0",
        'enable_qty_increments' => "0",
        'is_decimal_divided' => "0",
        'website_id' => "1",
        'related_skus'=> "",
        'crosssell_skus'=> "",
        'upsell_skus' => "",
        'additional_images' => "",
        'additional_image_labels' => "",
        'hide_from_product_page' => "",
        'bundle_price_type'=> "",
        'bundle_sku_type' => "",
        'bundle_price_view' => "",
        'bundle_weight_type' => "",
        'bundle_values' =>"",
        'configurable_variations' => $row['variations'],
        'configurable_variation_labels'=> "",
        'associated_skus' => "",
        
        );
   
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Users.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('sku','store_view_code','attribute_set_code','product_type','categories','product_websites','name','description','short_description','weight','product_online','tax_class_name','visibility','price','special_price','special_price_from_date','special_price_to_date','url_key','meta_title','meta_keywords','meta_description','base_image','base_image_label','small_image','small_image_label','thumbnail_image','thumbnail_image_label','swatch_image','swatch_image_label','created_at','updated_at','new_from_date','new_to_date','display_product_options_in','map_price','msrp_price','map_enabled','gift_message_available','custom_design','custom_design_from','custom_design_to','custom_layout_update','page_layout','product_options_container','msrp_display_actual_price_type','country_of_manufacture','additional_attributes','qty','out_of_stock_qty','use_config_min_qty','is_qty_decimal','allow_backorders','use_config_backorders','min_cart_qty','use_config_min_sale_qty','max_cart_qty','use_config_max_sale_qty','is_in_stock','notify_on_stock_below','use_config_notify_stock_qty','manage_stock','use_config_manage_stock','use_config_qty_increments','qty_increments','use_config_enable_qty_inc','enable_qty_increments','is_decimal_divided','website_id','related_skus','crosssell_skus','upsell_skus','additional_images','additional_image_labels','hide_from_product_page','bundle_price_type','bundle_sku_type','bundle_price_view','bundle_weight_type','bundle_values','configurable_variations','configurable_variation_labels','associated_skus'));
// print_r($output);
if (count($csvdata) > 0) {
    foreach ($csvdata as $row) {
        fputcsv($output, $row);
    }
}
?>