<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<br/>
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sehenge
 * Date: 4/25/13
 * Time: 5:56 PM
 * To change this template use File | Settings | File Templates.
 */
//var_dump(file_get_contents('media/adfeeds/admitad_feed_1.xml'));
$mainXml = simplexml_load_file('media/adfeeds/admitad_feed_1.xml');
$head = array('store','websites','attribute_set','type','category_ids','sku','has_options','name','url_key','country_of_manufacture','msrp_enabled','msrp_display_actual_price_type','meta_title','meta_description','image','small_image','thumbnail','custom_design','page_layout','options_container','gift_message_available','url_path','image_label','small_image_label','thumbnail_label','weight','price','special_price','msrp','status','visibility','enable_googlecheckout','tax_class_id','is_recurring','description','short_description','meta_keyword','custom_layout_update','news_from_date','news_to_date','special_from_date','special_to_date','custom_design_from','custom_design_to','qty','min_qty','use_config_min_qty','is_qty_decimal','backorders','use_config_backorders','min_sale_qty','use_config_min_sale_qty','max_sale_qty','use_config_max_sale_qty','is_in_stock','low_stock_date','notify_stock_qty','use_config_notify_stock_qty','manage_stock','use_config_manage_stock','stock_status_changed_auto','use_config_qty_increments','qty_increments','use_config_enable_qty_inc','enable_qty_increments','is_decimal_divided','stock_status_changed_automatically','use_config_
enable_qty_increments','product_name','store_id','product_type_id','product_status_changed','product_changed_websites','url','acolor','agender','material','asize','vendor','model','typeprefix');
$fp = fopen('var/import/magento_feed.csv', 'w');
fputcsv($fp, $head);
//print_r($mainXml->shop[0]->offers[0]->offer[0]);
$i = 0;
foreach ($mainXml->shop[0]->offers[0] as $offer) {
    //if ($i < 100) {
        $sku = $offer->attributes()->id;
        $name = $offer->name;
        $categories = getCategories($offer->categoryId);
        $image = getImage($offer->picture);
        $price = $offer->price;
        $specialPrice = '';
        $description = $offer->description;
        $url = $offer->url;
        $gender = $size = $material = $color = $typePrefix = $vendor = $model = '';
        $vendor = $offer->vendor;
        $model = $offer->model;
        $typePrefix = $offer->typePrefix;
    foreach ($offer->param as $param) {
        if ($param['name'] == 'пол') {
            $gender = $param[0];
        } else if ($param['name'] == 'размер') {
            $size = $param[0];
        } else if ($param['name'] == 'материал') {
            $material = $param[0];
        } else if ($param['name'] == 'цвет') {
            $color = $param[0];
        }
    }
        echo ++$i, ' --- ', $image, "\n";
        $content = array('admin','base','Default','simple',$categories, $sku,'0',$name,'','','use config','Use config','','',$image,$image,$image,'','No layout updates','Block agter Info Column',
                         'No','','','','','1',$price,$specialPrice,'','Enabled','Catalog, Search','Yes','None','No',$description,'','','','','','','','','','1','0','1','0','0','1','1','1','0','1','0',
                         '','','1','0','0','1','1','0','1','0','0','1','1',$name,'0','simple','','',$url,$color,$gender,$material,$size,$vendor,$model,$typePrefix);
        fputcsv($fp, $content);
    //}
}
fclose($fp);

function getCategories($catId)
{
    switch ($catId) {
        case 1797: return '3,5';
        case 1798: return '3,6';
        case 1799: return '3,4';
        case 1800: return '3,7';
        case 1801: return '3,8';
        case 1802: return '3,9';
        case 1803: return '3,10';
        case 1804: return '3,11';
    }
}

function getImage($img)
{
    $arr = explode('/', $img);
    copyImage($img, $arr[6] . '/' . $arr[7] . '/' . $arr[8]);
    return '/' . $arr[6] . '/' . $arr[7] . '/' . $arr[8];
}

function copyImage($src, $dest)
{
    $dirs = explode('/', $dest);

    if (!is_dir('media/import/' . $dirs[0] . '/' . $dirs[1])) {
        if (!is_dir('media/import/' . $dirs[0])) {
            mkdir('media/import/' . $dirs[0], 0777);
        }
        mkdir('media/import/' . $dirs[0] . '/' . $dirs[1], 0777);
    }

    copy($src, 'media/import/' . $dest);
}