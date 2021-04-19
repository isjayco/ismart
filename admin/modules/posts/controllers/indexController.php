<?php

use function JmesPath\search;

function construct()
{
    load_model('index');
}

//========================
// index view (list page)
//========================

function indexAction()
{
    load('helper', 'format');
    $data = array(
        "list_post_all"           => get_list_post_by_status('all'),
        "list_post_all_not_trash" => get_list_post_by_status('all_not_trash'),
        "list_post_publish"       => get_list_post_by_status('publish'),
        "list_post_pending"       => get_list_post_by_status('pending'),
        "list_post_trash"         => get_list_post_by_status('trash'),
        "list_search_history"     => get_list_search_history("tbl_posts"),
    );
    load_view('index', $data);
}

//==========
// add post
//==========

function addAction()
{
    load('lib', 'validation_form');
    load('helper', 'string');
    $list_post_cat = get_list_post_cat("all");
    if (isset($_POST['btn_add_post'])) {
        global $error;
        $error = array();
        // check title post
        if (empty($_POST['post_title'])) {
            $error['post_title'] = "<span class='error'>(*) Không được bỏ trống tiêu đề bài viết</span>";
        } else {
            if (title_post_exists($_POST['post_title'])) {
                $error['post_title'] = "<span class='error'>(*) Tiêu đề này đã tồn tại trước đó</span>";
            } else {
                $post_title = $_POST['post_title'];
            }
        }

        // check friendly url
        if (empty($_POST['friendly_url'])) {
            $friendly_url = create_slug($_POST['post_title']);
        } else {
            if (slug_url_exists(create_slug($_POST['friendly_url']))) {
                $error['friendly_url'] = "<span class='error'>(*) Đường dẫn này đã tồn tại trước đó</span>";
            } else {
                $friendly_url = create_slug($_POST['friendly_url']);
            }
        }

        // check post desc
        if (empty($_POST['post_desc'])) {
            $error['post_desc'] = "<span class='error'>(*) Không được bỏ trống mô tả ngắn cho bài viết</span>";
        } else {
            $post_desc = $_POST['post_desc'];
        }

        // check post content
        if (empty($_POST['post_content'])) {
            $error['post_content'] = "<span class='error'>(*) Không được bỏ trống nội dung bài viết</span>";
        } else {
            $post_content = $_POST['post_content'];
        }

        // check post img
        if (!empty($_POST['thumbnail_url'])) {
            $target_file = $_POST['thumbnail_url'];
        } else {
            $error['post_img'] = "<span class='error'>(*) Không được bỏ trống ảnh của bài viết</span>";
        }

        // check status
        if (empty($_POST['status'])) {
            $status = "pending";
        } else {
            $status = $_POST['status'];
        }

        // check post cat
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "<span class='error'>(*) Không được bỏ trống danh mục bài viết</span>";
        } else {
            $parent_cat = $_POST['parent_cat'];
        }

        // add post
        if (empty($error)) {
            $created_date = time();
            $creator = user_login();
            $data = array(
                "post_title"   => $post_title,
                "post_url"     => $friendly_url,
                "post_desc"    => $post_desc,
                "post_content" => $post_content,
                "post_img"     => $target_file,
                "status"       => $status,
                "post_cat_id"  => $parent_cat,
                "created_date" => $created_date,
                "creator"      => $creator
            );
            add_post($data);
            $error['no'] = "<span id='success'>(*) Thêm thành công</span>";
            $data_view['notification'] = "<div class='success'></div>";
            $data_view['process'] = "success";
        }
    }
    $data_view['list_post_cat'] = $list_post_cat;
    load_view('add_post', $data_view);
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
        $id_post_cat  = !empty($_GET['data_id']) ? $_GET['data_id'] : null;
        if ($id_post_cat != null) {
            $num_list_post = count(get_list_post_by_id_post_cat($id_post_cat));
        } else {
            $num_list_post = count(get_list_post_by_status($status));
            $list_trash    = count(get_list_post_by_status("trash"));
            if ($status == 'all') {
                $num_list_post -= $list_trash;
            }
        }
        $total_page    = ceil($num_list_post / $num_per_page);
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
            $id_post_cat  = !empty($_POST['data_id']) ? $_POST['data_id'] : null;
            $page_start = (int) ($curr_page - 1) * $num_per_page;
            if ($id_post_cat != null) {
                $list_post = get_list_page_post_by_pagination($page_start, $num_per_page, $status, $id_post_cat);
            } else {
                $list_post = get_list_page_post_by_pagination($page_start, $num_per_page, $status, null);
            }
        } else {
            $q = $_POST['q'];
            $option_search = $_POST['option_search'];
            $status_curr = $_POST['status_curr'];
            if ($option_search == "post_cat_id" && check_post_cat_exists($q)) {
                $post_cat_item = get_post_cat_item("name_postCat", $q);
                $q = (int) $post_cat_item['id_postCat'];
            }
            $curr_page = $_POST['current_page'];
            $num_per_page = $_POST['num_per_page'];
            $page_start = (int) ($curr_page - 1) * $num_per_page;
            $list_post = get_list_page_post_by_search($q, $option_search, $page_start, $num_per_page, $status_curr);
        }
        if (!empty($list_post)) {
?>
            <!-- ----------------- -->
            <thead>
                <tr>
                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                    <td><span class="thead-text">STT</span></td>
                    <td><span class="thead-text">Mã số</span></td>
                    <td><span class="thead-text">Tiêu đề</span></td>
                    <td><span class="thead-text">Danh mục</span></td>
                    <td><span class="thead-text">Trạng thái</span></td>
                    <td><span class="thead-text">Người tạo</span></td>
                    <td><span class="thead-text">Thời gian</span></td>
                    <td><span class="thead-text">Tùy chỉnh</span></td>
                </tr>
            </thead>
            <tbody id="main-table">
                <?php
                $temp = 1;
                foreach ($list_post as $post_item) {
                    $post_cat_item = get_postCat_item($post_item['post_cat_id']);
                    $data = getdate($post_item['created_date']);
                    $post_item['created_date'] = "(" . format_weekday($data['weekday']) . ")  " . "{$data['mday']}/{$data['mon']}/{$data['year']} {$data['hours']}:{$data['minutes']}";
                ?>
                    <tr>
                        <td><input type="checkbox" name="checkItem[]" data-id="<?php echo $post_item['post_id'] ?>" class="checkItem"></td>
                        <td><span class="tbody-text num_order"><?php echo $temp ?></span></td>
                        <td><span class="tbody-text"><?php echo $post_item['post_id'] ?></span></td>
                        <td><span contenteditable='false' data-post_id="<?php echo $post_item['post_id'] ?>" class="tbody-text post-title hidden_text"><?php echo $post_item['post_title'] ?></span></td>
                        <td><span class="tbody-text"><?php echo $post_cat_item['name_postCat'] ?></span></td>
                        <td><span class="tbody-text status" data-id_post="<?php echo $post_item['post_id'] ?>" data-status="<?php echo $post_item['status'] ?>"><?php echo format_status($post_item['status']) ?></span></td>
                        <td><span class="tbody-text"><?php echo $post_item['creator'] ?></span></td>
                        <td><span class="tbody-text created-date"><?php echo $post_item['created_date'] ?></span></td>
                        <td>
                            <span>
                                <ul class="list-operation d-flex" data-id_post="<?php echo $post_item['post_id'] ?>">
                                    <li><a href="?mod=posts&action=update&lct=<?php echo $temp ?>&id=<?php echo $post_item['post_id'] ?>" data-id_post="<?php echo $post_item['post_id'] ?>" title="Update" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li class="delete-opt position-relative">
                                        <a <?php if ($post_item['status'] == 'trash') { ?>href="" data-option="permanently" title="Xóa vĩnh viễn" <?php } ?> class="permanently delete d-inline-block">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        <?php
                                        if ($post_item['status'] != 'trash') {
                                        ?>
                                            <div class="option-delete position-absolute fa fa-caret-down">
                                                <a data-modules='post' href="" data-status="<?php echo $post_item['status'] ?>" class="goto-trash option-item" data-option="goto_trash">Thùng rác</a>
                                                <a data-modules='post' href="" class="permanently all option-item" data-option="permanently">Vĩnh viễn</a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </li>
                                    <li>
                                        <div class="switch status post">
                                            <?php
                                            if ($post_item['status'] == 'trash') {
                                            ?>
                                                <a href="" title="Khôi phục" style="font-size: 14px; padding: 5.8px 14px;" class="restore post fa fa-undo" data-option="restore"></a>
                                            <?php
                                            } else {
                                            ?>
                                                <label for="status" data-modules="post" class="btn-change-status" data-id_post="<?php echo $post_item['post_id'] ?>" data-active="<?php echo format_mode_status($post_item['status']) ?>">
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
                    <td><span class="tfoot-text-text">Tiêu đề</span></td>
                    <td><span class="tfoot-text-text">Danh mục</span></td>
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
                    <a href="?mod=posts&action=add" class="link-add text-center d-block">Thêm tại đây.!</a>
                </div>
            </div>
        <?php
        }
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
        $process = update_status_post($data, $data_id);
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
            update_status_post($data, $id_item);
        }
    }
}

