<?php
function construct()
{
    load_model('customer');
}
// customer view
function indexAction(){
    load('helper','format');
    $data = array(
        "list_customer"       => get_list_customer(),
        "list_search_history" => get_list_search_history("tbl_customer")
    );
    load_view('customer',$data);
}

// pagination
function paginationAction()
{
    load('helper', 'format');
    load('helper', 'string');
    $type = $_GET['type'];
    if ($type == "get_total_page"){
        $status            = $_GET['status'];
        $num_per_page      = $_GET['num_per_page'];
        $num_list_customer = count(get_list_customer());
        $total_page        = ceil($num_list_customer / $num_per_page);
        $data = array(
            "total_page" => $total_page,
        );
        echo json_encode($data);
    }
    if ($type == "load_data") {
        $info = $_GET['info'];
        if ($info == 'load_data_pagin') {
            $curr_page    = $_POST['current_page'];
            $status       = $_POST['status'];
            $num_per_page = $_POST['num_per_page'];
            $page_start = (int) ($curr_page - 1) * $num_per_page;
            $list_customer = get_list_page_customer_by_pagination($page_start, $num_per_page);
        } else {
            // search
            $q = $_POST['q'];
            $option_search = $_POST['option_search'];
            $curr_page = $_POST['current_page'];
            $num_per_page = $_POST['num_per_page'];
            $page_start = (int) ($curr_page - 1) * $num_per_page;
            $list_customer = get_list_page_customer_by_search($q, $option_search, $page_start, $num_per_page);
        }
        if (!empty($list_customer)) {
            ?>
            <!-- ------------------------------- -->
            <thead>
                <tr>
                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                    <td><span class="thead-text">STT</span></td>
                    <td><span class="thead-text">Họ và tên</span></td>
                    <td><span class="thead-text">Số điện thoại</span></td>
                    <td><span class="thead-text">Email</span></td>
                    <td><span class="thead-text">Địa chỉ</span></td>
                    <td><span class="thead-text">Đơn hàng</span></td>
                    <td><span class="thead-text">Thời gian</span></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $temp = 1;
                foreach($list_customer as $customer_item) {
                    $created_date = getdate(strtotime($customer_item['created_date']));
                    $customer_item['order_date'] = "(" . format_weekday($created_date['weekday']) . ")  " . "{$created_date['mday']}/{$created_date['mon']}/{$created_date['year']}";
                    $str_address     = $customer_item['address_customer'];
                    $json_address    = json_decode($str_address, true);
                    $province        =  get_location_by_id($json_address['province']);
                    $district        =  get_location_by_id($json_address['district']);
                    $street          =  get_location_by_id($json_address['street']);
                ?>
                <tr>
                    <td><input type="checkbox" name="checkItem[]" data-id="<?php echo $customer_item['id_customer'] ?>" class="checkItem"></td>
                    <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                    <td>
                        <div class="tb-title fl-left">
                            <a href="" title=""><?php echo $customer_item['name_customer'] ?></a>
                        </div>
                        <ul class="list-operation fl-right" data-id_customer="<?php echo $customer_item['id_customer'] ?>">
                            <li><a href="" title="Xóa" class="delete permanently" data-modules='customer' style="padding-left: 15px;"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                        </ul>
                    </td>
                    <td><a href="tel:<?php echo $customer_item['phone_customer'] ?>" title="Gọi ngay" class="tbody-text"><?php echo $customer_item['phone_customer'] ?></a></td>
                    <td><span class="tbody-text"><?php echo $customer_item['email_customer'] ?></span></td>
                    <td><span class="tbody-text"><?php echo ($province['name_location'] . "-" . $district['name_location'] . "-" . $street['name_location']) ?></span></td>
                    <td><span class="tbody-text"><?php echo $customer_item['num_order'] ?></span></td>
                    <td><span class="tbody-text"><?php echo $customer_item['order_date'] ?></span></td>
                </tr>
                <?php
                $temp ++;
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                    <td><span class="tfoot-body">STT</span></td>
                    <td><span class="tfoot-body">Họ và tên</span></td>
                    <td><span class="tfoot-body">Số điện thoại</span></td>
                    <td><span class="tfoot-body">Email</span></td>
                    <td><span class="tfoot-body">Địa chỉ</span></td>
                    <td><span class="tfoot-body">Đơn hàng</span></td>
                    <td><span class="tfoot-body">Thời gian</span></td>
                </tr>
            </tfoot>
            <!-- ------------------------------- -->
            <?php
        } else {
            ?>
            <div class="notifi_process mx-auto">
                <span class="thumb-img"><img src="public/images/notFoundIcon.png" class="img-fluid" alt=""></span>
                <p class="txt_notifi">Hiện tại không có khách hàng nào ..!</p>
            </div>
            <?php 
        }
    }
}
#delete customer
function delete_customerAction()
{
    $action = $_POST['action'];
    if ($action == 'delete_item'){
        $data_id = $_POST['id_customer'];
        $process = delete_customer_item($data_id);
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
            delete_customer_item($id_item);
        }
        $data = array(
            "status" => "success"
        );
        echo json_encode($data);
    }
}
// ===============
// search
//===============
function searchAction()
{
    load('helper', 'format');
    load('helper', 'string');
    $q             = $_GET['q'];
    $option_search = $_GET['option_search'];
    $tbl_search    = $_GET['tbl_search'];
    $num_per_page  = $_GET['num_per_page'];
    $data = array(
        "search_text"   => trim($q),
        "search_option" => $option_search,
        "tbl_search"    => $tbl_search
    );
    if (!check_search_exists($data)) {
        save_search_history($data);
    }
    $search_result = search_customer($q, $option_search);
    $num_list_order = count($search_result);
    $total_page = ceil($num_list_order / $num_per_page);
    $data_view = array(
        "total_page" => $total_page
    );
    echo json_encode($data_view);
}
//==========================
// load data history search
//==========================

function load_data_histoty_searchAction()
{
    load('helper', 'format');
    $list_history_search = get_list_search_history("tbl_customer");
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
                        <span class="field">(<?php echo format_name_customer($search_item['search_option']) ?>)</span>
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
                        <span class="field">(<?php echo format_name_customer($search_item['search_option']) ?>)</span>
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
#get total customer 
function get_total_customerAction()
{
    $list_customer = get_list_customer();
    $data = array(
        "num" => count($list_customer)
    );
    echo json_encode($data);
}
