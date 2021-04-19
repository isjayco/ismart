$(document).ready(function () {
    // setting defaults
    var defaults = {
        placeAppenPagination : ".pagination"
    }

    var placeAppenPagination = $(defaults.placeAppenPagination);

    // ================================== //
    // =========== PAGINATION =========== //
    // ================================== //

    // pagination reneral
    var paginationReneral = {
        currentPage : 1,
        dataIdPage  : 1,
        btnNext     : "a.page-link[data-page='next']",
        btnPrev     : "a.page-link[data-page='prev']",
        btnItem     : "a.page-link[data-page='normal']"  
    }

    // pagination posts
    var paginationPosts = {
        wrapperPagination : "ul.pagination[data-modules='posts']",
        numPerPage        : 6,
        totalPage         : 0,
        dataId            : "#main-content-wp[data-id]",
        totalValue        : new Array(),
        getTotalPageURL   : "?mod=posts&action=getTotalPage",
        loadDataPageURL   : "?mod=posts&action=loadDataPage",
        placeAppend       : ".section-detail[data-modules='posts']"
    }
    // pagination prod
    var paginationProd = {
        wrapperPagination : "ul.pagination[data-modules='categoryProdByCate']",
        numPerPage        : 16,
        totalPage         : 0,
        totalValue        : new Array(),
        getTotalPageURL   : "?mod=products&action=getTotalPage&type=category&id="+($("#main-content-wp[data-id_modules]").attr('data-id_modules'))+"",
        loadDataPageURL   : "?mod=products&action=loadDataPage&type=category&id="+($("#main-content-wp[data-id_modules]").attr('data-id_modules'))+"",
        placeAppend       : ".section-detail[data-modules='category']"
    }

    // pagination trademark
    var paginationTradeMark = {
        wrapperPagination : "ul.pagination[data-modules='categoryProdByTradeMark']",
        numPerPage        : 16,
        totalPage         : 0,
        totalValue        : new Array(),
        getTotalPageURL   : "?mod=products&action=getTotalPage&type=trademark&id="+($("#main-content-wp[data-id_modules]").attr('data-id_modules'))+"",
        loadDataPageURL   : "?mod=products&action=loadDataPage&type=trademark&id="+($("#main-content-wp[data-id_modules]").attr('data-id_modules'))+"",
        placeAppend       : ".section-detail[data-modules='category']"
    }

    // sort product
    var sortProduct = {
        wrapper : "#main-content-wp",
        sortBy  : ".filter-wp .form-filter [name='select']",
    }

    var filterMultiProd = {
        wrapper           : "#main-content-wp",
        filterByPrice     : "table[data-filter='price'] tbody input[name='r-price']",
        priceValueMin     : 0,
        priceValueMax     : 0,
        tradeMarkValue    : 0,
        filterBy          : 0,
        listProd          : [],
        filterByTradeMark : "table[data-filter='tradeMark'] tbody input[name='r-brand']",
        modules           : "#main-content-wp[data-modules]"
    }

    $(window).load(function() {
        progress();
        scrollTop(1200);
    });
    var modules = $("#main-content-wp[data-modules]").attr('data-modules');
    init(modules);
    function init(modules) {
        console.log('init : ' + modules);
        if (modules === "posts"){
            infoPagination(paginationPosts);
        } else if (modules === "categoryProdByCate") {
            infoPagination(paginationProd);
        } else if (modules === "categoryProdByTradeMark") {
            infoPagination(paginationTradeMark);
        }
    }

    // load total info of pagination name 
    function infoPagination (paginationName) {
        if(modules === "posts") {
            var dataId = parseInt($(paginationName.dataId).attr('data-id'));
        } else {
            var dataId = null;
        }
        $.ajax({
            url        : paginationName.getTotalPageURL,
            method     : "POST",
            data       : {
                numPerPage  : paginationName.numPerPage,
                currentPage : paginationReneral.currentPage,
                dataId      : dataId,
                totalValue  : paginationName.totalValue.length == 0 ? "" : paginationName.totalValue,
                listProd    : filterMultiProd.listProd.length == 0 ? "empty" : filterMultiProd.listProd
            },
            beforeSend : () => {
                console.log('load total pagination ...');
            },
            dataType   : "json",
            success    : data => {
                filterMultiProd.listProd = data.listProduct;
                paginationName.totalPage = data.totalPage;
                loadBtnPagination(data.totalPage, paginationName);
            },
            error : (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }

    //== handling click btn next of pagination
    //== posts
    $(paginationPosts.wrapperPagination).delegate(paginationReneral.btnNext,'click',function () {
        clickButtonNext(paginationPosts);
        event.preventDefault();
    });

    //== prod
    $(paginationProd.wrapperPagination).delegate(paginationReneral.btnNext,'click',function () {
        clickButtonNext(paginationProd);
        event.preventDefault();
    });

    //== handling click btn prev of pagination
    //== posts
    $(paginationPosts.wrapperPagination).delegate(paginationReneral.btnPrev,'click',function () {
        clickButtonPrev(paginationPosts);
        event.preventDefault();
    });

    //== prod
    $(paginationProd.wrapperPagination).delegate(paginationReneral.btnPrev,'click',function () {
        clickButtonPrev(paginationProd);
        event.preventDefault();
    });

    //== handling click btn item of pagination
    //== posts
    $(paginationPosts.wrapperPagination).delegate(paginationReneral.btnItem,'click',function () {
        paginationReneral.currentPage = parseInt($(this).attr('data-page_number'));
        clickButtonItem(paginationPosts);
        event.preventDefault();
    });
    //== prod
    $(paginationProd.wrapperPagination).delegate(paginationReneral.btnItem,'click',function () {
        paginationReneral.currentPage = parseInt($(this).attr('data-page_number'));
        clickButtonItem(paginationProd);
        event.preventDefault();
    });

    // function handling click button
    // #click next
    function clickButtonNext(paginationName) {
        if (paginationReneral.currentPage < paginationName.totalPage) {
            paginationReneral.currentPage ++;
            loadBtnPagination(paginationName.totalPage, paginationName);
            loadDataPage(paginationName);
            // effect
            progress();
            scrollTop(1200);
        }
    }

    // #click prev
    function clickButtonPrev(paginationName) {
        if (paginationReneral.currentPage > 1) {
            paginationReneral.currentPage --;
            loadBtnPagination(paginationName.totalPage, paginationName);
            loadDataPage(paginationName);
            // effect
            progress();
            scrollTop(1200);
        }
    }

    // #click item
    function clickButtonItem(paginationName) {
        loadBtnPagination(paginationName.totalPage, paginationName);
        loadDataPage(paginationName);
        // effect
        progress();
        scrollTop(1200);
    }

    // load data page ( list page )
    function loadDataPage(paginationName) {
        var data = {};
        if(modules === "posts") {
            data = {
                currentPage : paginationReneral.currentPage,
                numPerPage  : paginationName.numPerPage,
                dataId      : parseInt($(paginationName.dataId).attr('data-id'))
            }
        } else {
            data = {
                currentPage : paginationReneral.currentPage,
                numPerPage  : paginationName.numPerPage,
                totalValue  : paginationName.totalValue.length == 0 ? "" : paginationName.totalValue,
                listProd    : filterMultiProd.listProd.length == 0 ? "empty" : filterMultiProd.listProd
            }
        }
        $.ajax({
            url    : paginationName.loadDataPageURL,
            method : "POST",
            data   : data,
            beforeSend : () => {
                console.log('loading data page ...');
            },
            dataType : "text",
            success : data => {
                $(paginationName.placeAppend).empty();
                $(paginationName.placeAppend).append(data);
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }

    // load btn pagination
    function loadBtnPagination(total_page, modules) {
        let active;
        let disablePrev;
        let disableNext;
        if (total_page > 0) {
            if (total_page >= 2) {
                var htmlBtnPage;
                if (paginationReneral.currentPage >= 2) {
                    disablePrev = '';
                } else {
                    disablePrev = 'disabled';
                };
                htmlBtnPage = "   <li class='page-item " + (disablePrev) + "'>\
                                        <a href='#' class='page-link shadow-none' data-page='prev' data-page_number='" + (paginationReneral.currentPage - 1) + "'>&laquo;</a>\
                                    </li>";
                if (total_page >= 7) {
                    // --------------------
                    if (paginationReneral.currentPage == total_page - 1 || paginationReneral.currentPage == total_page - 2 || paginationReneral.currentPage == total_page - 3 || paginationReneral.currentPage == total_page) {
                        for (i = 1; i <= 2; i++) {
                            active = '';
                            dataPage = 'normal';
                            link = "href='#'"
                            if (i == paginationReneral.currentPage) {
                                active = 'active'
                                dataPage = 'current';
                                link = '';
                            }
                            htmlBtnPage += "  <li class='page-item " + (active) + "'>\
                                                     <a " + (link) + " class='page-link shadow-none' data-page='" + (dataPage) + "' data-page_number='" + (i) + "'>" + (i) + "</a>\
                                                 </li>";
                        }
                        // ---------------------
                        htmlBtnPage += "<span class='page-more'>...</span>";
                        //  ---------------------
                        for (i = total_page - 3; i <= total_page; i++) {
                            active = '';
                            dataPage = 'normal';
                            link = "href='#'"
                            if (i == paginationReneral.currentPage) {
                                active = 'active'
                                dataPage = 'current';
                                link = '';
                            }
                            htmlBtnPage += "  <li class='page-item " + (active) + "'>\
                                                     <a " + (link) + " class='page-link shadow-none' data-page='" + (dataPage) + "' data-page_number='" + (i) + "'>" + (i) + "</a>\
                                                 </li>";
                        }
                    } else {
                        var list_item = new Array();
                        for (h = 3; h < total_page - 3; h++) {
                            list_item.push(h);
                        }
                        if ($.inArray(paginationReneral.currentPage, list_item)) {
                            for (i = paginationReneral.currentPage - 1; i <= paginationReneral.currentPage + 2; i++) {
                                if (i != 0) {
                                    active = '';
                                    dataPage = 'normal';
                                    link = "href='#'"
                                    if (i == paginationReneral.currentPage) {
                                        active = 'active'
                                        dataPage = 'current';
                                        link = '';
                                    }
                                    htmlBtnPage += "  <li class='page-item " + (active) + "'>\
                                                         <a " + (link) + " class='page-link shadow-none' data-page='" + (dataPage) + "' data-page_number='" + (i) + "'>" + (i) + "</a>\
                                                     </li>";
                                }
                            }
                            htmlBtnPage += "<span class='page-more'>...</span>";
                            for (i = total_page - 1; i <= total_page; i++) {
                                active = '';
                                dataPage = 'normal';
                                link = "href='#'"
                                if (i == paginationReneral.currentPage) {
                                    active = 'active'
                                    dataPage = 'current';
                                    link = '';
                                }
                                htmlBtnPage += "  <li class='page-item " + (active) + "'>\
                                                         <a " + (link) + " class='page-link shadow-none' data-page='" + (dataPage) + "' data-page_number='" + (i) + "'>" + (i) + "</a>\
                                                     </li>";
                            }
                        } else {
                            for (i = 1; i <= 4; i++) {
                                active = '';
                                dataPage = 'normal';
                                link = "href='#'"
                                if (i == paginationReneral.currentPage) {
                                    active = 'active'
                                    dataPage = 'current';
                                    link = '';
                                }
                                htmlBtnPage += "  <li class='page-item " + (active) + "'>\
                                                         <a " + (link) + " class='page-link shadow-none' data-page='" + (dataPage) + "' data-page_number='" + (i) + "'>" + (i) + "</a>\
                                                     </li>";
                            }
                            // ---------------------
                            htmlBtnPage += "<span class='page-more'>...</span>";
                            //  ---------------------
                            for (i = total_page - 1; i <= total_page; i++) {
                                active = '';
                                dataPage = 'normal';
                                link = "href='#'"
                                if (i == paginationReneral.currentPage) {
                                    active = 'active'
                                    dataPage = 'current';
                                    link = '';
                                }
                                htmlBtnPage += "  <li class='page-item " + (active) + "'>\
                                                         <a " + (link) + " class='page-link shadow-none' data-page='" + (dataPage) + "' data-page_number='" + (i) + "'>" + (i) + "</a>\
                                                     </li>";
                            }
                        }
                    }
                } else {
                    for (i = 1; i <= total_page; i++) {
                        active = '';
                        dataPage = 'normal';
                        link = "href='#'"
                        if (i == paginationReneral.currentPage) {
                            active = 'active'
                            dataPage = 'current';
                            link = '';
                        }
                        htmlBtnPage += "  <li class='page-item " + (active) + "'>\
                                                 <a " + (link) + " class='page-link shadow-none' data-page='" + (dataPage) + "' data-page_number='" + (i) + "'>" + (i) + "</a>\
                                             </li>";
                    }
                }
                if (paginationReneral.currentPage < total_page) {
                    disableNext = '';
                } else {
                    disableNext = 'disabled'
                }
                htmlBtnPage += "  <li class='page-item " + (disableNext) + "'>\
                                        <a href='#' class='page-link shadow-none' data-page='next' data-page_number='" + (paginationReneral.currentPage + 1) + "'>&raquo;</a>\
                                    </li>";
            } else {
                htmlBtnPage = "  <li class='page-item active'>\
                                        <a class='page-link shadow-none' data-page='current' data-page_number='1'>1</a>\
                                    </li>";
            }
        }
        placeAppenPagination.empty();
        placeAppenPagination.append(htmlBtnPage);
    }
    
    // progress
    function progress() {
        let _html = '<div class="progress">\
                        <div class="progress-bar"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>\
                    </div>'
        $("#main-content-wp").prepend(_html);
    }
    
    // scroll top
    function scrollTop(timing) {
        $('body,html').stop().animate({scrollTop: 0}, timing,function () {
            $(".progress").remove();
        });
    }

    // ======================= //
    // ========= SORT ======== //
    // ======================= //
    $(sortProduct.wrapper).delegate(sortProduct.sortBy,'change',function () {
        progress();
        scrollTop(1200);
        if(filterMultiProd.listProd.length != 0) {
            let sortBy = parseInt($(this).val());
            let filterBy = getFilterBy( filterMultiProd.priceValueMin == 0 && filterMultiProd.priceValueMax == 0 ? 0 : 1, filterMultiProd.priceValueMax);
            if (modules == "categoryProdByCate") {
                paginationProd.totalValue = getTotalValueFilter(filterMultiProd.priceValueMin, filterMultiProd.priceValueMax, filterMultiProd.tradeMarkValue, sortBy, filterBy, "sort");
                infoPagination(paginationProd);
                loadDataPage(paginationProd);
            } else {
                paginationTradeMark.totalValue = getTotalValueFilter(filterMultiProd.priceValueMin, filterMultiProd.priceValueMax, filterMultiProd.tradeMarkValue, sortBy, filterBy, "sort");
                infoPagination(paginationTradeMark);
                loadDataPage(paginationTradeMark);
            }
        }
    });

    // fillter multi
    $(filterMultiProd.wrapper).delegate(filterMultiProd.filterByPrice,'change',function () {
        progress();
        scrollTop(1200);
        let priceValue = $(this).val();
        let priceValueMin = parseInt(priceValue.slice(0,priceValue.indexOf('-')));
        let priceValueMax = parseInt(priceValue.slice(priceValue.indexOf('-') + 1,priceValue.length));
        filterMultiProd.priceValueMin = priceValueMin;
        filterMultiProd.priceValueMax = priceValueMax;
        if (modules == "categoryProdByCate") {
            let filterBy = getFilterBy( (priceValueMin == 0 && priceValueMax == 0) ? 0 : 1, filterMultiProd.tradeMarkValue);
            paginationProd.totalValue = getTotalValueFilter(priceValueMin, priceValueMax, filterMultiProd.tradeMarkValue, 0,filterBy);
            infoPagination(paginationProd);
            loadDataPage(paginationProd);
        } else {
            let filterBy = getFilterBy( (priceValueMin == 0 && priceValueMax == 0) ? 0 : 1, 0);
            paginationTradeMark.totalValue = getTotalValueFilter(priceValueMin, priceValueMax, 0, 0, filterBy);
            infoPagination(paginationTradeMark);
            loadDataPage(paginationTradeMark);
        }
    });

    // change trademark
    $(filterMultiProd.wrapper).delegate(filterMultiProd.filterByTradeMark,'change',function () {
        progress();
        scrollTop(1200);
        let tradeMarkValue = parseInt($(this).val());
        filterMultiProd.tradeMarkValue = tradeMarkValue;
        let filterBy = getFilterBy( (filterMultiProd.priceValueMin == 0 && filterMultiProd.priceValueMax == 0) ? 0 : 1,tradeMarkValue);
        paginationTradeMark.totalValue = getTotalValueFilter(filterMultiProd.priceValueMin, filterMultiProd.priceValueMax, filterMultiProd.tradeMarkValue, 0,  filterBy );
        infoPagination(paginationTradeMark);
        loadDataPage(paginationTradeMark);
    });

    /// get filter
    function getFilterBy(tradeMarkValue, priceValue) {
        if( tradeMarkValue == 0 &&  priceValue != 0) 
            return 'trademark'; // filter by trademark
        else if ( tradeMarkValue != 0 &&  priceValue == 0 )
            return 'price'; // filter by price
        return 'both'; // filter by both ( trademark and price )
    }


    // function get total value filter
    function getTotalValueFilter(priceValueMin, priceValueMax, idTradeMark, sortBy, filterBy, action = "filter") {
        let type;
        if(modules == "categoryProdByCate") {
            type = "id_cat_product";
        } else {
            type = "trademark_product";
        }
        let totalValue = new Array();
        totalValue.push(type);
        totalValue.push(priceValueMin);
        totalValue.push(priceValueMax);
        totalValue.push(idTradeMark);
        totalValue.push(filterBy);
        totalValue.push(sortBy);
        totalValue.push(action);
        return totalValue;
    }


    // modal show detail info product
    var addToCart = {
        wrapper          : "body",
        btnAddCart       : ".add-cart",
        btnPayNow        : ".buy-now",
        btnAddCartDetail : ".add-cart-detail",
        modalDetail      : "#modal-cart",
        baseURL          : "?mod=cart&action=handleCart"       
    }

    // add to cart in detail
    $(addToCart.wrapper).delegate(addToCart.btnAddCartDetail,'click',function () {
        let idProd = parseInt($(this).attr('data-id_prod'));
        let qty    = parseInt($(this).parents('.info').find('#num-order').val());
        let maxQty = parseInt($(this).parents('.info').find('#num-order').attr('max'));
        if ( qty <= maxQty ) {
            $.ajax({
                url : addToCart.baseURL,
                method : "POST",
                data : {
                    dataId : idProd,
                    qty    : qty
                },
                beforeSend : () => {
                    console.log('update info order cart in detail');
                },
                dataType : "json",
                success : (data) => {
                    updateCart(data.listProductCart);
                    $(addToCart.modalDetail).find('.box-product').find('.info-intro').find('.num-qty').text(qty);
                    showModalProduct(data.productItem, data.listProductCart);
                },
                error : (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        } else {
            alert("Số lượng sản phẩm này ở shop chỉ còn " + maxQty + " sản phẩm");
        }
        event.preventDefault();
    });

    // add to cart
    $(addToCart.wrapper).delegate(addToCart.btnAddCart,'click',function () {
        let dataId = parseInt($(this).parents('li').find('a.thumb').attr('data-id_prod'));
        addCart(dataId);
        event.preventDefault();
    });

    // pay now
    $(addToCart.wrapper).delegate(addToCart.btnPayNow,'click',function () {
        let dataId = parseInt($(addToCart.btnAddCart).parents('li').find('a.thumb').attr('data-id_prod'));
        console.log('pay now');
        addCart(dataId);
    });

    // function add cart
    function addCart(dataId){
        $.ajax({
            url : addToCart.baseURL,
            method : "POST",
            data : {
                dataId : dataId,
                qty : 1
            },
            beforeSend : () => {
                console.log('add to carting');
            },
            dataType : "json",
            success : (data) => {
                updateCart(data.listProductCart);
                showModalProduct(data.productItem, data.listProductCart);
            },
            error : (xhr,thrownError, ajaxOptions) => {
                console.log(xhr.status);
                console.log(ajaxOptions);
            }
        });
    }

    // show detail product cart
    function showModalProduct(productItem, listProductCart){
        $(addToCart.modalDetail).find('.box-product').find('.info-img').find('img').attr('src','admin/' + productItem.avatar_product);
        $(addToCart.modalDetail).find('.box-product').find('.info-img').find('a').attr('href',"?mod=products&action=detail&id="+(productItem.id_product)+"");
        $(addToCart.modalDetail).find('.box-product').find('.info-intro').find('.name-prod').children('a').text(productItem.name_product);
        $(addToCart.modalDetail).find('.box-product').find('.info-intro').find('.name-prod').children('a').attr('href',"?mod=products&action=detail&id="+(productItem.id_product)+"");
        $(addToCart.modalDetail).find('.box-product').find('.info-intro').find('.price-curr').text(formatCurrency(productItem.price_product));
        $(addToCart.modalDetail).find('.box-product').find('.info-intro').find('.price-old').children('.price-num').text(formatCurrency(productItem.price_old_product));
        $(addToCart.modalDetail).find('.box-product').find('.info-intro').find('.price-old').children('.discount').text(getDiscount(productItem.price_product, productItem.price_old_product));
        // == 
        $(addToCart.modalDetail).find('.box-cart').find('.box-title').find('.num-cart').find('.num').text(listProductCart.info.numOrder);
        $(addToCart.modalDetail).find('.box-cart').find('.box-info').find('.num-price').find('.num').text(formatCurrency(listProductCart.info.total));

        $(addToCart.modalDetail).modal({
            show: 'true'
        }); 
    }

    // format currency
    function formatCurrency(number) {
        return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(number);
    }

    // get discout
    function getDiscount(priceNew, priceOld) {
        let discount = 100 - ((priceOld / priceNew) * 100);
        return discount.toFixed(1) + "%"
    }

    // update cart
    function updateCart(listProductCart){
        let html_ = `<p class="desc">Có <span>( ${listProductCart.info.numOrder} )</span> sản phẩm trong giỏ hàng</p>
                        <ul class="list-cart">`; 
        for(item in listProductCart.buy) {
            html_ += `  <li class="clearfix">
                            <a href="?mod=products&action=detail&id=${listProductCart.buy[item].id_product}" data-id_prod="${listProductCart.buy[item].id_product}" title="" class="thumb fl-left">
                                <img src="admin/${listProductCart.buy[item].avatar_product}" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="" title="" class="product-name">${listProductCart.buy[item].name_product}</a>
                                <p class="price">${formatCurrency(listProductCart.buy[item].price_product)}</p>
                                <p class="qty">Số lượng: <span>${listProductCart.buy[item].qty_product}</span></p>
                            </div>
                        </li>`;
        }
        html_ += ` </ul>
                    <div class="total-price clearfix">
                        <p class="title fl-left">Tổng:</p>
                        <p class="price fl-right">${formatCurrency(listProductCart.info.total)}</p>
                    </div>
                    <dic class="action-cart clearfix">
                        <a href="?page=cart" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                        <a href="?page=checkout" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                    </dic>`;
        $("#btn-cart #num").text(listProductCart.info.numOrder);
        $("#dropdown").empty();
        $("#dropdown").append(html_);
    }



    // cart
    // control order cart
    var cart = {
        wrapper                : "#info-cart-wp",
        btnMinus               : "span.control-order.minus-order",
        btnPlus                : "span.control-order.plus-order",
        baseURLUpdateOrderCart : "?mod=cart&action=updateOrderCart",
        btnDeleteItem          : ".del-product",
        btnDeleteTotal         : "#delete-cart",
        baseURLdeleteProdCart  : "?mod=cart&action=deleteProdCart"
    }

    // product btn plus product cart
    $(cart.wrapper).delegate(cart.btnPlus,'click',function () {
        let numOrder = parseInt($(this).parents('td').children('input.num-order').val());
        let maxQty   = parseInt($(this).parents('td').children('input.num-order').attr('max'));
        let idProd   = parseInt($(this).parents('td').children('input.num-order').attr('data-id_prod'));
        numOrder ++;
        if ( numOrder <= maxQty ) {
            updateOrderCart(numOrder, idProd);
            $(this).parents('td').children('input.num-order').val(numOrder);
        } else {
            alert('Số lượng sản phẩm trong giỏ hàng chỉ còn ' + maxQty + " sản phẩm");
        }
    });

    // btn minus order product cart
    $(cart.wrapper).delegate(cart.btnMinus,'click',function () {
        let numOrder = parseInt($(this).parents('td').children('input.num-order').val());
        let maxQty   = parseInt($(this).parents('td').children('input.num-order').attr('max'));
        let idProd   = parseInt($(this).parents('td').children('input.num-order').attr('data-id_prod'));
        numOrder -- ;
        if ( numOrder > 0 ) {
            updateOrderCart(numOrder, idProd);
            $(this).parents('td').children('input.num-order').val(numOrder);
        } else {
            alert('Số lượng sản phẩm phải lớn hơn hoặc bằng 1 sản phẩm');
        }
    });

    // delete item product cart
    $(cart.wrapper).delegate(cart.btnDeleteItem,'click',function () {
        let idProdCart = parseInt($(this).attr('data-id_prod'));
        let baseURL = cart.baseURLdeleteProdCart + "&type=deleteItem";
        deleteProdCart(idProdCart, baseURL);
        event.preventDefault();
    });

    // delete total product cart
    $("body").delegate(cart.btnDeleteTotal,'click',function () {
        let selectAgain = confirm("Bạn thực sự muốn xóa hết toàn bộ giỏ hàng");
        if(selectAgain) {
            let baseURL = cart.baseURLdeleteProdCart + "&type=deleteTotal";
            deleteProdCart(null, baseURL);
        }
        event.preventDefault();
    });

    // function update order cart
    function updateOrderCart(numOrder, idProd){
        $.ajax({
            url : cart.baseURLUpdateOrderCart,
            method : "POST",
            data : {
                numOrder : numOrder,
                idProd   : idProd
            },
            beforeSend : () => {
                console.log('update order cart');
            },
            dataType : "json",
            success : (data) => {
                $('input.num-order[data-id_prod='+(data.idProd)+']').parents('tr').find('.total-price').text(data.totalPrice);
                updateCart(data.listProductCart);
                $("#total-price span").text(data.total);
            },
            error : (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        })
    }

    // function delete prod cart
    function deleteProdCart(idProdCart, baseURL){
        $.ajax({
            url : baseURL,
            method : "POST",
            data : {
                idProdCart : idProdCart
            },
            beforeSend : () => {
                console.log('delete cart');
            },
            dataType : "text",
            success : (data) => {
                $("#wrapper.cart").empty();
                $("#wrapper.cart").append(data);
                updateInfoCart();
            },
            error : (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }
    
    // function update info cart
    function updateInfoCart(){
        $.ajax({
            url : "?mod=cart&action=updateInfoCart",
            method : "POST",
            beforeSend : () => {
                console.log('update info cart');
            },
            dataType : "json",
            success : (data) => {
                updateCart(data.listProductCart);
            },
            error : (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }


    // load location
    var location = {
        wrapper  : "body",
        province : "#province",
        district : "#district",
        street   : "#street",
        baseURL  : "?mod=cart&action=loadLocation"
    }

    // load district
    $(location.wrapper).delegate(location.province,'change',function () {
        let levelLoad = 2;
        let value = parseInt($(this).val());
        if(value !=0) {
            let placeAppend = "select#district";
            loadLocation(levelLoad,value,placeAppend);
        }
    });

    // load street
    $(location.wrapper).delegate(location.district,'change',function () {
        let levelLoad = 3;
        let value = parseInt($(this).val());
        if(value !=0) {
            let placeAppend = "select#street";
            loadLocation(levelLoad,value,placeAppend);
        }
    });


    // function load location
    function loadLocation(levelLoad,value,placeAppend){
        $.ajax({
            url : location.baseURL,
            method : "POST",
            data  : {
                levelLoad : levelLoad,
                value     : value,
            },
            beforeSend : () => {
                console.log('load location');
            },
            dataType : "json",
            success : (data) => {
                let _html = `<option value="0">Quận/huyện</option>`;
                for(let i=0 ; i<data.listLocation.length ; i++){
                    _html += `<option value="${data.listLocation[i].id_location}">${data.listLocation[i].name_location}</option>`;
                }
                $(placeAppend).empty();
                $(placeAppend).append(_html);
            },
            error : (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        })
    }


    var search = {
        wrapper     : "body",
        formSearch  : "form.form-search",
        inputSearch : "input#s[name='q']",
    }

    $(search.wrapper).delegate(search.formSearch,'submit',function () {
        let q = $(search.inputSearch).val();
        $.ajax({
            url : "?mod=search&action=getURL",
            method : "GET",
            data : { q : q },
            beforeSend : () => {
                console.log('searching');
            },
            dataType : "text",
            success : (data) => {
                window.location.replace(data);
            },
            error : (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        })
        event.preventDefault();
    });
});