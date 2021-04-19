<?php
function construct()
{
    load_model('index');
}

// load index view

function indexAction()
{
    // unset($_SESSION['cart']);
    load('helper','format');
    $listSlider           = getListSliderByStaTus("publish");
    $listProductCat       = getListProductCatByStatus("publish");
    $listProduct          = getListProductByStatus("publish");
    if(!empty($listProduct)) {
        $listProductFeature   = getListProductFeature($listProduct);
    } else {
        $listProductFeature = array();
    }
    $dataSendView = array(
        "listSlider"          => $listSlider,
        "listProductCat"      => $listProductCat,
        "listProductFeature"  => $listProductFeature
    );
    load_view('index', $dataSendView);
}
function getListProductFeature($listProduct)
{
    $listProductNew = array();
    $g = 0;
    for($i=0 ; $i<count($listProduct) - 1 ; $i++) {
        for($j=$i+1 ; $j<count($listProduct) ; $j++) {
            if($listProduct[$i]['created_date'] < $listProduct[$j]['created_date']) {
                $listProductNew[$g] = $listProduct[$i];
                $listProduct[$i]    = $listProduct[$j];
                $listProduct[$j]    = $listProductNew[$g];
                $g ++;
            }
        }
    }
    $listProductFeature = array();
    for($i=0 ; $i<10 ; $i++) {
        $listProductFeature[$i] = $listProduct[$i];
    }
    return $listProductFeature;
}