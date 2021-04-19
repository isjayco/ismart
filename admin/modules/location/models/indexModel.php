<?php
#check name location exists
function check_name_location_exists($name_location)
{
    $check = db_num_rows("SELECT * FROM `tbl_location` WHERE `name_location` = '{$name_location}'");
    if ($check > 0) return true;
    return false;
}

#add location 
function add_location($data)
{
    $id_location = db_insert("tbl_location", $data);
    return $id_location;
}

#add parent id
function update_parent_id($data_parent, $id_location)
{
    db_update("tbl_location", $data_parent, "`id_location` = {$id_location}");
}

#get list province
function get_list_province()
{
    $list_province = db_fetch_array("SELECT * FROM `tbl_location` WHERE `level_location` = 1");
    return $list_province;
}
#get province item by id
function get_province_item_by_id($id)
{
    $province_item = db_fetch_row("SELECT * FROM `tbl_location` WHERE `id_location` = {$id}");
    return $province_item;
}
#search key word location
function search_key_word($q, $level_location)
{
    $search_result = db_fetch_row("SELECT * FROM `tbl_location` WHERE `name_location` LIKE '%{$q}%' AND `level_location` = {$level_location}");
    return $search_result;
}
#load list distrist
function get_list_distrist($type = '', $id = 0)
{
    if (!empty($type)) {
        $list_distrist = db_fetch_array("SELECT * FROM `tbl_location` WHERE `level_location` = 2 AND `parent_id` = {$id}");
    } else {
        $list_distrist = db_fetch_array("SELECT * FROM `tbl_location` WHERE `level_location` = 2");
    }
    return $list_distrist;
}
#get dis distrist item by id
function get_distrist_item_by_id($id)
{
    $distrist_item = db_fetch_row("SELECT * FROM `tbl_location` WHERE `id_location` = {$id}");
    return $distrist_item;
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
