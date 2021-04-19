<?php
function checkProdCat($q)
{
    $num = db_num_rows("SELECT * FROM `tbl_productcat` WHERE `status` = 'publish' AND `name_productCat` LIKE '%{$q}%'");
    if ($num > 0) return true;
    return false;
}

function checkTradeMark($q)
{
    $num = db_num_rows("SELECT * FROM `tbl_trademark_product` WHERE `name_trademark` LIKE '%{$q}%'");
    if ($num > 0) return true;
    return false;
}

function checkProduct($q)
{
    $num = db_num_rows("SELECT * FROM `tbl_products` WHERE `status` = 'publish' AND `name_product` LIKE '%{$q}'");
    if ($num > 0) return true;
    return false;
}

function search($keyWordType)
{
    if($keyWordType['type'] == "prodCat") {
        $prodCatItem = db_fetch_row("SELECT * FROM `tbl_productcat` WHERE `status` = 'publish' AND `name_productCat` LIKE '%{$keyWordType['q']}%'");
        $idProdCat = $prodCatItem['id_productCat'];
        $searchResult = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'publish' AND `id_cat_product` = {$idProdCat}");
    } else if ($keyWordType['type'] == "tradeMark") {
        $tradeMarkItem = db_fetch_row("SELECT * FROM `tbl_trademark_product` WHERE `name_trademark` LIKE '%{$keyWordType['q']}%'");
        $idTradeMark = $tradeMarkItem['id_trademark'];
        $searchResult = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'publish' AND `trademark_product` = {$idTradeMark}");
    } else {
        $searchResult = db_fetch_array("SELECT * FROM `tbl_products` WHERE `status` = 'publish' AND `name_product` LIKE '%{$keyWordType['q']}%'");
    }
    return $searchResult;
}

function spellCheck($keyWordType,$q)
{
    if($keyWordType['type'] == "prodCat") {
        $prodCatItem = db_fetch_row("SELECT * FROM `tbl_productcat` WHERE `status` = 'publish' AND `name_productCat` LIKE '%{$keyWordType['q']}%'");
        if($prodCatItem['name_productCat'] != $q) {
            $resultCheck = array(
                "check"     => 0,
                "rightWord" => "Danh mục " . $prodCatItem['name_productCat']
            );
        } else {
            $resultCheck = array(
                "check"     => 1,
            );
        }
    } else if ($keyWordType['type'] == "tradeMark") {
        $tradeMarkItem = db_fetch_row("SELECT * FROM `tbl_trademark_product` WHERE `name_trademark` LIKE '%{$keyWordType['q']}%'");
        if($tradeMarkItem['name_trademark'] != $q) {
            $resultCheck = array(
                "check"     => 0,
                "rightWord" => "Thương hiệu ". $tradeMarkItem['name_trademark']
            );
        } else {
            $resultCheck = array(
                "check"     => 1,
            );
        }
    } else {
        $resultCheck = array(
            "check"     => 1,
            "rightWord" => $q
        );
    }
    return $resultCheck;
}