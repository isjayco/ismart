<?php
//==== LIST POST CATE ====//
#get list post cat
function get_list_post_cat($status)
{
    if ($status == 'all') {
        $list_postCat = db_fetch_array("SELECT * FROM `tbl_postcat`");
    } else if ($status == "all_not_trash") {
        $list_postCat = db_fetch_array("SELECT * FROM `tbl_postcat` WHERE `status` != 'trash'");
    } else {
        $list_postCat = db_fetch_array("SELECT * FROM `tbl_postcat` WHERE `status` = '{$status}'");
    }
    return $list_postCat;
}
#check name post cat exists
function check_name_postCat_exists($name_postCat)
{
    $name_exists = db_num_rows("SELECT * FROM `tbl_postcat` WHERE `name_postCat` = '{$name_postCat}' ");
    if ($name_exists > 0) return true;
    return false;
}
#add post cat
function add_postCat($data)
{
    db_insert("tbl_postcat", $data);
}
#get list post cat item
function get_post_cat_item($field, $value)
{
    $result = db_fetch_row("SELECT * FROM `tbl_postcat` WHERE `{$field}` = '{$value}'");
    return $result;
}
#update status post cat
function update_status($data, $id_postCat)
{
    $process = db_update("tbl_postcat", $data, "`id_postCat`='{$id_postCat}'");
    return $process;
}
#get post cat item
function get_postCat_item($post_id)
{
    $post_cat_item = db_fetch_row("SELECT * FROM `tbl_postCat` WHERE `id_postCat` = {$post_id}");
    return $post_cat_item;
}
#get list page post cat by pagination 
function get_list_page_post_cat_by_pagination($page_start, $num_per_page, $status)
{
    if ($status == 'all') {
        $list_post_cat = db_fetch_array("SELECT * FROM `tbl_postcat` WHERE `status` = 'pending' OR `status` = 'publish' LIMIT {$page_start},{$num_per_page}");
    } else {
        $list_post_cat = db_fetch_array("SELECT * FROM `tbl_postcat` WHERE `status` = '{$status}' LIMIT {$page_start},{$num_per_page}");
    }
    return $list_post_cat;
}
#get list page post cat by search
function get_list_page_post_cat_by_search($q, $option_search, $start, $num_per_page, $status_curr)
{
    if ($status_curr == 'all') {
        $list_post_cat = db_fetch_array("SELECT * FROM `tbl_postcat` WHERE `$option_search` LIKE '%{$q}%' LIMIT {$start},{$num_per_page}");
    } else {
        $list_post_cat = db_fetch_array("SELECT * FROM `tbl_postcat` WHERE `$option_search` LIKE '%{$q}%' AND `status` = '{$status_curr}' LIMIT {$start},{$num_per_page}");
    }
    return $list_post_cat;
}
#check name post cat exists
function check_exists_name_post_cat($name)
{
    $result = db_num_rows("SELECT * FROM `tbl_postcat` WHERE `name_postCat` = '{$name}' ");
    if ($result > 0) return true;
    return false;
}
#update name post cat
function update_name_post_cat($data, $data_id)
{
    $process = db_update("tbl_postcat", $data, "`id_postCat` = {$data_id} ");
    return $process;
}
#delete post cat item
function delete_post_cat_item($data_id)
{
    $process = db_delete("tbl_postcat", "`id_postCat` = {$data_id} ");
    return $process;
}
#update status post
function update_status_post_cat($data, $id_post_cat)
{
    $process = db_update("tbl_postcat", $data, "`id_postCat`={$id_post_cat}");
    return $process;
}
#get status old
function get_status_post_cat_old($data_id)
{
    $result = db_fetch_row("SELECT `status_old` FROM `tbl_postcat` WHERE `id_postCat` = {$data_id} ");
    return $result;
}
#check post cat exists
function check_post_cat_exists($name_postCat)
{
    $check = db_num_rows("SELECT * FROM `tbl_postcat` WHERE `name_postCat` = '{$name_postCat}'");
    if ($check > 0) return true;
    return false;
}
#search post cat
function search_post_cat($q, $option_search, $status_curr)
{
    if ($status_curr == 'all') {
        $search_result = db_fetch_array("SELECT * FROM `tbl_postcat` WHERE `{$option_search}` LIKE '%{$q}%'");
    } else {
        $search_result = db_fetch_array("SELECT * FROM `tbl_postcat` WHERE `status` = '{$status_curr}' AND `{$option_search}` LIKE '%{$q}%'");
    }
    return $search_result;
}
#num post by post cat
function num_post_by_id_post_cat($id_postCat)
{
    $num_post = db_num_rows("SELECT * FROM `tbl_posts` WHERE `post_cat_id` = {$id_postCat} ");
    return $num_post;
}

