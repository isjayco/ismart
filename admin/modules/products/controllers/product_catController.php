<?php
function construct()
{
    load_model('index');
}

// index 
function indexAction()
{
    load('helper', 'format');
    $data = array(
        "list_product_cat_all" => get_list_product_cat_by_status("all"),
        "list_product_cat_not_trash" => get_list_product_cat_by_status("all_not_trash"),
        "list_product_cat_publish" => get_list_product_cat_by_status("publish"),
        "list_product_cat_pending" => get_list_product_cat_by_status("pending"),
        "list_product_cat_trash" => get_list_product_cat_by_status("trash"),
        "list_search_history" => get_list_search_history("tbl_productcat")
    );
    load_view('product_cat', $data);
}
// add post cat 
function addAction()
{
    load('lib', 'validation_form');
    if (isset($_POST['btn_add_postProduct_cat'])) {
        $error = array();
        global $error;
        // check name product product cat
        if (empty($_POST['name_productCat'])) {
            $error['name_productCat'] = "<span class='error'>(*) Không được bỏ trống tên của danh mục</span>";
        } else {
            if (check_name_product_exists($_POST['name_productCat'])) {
                $error['name_productCat'] = "<span class='error'>(*) Danh mục này đã tồn tại</span>";
            } else {
                $name_productCat = $_POST['name_productCat'];
            }
        }
        // check status
        if (empty($_POST['status'])) {
            $status = "pending";
        } else {
            $status = $_POST['status'];
        }
        // check error
        if (empty($error)) {
            $created_date = time();
            $creator = user_login();
            $data = array(
                "name_productCat" => $name_productCat,
                "status"          => $status,
                "created_date"    => $created_date,
                "creator"         => $creator
            );
            add_productCat($data);
            $error['no'] = "<span id='success'>(*) Thêm thành công</span>";
            $data_view['notification'] = "<div class='success'></div>";
            $data_view['process'] = "success";
        }
    }
    if (!empty($data_view)) {
        load_view('add_product_cat', $data_view);
    } else {
        load_view('add_product_cat');
    }
}
//============
// pagination
//============

