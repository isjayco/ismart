<?php
function construct() {
    load_model('index');
}

// index action
function indexAction() {
    load('helper','format');
    $data_send_view = array(
        "list_order_all"      => get_list_order_by_status("all"),
        "list_order_pending"  => get_list_order_by_status("pending"),
        "list_order_delivery" => get_list_order_by_status("delivery"),
        "list_order_complete" => get_list_order_by_status("complete"),
        "list_order_canceled" => get_list_order_by_status("canceled"),
        "list_search_history" => get_list_search_history("tbl_order")
    );
    load_view('index',$data_send_view);
}



// pagination
function paginationAction()
{
    load('helper', 'format');
    load('helper', 'string');
    $type = $_GET['type'];
    if ($type == "get_total_page") {
        $status         = $_GET['status'];
        $num_per_page   = $_GET['num_per_page'];
        $num_list_order = count(get_list_order_by_status($status)); 
        $total_page = ceil($num_list_order / $num_per_page);
        $data = array(
            "total_page" => $total_page,
        );
        echo json_encode($data);
    }

    if ($type == "load_data") {
        $info = $_GET['info'];
        if ($info == "load_data_pagin") {
            $curr_page    = $_POST['current_page'];
            $status       = $_POST['status'];
            $num_per_page = $_POST['num_per_page'];
            $page_start = (int) ($curr_page - 1) * $num_per_page;
            $list_order = get_list_page_order_by_pagination($page_start, $num_per_page, $status);
        } else {
            // search
            $q = $_POST['q'];
            $option_search = $_POST['option_search'];
            $status_curr = $_POST['status_curr'];
            $curr_page = $_POST['current_page'];
            $num_per_page = $_POST['num_per_page'];
            $page_start = (int) ($curr_page - 1) * $num_per_page;
            if ($option_search == 'customer_id') {
                $list_order = get_user_order_by_name_pagination($q, $page_start, $num_per_page, $status_curr);
            } else {
                $list_order = get_list_page_order_by_search($q, $option_search, $page_start, $num_per_page, $status_curr);
            }
        }
        if(!empty($list_order)){
            ?>
            <!-- ------------------- -->
                <thead>
                    <tr>
                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                        <td><span class="thead-text">STT</span></td>
                        <td><span class="thead-text">Mã đơn hàng</span></td>
                        <td><span class="thead-text">Họ và tên</span></td>
                        <td><span class="thead-text">Số sản phẩm</span></td>
                        <td><span class="thead-text">Tổng giá</span></td>
                        <td><span class="thead-text">Trạng thái</span></td>
                        <td><span class="thead-text">Thời gian</span></td>
                        <td><span class="thead-text">Chi tiết</span></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $temp = 1;
                    foreach($list_order as $orderItem){
                        $data_time  = $orderItem['order_date'];
                        $user_order = get_user_order_by_id($orderItem['customer_id']);
                        $data_date  = getdate(strtotime($orderItem['order_date']));
                        $orderItem['order_date'] = "(" . format_weekday($data_date['weekday']) . ")  " . "{$data_date['mday']}/{$data_date['mon']}/{$data_date['year']}";
                    ?>
                    <tr>
                        <td><input type="checkbox" name="checkItem[]" class="checkItem" data-id="<?php echo $orderItem['id_order'] ?>"></td>
                        <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                        <td><span class="tbody-text code-status" data-id_order="<?php echo $orderItem['id_order'] ?>"><?php echo $orderItem['code_order'] ?></h3></span>
                        <td>
                            <div class="tb-title fl-left">
                                <a href="" title="" class="name_customer" data-toggle="modal" data-target="#edit_order" data-id_customer="<?php echo $user_order['id_customer'] ?>"><?php echo $user_order['name_customer'] ?></a>
                            </div>
                            <ul class="list-operation fl-right" data-id_order="<?php echo $orderItem['id_order'] ?>">
                                <li><a href="" title="Sửa" class="edit" data-toggle="modal" data-target="#edit_order"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                <li><a href="" title="Xóa" class="delete permanently" data-modules="order"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                            </ul>
                        </td>
                        <td><span class="tbody-text num-order"><?php echo $orderItem['num_order'] ?></span></td>
                        <td><span class="tbody-text total-price"><?php echo currency_format($orderItem['total_price_order']) ?></span></td>
                        <td><span class="tbody-text status" data-status="<?php echo $orderItem['status'] ?>"><?php echo format_status_order($orderItem['status']) ?></span></td>
                        <td><span class="tbody-text" data-time="<?php echo $data_time ?>"><?php echo $orderItem['order_date'] ?></span></td>
                        <td><a href="?mod=sales&action=detailOrder&id=<?php echo $orderItem['id_order'] ?>" title="" class="tbody-text">Chi tiết</a></td>
                    </tr>
                    <?php
                    $temp ++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                        <td><span class="tfoot-text">STT</span></td>
                        <td><span class="tfoot-text">Mã đơn hàng</span></td>
                        <td><span class="tfoot-text">Họ và tên</span></td>
                        <td><span class="tfoot-text">Số sản phẩm</span></td>
                        <td><span class="tfoot-text">Tổng giá</span></td>
                        <td><span class="tfoot-text">Trạng thái</span></td>
                        <td><span class="tfoot-text">Thời gian</span></td>
                        <td><span class="tfoot-text">Chi tiết</span></td>
                    </tr>
                </tfoot>
            <!-- ------------------- -->
            <?php 
        } else {
            ?>
                <div class="notifi_process mx-auto">
                    <span class="thumb-img"><img src="public/images/notFoundIcon.png" class="img-fluid" alt=""></span>
                    <p class="txt_notifi">Hiện tại không có đơn hàng nào ..!</p>
                    <div class="add">
                    </div>
                </div>
            <?php
        }
    }
}

// get info customer action
function get_info_customerAction()
{
    $id_customer     = $_POST['id_customer'];
    $id_order        = $_POST['id_order'];
    $info_order_item = get_info_order_item_by_id($id_order);
    $customer_item   = get_user_order_by_id($id_customer);
    $str_address     = $customer_item['address_customer'];
    $json_address    = json_decode($str_address, true);
    $address         = $customer_item['address'];
    $data_send_view = array(
        "customer_item"   => $customer_item,
        "data_address"    => $json_address,
        "info_order_item" => $info_order_item,
        "address"         => $address
    );
    echo json_encode($data_send_view);
}

#get address customer 
function get_address_customerAction()
{
    $id_province = $_POST['id_province'];
    $id_district = $_POST['id_district'];
    $id_street   = $_POST['id_street'];
    $data_send_view = array(
        "province"      => get_location_by_id($id_province),
        "district"      => get_location_by_id($id_district),
        "street"        => get_location_by_id($id_street),
        "list_province" => get_location_by_level(1),
        "list_district" => get_location_by_level_and_parent(2,$id_province),
        "list_street"   => get_location_by_level_and_parent(3,$id_district),
    );
    echo json_encode($data_send_view);
}
#update info customer and order
function update_info_customer_and_orderAction()
{
    $name_customer     = $_POST['name_customer'];
    $email_customer    = $_POST['email_customer'];
    $province_customer = $_POST['province_customer'];
    $district_customer = $_POST['district_customer'];
    $street_customer   = $_POST['street_customer'];
    $address_customer  = $_POST['address_customer'];
    $phone_customer    = $_POST['phone_customer'];
    $note_order        = $_POST['note_order'];
    $status            = $_POST['status'];
    $order_date        = $_POST['order_date'];
    $id_customer       = $_POST['id_customer'];
    $id_order          = $_POST['id_order'];

    $total_address_customer = array(
        "province" => $province_customer,
        "district" => $district_customer,
        "street"   => $street_customer,
    );
    $data_customer = array(
        "name_customer"    => $name_customer,
        "email_customer"   => $email_customer,
        "address_customer" => json_encode($total_address_customer),
        "phone_customer"   => $phone_customer,
        "address"          => $address_customer
    );
    $data_order = array(
        "note_order" => $note_order,
        "status"     => $status,
        "order_date" => $order_date
    );
    update_customer($data_customer,$id_customer);
    update_order($data_order, $id_order);
    $data_send_view = array(
        "status" => "success"
    );
    echo json_encode($data_send_view);
}
#load location
function load_locationAction()
{
    $level_get   = $_POST['level_get'];
    $id_location = $_POST['id_location'];
    $list_location = get_location_by_level_and_parent($level_get,$id_location);
    $data_send_view = array(
        "list_location" => $list_location
    );
    echo json_encode($data_send_view);
}

#delete order
function delete_orderAction()
{
    $action = $_POST['action'];
    if ($action == 'delete_item'){
        $data_id = $_POST['id_order'];
        $process = delete_order_item($data_id);
        if($process) {
            $data = array(
                "status" => "success",
            );
        } else {
            $data = array(
                "status" => "error"
            );
        }
        echo json_encode($data);
    } else {
        $list_checked = $_POST['data_id'];
        foreach($list_checked as $id_item) {
            delete_order_item($id_item);
        }
        $data = array(
            "status" => "success"
        );
        echo json_encode($data);
    }
}
function load_num_statusAction()
{
    $data = array(
        "num_all"        => count(get_list_order_by_status("all")),
        "num_pending"    => count(get_list_order_by_status("pending")),
        "num_delivery"   => count(get_list_order_by_status("delivery")),
        "num_complete"   => count(get_list_order_by_status("complete")),
        "num_canceled"   => count(get_list_order_by_status("canceled")),
    );
    echo json_encode($data);
}

// ========================================== //
// ============== DETAIL ORDER ============== //
// ========================================== //
function detailOrderAction()
{
    load('helper','format');
    @$id_order        = !empty($_GET['id']) ? (int) $_GET['id'] : 0;
    @$orderItem       = get_info_order_item_by_id($id_order);
    @$orderItem['customer_id'] = !empty($orderItem['customer_id']) ? (int) $orderItem['customer_id'] : 0;
    @$customer_item   = get_user_order_by_id($orderItem['customer_id']);
    @$str_address     = $customer_item['address_customer'];
    @$json_address    = json_decode($str_address, true);
    @$json_cart_buy   = json_decode($orderItem['list_prod_cart'],true);
    $data_send_view = array(
        "orderItem"      => $orderItem,
        "province"       => get_location_by_id((int) $json_address['province']),
        "district"       => get_location_by_id((int) $json_address['district']),
        "street"         => get_location_by_id((int) $json_address['street']),
        "customer_item"  => $customer_item,
        "list_cart_buy"  => $json_cart_buy,
    );
    $list_prod_cart = array();
    $i = 0;
    if(!empty($orderItem) && $orderItem['customer_id'] != 0) {
        foreach($data_send_view['list_cart_buy'] as $cartItem) {
            $prod_item = get_product_item_by_id($cartItem['id']);
            $list_prod_cart[$i] = array(
                "id"           => $prod_item['id_product'],
                "avatar"       => $prod_item['avatar_product'],
                "name"         => $prod_item['name_product'],
                "price"        => $prod_item['price_product'],
                "qty"          => $cartItem['qty'],
                "total_price"  => $cartItem['price'],
            );
            $i++;
        }
        $data_send_view['list_prod_cart'] = $list_prod_cart;
    }
    load_view('detailOrder',$data_send_view);
}
#change status order in detail order
function change_status_in_detail_orderAction()
{
    $id_order = $_POST['id_order'];
    $status = $_POST['status'];
    $data = array(
        "status" => $status
    );
    update_order($data,$id_order);
    $data = array(
        "status" => "success"
    );
    echo json_encode($data);
}
// ===============
// search
//===============
function searchAction()
{
    load('helper', 'format');
    load('helper', 'string');
    $type          = $_GET['type'];
    $q             = $_GET['q'];
    $option_search = $_GET['option_search'];
    $tbl_search    = $_GET['tbl_search'];
    $num_per_page  = $_GET['num_per_page'];
    $status_curr   = $_GET['status_curr'];
    $data = array(
        "search_text"   => trim($q),
        "search_option" => $option_search,
        "tbl_search"    => $tbl_search
    );
    if (!check_search_exists($data)) {
        save_search_history($data);
    }
    if ($option_search == 'customer_id') {
        $search_result = get_user_order_by_name($q);
    } else {
        $search_result = search_order($q, $option_search, $status_curr);
    }
    $num_list_order = count($search_result);
    $total_page = ceil($num_list_order / $num_per_page);
    $data_view = array(
        "total_page" => $total_page
    );
    echo json_encode($data_view);
}
// delete history search item
function delete_search_historyAction()
{
    $search_id = (int) $_POST['data_id'];
    $process = delete_search_history_item($search_id);
    if ($process) {
        $data = array(
            "status" => "success"
        );
    } else {
        $data = array(
            "status" => "error"
        );
    }
    echo json_encode($data);
}
//==========================
// load data history search
//==========================

function load_data_histoty_searchAction()
{
    load('helper', 'format');
    $list_history_search = get_list_search_history("tbl_order");
    if (!empty($list_history_search)) {
        // -------------------------
        ?>
        <h4 class="title"></h4>
        <ul class="list-history">
            <?php
            foreach ($list_history_search as $search_item) {
            ?>
                <li class="history-item d-flex">
                    <a href="" data-option_search="<?php echo $search_item['search_option'] ?>" class="content">
                        <span class="text"><?php echo $search_item['search_text']; ?></span>
                        <span class="field">(<?php echo format_name_order($search_item['search_option']) ?>)</span>
                    </a>
                    <a href="" data-search_id="<?php echo $search_item['search_id'] ?>" class="delete">Xóa</a>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
        // -------------------------
    }
}

//=====================
// search data history
//=====================

function search_historyAction()
{
    load('helper', 'format');
    $q             = $_POST['key_text'];
    $option_search = $_POST['option_search'];
    $tbl_search    = $_POST['tbl_search'];
    $list_history_search = search_history($q, $option_search, $tbl_search);
    if (!empty($list_history_search)) {
        // -------------------------
    ?>
        <h4 class="title"></h4>
        <ul class="list-history">
            <?php
            foreach ($list_history_search as $search_item) {
            ?>
                <li class="history-item d-flex">
                    <a href="" data-option_search="<?php echo $search_item['search_option'] ?>" class="content">
                        <span class="text"><?php echo $search_item['search_text']; ?></span>
                        <span class="field">(<?php echo format_name_order($search_item['search_option']) ?>)</span>
                    </a>
                    <a href="" data-search_id="<?php echo $search_item['search_id'] ?>" class="delete">Xóa</a>
                </li>
            <?php
            }
            ?>
        </ul>
<?php
        // -------------------------
    }
}


#get total order
function get_total_orderAction()
{
    $list_order = get_list_order();
    $data = array(
        "num" => count($list_order)
    );
    echo json_encode($data);
}