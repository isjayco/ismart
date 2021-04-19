<?php
function construct()
{
    load_model('index');
}


//== index view ==//
function indexAction()
{

    load('helper', 'format');
    $data = array(
        "list_advt_all" => get_list_advt_by_status("all"),
        "list_advt_not_trash" => get_list_advt_by_status("all_not_trash"),
        "list_advt_publish" => get_list_advt_by_status("publish"),
        "list_advt_pending" => get_list_advt_by_status("pending"),
        "list_advt_trash" => get_list_advt_by_status('trash'),
        "list_search_history" => get_list_search_history("tbl_advt")
    );
    load_view('index', $data);
}


//===========
// paginatio
//===========

function paginationAction()
{
    load('helper', 'format');
    load('helper', 'string');
    $type = $_GET['type'];
    if ($type == "get_total_page") {
        $status        = $_GET['status'];
        $num_per_page  = $_GET['num_per_page'];
        $num_list_advt = count(get_list_advt_by_status($status));
        $list_trash    = count(get_list_advt_by_status("trash"));
        if ($status == 'all') {
            $num_list_advt -= $list_trash;
        }
        $total_page    = ceil($num_list_advt / $num_per_page);
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
            $list_advt = get_list_page_advt_by_pagination($page_start, $num_per_page, $status);
        } else {
            $q = $_POST['q'];
            $option_search = $_POST['option_search'];
            $status_curr = $_POST['status_curr'];
            $curr_page = $_POST['current_page'];
            $num_per_page = $_POST['num_per_page'];
            $page_start = (int) ($curr_page - 1) * $num_per_page;
            $list_advt = get_list_page_advt_by_search($q, $option_search, $page_start, $num_per_page, $status_curr);
        }
        if (!empty($list_advt)) {
?>
            <!-- ----------------- -->
            <thead>
                <tr>
                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                    <td><span class="thead-text">STT</span></td>
                    <td><span class="thead-text">Mã số</span></td>
                    <td><span class="thead-text">Hình ảnh</span></td>
                    <td><span class="thead-text">Link quảng cáo</span></td>
                    <td><span class="thead-text">Trạng thái</span></td>
                    <td><span class="thead-text">Người tạo</span></td>
                    <td><span class="thead-text">Thời gian</span></td>
                    <td><span class="thead-text">Tùy chỉnh</span></td>
                </tr>
            </thead>
            <tbody id="main-table">
                <?php
                $temp = 1;
                foreach ($list_advt as $advt_item) {
                    $created_date = getdate(strtotime($advt_item['created_date']));
                    $advt_item['created_date'] = "(" . format_weekday($created_date['weekday']) . ")  " . "{$created_date['mday']}/{$created_date['mon']}/{$created_date['year']}";
                ?>
                    <tr>
                        <td><input type="checkbox" name="checkItem[]" data-id="<?php echo $advt_item['id_advt'] ?>" class="checkItem"></td>
                        <td><span class="tbody-text num_order"><?php echo $temp ?></span></td>
                        <td><span class="tbody-text"><?php echo $advt_item['id_advt'] ?></span></td>
                        <td>
                            <div class="tbody-thumb img_wrapper">
                                <img src="<?php echo $advt_item['img_url'] ?>" alt="">
                            </div>
                        </td>
                        <td><a href="<?php echo $advt_item['link_url'] ?>" target="_blank" ><span data-advt_id="<?php echo $advt_item['id_advt'] ?>" class="tbody-text advt-title hidden_text"><?php echo $advt_item['link_url'] ?></span></a></td>
                        <td><span class="tbody-text status" data-id_advt="<?php echo $advt_item['id_advt'] ?>" data-status="<?php echo $advt_item['status'] ?>"><?php echo format_status($advt_item['status']) ?></span></td>
                        <td><span class="tbody-text"><?php echo $advt_item['creator'] ?></span></td>
                        <td><span class="tbody-text created-date" data-start_time="<?php echo $advt_item['start_time'] ?>" data-deadline="<?php echo $advt_item['deadline'] ?>"><?php echo $advt_item['created_date'] ?></span></td>
                        <td>
                            <span>
                                <ul class="list-operation d-flex" data-id_advt="<?php echo $advt_item['id_advt'] ?>">
                                    <li><a href="" data-id_advt="<?php echo $advt_item['id_advt'] ?>" data-toggle="modal" data-target="#modal_update_advt" title="Update" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li class="delete-opt position-relative">
                                        <a <?php if ($advt_item['status'] == 'trash') { ?>href="" data-option="permanently" title="Xóa vĩnh viễn" <?php } ?> data-modules="advt" class="permanently delete d-inline-block">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        <?php
                                        if ($advt_item['status'] != 'trash') {
                                        ?>
                                            <div class="option-delete position-absolute fa fa-caret-down">
                                                <a data-modules='advt' href="" data-status="<?php echo $advt_item['status'] ?>" class="goto-trash option-item" data-option="goto_trash">Thùng rác</a>
                                                <a data-modules='advt' href="" class="permanently all option-item" data-option="permanently">Vĩnh viễn</a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </li>
                                    <li>
                                        <div class="switch status advt">
                                            <?php
                                            if ($advt_item['status'] == 'trash') {
                                            ?>
                                                <a href="" title="Khôi phục" style="font-size: 14px; padding: 5.8px 14px;" class="restore advt fa fa-undo" data-option="restore"></a>
                                            <?php
                                            } else {
                                            ?>
                                                <label for="status" data-modules="advt" class="btn-change-status" data-id_advt="<?php echo $advt_item['id_advt'] ?>" data-active="<?php echo format_mode_status($advt_item['status']) ?>">
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
                    <td><span class="tfoot-text">STT</span></td>
                    <td><span class="tfoot-text">Mã số</span></td>
                    <td><span class="tfoot-text-text">Link quảng cáo</span></td>
                    <td><span class="tfoot-text">Trạng thái</span></td>
                    <td><span class="tfoot-text">Người tạo</span></td>
                    <td><span class="tfoot-text">Tên danh mục</span></td>
                    <td><span class="thead-text">Tùy chỉnh</span></td>
                </tr>
            </tfoot>
            <!-- ----------------- -->
        <?php
        } else {
        ?>
            <div class="notifi_process mx-auto">
                <span class="thumb-img"><img src="public/images/notFoundIcon.png" class="img-fluid" alt=""></span>
                <p class="txt_notifi">Hiện tại không tìm thấy bài viết nào ..!</p>
                <div class="add">
                    <a href="?mod=advt&action=add" class="link-add text-center d-block">Thêm tại đây.!</a>
                </div>
            </div>
<?php
        }
    }
}


//== add view ==//
function addAction()
{
    load('lib', 'validation_form');
    if (isset($_POST['btn_add_advt'])) {
        $error = array();
        global $error;

        // check link url 
        if (empty($_POST['link_url'])) {
            $error['link_url'] = "<span class='error'>(*) Vui lòng chọn một đường dẫn của quảng cáo</span>";
        } else {
            $link_url = $_POST['link_url'];
        }

        // check start time
        if (empty($_POST['start_time'])) {
            $error['start_time'] = "<span class='error'>(*) Vui lòng chòn ngày bắt đầu của quảng cáo</span>";
        } else {
            $start_time = $_POST['start_time'];
        }

        // check deadline
        if (empty($_POST['deadline'])) {
            $error['deadline'] = "<span class='error'>(*) Vui lòng chọn ngày kết thúc của quảng cáo</span>";
        } else {
            if (strtotime($_POST['start_time']) > strtotime($_POST['deadline'])) {
                $error['deadline'] = "<span class='error'>(*) Thời gian kết thúc đang nhỏ hơn thời gian bắt đầu</span>";
            } else {
                $deadline = $_POST['deadline'];
            }
        }

        // check img
        if (empty($_POST['thumbnail_url'])) {
            $error['thumbnail_url'] = "<span class='error'>(*) Bạn chưa thêm ảnh cho quảng cáo</span>";
        } else {
            $img_url = $_POST['thumbnail_url'];
        }

        // check status
        if (empty($_POST['status'])) {
            $status = "pending";
        } else {
            $status = $_POST['status'];
        }
        // check error
        if (empty($error)) {
            $creator = user_login();
            $created_date = date('y-m-d');
            $data = array(
                "link_url" => $link_url,
                "img_url" => $img_url,
                "start_time" => $start_time,
                "deadline" => $deadline,
                "status" => $status,
                "creator" => $creator,
                "created_date" => $created_date
            );
            add_advt($data);
            $data_view['notification'] = "<div class='success'></div>";
            $data_view['process'] = "success";
        }
    }
    if (!empty($data_view)) {
        load_view('add', $data_view);
    } else {
        load_view('add');
    }
}
//=============
// update info
//=============

function upload_img_fileAction()
{
    if ($_SERVER['REQUEST_METHOD']) {
        if (!isset($_FILES['file'])) {
            $error['file'] = "Bạn chưa chọn bấc kỳ file ảnh nào";
            $data = array(
                "status" => "error",
                "error" => $error
            );
            echo json_encode($data);
        } else {
            $error = array();
            $target_dir  = "public/uploads/advt/";
            $target_file = $target_dir . basename($_FILES['file']['name']);
            // check type file img valid
            $type_file = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
            if (!in_array(strtolower($type_file), $type_fileAllow)) {
                $error['file'] = "Hệ thống không hỗ trợ file này, vui lòng chọn một file ảnh hợp lệ";
            } else {
                $file_size = $_FILES['file']['size'];
                if ($file_size > 5242880) {
                    $error['file'] = "File bạn chọn không được vược quá 5MB";
                } else {
                    if (file_exists($target_file)) {
                        $get_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                        $name_new = $get_name . " - Copy.";
                        $path_file_new = $target_dir . $name_new . $type_file;
                        $k = 1;
                        while (file_exists($path_file_new)) {
                            $get_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                            $name_new = $get_name . " - Copy({$k}).";
                            $path_file_new = $target_dir . $name_new . $type_file;
                            $k++;
                        }
                        $target_file = $path_file_new;
                    }
                }
            }
            // upload when not error
            if (empty($error)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                    $flag = true;
                    $data = array(
                        "status" => "success",
                        "file_path" => $target_file
                    );
                } else {
                    $error['file'] = "Upload không thành công";
                    $data = array(
                        "status" => "error",
                        "error" => $error
                    );
                }
            } else {
                $data = array(
                    "status" => "error",
                    "error" => $error
                );
            }
            echo json_encode($data);
        }
    }
};
// update total info advt
function update_total_infoAction()
{
    $id_advt = $_POST['id_advt'];
    $data = array(
        "link_url" => $_POST['link_url'],
        "start_time" => $_POST['start_time'],
        "deadline" => $_POST['deadline']
    );
    $process = update_advt($data, $id_advt);
    if ($process == true) {
        $data_process = array(
            "status" => "success"
        );
    } else {
        $data_process = array(
            "status" => "error"
        );
    }
    echo json_encode($data_process);
}

// change img advt 
function change_img_advtAction()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $target_dir = "public/uploads/advt/";
        $name_img = basename($_FILES['file']['name']);
        $target_file = $target_dir . $name_img;
        $exten_file = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (file_exists($target_file)) {
            $get_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
            $name_new = $get_name . " - Copy.";
            $path_file_new = $target_dir . $name_new . $exten_file;
            $k = 1;
            while (file_exists($path_file_new)) {
                $name_new = $get_name . " - Copy({$k}).";
                $path_file_new = $target_dir . $name_new . $exten_file;
                $k++;
            }
            $target_file = $path_file_new;
        }
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            $data = array(
                "status" => "success",
                "path_img" => $target_file
            );
        } else {
            $data = array(
                "status" => "error"
            );
        }
        echo json_encode($data);
    }
}
//  update img advt
function update_img_advtAction()
{
    $src_img_curr = $_POST['src_img_curr'];
    $data_id = (int) $_POST['data_id'];
    $src_img_new = $_POST['src_img_new'];
    $allow_delete_img_old = $_POST['allow_delete_img_old'];
    $data = array(
        "img_url" => $src_img_new
    );
    $process = update_img_new($data, $data_id);
    if ($process) {
        if ($allow_delete_img_old == "true") {
            unlink($src_img_curr);
        }
        $data = array(
            "status" => "success",
            "path_img" => $src_img_new
        );
    } else {
        $data = array(
            "status" => "error",
            "path_img" => $src_img_curr
        );
    }
    echo json_encode($data);
}
//=================
// load num status
//=================

