<?php

// ============================= //
// ========== SLIDERS ========== //
// ============================= //
#get list slider by status
function getListSliderByStaTus($status) {
    $listSlider = db_fetch_array("SELECT * FROM `tbl_sliders` WHERE `status` = '{$status}' ORDER BY `numerical_order` ASC");
    return $listSlider;
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
?>