<?php
// ======================= //
// ======= PRODUCT ======= //
// ======================= //
#get product item by id
function getProductItemById($dataId)
{
    $prodItem = db_fetch_row("SELECT * FROM `tbl_products` WHERE `id_product` = {$dataId}");
    return $prodItem;

}
#get list product by id product cat
function getListProductByIdProductCat($dataId)
{
    $listProduct = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'publish' AND `id_cat_product` = {$dataId}");
    return $listProduct;
}
#get list product by status
function getListProductByStatus($status)
{
    $listProduct = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'publish' AND `status` = '{$status}'");
    return $listProduct;
}
#get list product by id trade mark
function getListProductIdTrademark($dataId)
{
    $listProduct = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'publish' AND  `trademark_product` = {$dataId}");
    return $listProduct;
}
#get list product by pagination
function getListProductByPagination($pageStart, $numPerPage, $paginationBy, $dataId)
{
    if ($paginationBy == "status") {
        $listProduct = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = '{$dataId}' LIMIT {$pageStart},{$numPerPage}");
    } else {
        $listProduct = db_fetch_array("SELECT * FROM `tbl_products` WHERE `{$paginationBy}` = {$dataId}  AND `status` = 'publish' LIMIT {$pageStart},{$numPerPage}");
    }
    return $listProduct;
}
#get list product by price
function getListProductByPrice($priceValueMin, $priceValueMax, $typeField, $dataId)
{
    $maxPrice = db_fetch_row("SELECT MAX(`price_product`) AS `maxPrice` FROM `tbl_products` WHERE `status` = 'publish'");
    if ($priceValueMax == 0) {
        $priceValueMax = $maxPrice['maxPrice'];
    }
    $listProduct = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'publish' AND `{$typeField}` = {$dataId} AND `price_product` >= {$priceValueMin} AND `price_product` <= {$priceValueMax}");
    return $listProduct;
}
#get list product pagination by price
function getListProductPaginationByPrice($pageStart, $numPerPage,$priceValueMin, $priceValueMax, $typeField, $dataId)
{
    $maxPrice = db_fetch_row("SELECT MAX(`price_product`) AS `maxPrice` FROM `tbl_products` WHERE `status` = 'publish'");
    if ($priceValueMax == 0) {
        $priceValueMax = $maxPrice['maxPrice'];
    }
    $listProduct = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'publish' AND `{$typeField}` = {$dataId} AND `price_product` >= {$priceValueMin} AND `price_product` <= {$priceValueMax} LIMIT {$pageStart},{$numPerPage}");
    return $listProduct;
}
#get list product by trademark 
function getListProductByTradeMark($typeField, $idTradeMark)
{
    $listProduct = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'publish' AND `$typeField` = {$idTradeMark}");
    return $listProduct;   
}
#get list product pagination by trademark 
function getListProductPaginationByTradeMark($pageStart, $numPerPage,$typeField, $idTradeMark)
{
    $listProduct = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'publish' AND `$typeField` = {$idTradeMark} LIMIT {$pageStart},{$numPerPage}");
    return $listProduct;   
}
#get list product by price and trademark
function getListProductByPriceAndTradeMark($priceValueMin, $priceValueMax, $typeField, $idTradeMark)
{
    $maxPrice = db_fetch_row("SELECT MAX(`price_product`) AS `maxPrice` FROM `tbl_products` WHERE `status` = 'publish'");
    if ($priceValueMax == 0) {
        $priceValueMax = $maxPrice['maxPrice'];
    }
    $listProduct = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'publish' AND `$typeField` = {$idTradeMark} AND `price_product` >= {$priceValueMin} AND `price_product` <= {$priceValueMax}");
    return $listProduct;
}
#get list product pagination by price and trademark
function getListProductPaginationByPriceAndTradeMark($pageStart, $numPerPage, $priceValueMin, $priceValueMax, $typeField, $idTradeMark)
{
    $maxPrice = db_fetch_row("SELECT MAX(`price_product`) AS `maxPrice` FROM `tbl_products` WHERE `status` = 'publish'");
    if ($priceValueMax == 0) {
        $priceValueMax = $maxPrice['maxPrice'];
    }
    $listProduct = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'publish' AND `$typeField` = {$idTradeMark} AND `price_product` >= {$priceValueMin} AND `price_product` <= {$priceValueMax} LIMIT {$pageStart},{$numPerPage}");
    return $listProduct;
}

#get list img relative by id product
function getListImgRelativeByIdProduct($dataId)
{
    $listImgRelative = db_fetch_array("SELECT * FROM `tbl_img_relative_product` WHERE `id_relative_product` = {$dataId}");
    return $listImgRelative;
}
#get list detail info by id product
function getListInfoDetailByIdProd($dataId)
{
    $listInfoDetail = db_fetch_array("SELECT * FROM `tbl_data_detail_product` WHERE `id_relative_product` = {$dataId}");
    return $listInfoDetail;
}
#get list trelative product by id product cate
function getListRelativeProdByIdProdCate($dataId,$id){
    $listProductRelative = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'publish' AND `id_cat_product` = {$dataId} AND NOT `id_product` = {$id}");
    return $listProductRelative;
}
// ========================= //
// ====== PRODUCT CAT ====== //
// ========================= //
function getProductCatItemById($DataId)
{
    $productCatItem = db_fetch_row("SELECT * FROM `tbl_productcat` WHERE `id_productCat`={$DataId}");
    return $productCatItem;
}

// ========================= //
// ======= TRADEMARK ======= //
// ========================= //
function getTradeMarkItemById($DataId)
{
    $trademarkItem = db_fetch_row("SELECT * FROM `tbl_trademark_product` WHERE `id_trademark` = {$DataId}");
    return $trademarkItem;
}
