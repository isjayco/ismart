<?php
function construct()
{
    load_model('index');
}


//=====================
// Index list post cat
//=====================

function indexAction()
{
    load('helper', 'format');
    $data = array(
        "list_post_cat_all"           => get_list_post_cat("all"),
        "list_post_cat_all_not_trash" => get_list_post_cat("all_not_trash"),
        "list_post_cat_publish"       => get_list_post_cat("publish"),
        "list_post_cat_pending"       => get_list_post_cat("pending"),
        "list_post_cat_trash"         => get_list_post_cat("trash"),
        "list_search_history"         => get_list_search_history("tbl_postcat"),
    );
    load_view("postCat", $data);
}

//==============
// Add post cat
//==============

function addAction()
{
    load('lib', 'validation_form');
    if (isset($_POST['btn_add_postCat'])) {
        $error = array();
        global $error;
        // check name post cat
        if (empty($_POST['name_postCat'])) {
            $error['name_postCat'] = "<span class='error'>(*) Không được bỏ trống tên của danh mục</span>";
        } else {
            if (check_name_postCat_exists($_POST['name_postCat'])) {
                $error['name_postCat'] = "<span class='error'>(*) Danh mục này đã tồn tại</span>";
            } else {
                $name_postCat = $_POST['name_postCat'];
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
                "name_postCat" => $name_postCat,
                "status"       => $status,
                "created_date" => $created_date,
                "creator"      => $creator
            );
            add_postCat($data);
            $error['no'] = "<span id='success'>(*) Thêm thành công</span>";
            $data_view['notification'] = "<div class='success'></div>";
            $data_view['process'] = "success";
        }
    }
    if (!empty($data_view)) {
        load_view('addPostcat', $data_view);
    } else {
        load_view('addPostcat');
    }
}