function load_num_statusAction()
{
    $data = array(
        "num_all"     => count(get_list_advt_by_status("all")),
        "num_publish" => count(get_list_advt_by_status("publish")),
        "num_pending" => count(get_list_advt_by_status("pending")),
        "num_trash"   => count(get_list_advt_by_status("trash")),
    );
    echo json_encode($data);
}
//============
// goto trash
//============

function goto_trashAction()
{
    $action = $_POST['action'];
    if ($action == "goto_trash_item") {
        $data_id = $_POST['data_id'];
        $status_old = $_POST['status_old'];
        $data = array(
            "status_old" => $status_old,
            "status" => "trash"
        );
        update_status_advt($data, $data_id);
    } else {
        // update list
        $list_status_old = $_POST['status_old'];
        foreach ($list_status_old as $key => $status_old) {
            if ($status_old != '') {
                $data_save_status = array(
                    "status_old" => $status_old,
                    "status"     => "trash"
                );
                update_status_advt($data_save_status, $key);
            }
        }
    }
}
//====================
// delete permanently
//====================

function delete_permanentlyAction()
{
    $action = $_POST['action'];
    if ($action == 'delete_item') {
        $data_id = (int) $_POST['data_id'];
        $path_img_avatar = get_advt_item_by_id($data_id)['img_url'];
        $unlink = $_POST['unlink'];
        $process = delete_advt_item($data_id);
        if ($process) {
            if ($unlink == 1) {
                unlink($path_img_avatar);
            }
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
        $unlink = $_POST['unlink'];
        foreach ($list_checked as $id_item) {
            $path_img_avatar = get_advt_item_by_id($id_item)['img_url'];
            delete_advt_item($id_item);
            if ($unlink == 1) {
                unlink($path_img_avatar);
            }
        }
        $data = array(
            "status" => "success"
        );
        echo json_encode($data);
    }
}

//===============
// change status
//===============

function change_statusAction()
{
    $action = $_POST['action'];
    if ($action == "change_status_item") {
        load('helper', 'format');
        $data_id        = $_POST['data_id'];
        $status_current = $_POST['status_current'];
        $data = array(
            "status" => $status_current
        );
        $process = update_status_advt($data, $data_id);
        if ($process) {
            $data['status_vnm'] = format_status($data["status"]);
            echo json_encode($data);
        }
    } else {
        $list_checked = $_POST['list_checked'];
        $action_status = $_POST['action_status'];
        foreach ($list_checked as $id_item) {
            $data = array(
                "status" => $action_status
            );
            update_status_advt($data, $id_item);
        }
    }
}

//=========
// restore
//=========

function restoreAction()
{
    $action = $_POST['action'];
    if ($action == 'restore_item') {
        $data_id = $_POST['data_id'];
        $slider_item = get_advt_item_by_id($data_id);
        $status_old = $slider_item['status_old'];
        $data = array(
            "status" => $status_old,
            "status_old" => null
        );
        update_status_advt($data, $data_id);
    } else {
        $list_data_id = $_POST['data_id'];
        foreach ($list_data_id as $id_item) {
            $slider_item = get_advt_item_by_id($id_item);
            $status_old = $slider_item['status_old'];
            $data_update_status = array(
                "status"     => $status_old,
                "status_old" => null
            );
            update_status_advt($data_update_status, $id_item);
        }
    }
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
    $search_result = search_advt($q, $option_search, $status_curr);
    $num_list_advt = count($search_result);
    $total_page = ceil($num_list_advt / $num_per_page);
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
    $list_history_search = get_list_search_history("tbl_advt");
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
                        <span class="field">(<?php echo format_name_advt($search_item['search_option']) ?>)</span>
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