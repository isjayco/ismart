<?php
// ============
// PRODUCT CAT
// ============

#check name product exists
function check_name_product_exists($name_product)
{
    $check_name = db_num_rows("SELECT * FROM `tbl_productcat` WHERE `name_productCat` = '{$name_product}'");
    if ($check_name > 0) return true;
    return false;
}

#add product cat
function add_productCat($data)
{
    db_insert("tbl_productcat", $data);
}
#list cat product
function get_list_cat_product($status)
{
    if ($status == 'not_trash') {
        $list_cat_product = db_fetch_array("SELECT * FROM `tbl_productcat` WHERE `status` = 'publish' OR `status` = 'pending'");
    } else {
        if ($status == 'all') {
            $list_cat_product = db_fetch_array("SELECT * FROM `tbl_productcat`");
        } else {
            $list_cat_product = db_fetch_array("SELECT * FROM `tbl_productcat` WHERE `status` = '{$status}'");
        }
    }
    return $list_cat_product;
}
#get product cat item
function get_product_cat_item($id_cat_product)
{
    $product_cat_item = db_fetch_row("SELECT * FROM `tbl_productcat` WHERE `id_productCat` = {$id_cat_product}");
    return $product_cat_item;
}
# get products cat item by name
function get_product_cat_item_by_name($name_cat_product)
{
    $product_cat_name = db_fetch_row("SELECT * FROM `tbl_productcat` WHERE `name_productCat` = '{$name_cat_product}'");
    return $product_cat_name;
}
# get list product cat by status 
function get_list_product_cat_by_status($status)
{
    if ($status == 'all') {
        $list_product_cat = db_fetch_array("SELECT * FROM `tbl_productcat`");
    } else if ($status == "all_not_trash") {
        $list_product_cat = db_fetch_array("SELECT * FROM `tbl_productcat` WHERE `status` != 'trash'");
    } else {
        $list_product_cat = db_fetch_array("SELECT * FROM `tbl_productcat` WHERE `status` = '{$status}'");
    }
    return $list_product_cat;
}
#get list page product cat by pagination
function get_list_page_product_cat_by_pagination($page_start, $num_per_page, $status)
{
    if ($status == 'all') {
        $list_post_cat = db_fetch_array("SELECT * FROM `tbl_productcat` WHERE `status` = 'pending' OR `status` = 'publish' LIMIT {$page_start},{$num_per_page}");
    } else {
        $list_post_cat = db_fetch_array("SELECT * FROM `tbl_productcat` WHERE `status` = '{$status}' LIMIT {$page_start},{$num_per_page}");
    }
    return $list_post_cat;
}
#check name product cat exists
function check_name_product_cat_exists($name)
{
    $result = db_num_rows("SELECT * FROM `tbl_productcat` WHERE `name_productCat` = '{$name}' ");
    if ($result > 0) return true;
    return false;
}
#update name product cat
function update_name_product_cat($data, $data_id)
{
    $process = db_update("tbl_productcat", $data, "`id_productCat` = {$data_id} ");
    return $process;
}
#delete product cat item
function delete_product_cat_item($data_id)
{
    $process = db_delete("tbl_productcat", "`id_productCat` = {$data_id} ");
    return $process;
}
#update status post
function update_status_product_cat($data, $data_id)
{
    $process = db_update("tbl_productcat", $data, "`id_productCat`={$data_id}");
    return $process;
}
#get status old
function get_status_product_cat_old($data_id)
{
    $result = db_fetch_row("SELECT `status_old` FROM `tbl_productcat` WHERE `id_productCat` = {$data_id} ");
    return $result;
}
#search product cat
function search_product_cat($q, $option_search, $status_curr)
{
    if ($status_curr == 'all') {
        $search_result = db_fetch_array("SELECT * FROM `tbl_productcat` WHERE `{$option_search}` LIKE '%{$q}%'");
    } else {
        $search_result = db_fetch_array("SELECT * FROM `tbl_productcat` WHERE `status` = '{$status_curr}' AND `{$option_search}` LIKE '%{$q}%'");
    }
    return $search_result;
}
#get list page product cat by search
function get_list_page_product_cat_by_search($q, $option_search, $start, $num_per_page, $status_curr)
{
    if ($status_curr == 'all') {
        $list_product_cat = db_fetch_array("SELECT * FROM `tbl_productcat` WHERE `$option_search` LIKE '%{$q}%' LIMIT {$start},{$num_per_page}");
    } else {
        $list_product_cat = db_fetch_array("SELECT * FROM `tbl_productcat` WHERE `$option_search` LIKE '%{$q}%' AND `status` = '{$status_curr}' LIMIT {$start},{$num_per_page}");
    }
    return $list_product_cat;
}
#search 
// ==========
// TRADE MARK
// ==========
#check name trademark exists
function check_name_trademark_exists($name_trademark)
{
    $check_name = db_num_rows("SELECT * FROM `tbl_trademark_product` WHERE `name_trademark` = '{$name_trademark}'");
    if ($check_name > 0) return true;
    return false;
}
#add trademark
function add_trademark($data)
{
    db_insert("tbl_trademark_product", $data);
}
#get list trademark
function get_list_trademark()
{
    $list_trademark = db_fetch_array("SELECT * FROM `tbl_trademark_product`");
    return $list_trademark;
}
#get list trademark by product cat id
function get_list_trademark_by_id_product_cat($data_id)
{
    $list_trademark = db_fetch_array("SELECT * FROM `tbl_trademark_product` WHERE `id_cat_product` = {$data_id}");
    return $list_trademark;
}
#get list page trademark
function get_list_page_trademark($start, $num_per_page, $data_id)
{
    if ($data_id != null) {
        $list_trademark = db_fetch_array("SELECT * FROM `tbl_trademark_product` WHERE `id_cat_product` = {$data_id} LIMIT {$start},{$num_per_page}");
    } else {
        $list_trademark = db_fetch_array("SELECT * FROM `tbl_trademark_product` LIMIT {$start},{$num_per_page}");
    }
    return $list_trademark;
};
#update name trademark 
function update_name_trademark($data, $data_id)
{
    $process = db_update("tbl_trademark_product", $data, "`id_trademark` = {$data_id}");
    return $process;
}
#save category 
function save_category($data, $id_trademark)
{
    $process = db_update("tbl_trademark_product", $data, "`id_trademark` = {$id_trademark}");
    return $process;
}
#get old image name
function get_path_img_file($data_id)
{
    $img_name = db_fetch_row("SELECT `img_trademark` FROM `tbl_trademark_product` WHERE `id_trademark` = {$data_id} ");
    return $img_name;
}
#delete permanently
function delete_trademark_item($data_id)
{
    $process = db_delete("tbl_trademark_product", "`id_trademark` = {$data_id}");
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

#check post cat exists
function check_product_cat_exists($name_product_cat)
{
    $check = db_num_rows("SELECT * FROM `tbl_productcat` WHERE `name_productCat` = '{$name_product_cat}'");
    if ($check > 0) return true;
    return false;
}
function get_trademark_item($trademark_id)
{
    $trademark_item = db_fetch_row("SELECT * FROM `tbl_trademark_product` WHERE `id_trademark` = {$trademark_id}");
    return $trademark_item;
}
#search
function search_trademark($q, $option_search)
{
    $search_result = db_fetch_array("SELECT * FROM `tbl_trademark_product` WHERE `{$option_search}` = '{$q}'");
    return $search_result;
}
function get_list_page_trademark_by_search($q, $option_search, $page_start, $num_per_page)
{
    $list_page_trademark = db_fetch_array("SELECT * FROM `tbl_trademark_product` WHERE `{$option_search}` = '{$q}' LIMIT {$page_start},{$num_per_page}");
    return $list_page_trademark;
}
# get list seatch history
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
# get list trademark by product cat id
function get_list_trademark_by_product_id($product_cate_id)
{
    $list_trademark = db_fetch_array("SELECT * FROM `tbl_trademark_product` WHERE `id_cat_product` = {$product_cate_id}");
    return $list_trademark;
}
function get_trademark_item_by_name($q)
{
    $trademark_item = db_fetch_row("SELECT * FROM `tbl_trademark_product` WHERE `name_trademark` = '{$q}'");
    return $trademark_item;
}
// =======
// PRODUCT
// =======

function num_product_by_trademark_id($trademark_id)
{
    $list_product = db_fetch_array("SELECT * FROM `tbl_products` WHERE `trademark_product` = {$trademark_id}");
    return $list_product;
}
#get list product by trademark
function get_list_product_by_id_trademark($trademark_id)
{
    $list_product = db_fetch_array("SELECT * FROM `tbl_products` WHERE `trademark_product` = {$trademark_id}");
    return $list_product;
}
#check code product exists
function check_code_product_exists($code_product)
{
    $check = db_num_rows("SELECT * FROM `tbl_products` WHERE `code_product` = '{$code_product}' ");
    if ($check > 0) return true;
    return false;
}
#upload img relative product
function upload_file_relative_img_product($data)
{
    db_insert("tbl_img_relative_product", $data);
}
#add products
function add_product($data)
{
    // insert products
    $data_product = array(
        "name_product"      => $data['name_product'],
        "code_product"      => $data['code_product'],
        "price_product"     => $data['price_product'],
        "price_old_product" => $data['price_old_product'],
        "qty_product"       => $data['qty_product'],
        "avatar_product"    => $data['avatar_product'],
        "desc_product"      => $data['desc_product'],
        "content_product"   => $data['content_product'],
        "id_cat_product"    => $data['id_cat_product'],
        "trademark_product" => $data['trademark_product'],
        "status"            => $data['status'],
        "created_date"      => $data['created_date'],
        "creator"           => $data['creator']
    );
    $id_product = db_insert("tbl_products", $data_product);

    // insert img relative
    $list_relative_products = $data['arr_img_relative'];
    foreach ($list_relative_products as $key => $value) {
        $data_img = array(
            "name_img_relative"   => $value,
            "id_relative_product" => $id_product
        );
        add_relative_img($data_img);
    }

    // insert info detail
    $list_info_detail_product = $data['list_info_detail'];
    foreach ($list_info_detail_product as $key => $value) {
        $data_info = array(
            "name_detail"  => $key,
            "value_detail" => $value,
            "id_relative_product" => $id_product
        );
        add_info_detail_relative_product($data_info);
    }
}
# add relative img
function add_relative_img($data)
{
    db_insert("tbl_img_relative_product", $data);
}
# add info detail relative products
function add_info_detail_relative_product($data)
{
    db_insert("tbl_data_detail_product", $data);
}
#get list products by products cat
function  get_list_products_by_id_products_cat($id_products_cat)
{
    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `id_cat_product` = {$id_products_cat}");
    return $result;
}
#get list products by status
function get_list_products_by_status($status)
{
    if ($status == "all") {
        $list_products = db_fetch_array("SELECT * FROM `tbl_products`");
    } else if ($status == "all_not_trash") {
        $list_products = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` != 'trash'");
    } else {
        $list_products = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = '{$status}'");
    }
    return $list_products;
}
#get page products by pagination
function get_list_page_products_by_pagination($start, $num_per_page, $status, $id_products_cat)
{
    if ($id_products_cat != null) {
        $list_products = db_fetch_array("SELECT * FROM `tbl_products` WHERE `id_cat_product` = {$id_products_cat} LIMIT {$start},{$num_per_page}");
    } else {
        if ($status == 'all') {
            $list_products = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'pending' OR `status` = 'publish' LIMIT {$start},{$num_per_page}");
        } else {
            $list_products = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = '{$status}' LIMIT {$start},{$num_per_page}");
        }
    }
    return $list_products;
};
#get page products by pagination
function get_list_page_products_by_trademark($start, $num_per_page, $status, $data_id)
{
    if ($data_id != null) {
        $list_products = db_fetch_array("SELECT * FROM `tbl_products` WHERE `trademark_product` = {$data_id} LIMIT {$start},{$num_per_page}");
    } else {
        if ($status == 'all') {
            $list_products = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'pending' OR `status` = 'publish' LIMIT {$start},{$num_per_page}");
        } else {
            $list_products = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = '{$status}' LIMIT {$start},{$num_per_page}");
        }
    }
    return $list_products;
};
#get products item by id
function get_product_item_by_id($product_id)
{
    $product_item = db_fetch_row("SELECT * FROM `tbl_products` WHERE `id_product` = {$product_id}");
    return $product_item;
}
#get list info detail
function get_list_info_detail($product_id)
{
    $list_info = db_fetch_array("SELECT * FROM `tbl_data_detail_product` WHERE `id_relative_product` = {$product_id}");
    return $list_info;
}
#get list relative img
function get_list_relative_img($product_id)
{
    $list_img = db_fetch_array("SELECT * FROM `tbl_img_relative_product` WHERE `id_relative_product` = {$product_id}");
    return $list_img;
}
#delete img item relative 
function delete_img_relative_products($id_img)
{
    $process = db_delete("tbl_img_relative_product", "`id_img_relative` = {$id_img}");
    return $process;
}
#rename relative img
function rename_relative_img($id_change, $tbl, $target_file)
{
    if ($tbl == 'tbl_products') {
        $data = array(
            "avatar_product" => $target_file
        );
        $process = db_update($tbl, $data, "`id_product` = {$id_change}");
        return $process;
    } else {
        $data = array(
            "name_img_relative" => $target_file
        );
        $process = db_update($tbl, $data, "`id_img_relative` = {$id_change}");
        return $process;
    }
}
#update img products
function update_img_new($data_id, $type_image, $src_img_new)
{
    if ($type_image == 'avatar') {
        $data = array(
            "avatar_product" => $src_img_new
        );
        $process = db_update("tbl_products", $data, "`id_product` = {$data_id}");
    } else {
        $data = array(
            "name_img_relative" => $src_img_new
        );
        $process = db_update("tbl_img_relative_product", $data, "`id_img_relative` = {$data_id}");
    }
    return $process;
}
#update total info products
function update_products($data, $product_id)
{
    db_update("tbl_products", $data, "`id_product` = {$product_id}");
}
#update detail info products
function update_detail_info_product($product_id, $list_info_detail)
{
    $process = db_delete("tbl_data_detail_product", "`id_relative_product`={$product_id}");
    if ($process == true) {
        foreach ($list_info_detail as $key => $value) {
            $data_info = array(
                "name_detail"  => $key,
                "value_detail" => $value,
                "id_relative_product" => $product_id
            );
            db_insert("tbl_data_detail_product", $data_info);
        }
    }
}
#delete products item
function delete_product_item($data_id)
{
    $process = db_delete("tbl_products", "`id_product` = {$data_id}");
    delete_total_relative_img($data_id);
    delete_info_detail_product($data_id);
    return $process;
}
#delete total relative products
function delete_total_relative_img($data_id)
{
    db_delete("tbl_img_relative_product", "`id_relative_product` = {$data_id}");
}
#delete total info detail products
function delete_info_detail_product($data_id)
{
    db_delete("tbl_data_detail_product", "`id_relative_product` = {$data_id}");
}
#update status product
function update_status_product($data, $id_product)
{
    $process = db_update("tbl_products", $data, "`id_product`={$id_product}");
    return $process;
}

// search
# search product
function search_product($q, $option_search, $status_curr)
{
    if ($status_curr == 'all') {
        $search_result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `{$option_search}` LIKE '%{$q}%'");
    } else {
        $search_result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = '{$status_curr}' AND `{$option_search}` LIKE '%{$q}%'");
    }
    return $search_result;
}
#get list page by search
function get_list_page_products_by_search($q, $option_search, $start, $num_per_page, $status_curr)
{
    if ($status_curr == 'all') {
        $list_products = db_fetch_array("SELECT * FROM `tbl_products` WHERE `$option_search` LIKE '%{$q}%' LIMIT {$start},{$num_per_page}");
    } else {
        $list_products = db_fetch_array("SELECT * FROM `tbl_products` WHERE `$option_search` LIKE '%{$q}%' AND `status` = '{$status_curr}' LIMIT {$start},{$num_per_page}");
    }
    return $list_products;
}
