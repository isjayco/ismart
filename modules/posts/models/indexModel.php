<?php

// ===== POST CAT ===== //
#get post cat item by id
function getPostCatItemById($dataId)
{
    $postCatItem = db_fetch_row("SELECT * FROM `tbl_postcat` WHERE `id_postCat` = {$dataId}");
    return $postCatItem;
}
#get list posts cat by status

// ===== POSTS ===== //
#get post item post by id
function getPostsItemById($dataId)
{
    $postItem = db_fetch_row("SELECT * FROM `tbl_posts` WHERE `post_id` = {$dataId}");
    return $postItem;
}
#get list post by id post cat
function getListPostsByIdPostCat($dataId)
{
    $listPost = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `post_cat_id` = {$dataId}");
    return $listPost;
}
#get list posts by status
function getListPostsByStatus($status)
{
    $listPostsCat = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `status` = '{$status}'");
    return $listPostsCat;
}
#get list post by pagination
function getListPostsByPagination($pageStart, $numPerPage,$dataId = null) 
{
    if ( $dataId != null ) {
        $listPost = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `status` = 'publish' AND `post_cat_id` = {$dataId} LIMIT {$pageStart},{$numPerPage}");
    } else {
        $listPost = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `status` = 'publish' LIMIT {$pageStart},{$numPerPage}");
    }
    return $listPost;
}

function getListPostsByPostCatId($dataId)
{
    $listPost = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `status` = 'publish' AND `post_cat_id` = {$dataId}");
    return $listPost;
}