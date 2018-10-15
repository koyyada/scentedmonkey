<?php
// Database Connection
require("db_connection.php");
// List csvdata
$query = "SELECT * FROM csvdata";

if (!$result = mysqli_query($conn, $query)) 
{
    exit(mysqli_error($conn)); 
    }
if (mysqli_num_rows($result) > 0)
{
  $itemID = 1;
    $csvdata = '<table class="table table-bordered">
        <tr>
        <th>sku</th><th>store_view_code</th><th>attribute_set_code</th><th>product_type</th><th>categories</th><th>product_websites</th><th>name</th><th>description</th><th>short_description</th><th>weight</th><th>product_online</th><th>tax_class_name</th><th>visibility</th><th>price</th><th>special_price</th><th>special_price_from_date</th><th>special_price_to_date</th><th>url_key</th><th>meta_title</th><th>meta_keywords</th><th>meta_description</th><th>base_image</th><th>base_image_label</th><th>small_image</th><th>small_image_label</th><th>thumbnail_image</th><th>thumbnail_image_label</th><th>swatch_image</th><th>swatch_image_label</th><th>created_at</th><th>updated_at</th><th>new_from_date</th><th>new_to_date</th><th>display_product_options_in</th><th>map_price</th><th>msrp_price</th><th>map_enabled</th><th>gift_message_available</th><th>custom_design</th><th>custom_design_from</th><th>custom_design_to</th><th>custom_layout_update</th><th>page_layout</th><th>product_options_container</th><th>msrp_display_actual_price_type</th><th>country_of_manufacture</th><th>additional_attributes</th><th>qty</th><th>out_of_stock_qty</th><th>use_config_min_qty</th><th>is_qty_decimal</th><th>allow_backorders</th><th>use_config_backorders</th><th>min_cart_qty</th><th>use_config_min_sale_qty</th><th>max_cart_qty</th><th>use_config_max_sale_qty</th><th>is_in_stock</th><th>notify_on_stock_below</th><th>use_config_notify_stock_qty</th><th>manage_stock</th><th>use_config_manage_stock</th><th>use_config_qty_increments</th><th>qty_increments</th><th>use_config_enable_qty_inc</th><th>enable_qty_increments</th><th>is_decimal_divided</th><th>website_id</th><th>related_skus</th><th>crosssell_skus</th><th>upsell_skus</th><th>additional_images</th><th>additional_image_labels</th><th>hide_from_product_page</th><th>bundle_price_type</th><th>bundle_sku_type</th><th>bundle_price_view</th><th>bundle_weight_type</th><th>bundle_values</th><th>configurable_variations</th><th>configurable_variation_labels</th><th>associated_skus</th>
        </tr>
        ';
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['Designer']!="")
            {      
              $Designer ="Designer=".$row['Designer'];
                 }
                 if($row['Gender']!="")
                 { 
              $Gender =",gender=".$row['Gender'];
                 }
                 if($row['Size']!="")    
                 { 
              $size =",size=".$row['Size'];
                 }
                 if($row['UPC']!="")
                 { 
              $UPC =",upc=".$row['UPC'];
                 }
                 if($row['Type']!="")
                 { 
              $Type =",Type=".$row['Type'];
                 }  
               $product_attributes =$Designer.$size.$Type.$Gender.$UPC;
      if($row['Price']>0)
        {
           $status=1;
        }
        else{
            $status=0;
        }
        

        if($row['QuantityAvailable']>0)
        {
            $out_of_stock_qty=0;
        }
        else{
            $out_of_stock_qty=1;
        }
        $csvdata .= '<tr>
            <td>'.$row['itemID'].'</td>
            <td></td>
            <td>Default</td>
            <td>simple</td>
            <td>Default Category/'.$row['Category'].'</td>
            <td>base</td>
            <td>'.$row['Name'].'</td>
            <td>'.$row['Description'].'</td>
            <td>'.$row['Description'].'</td>
            <td>1</td>
            <td>'.$status.'</td>
            <td>Taxable Goods</td>
            <td>Not Visible Individually</td>
            <td>'.$row['Price'].'</td>
            <td></td>
            <td></td>
            <td></td>
            <td>'.$row['itemID'].'</td>
            <td></td>
            <td></td>
            <td></td>
            <td>images/'.$row['itemID'].'.png</td>
            <td></td>
            <td>images/'.$row['itemID'].'.png</td>
            <td></td>
            <td>images/'.$row['itemID'].'.png</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Block after Info Column</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>'.$product_attributes.'</td>
            <td>'.$row['QuantityAvailable'].'</td>
            <td>'.$out_of_stock_qty.'</td>
            <td>1</td>
            <td>0</td>
            <td>0</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>0</td>
            <td>1</td>
            <td>1</td>
            <td></td>
            <td>1</td>
            <td>0</td>
            <td>0</td>
            <td>1</td>
            <td>1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>1</td>
        </tr>';
        $itemID++;
    }
    $csvdata .= '</table>';
}
 ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
</head>
<body>
<div class="container">
    <!--  Header  -->
    <div class="row">
        <div class="col-md-12">
            <h2>Export Data from MySQL to CSV</h2>
        </div>
    </div>
    <!--  /Header  -->
 
    <!--  Content   -->
    <div class="form-group">
        <?php echo $csvdata ?>
    </div>
    <div class="form-group">
        <button onclick="Export()" class="btn btn-primary">Export to CSV File</button>
    </div>
    <!--  /Content   -->
 
    <script>
        function Export()
        {
            var conf = confirm("Export users to CSV?");
            if(conf == true)
            {
                window.open("export.php", '_blank');
            }
        }
    </script>
</div>
</body>
</html>