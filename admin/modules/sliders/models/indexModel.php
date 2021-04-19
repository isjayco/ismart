<?php

// check name slider exists
function check_name_slider_exists($name)
{
    $check = db_num_rows("SELECT * FROM `tbl_sliders` WHERE `name_slider` = '{$name}'");
    if ($check > 0) return true;
    return false;
}
# check slug exists
function slug_url_exists($friendly_url)
{
    $check = db_num_rows("SELECT * FROM `tbl_sliders` WHERE `friendly_url` = '{$friendly_url}'");
    if ($check > 0) return true;
    return false;
}
// add slider
function add_slider($data)
{
    db_insert("tbl_sliders", $data);
}

// check numerical orser exists 
function check_numerical_order_exists($numerical_order)
{
    $check = db_num_rows("SELECT * FROM `tbl_sliders` WHERE `numerical_order` = {$numerical_order}");
    if ($check > 0) return true;
    return false;
}

#check avatar slider exists
function check_avatar_slider_exists($path_img)
{
    $check = db_num_rows("SELECT * FROM `tbl_sliders` WHERE `avatar` = '{$path_img}'");
    if ($check > 0) return true;
    return false;
}

# get slider item by numerical order
function get_slider_item_by_numerical_order($numerical_order)
{
    $slider_item = db_fetch_row("SELECT * FROM `tbl_sliders` WHERE `numerical_order` = {$numerical_order}");
    return $slider_item;
}
#get list post by status
function get_list_slider_by_status($status)
{
    if ($status == "all") {
        $list_slider = db_fetch_array("SELECT * FROM `tbl_sliders`");
    } else if ($status == "all_not_trash") {
        $list_slider = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `status` != 'trash'");
    } else {
        $list_slider = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `status` = '{$status}'");
    }
    return $list_slider;
}

#get page by pagination
function get_list_page_slider_by_pagination($start, $num_per_page, $status, $data_id)
{
    if ($data_id != null) {
        $list_slider = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `post_cat_id` = {$data_id} LIMIT {$start},{$num_per_page}");
    } else {
        if ($status == 'all') {
            $list_slider = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `status` = 'pending' OR `status` = 'publish' LIMIT {$start},{$num_per_page}");
        } else {
            $list_slider = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `status` = '{$status}' LIMIT {$start},{$num_per_page}");
        }
    }
    return $list_slider;
};
# update img slider
function update_img_new($data, $data_id) {
    $process = db_update("tbl_sliders",$data,"`id_slider` = {$data_id}");
    return $process;
}
# update info slider
function update_info_slider($data,$id_slider) {
    $process = db_update("tbl_sliders",$data,"`id_slider` = {$id_slider}");
    return $process;
}

#get list sliders by status
function get_list_sliders_by_status($status)
{
    if ($status == "all") {
        $list_sliders = db_fetch_array("SELECT * FROM `tbl_sliders`");
    } else if ($status == "all_not_trash") {
        $list_sliders = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `status` != 'trash'");
    } else {
        $list_sliders = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `status` = '{$status}'");
    }
    return $list_sliders;
}
#update status sliders
function update_status_sliders($data, $id_slider)
{
    $process = db_update("tbl_sliders", $data, "`id_slider`={$id_slider}");
    return $process;
}
#get sliders item by id
function get_slider_item_by_id($data_id) {
    $slider_item = db_fetch_row("SELECT * FROM `tbl_sliders` WHERE `id_slider` = {$data_id}");
    return $slider_item;
}
#delete slider item
function delete_slider_item($data_id) {
    $process = db_delete("tbl_sliders","`id_slider` = {$data_id}");
    return $process;
}
#update status slider
function update_status_slider($data, $id_slider)
{
    $process = db_update("tbl_sliders", $data, "`id_slider`={$id_slider}");
    return $process;
}


//==== search
#save search history
function save_search_history($data)
{
    db_insert("tbl_search_history", $data);
}

# search slider
function search_slider($q, $option_search, $status_curr)
{
    if ($status_curr == 'all') {
        $search_result = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `{$option_search}` LIKE '%{$q}%'");
    } else {
        $search_result = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `status` = '{$status_curr}' AND `{$option_search}` LIKE '%{$q}%'");
    }
    return $search_result;
}
# get list search history
function get_list_search_history($table)
{
    $list_search = db_fetch_array("SELECT * FROM `tbl_search_history` WHERE `tbl_search` = '{$table}'");
    return $list_search;
}
#check search exists
function check_search_exists($data)
{
    $num = db_num_rows("SELECT * FROM `tbl_search_history` WHERE `search_text` = '{$data['search_text']}' AND `search_option` = '{$data['search_option']}' AND `tbl_search` = '{$data['tbl_search']}' ");
    if ($num > 0) return true;
    return false;
}
#get list page by search
function get_list_page_slider_by_search($q, $option_search, $start, $num_per_page, $status_curr)
{
    if ($status_curr == 'all') {
        $list_slider = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `$option_search` LIKE '%{$q}%' LIMIT {$start},{$num_per_page}");
    } else {
        $list_slider = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `$option_search` LIKE '%{$q}%' AND `status` = '{$status_curr}' LIMIT {$start},{$num_per_page}");
    }
    return $list_slider;
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