//============
// Pagination
//============
function paginationAction()
{
    load('helper', 'format');
    load('helper', 'string');
    $type = $_GET['type'];
    if ($type == "get_total_page") {
        $status = $_GET['status'];
        $num_per_page = $_GET['num_per_page'];
        $num_list_post_cat = count(get_list_post_cat($status));
        $list_trash =  count(get_list_post_cat('trash'));
        if ($status == 'all') {
            $num_list_post_cat -= $list_trash;
        }
        $total_page = ceil($num_list_post_cat / $num_per_page);
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
            $list_post_cat = get_list_page_post_cat_by_pagination($page_start, $num_per_page, $status);
        } else {
            $q = $_POST['q'];
            $option_search = $_POST['option_search'];
            $status_curr = $_POST['status_curr'];
            $curr_page = $_POST['current_page'];
            $num_per_page = $_POST['num_per_page'];
            $page_start = (int) ($curr_page - 1) * $num_per_page;
            $list_post_cat = get_list_page_post_cat_by_search($q, $option_search, $page_start, $num_per_page, $status_curr);
        }
        if (!empty($list_post_cat)) {
?>
            <!-- ------------------- -->
            <thead>
                <tr>
                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                    <td><span class="thead-text">STT</span></td>
                    <td><span class="thead-text">Mã số</span></td>
                    <td><span class="thead-text">Tên danh mục</span></td>
                    <td><span class="thead-text">Trạng thái</span></td>
                    <td><span class="thead-text">Người tạo</span></td>
                    <td><span class="thead-text">Danh mục con</span></td>
                    <td><span class="thead-text">Thời gian</span></td>
                    <td><span class="thead-text">Tùy chỉnh</span></td>
                </tr>
            </thead>
            <tbody id="main-table">
                <?php
                $temp = 1;
                foreach ($list_post_cat as $item) {
                    $data = getdate($item['created_date']);
                    $item['created_date'] = "(" . format_weekday($data['weekday']) . ")  " . "{$data['mday']}/{$data['mon']}/{$data['year']} {$data['hours']}:{$data['minutes']}";
                ?>
                    <tr>
                        <td><input data-id_post_cat="<?php echo $item['id_postCat'] ?>" type="checkbox" name="checkItem[]" class="checkItem"></td>
                        <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                        <td><span class="tbody-text"><?php echo $item['id_postCat'] ?></h3></span>
                        <td><a href="?mod=posts&controller=postsCat&action=subCat&id=<?php echo $item['id_postCat'] ?>"><span class="tbody-text name" data-id_post_cat="<?php echo $item['id_postCat'] ?>"><?php echo $item['name_postCat'] ?></span></a></td>
                        <td><span class="tbody-text status" data-id_post_cat="<?php echo $item['id_postCat'] ?>" data-status="<?php echo $item['status'] ?>"><?php echo format_status($item['status']) ?></span></td>
                        <td><span class="tbody-text"><?php echo $item['creator'] ?></span></td>
                        <td class="text-center"><span class="tbody-text"><?php echo num_post_by_id_post_cat($item['id_postCat']) ?></span></td>
                        <td><span class="tbody-text created-date"><?php echo $item['created_date'] ?></span></td>
                        <td>
                            <span>
                                <ul class="list-operation d-flex" data-id_post_cat="<?php echo $item['id_postCat'] ?>">
                                    <li><a href="" title="Sửa" class="edit" data-toggle="modal" data-target="#edit_postCat"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li class="delete-opt position-relative">
                                        <a <?php if ($item['status'] == 'trash') { ?> href="" data-modules="post_cat" data-option="permanently" <?php } ?> title="Xóa vĩnh viễn" class="permanently delete d-inline-block">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        <?php
                                        if ($item['status'] != 'trash') {
                                        ?>
                                            <div class="option-delete position-absolute fa fa-caret-down">
                                                <a href="" data-status="pending" data-modules='post_cat' class="goto-trash option-item" data-option="goto_trash">Thùng rác</a>
                                                <a href="" class="permanently all option-item" data-modules="post_cat" data-option="permanently">Vĩnh viễn</a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </li>
                                    <li>
                                        <div class="switch status post-cat">
                                            <?php
                                            if ($item['status'] == 'trash') {
                                            ?>
                                                <a href="" title="Khôi phục" style="font-size: 14px; padding: 5.8px 14px;" class="restore post_cat fa fa-undo" data-option="restore"></a>
                                            <?php
                                            } else {
                                            ?>
                                                <label for="status" data-modules="post_cat" class='btn-change-status' data-id_post_cat="<?php echo $item['id_postCat'] ?>" data-active="<?php echo format_mode_status($item['status']) ?>">
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
                    <td><span class="tfoot-text-text">Tên danh mục</span></td>
                    <td><span class="tfoot-text">Trạng thái</span></td>
                    <td><span class="tfoot-text">Người tạo</span></td>
                    <td><span class="tfoot-text">Tên danh mục</span></td>
                    <td><span class="thead-text">Tùy chỉnh</span></td>
                </tr>
            </tfoot>
            <!-- ------------------- -->
        <?php
        } else {
        ?>
            <div class="notifi_process mx-auto">
                <span class="thumb-img"><img src="public/images/notFoundIcon.png" class="img-fluid" alt=""></span>
                <p class="txt_notifi">Hiện tại không tìm thấy danh mục nào ..!</p>
                <div class="add">
                    <a href="?mod=posts&action=add" class="link-add text-center d-block">Thêm tại đây.!</a>
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
    if (check_exists_name_post_cat($name_new)) {
        $error['name_new'] = "Tên danh mục này đã tồn tại trong hệ thống";
    }
    if (empty($error)) {
        $data = array(
            "name_postCat" => $name_new
        );
        $process = update_name_post_cat($data, $data_id);
        if ($process == true) {
            $data_process = array(
                "status"   => "success",
                "notifi"   => "Cập nhật thành công",
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
        $process = delete_post_cat_item($data_id);
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
            $process = delete_post_cat_item($id_item);
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

//=================
// Load num status
//=================

function load_num_statusAction()
{
    $data = array(
        "num_all"     => count(get_list_post_cat('all')),
        "num_publish" => count(get_list_post_cat('publish')),
        "num_pending" => count(get_list_post_cat('pending')),
        "num_trash"   => count(get_list_post_cat('trash')),
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
        update_status_post_cat($data_save_status, $data_id);
    } else {
        $list_status_old = $_POST['status_old'];
        $status = array();
        foreach ($list_status_old as $key => $status_old) {
            if ($status_old != '') {
                $data_save_status = array(
                    "status_old" => $status_old,
                    "status"     => "trash"
                );
                update_status_post_cat($data_save_status, $key);
            }
        }
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
        $process = update_status_post_cat($data, $data_id);
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
            update_status_post_cat($data, $id_item);
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
        $status_old = get_status_post_cat_old($data_id);
        $status_old = $status_old['status_old'];
        $data_update_status = array(
            "status" => $status_old,
            "status_old" => null
        );
        update_status_post_cat($data_update_status, $data_id);
    } else {
        $list_data_id = $_POST['data_id'];
        foreach ($list_data_id as $id_item) {
            $status_old = get_status_post_cat_old($id_item);
            $status_old = $status_old['status_old'];
            $data_update_status = array(
                "status" => $status_old,
                "status_old" => null
            );
            update_status_post_cat($data_update_status, $id_item);
        }
    }
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
    $search_result = search_post_cat($q, $option_search, $status_curr);
    $num_list_post_cat = count($search_result);
    $total_page = ceil($num_list_post_cat / $num_per_page);
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
    $list_history_search = get_list_search_history("tbl_postcat");
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
                        <span class="field">(<?php echo format_name_post_cat($search_item['search_option']) ?>)</span>
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
                        <span class="field">(<?php echo format_name_post_cat($search_item['search_option']) ?>)</span>
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

//==============
// List sub cat
//==============

function subCatAction()
{
    $controller  = $_GET['controller'];
    $action      = $_GET['action'];
    $post_cat_id = $_GET['id'];
    $post_cat_item = get_postCat_item($post_cat_id);
    $name_postCat = $post_cat_item['name_postCat'];
    $list_post = get_list_post_by_id_post_cat($post_cat_id);
    $data = array(
        "id_post_cat"  => $post_cat_id,
        "name_postCat" => $name_postCat,
        "list_post"    => $list_post,
        "controller"   => $controller,
        "action"       => $action
    );
    load_view('sub_cat', $data);
}
