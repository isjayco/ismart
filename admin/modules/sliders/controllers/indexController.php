<?php
function construct()
{
    load_model('index');
}

// index action
function indexAction()
{
    load('helper', 'format');
    $data = array(
        "list_sliders_all" => get_list_sliders_by_status("all"),
        "list_sliders_not_trash" => get_list_sliders_by_status("all_not_trash"),
        "list_sliders_publish" => get_list_sliders_by_status("publish"),
        "list_sliders_pending" => get_list_sliders_by_status("pending"),
        "list_sliders_trash" => get_list_sliders_by_status('trash'),
        "list_search_history" => get_list_search_history("tbl_sliders")
    );
    load_view('index', $data);
}

// function add action
function addAction()
{
    load('lib', 'validation_form');
    load('helper', 'format');
    load('helper', 'string');
    if (isset($_POST['btn_add_slider'])) {
        $error = array();
        global $error;
        // check name slider
        if (empty($_POST['name_slider'])) {
            $error['name_slider'] = "<span class='error'>(*) Vui lòng không để trống tên của slider</span>";
        } else {
            if (check_name_slider_exists($_POST['name_slider'])) {
                $error['name_slider'] = "<span class='error'>(*) Tên slider này đã tồn tại trước đó</span>";
            } else {
                $name_slider = $_POST['name_slider'];
            }
        }

        // check friendly url
        if (empty($_POST['friendly_url'])) {
            $_POST['friendly_url'] = create_slug($_POST['name_slider']);
            $friendly_url = $_POST['friendly_url'];
        } else {
            if (slug_url_exists(create_slug($_POST['friendly_url']))) {
                $error['friendly_url'] = "<span class='error'>(*) Đường link thân thiện này đã tồn tại trước đó</span>";
            } else {
                $friendly_url = create_slug($_POST['friendly_url']);
            }
        }

        // check numerical order
        if (empty($_POST['numerical_order'])) {
            $error['numerical_order'] = "<span class='error'>(*) Vui lòng không bỏ trống thứ tự của slider</span>";
        } else {
            if (!is_number($_POST['numerical_order'])) {
                $error['numerical_order'] = "<span class='error'>(*) Định dạng không hợp lệ chỉ chấp nhận số từ 0 đến 9 và lớn hơn hoặc bằng 1</span>";
            } else {
                $numerical_order = (int) $_POST['numerical_order'];
            }
        }

        // check thumb img
        if (empty($_POST['thumbnail_url'])) {
            $error['thumbnail_url'] = "<span class='error'>(*) Vui lòng chọn bộ slider image cho slider</span>";
        } else {
            if (check_avatar_slider_exists($_POST['thumbnail_url'])) {
                $error['thumbnail_url'] = "<span class='error'>(*) File ảnh này đã được sử dụng trước đó</span>";
            } else {
                $thumbnail_url = $_POST['thumbnail_url'];
            }
        }

        // check status 
        if (empty($_POST['status'])) {
            $status = "pending";
        } else {
            $status = $_POST['status'];
        }

        // check if not error then add slider into db

        if (empty($error)) {
            $creator = user_login();
            $created_date = time();
            $data = array(
                "name_slider" => $name_slider,
                "friendly_url" => $friendly_url,
                "numerical_order" => $numerical_order,
                "avatar" => $thumbnail_url,
                "status" => $status,
                "creator" => $creator,
                "created_date" => $created_date
            );
            add_slider($data);
            $error['no'] = "<span id='success'>(*) Thêm thành công</span>";
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

// upload img file
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
            $target_dir = "public/uploads/sliders/";
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
}
// check_numerical_order_exists
function check_numerical_order_existsAction()
{
    $numerical_order = $_POST['numerical_order'];
    $check = check_numerical_order_exists($numerical_order);
    if ($check == true) {
        $slider_item = get_slider_item_by_numerical_order($numerical_order);
        $data = array(
            "status" => $check,
            "slider_item" => $slider_item
        );
    } else {
        $data = array(
            "status" => $check
        );
    }
    echo json_encode($data);
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
        $id_slider  = !empty($_GET['data_id']) ? $_GET['data_id'] : null;
        if ($id_slider != null) {
            $num_list_slider = count(get_list_slider_by_status("public"));
        } else {
            $num_list_slider = count(get_list_slider_by_status($status));
            $list_trash = count(get_list_slider_by_status("trash"));
            if ($status == "trash") {
                $num_list_slider -= $list_trash;
            }
        }
        $total_page = ceil($num_list_slider / $num_per_page);
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
            $list_slider = get_list_page_slider_by_pagination($page_start, $num_per_page, $status, null);
        } else {
            $q = $_POST['q'];
            $option_search = $_POST['option_search'];
            $status_curr = $_POST['status_curr'];
            $curr_page = $_POST['current_page'];
            $num_per_page = $_POST['num_per_page'];
            $page_start = (int) ($curr_page - 1) * $num_per_page;
            $list_slider = get_list_page_slider_by_search($q, $option_search, $page_start, $num_per_page, $status_curr);
        }
        if (!empty($list_slider)) {
?>
            <!-- -------------- -->
            <thead>
                <tr>
                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                    <td><span class="thead-text">STT</span></td>
                    <td><span class="thead-text">Hình ảnh</span></td>
                    <td><span class="thead-text">Tên slider</span></td>
                    <td><span class="thead-text">Thứ tự</span></td>
                    <td><span class="thead-text">Trạng thái</span></td>
                    <td><span class="thead-text">Người tạo</span></td>
                    <td><span class="thead-text">Thời gian</span></td>
                    <td><span class="thead-text pl-4">Tác vụ</span></td>
                </tr>
            </thead>
            <tbody id="main-table">
                <?php
                $temp = 1;
                foreach ($list_slider as $slider_item) {
                    $data = getdate($slider_item['created_date']);
                    $slider_item['created_date'] = "(" . format_weekday($data['weekday']) . ")  " . "{$data['mday']}/{$data['mon']}/{$data['year']} {$data['hours']}:{$data['minutes']}";
                ?>
                    <tr>
                        <td><input type="checkbox" name="checkItem[]" data-id="<?php echo $slider_item['id_slider'] ?>" class="checkItem"></td>
                        <td><span class="tbody-text num_order"><?php echo $temp; ?></span></td>
                        <td>
                            <div class="tbody-thumb">
                                <img src="<?php echo $slider_item['avatar'] ?>" alt="">
                            </div>
                        </td>
                        <td><a href="" data-href='<?php echo $slider_item['friendly_url'] ?>' data-toggle="modal" data-target="#modal_update_slider" contenteditable="false" class="tbody-text hidden_text name_slider"><?php echo $slider_item['name_slider'] ?></a></td>
                        <td><span class="tbody-text numerical-order"><?php echo $slider_item['numerical_order'] ?></span></td>
                        <td><span class="tbody-text status" data-id_sliders="<?php echo $slider_item['id_slider'] ?>" data-status="<?php echo $slider_item['status'] ?>"><?php echo format_status($slider_item['status']) ?></span></td>
                        <td><span class="tbody-text"><?php echo $slider_item['creator'] ?></span></td>
                        <td><span class="tbody-text"><?php echo $slider_item['created_date'] ?></span></td>
                        <td>
                            <span>
                                <ul class="list-operation d-flex" data-id_sliders="<?php echo $slider_item['id_slider'] ?>">
                                    <li><a href="" data-toggle="modal" data-target="#modal_update_slider" data-id_sliders="<?php echo $slider_item['id_slider'] ?>" title="Update" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li class="delete-opt position-relative">
                                        <a <?php if ($slider_item['status'] == 'trash') { ?> href="" data-option="permanently" title="Xóa vĩnh viễn" data-modules="sliders" <?php } ?> class="permanently delete d-inline-block">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        <?php
                                        if ($slider_item['status'] != 'trash') {
                                        ?>
                                            <div class="option-delete position-absolute fa fa-caret-down">
                                                <a data-modules="sliders" href="" data-status="<?php echo $slider_item['status'] ?>" class="goto-trash option-item" data-option="goto_trash">Thùng rác</a>
                                                <a data-modules="sliders" href="" class="permanently all option-item" data-option="permanently">Vĩnh viễn</a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </li>
                                    <li>
                                        <div class="switch status sliders">
                                            <?php
                                            if ($slider_item['status'] == 'trash') {
                                            ?>
                                                <a href="" title="Khôi phục" style="font-size: 14px; padding: 5.8px 14px;" class="restore sliders fa fa-undo" data-option="restore"></a>
                                            <?php
                                            } else {
                                            ?>
                                                <label for="status" data-modules="sliders" class="btn-change-status" data-id_sliders="<?php echo $slider_item['id_slider'] ?>" data-active="<?php echo format_mode_status($slider_item['status']) ?>">
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
                    <td><span class="thead-text">Hình ảnh</span></td>
                    <td><span class="thead-text">Link slider</span></td>
                    <td><span class="thead-text">Thứ tự</span></td>
                    <td><span class="thead-text">Trạng thái</span></td>
                    <td><span class="thead-text">Người tạo</span></td>
                    <td><span class="thead-text">Thời gian</span></td>
                    <td><span class="thead-text pl-4">Tác vụ</span></td>
                </tr>
            </tfoot>
            <!-- -------------- -->
        <?php
        } else {
        ?>
            <div class="notifi_process mx-auto">
                <span class="thumb-img"><img src="public/images/notFoundIcon.png" class="img-fluid" alt=""></span>
                <p class="txt_notifi">Hiện tại không tìm thấy slider nào ..!</p>
                <div class="add">
                    <a href="?mod=sliders&action=add" class="link-add text-center d-block">Thêm tại đây.!</a>
                </div>
            </div>
<?php
        }
    }
}

// change img slider 
function change_img_sliderAction()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $target_dir = "public/uploads/sliders/";
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

//  update img slider
function update_img_sliderAction()
{
    $src_img_curr = $_POST['src_img_curr'];
    $data_id = $_POST['data_id'];
    $src_img_new = $_POST['src_img_new'];
    $allow_delete_img_old = $_POST['allow_delete_img_old'];
    $data = array(
        "avatar" => $src_img_new
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
function update_info_sliderAction()
{
    $id_slider   = $_POST['id_slider'];
    $name_slider = $_POST['name_slider'];
    $numerical_order = $_POST['numerical_order'];
    $link_slider = empty($_POST['link_slider']) ? $name_slider : $_POST['link_slider'];
    $data = array(
        "name_slider" => $name_slider,
        "friendly_url" => $link_slider,
        "numerical_order" => $numerical_order,
        "update_date" => time()
    );
    $process = update_info_slider($data, $id_slider);
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
//=================
// load num status
//=================

function load_num_statusAction()
{
    $data = array(
        "num_all"     => count(get_list_sliders_by_status("all")),
        "num_publish" => count(get_list_sliders_by_status("publish")),
        "num_pending" => count(get_list_sliders_by_status("pending")),
        "num_trash"   => count(get_list_sliders_by_status("trash")),
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
        update_status_sliders($data, $data_id);
    } else {
        // update list
        $list_status_old = $_POST['status_old'];
        $status = array();
        foreach ($list_status_old as $key => $status_old) {
            if ($status_old != '') {
                $data_save_status = array(
                    "status_old" => $status_old,
                    "status"     => "trash"
                );
                update_status_sliders($data_save_status, $key);
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
        $path_img_avatar = get_slider_item_by_id($data_id)['avatar'];
        $unlink = $_POST['unlink'];
        $process = delete_slider_item($data_id);
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
            $path_img_avatar = get_slider_item_by_id($id_item)['avatar'];
            delete_slider_item($id_item);
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
        $process = update_status_slider($data, $data_id);
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
            update_status_slider($data, $id_item);
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
        $slider_item = get_slider_item_by_id($data_id);
        $status_old = $slider_item['status_old'];
        $data = array(
            "status" => $status_old,
            "status_old" => null
        );
        update_status_slider($data, $data_id);
    } else {
        $list_data_id = $_POST['data_id'];
        foreach ($list_data_id as $id_item) {
            $slider_item = get_slider_item_by_id($id_item);
            $status_old = $slider_item['status_old'];
            $data_update_status = array(
                "status"     => $status_old,
                "status_old" => null
            );
            update_status_slider($data_update_status, $id_item);
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
    $search_result = search_slider($q, $option_search, $status_curr);
    $num_list_slider = count($search_result);
    $total_page = ceil($num_list_slider / $num_per_page);
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
    $list_history_search = get_list_search_history("tbl_sliders");
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
                        <span class="field">(<?php echo format_name_slider($search_item['search_option']) ?>)</span>
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
                        <span class="field">(<?php echo format_name_slider($search_item['search_option']) ?>)</span>
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
