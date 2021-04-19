<?php
#get list customer
function get_list_customer()
{
    $list_customer = db_fetch_array("SELECT * FROM `tbl_customer`");
    return $list_customer;
}
# get list search history
function get_list_search_history($table)
{
    $list_search = db_fetch_array("SELECT * FROM `tbl_search_history` WHERE `tbl_search` = '{$table}'");
    return $list_search;
}
#get list customer by pagination 
function get_list_page_customer_by_pagination($page_start, $num_per_page)
{
    $list_customer = db_fetch_array("SELECT * FROM `tbl_customer` LIMIT {$page_start},{$num_per_page}");
    return $list_customer;
}
#get location by id
function get_location_by_id($id_location)
{
    $location_item = db_fetch_row("SELECT * FROM `tbl_location` WHERE `id_location` = {$id_location}");
    return $location_item;
}
#delete customer item
function delete_customer_item($data_id)
{
    $process = db_delete("tbl_customer","`id_customer` = {$data_id}");
    return $process;
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
#search customer
function search_customer($q, $option_search)
{
    $search_result = db_fetch_array("SELECT * FROM `tbl_customer` WHERE `$option_search` LIKE '%{$q}%'");
    return $search_result;
}

#get list customer by pagination search
function get_list_page_customer_by_search($q, $option_search, $page_start, $num_per_page)
{
    $search_result = db_fetch_array("SELECT * FROM `tbl_customer` WHERE `$option_search` LIKE '%{$q}%' LIMIT {$page_start},{$num_per_page}");
    return $search_result;
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