<?php
# add advt
function add_advt($data)
{
    db_insert("tbl_advt", $data);
}
#get list advt by status
function get_list_advt_by_status($status)
{
    if ($status == "all") {
        $list_advt = db_fetch_array("SELECT * FROM `tbl_advt`");
    } else if ($status == "all_not_trash") {
        $list_advt = db_fetch_array("SELECT * FROM `tbl_advt` WHERE `status` != 'trash'");
    } else {
        $list_advt = db_fetch_array("SELECT * FROM `tbl_advt` WHERE `status` = '{$status}'");
    }
    return $list_advt;
}

#get page by pagination
function get_list_page_advt_by_pagination($start, $num_per_page, $status)
{
    if ($status == 'all') {
        $list_advt = db_fetch_array("SELECT * FROM `tbl_advt` WHERE `status` = 'pending' OR `status` = 'publish' LIMIT {$start},{$num_per_page}");
    } else {
        $list_advt = db_fetch_array("SELECT * FROM `tbl_advt` WHERE `status` = '{$status}' LIMIT {$start},{$num_per_page}");
    }
    return $list_advt;
};
#update advt
function update_advt($data,$id_advt) {
    $process = db_update("tbl_advt",$data,"`id_advt` = {$id_advt}");
    return $process;
}
# update img advt
function update_img_new($data, $data_id) {
    $process = db_update("tbl_advt",$data,"`id_advt` = {$data_id}");
    return $process;
}
#update status advt
function update_status_advt($data, $id_advt)
{
    $process = db_update("tbl_advt", $data, "`id_advt`={$id_advt}");
    return $process;
}
#get sliders item by id
function get_advt_item_by_id($data_id) {
    $advt_item = db_fetch_row("SELECT * FROM `tbl_advt` WHERE `id_advt` = {$data_id}");
    return $advt_item;
}
#delete slider item
function delete_advt_item($data_id) {
    $process = db_delete("tbl_advt","`id_advt` = {$data_id}");
    return $process;
}
#save search history
function save_search_history($data)
{
    db_insert("tbl_search_history", $data);
}
#check search exists
function check_search_exists($data)
{
    $num = db_num_rows("SELECT * FROM `tbl_search_history` WHERE `search_text` = '{$data['search_text']}' AND `search_option` = '{$data['search_option']}' AND `tbl_search` = '{$data['tbl_search']}' ");
    if ($num > 0) return true;
    return false;
}
# search advt
function search_advt($q, $option_search, $status_curr)
{
    if ($status_curr == 'all') {
        $search_result = db_fetch_array("SELECT * FROM `tbl_advt` WHERE `{$option_search}` LIKE '%{$q}%'");
    } else {
        $search_result = db_fetch_array("SELECT * FROM `tbl_advt` WHERE `status` = '{$status_curr}' AND `{$option_search}` LIKE '%{$q}%'");
    }
    return $search_result;
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
#get list page by search
function get_list_page_advt_by_search($q, $option_search, $start, $num_per_page, $status_curr)
{
    if ($status_curr == 'all') {
        $list_slider = db_fetch_array("SELECT * FROM `tbl_advt` WHERE `$option_search` LIKE '%{$q}%' LIMIT {$start},{$num_per_page}");
    } else {
        $list_slider = db_fetch_array("SELECT * FROM `tbl_advt` WHERE `$option_search` LIKE '%{$q}%' AND `status` = '{$status_curr}' LIMIT {$start},{$num_per_page}");
    }
    return $list_slider;
}