//=================
// load num status
//=================

function load_num_statusAction()
{
    $data = array(
        "num_all"     => count(get_list_post_by_status('all')),
        "num_publish" => count(get_list_post_by_status('publish')),
        "num_pending" => count(get_list_post_by_status('pending')),
        "num_trash"   => count(get_list_post_by_status('trash')),
    );
    echo json_encode($data);
}

//===============
// get info post
//===============

function updateAction()
{
    load('helper', 'format');
    load('helper', 'string');
    load('lib', 'validation_form');
    $post_id = (int) !empty($_GET['id']) ? $_GET['id'] : 0;
    $location = (int) !empty($_GET['lct']) ? $_GET['lct'] : 0;
    $post_item_by_id = get_post_item_by_id($post_id);
    $list_post_cat = get_list_post_cat("all");
    $data = getdate($post_item_by_id['created_date']);
    $post_item_by_id['created_date'] = "(" . format_weekday($data['weekday']) . ")  " . "{$data['mday']}/{$data['mon']}/{$data['year']} {$data['hours']}:{$data['minutes']}";
    $data_view = array(
        "location"      => $location,
        "post_item"     => $post_item_by_id,
        "list_post_cat" => $list_post_cat
    );


    if (isset($_POST['update_info_post'])) {
        global $error;
        $error = array();
        // check title post
        if (empty($_POST['post_title'])) {
            $error['post_title'] = "<span class='error'>(*) Không được bỏ trống tiêu đề bài viết</span>";
        } else {
            $post_title = $_POST['post_title'];
        }

        // check friendly url
        if (empty($_POST['friendly_url'])) {
            $friendly_url = create_slug($_POST['post_title']);
        } else {
            $friendly_url = create_slug($_POST['friendly_url']);
        }

        // check post desc
        if (empty($_POST['post_desc'])) {
            $error['post_desc'] = "<span class='error'>(*) Không được bỏ trống mô tả ngắn bài viết</span>";
        } else {
            $post_desc = $_POST['post_desc'];
        }

        // check post content
        if (empty($_POST['post_content'])) {
            $error['post_content'] = "<span class='error'>(*) Không được bỏ trống nội dung bài viết</span>";
        } else {
            $post_content = $_POST['post_content'];
        }

        // check post img
        if (!empty($_POST['thumbnail_url'])) {
            $target_file = $_POST['thumbnail_url'];
        } else {
            $error['post_img'] = "<span class='error'>(*) Không được bỏ trống ảnh của bài viết</span>";
        }

        // check status
        if (empty($_POST['status'])) {
            $status = "pending";
        } else {
            $status = $_POST['status'];
        }

        // check post cat
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "<span class='error'>(*) Không được bỏ trống danh mục bài viết</span>";
        } else {
            $parent_cat = $_POST['parent_cat'];
        }

        // add post
        if (empty($error)) {
            $update_date = time();
            $creator = user_login();
            $data = array(
                "post_title"   => $post_title,
                "post_url"     => $friendly_url,
                "post_desc"    => $post_desc,
                "post_content" => $post_content,
                "post_img"     => $target_file,
                "status"       => $status,
                "post_cat_id"  => $parent_cat,
                "update_date"  => $update_date,
                "creator"      => $creator
            );
            update_post($data, $post_id);
            $post_item_by_id = get_post_item_by_id($post_id);
            $data = getdate($post_item_by_id['created_date']);
            $post_item_by_id['created_date'] = "(" . format_weekday($data['weekday']) . ")  " . "{$data['mday']}/{$data['mon']}/{$data['year']} {$data['hours']}:{$data['minutes']}";
            $data_view = array(
                "location"      => $location,
                "post_item"     => $post_item_by_id,
                "list_post_cat" => $list_post_cat
            );
            $error['no'] = "<span id='success'>(*) Thêm thành công</span>";
            $data_view['notification'] = "<div class='success'></div>";
            $data_view['process'] = "success";
            $error['process_success'] = "<span class='success update-post'>(*) Cập nhật thành công</span>";
        }
        $error['process_error'] = "<span class='error update-post'>(*) Cập nhật không thành công</span>";
    }
    load_view('update', $data_view);
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
            $target_dir  = "public/uploads/posts/";
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

