<?php
// header
function getListPostsCatByStytus($status)
{
    $listPostsCat = db_fetch_array("SELECT * FROM `tbl_postcat` WHERE `status` = '{$status}'");
    return $listPostsCat;
}
// sidebar
function getAdvtItemByStutus($status)
{
    $listAdvt = db_fetch_array("SELECT * FROM `tbl_advt` WHERE `status` = '{$status}'");
    if (!empty($listAdvt)) {
        $timeStartMin = (int) strtotime($listAdvt[0]['start_time']);
        $advtItem = $listAdvt[0];
        foreach ($listAdvt as $item) {
            if ((int) strtotime($item['start_time']) < $timeStartMin) {
                $timeStartMin = (int) strtotime($item['start_time']);
                $advtItem     = $item;
            }
        }
        return $advtItem;
    }
}

#get list product cat by status 
function getListProductCatByStatus($status)
{
    $listProductCat = db_fetch_array("SELECT * FROM `tbl_productcat` WHERE `status` = '{$status}'");
    return $listProductCat;
}
#get list trademark by id product cat
function getListTradeMarkByIdProductCat($dataId)
{
    $listTradeMark = db_fetch_array("SELECT * FROM `tbl_trademark_product` WHERE `id_cat_product` = {$dataId}");
    return $listTradeMark;
}
#get list total trademark
function getListTradeMark()
{
    $listTradeMark = db_fetch_array("SELECT * FROM `tbl_trademark_product`");
    return $listTradeMark;
}
#get list product hot
function getListProductHot() {
    $listProd = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'publish'");
    if(!empty($listProd)) {
        $listProdTemp = array();
        $g = 0;
        for($i=0 ; $i<count($listProd)-1 ; $i++) {
            for($j=0 ; $j<count($listProd) ; $j++) {
                if($listProd[$i]['numPurchases'] < $listProd[$j]['numPurchases']) {
                    $listProdTemp[$g] = $listProd[$i];
                    $listProd[$i]     = $listProd[$j];
                    $listProd[$j]     = $listProdTemp[$g];
                }
            }
        }
        $listProdHot = array();
        for($i=0 ; $i<8 ; $i++) {
            $listProdHot[$i] = $listProd[$i];
        }
    } else {
        $listProdHot = array();
    }
    
    return $listProdHot;
}