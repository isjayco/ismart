<?php
function construct()
{
    load_model('index');
}

// index
function indexAction()
{

}

// detail product
function detailAction()
{
    load('helper','format');
    $id                  = $_GET['id'];
    $productItem         = getProductItemById($id);
    $listImgRelative     = getListImgRelativeByIdProduct($id);
    $listInfoDetailProd  = getListInfoDetailByIdProd($id);
    $litsProductRelative = getListRelativeProdByIdProdCate($productItem['id_cat_product'],$id);
    $data['productItem'] = $productItem;
    $data = array(
        "productItem"         => $productItem, 
        "listImgRelativeProd" => $listImgRelative,
        "listInfoDetailProd"  => $listInfoDetailProd,
        "litsProductRelative" => $litsProductRelative
    );
    load_view('detail',$data);
}

// category
function categoryAction()
{
    load('helper', 'format');
    $type = $_GET['type'];
    $id   = (int) !empty($_GET['id']) ? $_GET['id'] : 0;
    $numPerPage     = 16;
    if ($type == "productCate") {
        $paginationBy   = "id_cat_product";
        $listProduct    = getListProductByPagination(0, $numPerPage, $paginationBy, $id);    
        $productCatItem = getProductCatItemById($id);
        $dataSendView['nameCategory'] =  ucfirst($productCatItem['name_productCat']);
        $dataSendView['message']      = "<span style='font-weight: bold; border-bottom: 1px solid #333'>Danh mục {$productCatItem['name_productCat']}</span>";
        $dataSendView['modules']      = "categoryProdByCate";
    } else {
        $paginationBy   = "trademark_product";
        $listProduct    = getListProductByPagination(0, $numPerPage, $paginationBy, $id);
        $tradeMarkItem  = getTradeMarkItemById($id);
        $dataSendView['nameCategory'] =  ucfirst($tradeMarkItem['name_trademark']);
        $dataSendView['message']      = "<span style='font-weight: bold; border-bottom: 1px solid #333'>Thuộc thương hiệu {$tradeMarkItem['name_trademark']}</span>";
        $dataSendView['modules']      = "categoryProdByTradeMark";
    }
    $dataSendView['id']          = $id;
    $dataSendView['totalProd']   = count(getListProductByStatus("publish"));
    $dataSendView['numPerPage']  = $numPerPage;
    $dataSendView['listProduct'] = $listProduct;
    load_view('category', $dataSendView);
}


// ==== AJAX  ==== //
// get total page
// ==== AJAX  ==== //
// get total page
function getTotalPageAction()
{
    $type        = $_GET['type'];
    $dataId      = $_GET['id'];
    $numPerPage  = $_POST['numPerPage'];
    $totalValue  = $_POST['totalValue'];
    // action get total 
    if( is_array($totalValue) ) {
        $data['arr'] = $totalValue[6];
        $data['type'] = $totalValue[0];
        if ($totalValue[6] == "filter") {
            $data['action'] = "filter";
            if ( $totalValue[4] == "price" ) {
                $priceValueMin = (int) $totalValue[1];
                $priceValueMax = (int) $totalValue[2];
                $typeField     = $totalValue[0]; 
                $listProduct   = getListProductByPrice($priceValueMin, $priceValueMax, $typeField, (int) $dataId);
            } else if ( $totalValue[4] == "trademark" ) { 
                $idTradeMark   = (int) $totalValue[3];
                $typeField   = "trademark_product";
                $listProduct   = getListProductByTradeMark($typeField, $idTradeMark);
            } else {
                $idTradeMark   = (int) $totalValue[3];
                $priceValueMin = (int) $totalValue[1];
                $priceValueMax = (int) $totalValue[2];
                if ($idTradeMark == 0) {
                    $idTradeMark = (int) $dataId;
                    $typeField   = "id_cat_product";
                } else {
                    $idTradeMark = $idTradeMark;
                    $typeField   = "trademark_product";
                }
                $listProduct = getListProductByPriceAndTradeMark($priceValueMin, $priceValueMax, $typeField, $idTradeMark);
            }
        } else {
            // sort
        }
    } else {
        if ($type == "category") {
            $listProduct   = getListProductByIdProductCat($dataId);
        } else {
            $listProduct   = getListProductIdTrademark($dataId);
        }
    }
    
    $totalPage           = count($listProduct) / $numPerPage;
    $data['totalPage']   = ceil($totalPage);
    $data['numProd']     = count($listProduct);
    $data['listProduct'] = $listProduct;
    echo json_encode($data);
}