//=================
// update name img
//=================

function update_name_imgAction()
{
    $name_new = $_POST['name_new'];
    $data_id  = $_POST['data_id'];
    $path_name_old = get_path_img_file($data_id);
    $name_old = pathinfo($path_name_old['post_img'], PATHINFO_FILENAME);
    $exten_name_old = pathinfo($path_name_old['post_img'], PATHINFO_EXTENSION);
    $target_file = "public/uploads/posts/";
    if ($name_new != $name_old) {
        $path_name_new = $target_file . $name_new . "." . $exten_name_old;
        $path_name_old = $target_file . $name_old . "." . $exten_name_old;
        if (rename($path_name_old, $path_name_new)) {
            $data = array(
                "post_img" => $path_name_new
            );
            $process = update_name_img($data, $data_id);
            if ($process) {
                $data_view = array(
                    "status"   => "success",
                    "name_new" => $name_new,
                    "path_name_new" => $path_name_new
                );
            } else {
                $data_view = array(
                    "status"  => "error",
                    "new_old" => $name_old
                );
            }
        }
    } else {
        $data_view = array(
            "status" => "same",
            "content_error" => "Bạn đã lưu hình ảnh với tên cũ"
        );
    }
    echo json_encode($data_view);
}

//====================
// delete permanently
//====================