function paginationAction()
{
    load('helper', 'format');
    load('helper', 'string');
    $type = $_GET['type'];
    if ($type == 'get_total_page') {
        $status = $_GET['status'];
        $num_per_page = $_GET['num_per_page'];
        $num_list_product_cat = count(get_list_product_cat_by_status($status));
        $list_trash = count(get_list_product_cat_by_status("trash"));
        if ($status == 'all') {
            $num_list_product_cat -= $list_trash;
        }
        $total_page = ceil($num_list_product_cat / $num_per_page);
        $data = array(
            "total_page" => $total_page
        );
        echo json_encode($data);
    }

    if ($type == 'load_data') {
        $info = $_GET['info'];
        if ($info == 'load_data_pagin') {
            $curr_page    = $_POST['current_page'];
            $status       = $_POST['status'];
            $num_per_page = $_POST['num_per_page'];
            $page_start = (int) ($curr_page - 1) * $num_per_page;
            $list_product_cat = get_list_page_product_cat_by_pagination($page_start, $num_per_page, $status);
        } else {
            $q = $_POST['q'];
            $option_search = $_POST['option_search'];
            $status_curr = $_POST['status_curr'];
            $curr_page = $_POST['current_page'];
            $num_per_page = $_POST['num_per_page'];
            $page_start = (int) ($curr_page - 1) * $num_per_page;
            $list_product_cat = get_list_page_product_cat_by_search($q, $option_search, $page_start, $num_per_page, $status_curr);
        }
        if (!empty($list_product_cat)) {
?>
            <thead>
                <tr>
                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                    <td><span class="thead-text">STT</span></td>
                    <td><span class="thead-text">Mã số</span></td>
                    <td><span class="thead-text">Tên danh mục</span></td>
                    <td><span class="thead-text">Trạng thái</span></td>
                    <td><span class="thead-text">Người tạo</span></td>
                    <td><span class="thead-text">Thương hiệu</span></td>
                    <td><span class="thead-text">Sản phẩm</span></td>
                    <td><span class="thead-text">Thời gian</span></td>
                    <td><span class="thead-text">Tùy chỉnh</span></td>
                </tr>
            </thead>
            <tbody id="main-table">
                <?php
                $temp = 1;
                foreach ($list_product_cat as $product_cat_item) {
                    $data = getdate($product_cat_item['created_date']);
                    $product_cat_item['created_date'] = "(" . format_weekday($data['weekday']) . ")  " . "{$data['mday']}/{$data['mon']}/{$data['year']} {$data['hours']}:{$data['minutes']}";
                    $list_trademark_by_product_cat = get_list_trademark_by_id_product_cat($product_cat_item['id_productCat']);
                    $list_product_by_product_cat = get_list_products_by_id_products_cat($product_cat_item['id_productCat']);
                    $num_trademark = count($list_trademark_by_product_cat);
                    $num_product = count($list_product_by_product_cat);
                ?>
                    <tr>
                        <td><input data-id_product_cat="<?php echo $product_cat_item['id_productCat'] ?>" type="checkbox" name="checkItem[]" class="checkItem"></td>
                        <td><span class="tbody-text"><?php echo $temp; ?></span></td>
                        <td><span class="tbody-text"><?php echo $product_cat_item['id_productCat'] ?></span></td>
                        <td><a href="?mod=products&controller=product_cat&action=subCat&id=<?php echo $product_cat_item['id_productCat'] ?>" class="name_product_cat"><span class="tbody-text name" data-id_product_cat="<?php echo $product_cat_item['id_productCat'] ?>"><?php echo $product_cat_item['name_productCat'] ?></span></a></td>
                        <td><span class="tbody-text status" data-id_product_cat="<?php echo $product_cat_item['id_productCat'] ?>" data-status="<?php echo $product_cat_item['status'] ?>"><?php echo format_status($product_cat_item['status']) ?></span></td>
                        <td><span class="tbody-text"><?php echo $product_cat_item['creator'] ?></span></td>
                        <td class="text-center position-relative">
                            <span class="tbody-text has_tooltip d-block h-100" style="cursor:pointer;"><?php echo $num_trademark ?></span>
                            <?php
                            if (!empty($list_trademark_by_product_cat)) {
                            ?>
                                <div class="info_list_tooltip position-absolute">
                                    <ul>
                                        <?php
                                        foreach ($list_trademark_by_product_cat as $trademark_item) {
                                        ?>
                                            <li><span><?php echo $trademark_item['name_trademark']; ?></span></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            <?php
                            }
                            ?>
                        </td>
                        <td class="text-center position-relative has_tooltip">
                            <span class="tbody-text d-block h-100" style="cursor:pointer;"><?php echo $num_product; ?></span>
                            <?php
                            if (!empty($list_product_by_product_cat)) {
                            ?>
                                <div class="show_info_tooltip position-absolute">
                                    <a href="?mod=products&controller=product_cat&action=list_product&id=<?php echo $product_cat_item['id_productCat'] ?>" class="show_list_product" title="Xem danh sách sản phẩm"><i class="fa fa-info" aria-hidden="true"></i></a>
                                </div>
                            <?php
                            }
                            ?>
                        </td>
                        <td><span class="tbody-text created-date"><?php echo $product_cat_item['created_date'] ?></span></td>
                        <td>
                            <span>
                                <ul class="list-operation d-flex" data-id_product_cat="<?php echo $product_cat_item['id_productCat'] ?>">
                                    <li><a href="" title="Sửa" class="edit" data-toggle="modal" data-target="#edit_product_cat"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li class="delete-opt position-relative">
                                        <a <?php if ($product_cat_item['status'] == 'trash') { ?> href="" data-modules="product_cat" data-option="permanently" <?php } ?> title="Xóa vĩnh viễn" class="permanently delete d-inline-block">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        <?php
                                        if ($product_cat_item['status'] != 'trash') {
                                        ?>
                                            <div class="option-delete position-absolute fa fa-caret-down">
                                                <a href="" data-status="pending" data-modules='product_cat' class="goto-trash option-item" data-option="goto_trash">Thùng rác</a>
                                                <a href="" class="permanently all option-item" data-modules="product_cat" data-option="permanently">Vĩnh viễn</a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </li>
                                    <li>
                                        <div class="switch status product_cat">
                                            <?php
                                            if ($product_cat_item['status'] == 'trash') {
                                            ?>
                                                <a href="" title="Khôi phục" style="font-size: 14px; padding: 5.8px 14px;" class="restore product_cat fa fa-undo" data-option="restore"></a>
                                            <?php
                                            } else {
                                            ?>
                                                <label for="status" data-modules="product_cat" class="btn-change-status" data-id_product_cat="<?php echo $product_cat_item['id_productCat'] ?>" data-active="<?php echo format_mode_status($product_cat_item['status']) ?>">
                                                    <span class="lever"></span>
                                                </label>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </li>
                                </ul>
                            </span>
                        </td>
                    </tr>
                <?php
                    $temp++;
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                    <td><span class="thead-text">STT</span></td>
                    <td><span class="thead-text">Mã số</span></td>
                    <td><span class="thead-text">Tên danh mục</span></td>
                    <td><span class="thead-text">Trạng thái</span></td>
                    <td><span class="thead-text">Người tạo</span></td>
                    <td><span class="thead-text">Thương hiệu</span></td>
                    <td><span class="thead-text">Sản phẩm</span></td>
                    <td><span class="thead-text">Thời gian</span></td>
                    <td><span class="thead-text">Tùy chỉnh</span></td>
                </tr>
            </tfoot>
        <?php
        } else {
        ?>
            <div class="notifi_process mx-auto">
                <span class="thumb-img"><img src="public/images/notFoundIcon.png" class="img-fluid" alt=""></span>
                <p class="txt_notifi">Hiện tại không tìm thấy danh mục sản phẩm nào ..!</p>
                <div class="add">
                    <a href="?mod=products&controller=product_cat&action=add" class="link-add text-center d-block">Thêm tại đây.!</a>
                </div>
            </div>
<?php
        }
    }
}

//=============
// Update name
//=============

function update_nameAction()
{
    $name_new = $_POST['name_new'];
    $error = array();
    $current_name = $_POST['current_name'];
    $data_id = $_POST['data_id'];
    if (check_name_product_cat_exists($name_new)) {
        $error['name_new'] = "Tên danh mục này đã tồn tại trong hệ thống";
    }
    if (empty($error)) {
        $data = array(
            "name_productCat" => $name_new
        );
        $process = update_name_product_cat($data, $data_id);
        if ($process == true) {
            $data_process = array(
                "status" => "success",
                "notifi" => "Cập nhật thành công",
                "name_new" => $name_new
            );
        } else {
            $data_process = array(
                "status"   => "error",
                "notifi"   => "Cập nhật không thành công",
                "name_old" => $current_name
            );
        }
    } else {
        $data_process = array(
            "status"   => "error",
            "name_old" => $current_name,
            "notifi"    => $error['name_new']
        );
    }
    echo json_encode($data_process);
}

//==================
// Delete permanently
//===================

function delete_permanentlyAction()
{
    $action = $_POST['action'];
    if ($action == 'delete_item') {
        $data_id = (int) $_POST['data_id'];
        $process = delete_product_cat_item($data_id);
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
    } else {
        $list_checked = $_POST['data_id'];
        foreach ($list_checked as $id_item) {
            $process = delete_product_cat_item($id_item);
            if ($process) {
                $data_view = array(
                    "status" => "success"
                );
            } else {
                $data_view = array(
                    "status" => "error"
                );
            }
        }
        echo json_encode($data_view);
    }
}
//=======================
// Changes status action
//=======================

function change_statusAction()
{
    $action = $_POST['action'];
    if ($action == 'change_status_item') {
        load('helper', 'format');
        $data_id = $_POST['data_id'];
        $status_current = $_POST['status_current'];
        $data = array(
            "status" => $status_current
        );
        $process = update_status_product_cat($data, $data_id);
        if ($process) {
            $data['status_vnm'] = format_status($data['status']);
            echo json_encode($data);
        }
    } else {
        $list_checked = $_POST['list_checked'];
        $action_status = $_POST['action_status'];
        foreach ($list_checked as $id_item) {
            $data = array(
                "status" => $action_status
            );
            update_status_product_cat($data, $id_item);
        }
    }
}

//=================
// Load num status
//=================

function load_num_statusAction()
{
    $data = array(
        "num_all"     => count(get_list_product_cat_by_status('all')),
        "num_publish" => count(get_list_product_cat_by_status('publish')),
        "num_pending" => count(get_list_product_cat_by_status('pending')),
        "num_trash"   => count(get_list_product_cat_by_status('trash')),
    );
    echo json_encode($data);
}
//============
// Goto trash
//============

function goto_trashAction()
{
    $action = $_POST['action'];
    if ($action == 'goto_trash_item') {
        $data_id = $_POST['data_id'];
        $status_old = $_POST['status_old'];
        $data_save_status = array(
            "status_old" => $status_old,
            "status" => "trash"
        );
        update_status_product_cat($data_save_status, $data_id);
    } else {
        $list_status_old = $_POST['status_old'];
        $status = array();
        foreach ($list_status_old as $key => $status_old) {
            if ($status_old != '') {
                $data_save_status = array(
                    "status_old" => $status_old,
                    "status"     => "trash"
                );
                update_status_product_cat($data_save_status, $key);
            }
        }
    }
}

//=========
// Restore
//=========

function restoreAction()
{
    $action = $_POST['action'];
    if ($action == 'restore_item') {
        $data_id = $_POST['data_id'];
        $status_old = get_product_cat_item($data_id);
        $status_old = $status_old['status_old'];
        $data_update_status = array(
            "status" => $status_old,
            "status_old" => null
        );
        update_status_product_cat($data_update_status, $data_id);
    } else {
        $list_data_id = $_POST['data_id'];
        foreach ($list_data_id as $id_item) {
            $status_old = get_status_product_cat_old($id_item);
            $status_old = $status_old['status_old'];
            $data_update_status = array(
                "status" => $status_old,
                "status_old" => null
            );
            update_status_product_cat($data_update_status, $id_item);
        }
    }
}

// ===============
// Sub product cat
// ===============

function subCatAction()
{
    $controller = $_GET['controller'];
    $action = $_GET['action'];
    $product_cat_id = $_GET['id'];
    $product_cat_item = get_product_cat_item($product_cat_id);
    $name_productCat = $product_cat_item['name_productCat'];
    $list_trademark = get_list_trademark_by_id_product_cat($product_cat_id);
    $data = array(
        "product_cat_id" => $product_cat_id,
        "name_product_cat" => $name_productCat,
        "list_trademark" => $list_trademark,
        "controller" => $controller,
        "action" => $action,
        "list_product_cat" => get_list_product_cat_by_status("all_not_trash")
    );
    load_view('sub_product_cat',$data);
}

// ===============
// Sub product cat
// ===============

function list_productAction()
{
    $controller = $_GET['controller'];
    $action = $_GET['action'];
    $product_cat_id = $_GET['id'];
    $product_cat_item = get_product_cat_item($product_cat_id);
    $name_productCat = $product_cat_item['name_productCat'];
    $list_products = get_list_products_by_id_products_cat($product_cat_id);
    $data = array(
        "product_cat_id" => $product_cat_id,
        "name_product_cat" => $name_productCat,
        "list_products" => $list_products,
        "controller" => $controller,
        "action" => $action,
    );
    load_view('sub_product_list',$data);
}
//========
// Search
//========

function searchAction()
{
    load('helper', 'format');
    load('helper', 'string');
    $type = $_GET['type'];
    $q = $_GET['q'];
    $option_search = $_GET['option_search'];
    $tbl_search    = $_GET['tbl_search'];
    $num_per_page  = $_GET['num_per_page'];
    $status_curr   = $_GET['status_curr'];
    $data = array(
        "search_text" => trim($q),
        "search_option" => $option_search,
        "tbl_search" => $tbl_search,
    );
    if (!check_search_exists($data)) {
        save_search_history($data);
    }
    $search_result = search_product_cat($q, $option_search, $status_curr);
    $num_list_product_cat = count($search_result);
    $total_page = ceil($num_list_product_cat / $num_per_page);
    $data_view = array(
        "total_page" => $total_page,
    );
    echo json_encode($data_view);
}

//==========================
// Load data history search
//==========================
function load_data_histoty_searchAction()
{
    load('helper', 'format');
    $list_history_search = get_list_search_history("tbl_productcat");
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
                        <span class="field">(<?php echo format_name_product_cat($search_item['search_option']) ?>)</span>
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

//=======================
// Delete search history
//=======================

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
// Search data history
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
                        <span class="field">(<?php echo format_name_product_cat($search_item['search_option']) ?>)</span>
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