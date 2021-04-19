<?php
#get product item by id
function getProductItemById($dataId)
{
    $prodItem = db_fetch_row("SELECT * FROM `tbl_products` WHERE `id_product` = {$dataId}");
    return $prodItem;

}

#Get locatio by level
function getLocationByLevel($level)
{
    $listLocation = db_fetch_array("SELECT * FROM `tbl_location` WHERE `level_location` = {$level}");
    return $listLocation;
}

#get location 
function loadLocation($levelLoad, $value)
{
    $listLocation = db_fetch_array("SELECT * FROM `tbl_location` WHERE `level_location` = {$levelLoad} AND `parent_id` = {$value}");
    return $listLocation;
}

#add customer
function addCustomer($data)
{
    $idCustomer = db_insert("tbl_customer", $data);
    return $idCustomer;
}


#add order
function addOrder($dataOrder)
{
    db_insert("tbl_order",$dataOrder);
}
function plusNumPurchases($list_prod_cart)
{
    foreach($list_prod_cart as $prodCarItem) {
        $prodCarItem['id'];
        $prodItem = getProductItemById($prodCarItem['id']);
        $numPurchases = $prodItem['numPurchases'] + 1;
        $data = array(
            "numPurchases" => $numPurchases
        );
        update_products($data, $prodCarItem['id']);
    }
}
#update total info products
function update_products($data, $product_id)
{
    db_update("tbl_products", $data, "`id_product` = {$product_id}");
}
#check code exists
function codeExists($code_order)
{
    $checkCodeOrder = db_num_rows("SELECT * FROM `tbl_order` WHERE `code_order` = '{$code_order}'");
    if($checkCodeOrder > 0) {
        return true;
    } return false;
}
#check customer exists
function check_customer_exists($name_customer, $email_customer, $phone_customer)
{
    $num_customer = db_num_rows("SELECT * FROM `tbl_customer` WHERE `name_customer` = '{$name_customer}' AND `email_customer` = '{$email_customer}' AND `phone_customer` = '{$phone_customer}' ");
    if($num_customer > 0) return true;
    else return false;
}

#get customer item by multi info
function get_and_update_customer_item_item_by_multi_info($name_customer, $email_customer, $phone_customer) 
{
    $customer_item = db_fetch_row("SELECT * FROM `tbl_customer` WHERE `name_customer` = '{$name_customer}' AND `email_customer` = '{$email_customer}' AND `phone_customer` = '{$phone_customer}' ");
    $num_order     = $customer_item['num_order'];
    $num_order ++;
    $data_update = array(
        "num_order" => $num_order
    );
    db_update("tbl_customer",$data_update,"`id_customer` = {$customer_item['id_customer']}");
    return $customer_item;

}