function delete_permanentlyAction()
{
    $action = $_POST['action'];
    if ($action == 'delete_item') {
        $data_id  = (int) $_POST['data_id'];
        $path_img = get_path_img_file($data_id);
        $path_img = $path_img['post_img'];
        $unlink   = $_POST['unlink'];
        $process  = delete_post_item($data_id);
        if ($process) {
            if ($unlink == 1) {
                unlink($path_img);
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
            $path_img = get_path_img_file($id_item);
            $path_img = $path_img['post_img'];
            $process = delete_post_item($id_item);
            if ($process) {
                if ($unlink == 1) {
                    unlink($path_img);
                }
                $data_view = array(
                    "status" => "success",
                );
            } else {
                $data_view = array(
                    "status" => "error",
                );
            }
        }
        echo json_encode($data_view);
    }
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
        update_status_post($data, $data_id);
    } else {
        $list_status_old = $_POST['status_old'];
        $status = array();
        foreach ($list_status_old as $key => $status_old) {
            if ($status_old != '') {
                $data_save_status = array(
                    "status_old" => $status_old,
                    "status"     => "trash"
                );
                update_status_post($data_save_status, $key);
            }
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
        $status_old = get_status_post_old($data_id);
        $status_old = $status_old['status_old'];
        $data = array(
            "status" => $status_old,
            "status_old" => null
        );
        update_status_post($data, $data_id);
    } else {
        $list_data_id = $_POST['data_id'];
        foreach ($list_data_id as $id_item) {
            $status_old = get_status_post_old($id_item);
            $status_old = $status_old['status_old'];
            $data_update_status = array(
                "status"     => $status_old,
                "status_old" => null
            );
            update_status_post($data_update_status, $id_item);
        }
    }
}

//========
// search
//========

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
    if ($option_search == 'post_cat_id' && check_post_cat_exists($q)) {
        $post_cat_item = get_post_cat_item("name_postCat", $q);
        $q = (int) $post_cat_item['id_postCat'];
    }
    $search_result = search_post($q, $option_search, $status_curr);
    $num_list_post = count($search_result);
    $total_page = ceil($num_list_post / $num_per_page);
    $data_view = array(
        "total_page" => $total_page,
    );
    echo json_encode($data_view);
}

//==========================
// load data history search
//==========================

function load_data_histoty_searchAction()
{
    load('helper', 'format');
    $list_history_search = get_list_search_history("tbl_posts");
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
                        <span class="field">(<?php echo format_name_post($search_item['search_option']) ?>)</span>
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
// delete search history
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
                        <span class="field">(<?php echo format_name_post($search_item['search_option']) ?>)</span>
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


// get total num posts 
function get_num_total_postsAction() 
{
    $list_posts = get_list_post_by_status("all");
    $data = array(
        "num" => count($list_posts)
    );
    echo json_encode($data);
}