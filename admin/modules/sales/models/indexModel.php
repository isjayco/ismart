<?php

#pagination
function get_list_order()
{
    $list_order = db_fetch_array("SELECT * FROM `tbl_order`");
    return $list_order;
}

#get list order by pagination
function get_list_page_order_by_pagination($start, $num_per_page,$status)
{
    if($status == 'all') {
        $list_order = db_fetch_array("SELECT * FROM `tbl_order` LIMIT {$start},{$num_per_page}");
    } else {
        $list_order = db_fetch_array("SELECT * FROM `tbl_order` WHERE `status` = '{$status}' LIMIT {$start},{$num_per_page}");
    }
    return $list_order;
};

#get user order by id 
function get_user_order_by_id($dataId)
{
    $user_order = db_fetch_row("SELECT * FROM `tbl_customer` WHERE `id_customer` = {$dataId}");
    return $user_order;
}
#get user order by name
function get_user_order_by_name($name_customer)
{
    $list_id_customer = array();
    $list_customer_order = db_fetch_array("SELECT * FROM `tbl_customer` WHERE `name_customer` LIKE '%{$name_customer}%'");
    $i = 0;
    foreach($list_customer_order as $customer_order_item) {
        $list_id_customer[$i] = $customer_order_item['id_customer'];
        $i++;
    }
    $g = 0;
    $list_order_search = array();
    $list_order = db_fetch_array("SELECT * FROM `tbl_order`");
    for($i=0 ; $i<count($list_id_customer) ; $i++) {
        for($j=0 ; $j<count($list_order) ; $j++) {
            if( $list_id_customer[$i] == $list_order[$j]['customer_id'] ) {
                $list_order_search[$g] = $list_order[$j];
                $g ++;
            }
        }
    }
    return $list_order_search;
}
function get_user_order_by_name_pagination($q, $page_start, $num_per_page, $status_curr)
{
    $rearch_result = array();
    $list_order_search = get_user_order_by_name($q);
    $i = $page_start;
    $j = 0;
    $g = 0;
    foreach($list_order_search as $order_item) {
        if($j >= $i && $g < $num_per_page ) {
            if($status_curr == 'all') {
                $rearch_result[$g] = $order_item;
                $g ++;
            } else {
                if($status_curr == $order_item['status']) {
                    $rearch_result[$g] = $order_item;
                    $g ++;
                }
            }
        }
        $j ++;
    }
    return $rearch_result;
}
#get location by level
function get_location_by_level($level)
{
    $list_location = db_fetch_array("SELECT * FROM `tbl_location` WHERE `level_location` = {$level}");
    return $list_location;
}
#get location by id
function get_location_by_id($id_location)
{
    $location_item = db_fetch_row("SELECT * FROM `tbl_location` WHERE `id_location` = {$id_location}");
    return $location_item;
}
#get location by level and parent
function get_location_by_level_and_parent($level, $parent)
{
    $list_location = db_fetch_array("SELECT * FROM `tbl_location` WHERE `level_location` = {$level} AND `parent_id` = {$parent}");
    return $list_location;
}
#get info order item by id
function get_info_order_item_by_id($id_order)
{
    $order_item = db_fetch_row("SELECT * FROM `tbl_order` WHERE `id_order` = {$id_order}");
    return $order_item;
}
#update customer 
function update_customer($data_customer,$id_customer)
{
    db_update("tbl_customer",$data_customer,"`id_customer` = {$id_customer}");
}
#update order
function update_order($data_order, $id_order)
{
    db_update("tbl_order",$data_order,"`id_order` = {$id_order}");
}
#delete order item
function delete_order_item($data_id)
{
    $process = db_delete("tbl_order","`id_order` = {$data_id}");
    return $process;
}
#get lit order by status
function get_list_order_by_status($status)
{
    if ($status == 'all') {
        $list_order = db_fetch_array("SELECT * FROM `tbl_order`");
    } else {
        $list_order = db_fetch_array("SELECT * FROM `tbl_order` WHERE `status` = '{$status}'");
    }
    return $list_order;
}
#get products item by id
function get_product_item_by_id($product_id)
{
    $product_item = db_fetch_row("SELECT * FROM `tbl_products` WHERE `id_product` = {$product_id}");
    return $product_item;
}
#check search exists
function check_search_exists($data)
{
    $num = db_num_rows("SELECT * FROM `tbl_search_history` WHERE `search_text` = '{$data['search_text']}' AND `search_option` = '{$data['search_option']}' AND `tbl_search` = '{$data['tbl_search']}' ");
    if ($num > 0) return true;
    return false;
}
#save search history
function save_search_history($data)
{
    db_insert("tbl_search_history", $data);
}

# search advt
function search_order($q, $option_search, $status_curr)
{
    if ($status_curr == 'all') {
        $search_result = db_fetch_array("SELECT * FROM `tbl_order` WHERE `{$option_search}` LIKE '%{$q}%'");
    } else {
        $search_result = db_fetch_array("SELECT * FROM `tbl_order` WHERE `status` = '{$status_curr}' AND `{$option_search}` LIKE '%{$q}%'");
    }
    return $search_result;
}
#get list page by search
function get_list_page_order_by_search($q, $option_search, $start, $num_per_page, $status_curr)
{
    if ($status_curr == 'all') {
        $list_order = db_fetch_array("SELECT * FROM `tbl_order` WHERE `$option_search` LIKE '%{$q}%' LIMIT {$start},{$num_per_page}");
    } else {
        $list_order = db_fetch_array("SELECT * FROM `tbl_order` WHERE `$option_search` LIKE '%{$q}%' AND `status` = '{$status_curr}' LIMIT {$start},{$num_per_page}");
    }
    return $list_order;
}
# get list search history
function get_list_search_history($table)
{
    $list_search = db_fetch_array("SELECT * FROM `tbl_search_history` WHERE `tbl_search` = '{$table}'");
    return $list_search;
}
#delete search history item
function delete_search_history_item($search_id)
{
    $process = db_delete("tbl_search_history", "`search_id` = {$search_id}");
    return $process;
}
#search history
function search_history($q, $option_search, $tbl_search)
{
    $list_history_search = db_fetch_array("SELECT * FROM `tbl_search_history` WHERE `tbl_search` = '{$tbl_search}' AND `{$option_search}` LIKE '%{$q}%' ");
    return $list_history_search;
}