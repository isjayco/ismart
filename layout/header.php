<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo base_url() ?>">
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />
    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
    <script src="public/js/app.js" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="?" title="">Trang chủ</a>
                                </li>
                                <?php
                                $listPostsCat = getListPostsCatByStytus("publish");
                                if (!empty($listPostsCat)) {
                                    foreach ($listPostsCat as $postCatItem) {
                                ?>
                                        <li>
                                            <a href="bai-viet/<?php echo create_slug($postCatItem['name_postCat']) ?>/danh-sach-<?php echo $postCatItem['id_postCat'] ?>.html"><?php echo $postCatItem['name_postCat'] ?></a>
                                        </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="?" title="" id="logo" class="fl-left"><img src="public/images/logo.png" /></a>
                        <div id="search-wp" class="fl-left">
                            <form class="form-search" method="GET">
                                <input type="text" name="q" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!" autocomplete="off" spellcheck="false">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <a href="tel:0385763717" id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0987.654.321</span>
                            </a>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">2</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <a href="?mod=cart" style="color: #fff" id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <?php
                                        if(!empty($_SESSION['cart'])) {
                                            ?>
                                                <span id="num"><?php echo $_SESSION['cart']['info']['numOrder'] ?></span>
                                            <?php 
                                        }
                                    ?>
                                </a>
                                <div id="dropdown">
                                <?php
                                if(!empty($_SESSION['cart'])){
                                ?>
                                    <p class="desc">Có <span>( <?php echo $_SESSION['cart']['info']['numOrder'] ?> )</span> sản phẩm trong giỏ hàng</p>
                                    <ul class="list-cart">
                                        <?php
                                        foreach($_SESSION['cart']['buy'] as $cartItem){
                                            $cartItem['avatar_product'] = "admin/".$cartItem['avatar_product'];
                                            $cartItem['url']            = "?mod=products&action=detail&id={$cartItem['id_product']}";
                                        ?>
                                        <li class="clearfix">
                                            <a href="<?php echo $cartItem['url'] ?>" title="" class="thumb fl-left">
                                                <img src="<?php echo $cartItem['avatar_product'] ?>" alt="">
                                            </a>
                                            <div class="info fl-right">
                                                <a href="" title="" class="product-name"><?php echo $cartItem['name_product'] ?></a>
                                                <p class="price"><?php echo currency_format($cartItem['price_product']) ?></p>
                                                <p class="qty">Số lượng: <span><?php echo $cartItem['qty_product'] ?></span></p>
                                            </div>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">Tổng:</p>
                                        <p class="price fl-right"><?php echo currency_format($_SESSION['cart']['info']['total']); ?></p>
                                    </div>
                                    <dic class="action-cart clearfix">
                                        <a href="gio-hang" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                        <a href="thanh-toan" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                    </dic>
                                    <?php
                                    } else {
                                        ?>
                                            <p style="color: #888787;text-align: center;">Giỏ hàng trống ..!</p>
                                        <?php 
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            