// ====== ADD POST ======//
# check post title exists
function title_post_exists($title_post)
{
    $check = db_num_rows("SELECT * FROM `tbl_posts` WHERE `post_title` = '{$title_post}'");
    if ($check > 0) return true;
    return false;
}
# check slug exists
function slug_url_exists($slug_url)
{
    $check = db_num_rows("SELECT * FROM `tbl_posts` WHERE `post_url` = '{$slug_url}'");
    if ($check > 0) return true;
    return false;
}
#add post new
function add_post($data)
{
    db_insert("tbl_posts", $data);
}
// ====== SHOW POST ======//
#get list post by status
function get_list_post_by_status($status)
{
    if ($status == "all") {
        $list_post = db_fetch_array("SELECT * FROM `tbl_posts`");
    } else if ($status == "all_not_trash") {
        $list_post = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `status` != 'trash'");
    } else {
        $list_post = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `status` = '{$status}'");
    }
    return $list_post;
}
#update status post
function update_status_post($data, $id_post)
{
    $process = db_update("tbl_posts", $data, "`post_id`={$id_post}");
    return $process;
}
#get info post item by id
function get_post_item_by_id($post_id)
{
    $post_item = db_fetch_row("SELECT * FROM `tbl_posts` WHERE `post_id`={$post_id}");
    return $post_item;
}
#update info post
function update_post($data, $post_id)
{
    $process = db_update("tbl_posts", $data, "`post_id`={$post_id}");
    return $process;
}
#delete post item
function delete_post_item($post_id)
{
    $process = db_delete("tbl_posts", "`post_id`={$post_id}");
    return $process;
}
# get list seatch history
function get_list_search_history($table)
{
    $list_search = db_fetch_array("SELECT * FROM `tbl_search_history` WHERE `tbl_search` = '{$table}'");
    return $list_search;
}

# search post
function search_post($q, $option_search, $status_curr)
{
    if ($status_curr == 'all') {
        $search_result = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `{$option_search}` LIKE '%{$q}%'");
    } else {
        $search_result = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `status` = '{$status_curr}' AND `{$option_search}` LIKE '%{$q}%'");
    }
    return $search_result;
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
#delete search history item
function delete_search_history_item($search_id)
{
    $process = db_delete("tbl_search_history", "`search_id` = {$search_id}");
    return $process;
}
#get page by pagination
function get_list_page_post_by_pagination($start, $num_per_page, $status, $id_post_cat)
{
    if ($id_post_cat != null) {
        $list_post = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `post_cat_id` = {$id_post_cat} LIMIT {$start},{$num_per_page}");
    } else {
        if ($status == 'all') {
            $list_post = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `status` = 'pending' OR `status` = 'publish' LIMIT {$start},{$num_per_page}");
        } else {
            $list_post = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `status` = '{$status}' LIMIT {$start},{$num_per_page}");
        }
    }
    return $list_post;
};
#get old image name
function get_path_img_file($data_id)
{
    $img_name = db_fetch_row("SELECT `post_img` FROM `tbl_posts` WHERE `post_id` = {$data_id}");
    return $img_name;
}
#update name img pos
function update_name_img($data, $data_id)
{
    $process = db_update("tbl_posts", $data, "`post_id`={$data_id}");
    return $process;
}
#get status old
function get_status_post_old($data_id)
{
    $result = db_fetch_row("SELECT `status_old` FROM `tbl_posts` WHERE `post_id` = {$data_id} ");
    return $result;
}
#get list page by search
function get_list_page_post_by_search($q, $option_search, $start, $num_per_page, $status_curr)
{
    if ($status_curr == 'all') {
        $list_post = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `$option_search` LIKE '%{$q}%' LIMIT {$start},{$num_per_page}");
    } else {
        $list_post = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `$option_search` LIKE '%{$q}%' AND `status` = '{$status_curr}' LIMIT {$start},{$num_per_page}");
    }
    return $list_post;
}
#search history
function search_history($q, $option_search, $tbl_search)
{
    $list_history_search = db_fetch_array("SELECT * FROM `tbl_search_history` WHERE `tbl_search` = '{$tbl_search}' AND `{$option_search}` LIKE '%{$q}%' ");
    return $list_history_search;
}
#get list post by id post cat
function  get_list_post_by_id_post_cat($post_cat_id)
{
    $result = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `post_cat_id` = {$post_cat_id}");
    return $result;
}