// load Data Page
function loadDataPageAction()
{
    load('helper','format');
    $type        = $_GET['type'];
    $dataId      = $_GET['id'];
    $numPerPage    = $_POST['numPerPage'];
    $currentPage   = $_POST['currentPage'];
    $pageStart     = (int) ($currentPage - 1) * $numPerPage;
    $totalValue    = $_POST['totalValue'];
    if ( is_array($totalValue) ) {
        $data['arr'] = $totalValue[6];
        $data['type'] = $totalValue[0];
        if ($totalValue[6] == "filter") {
            $data['action'] = "filter";
            if ( $totalValue[4] == "price" ) {
                $priceValueMin = (int) $totalValue[1];
                $priceValueMax = (int) $totalValue[2];
                $typeField     = $totalValue[0]; 
                $listProduct   = getListProductPaginationByPrice($pageStart, $numPerPage,$priceValueMin, $priceValueMax, $typeField, (int) $dataId);
            } else if ( $totalValue[4] == "trademark" ) { 
                $idTradeMark   = (int) $totalValue[3];
                $typeField   = "trademark_product";
                $listProduct   = getListProductPaginationByTradeMark($pageStart, $numPerPage,$typeField, $idTradeMark);
            } else {
                $idTradeMark   = (int) $totalValue[3];
                $priceValueMin = (int) $totalValue[1];
                $priceValueMax = (int) $totalValue[2];
                if ($idTradeMark == 0) {
                    $idTradeMark = (int) $dataId;
                    $typeField   = "id_cat_product";
                } else {
                    $idTradeMark = $idTradeMark;
                    $typeField   = "trademark_product";
                }
                $listProduct = getListProductPaginationByPriceAndTradeMark($pageStart, $numPerPage, $priceValueMin, $priceValueMax, $typeField, $idTradeMark);
            }
        } else {
            $data['action'] = "sort";
            $listProduct = $_POST['listProd'];
            if(!empty($listProduct)) {
                $sortBy = $totalValue[5];
                $data['sortBy'] = (int) $sortBy;
                if ( $sortBy == 0 ) {
                    
                } else if ( $sortBy == 1 ) {
                    @rsort($listProduct);
                } else if ( $sortBy == 2 ) {
                    @sort($listProduct);
                } else if ( $sortBy == 3 ) {
                    for ( $i = 0 ; $i < count($listProduct) - 1 ; $i ++ ) {
                        for ( $j = $i + 1 ; $j < count($listProduct) ; $j ++) {
                            if( $listProduct[$i]['price_product'] < $listProduct[$j]['price_product'] ) {
                                $temp = array();
                                $temp = $listProduct[$i]; 
                                $listProduct[$i] = $listProduct[$j];
                                $listProduct[$j] = $temp;
                            }
                        }
                    }
                } else {
                    for ( $i = 0 ; $i < count($listProduct) - 1 ; $i ++ ) {
                        for ( $j = $i + 1 ; $j < count($listProduct) ; $j ++) {
                            if( $listProduct[$i]['price_product'] > $listProduct[$j]['price_product'] ) {
                                $temp = array();
                                $temp = $listProduct[$i]; 
                                $listProduct[$i] = $listProduct[$j];
                                $listProduct[$j] = $temp;
                            }
                        }
                    }
                }
            }
        }
    } else {
        if ($type == "category") {
            $listProduct = getListProductByPagination($pageStart, $numPerPage, "id_cat_product", $dataId);
        } else {
            $listProduct = getListProductByPagination($pageStart, $numPerPage, "trademark_product", $dataId);
        }
    }
    if (!empty($listProduct)) {
    ?>
        <ul class="list-item clearfix">
        <?php
        foreach($listProduct as $prodItem) {
            $prodItem['avatar_product'] = "admin/" . $prodItem['avatar_product'];
        ?>
            <li>
                <a href="" title="" class="thumb">
                    <img src="<?php echo $prodItem['avatar_product']; ?>">
                </a>
                <a href="" title="" class="product-name"><?php echo $prodItem['name_product']; ?></a>
                <div class="price">
                    <span class="new"><?php echo currency_format($prodItem['price_product']); ?></span>
                    <span class="old"><?php echo !empty($prodItem['price_old_product']) ? currency_format($prodItem['price_old_product']) : "" ?></span>
                </div>
                <div class="action clearfix">
                    <a href="" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                    <a href="" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                </div>
            </li>
        <?php
        }
        ?>      
        </ul>
    <?php
    } else {
        ?>
        <span style="font-size: 1.2rem;color: #737070;">Hiện tại không tìm thấy sản phẩm nào ? </span>
        <?php 
    }
}
