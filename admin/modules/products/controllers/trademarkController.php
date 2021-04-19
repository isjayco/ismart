<?php
function construct()
{
    load_model('index');
}
// index trade mark
function indexAction()
{
    load('helper', 'format');
    $data = array(
        "count_list_trademark" => count(get_list_trademark()),
        "list_search_history"  => get_list_search_history("tbl_trademark_product"),
        "list_product_cat" => get_list_product_cat_by_status("all_not_trash")
    );
    load_view('trademark', $data);
}
// pagination
function paginationAction()
{
    load('helper', 'format');
    load('helper', 'string');
    $type = $_GET['type'];
    if ($type == 'get_total_page') {
        $status = $_GET['status'];
        $num_per_page = $_GET['num_per_page'];
        $id_product_cat = !empty($_GET['data_id']) ? $_GET['data_id'] : null;
        if ($id_product_cat != null) {
            $num_list_trademark = count(get_list_trademark_by_id_product_cat($id_product_cat));
        } else {
            $num_list_trademark = count(get_list_trademark());
        }
        $total_page = ceil($num_list_trademark / $num_per_page);
        $data = array(
            "total_page" => $total_page
        );
        echo json_encode($data);
    }

    if ($type == "load_data") {
        $info = $_GET['info'];
        if ($info == 'load_data_pagin') {
            $current_page = $_POST['current_page'];
            $status       = $_POST['status'];
            $num_per_page = $_POST['num_per_page'];
            $id_product_cat = !empty($_POST['data_id']) ? $_POST['data_id'] : null;
            $page_start = (int) ($current_page - 1) * $num_per_page;
            if ($id_product_cat != null) {
                $list_trademark = get_list_page_trademark($page_start, $num_per_page, $id_product_cat);
            } else {
                $list_trademark = get_list_page_trademark($page_start, $num_per_page, null);
            }
        } else {
            $q = $_POST['q'];
            $option_search = $_POST['option_search'];
            $status_curr = $_POST['status_curr'];
            if ($option_search == 'id_cat_product' && check_product_cat_exists($q)) {
                $product_cat_item = get_product_cat_item_by_name($q);
                $q = (int) $product_cat_item['id_productCat'];
            }
            $curr_page = $_POST['current_page'];
            $num_per_page = $_POST['num_per_page'];
            $page_start = (int) ($curr_page - 1) * $num_per_page;
            $list_trademark = get_list_page_trademark_by_search($q, $option_search, $page_start, $num_per_page);
        }
        $list_cat_product = get_list_cat_product("not_trash");
        if (!empty($list_trademark)) {
?>
            <!-- ---------------- -->
            <thead>
                <tr>
                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                    <td><span class="thead-text">STT</span></td>
                    <td><span class="thead-text">Mã số</span></td>
                    <td><span class="thead-text">Hình ảnh</span></td>
                    <td><span class="thead-text">Tên thương hiệu</span></td>
                    <td><span class="thead-text">Sản phẩm</span></td>
                    <td><span class="thead-text">Danh mục</span></td>
                    <td><span class="thead-text">Người tạo</span></td>
                    <td><span class="thead-text">Thời gian</span></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $temp = 1;
                foreach ($list_trademark as $trademark_item) {
                    $data = getdate($trademark_item['created_date']);
                    $trademark_item['created_date'] = "(" . format_weekday($data['weekday']) . ")  " . "{$data['mday']}/{$data['mon']}/{$data['year']} {$data['hours']}:{$data['minutes']}";
                    $num_product = count(num_product_by_trademark_id($trademark_item['id_trademark']));
                    $product_cat = get_product_cat_item($trademark_item['id_cat_product']);
                ?>
                    <tr>
                        <td><input data-id_trademark="<?php echo $trademark_item['id_trademark'] ?>" type="checkbox" name="checkItem[]" class="checkItem"></td>
                        <td><span class="tbody-text"><?php echo $temp; ?></h3></span>
                        <td><span class="tbody-text"><?php echo $trademark_item['id_trademark'] ?></span></td>
                        <td>
                            <div class="tbody-thumb overflow-hidden" style="width: 100px; height: 50px">
                                <img src="<?php echo $trademark_item['img_trademark'] ?>" data-id_trademark="<?php echo $trademark_item['id_trademark'] ?>" alt="" class='w-100 h-100'>
                            </div>
                        </td>
                        <td class="clearfix">
                            <div class="tb-title fl-left">
                                <a href="?mod=products&controller=trademark&action=subTrademark&id=<?php echo $trademark_item['id_trademark'] ?>" title="" class="name_trademark" data-id_trademark="<?php echo $trademark_item['id_trademark'] ?>"><?php echo $trademark_item['name_trademark'] ?></a>
                            </div>
                            <ul class="list-operation fl-right d-flex" data-id_trademark="<?php echo $trademark_item['id_trademark'] ?>">
                                <li><a href="" title="Update" class="edit" data-toggle="modal" data-target="#edit_trademark"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                <li><a href="" title="Xóa" class="permanently delete" data-option='permanently' data-modules='trademark'><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                            </ul>
                        </td>
                        <td><span class="tbody-text ml-3"><?php echo $num_product ?></span></td>
                        <td class='position-relative'>
                            <span class="tbody-text name-category" spellcheck="false" contenteditable="false" data-id_product_cat="<?php echo $product_cat['id_productCat'] ?>"><?php echo $product_cat['name_productCat'] ?></span>
                            <?php
                            if (!empty($list_cat_product)) {
                            ?>
                                <div class="change-cat-modal position-absolute">
                                    <div class="change-cat-modal-content position-relative">
                                        <select name="id_cat_product" id="id_cat_product" style="cursor: pointer;">
                                            <option value="<?php echo $product_cat['id_productCat'] ?>"><?php echo $product_cat['name_productCat'] ?></option>
                                            <?php
                                            foreach ($list_cat_product as $product_cat_item) {
                                                if ($product_cat_item['name_productCat'] != $product_cat['name_productCat']) {
                                            ?>
                                                    <option value="<?php echo $product_cat_item['id_productCat'] ?>"><?php echo $product_cat_item['name_productCat'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <div class="position-absolute" style="top: 42px;">
                                            <span class="save-modal mx-1">Lưu</span>
                                            <span class="close-modal mx-1">Đóng</span>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </td>
                        <td><span class="tbody-text"><?php echo $trademark_item['creator'] ?></span></td>
                        <td><span class="tbody-text"><?php echo $trademark_item['created_date'] ?></span></td>
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
                    <td><span class="tfoot-text">Hình ảnh</span></td>
                    <td><span class="tfoot-text">Tên sản phẩm</span></td>
                    <td><span class="thead-text">Sản phẩm</span></td>
                    <td><span class="thead-text">Danh mục</span></td>
                    <td><span class="tfoot-text">Người tạo</span></td>
                    <td><span class="tfoot-text">Thời gian</span></td>
                </tr>
            </tfoot>
            <!-- ---------------- -->
        <?php
        } else {
        ?>
            <!-- ------------ -->
            <div class="notifi_process mx-auto">
                <span class="thumb-img"><img src="public/images/notFoundIcon.png" class="img-fluid" alt=""></span>
                <p class="txt_notifi">Hiện tại không tìm thấy thương hiệu nào ..!</p>
                <div class="add">
                    <a href="?mod=posts&action=add" class="link-add text-center d-block">Thêm tại đây.!</a>
                </div>
            </div>
            <!-- ------------ -->
        <?php
        }
    }
}
// add trade mark
function addAction()
{
    load('lib', 'validation_form');
    $list_cat_product = get_list_cat_product("not_trash");
    if (isset($_POST['btn_add_trademark'])) {
        $error = array();
        global $error;
        // check name
        if (empty($_POST['name_trademark'])) {
            $error['name_trademark'] = "<span class='error'>(*) Không được bỏ trống tên thương hiệu</span>";
        } else {
            if (check_name_trademark_exists($_POST['name_trademark'])) {
                $error['name_trademark'] = "<span class='error'>(*) Thương hiệu này đã tồn tại trước đó</span>";
            } else {
                $name_trademark = $_POST['name_trademark'];
            }
        }
        // check image
        if (!empty($_POST['thumbnail_url'])) {
            $target_file = $_POST['thumbnail_url'];
        } else {
            $error['img_trademark'] = "<span class='error'>(*) Không được bỏ trống ảnh của bài viết</span>";
        }

        // check id cat product
        if (empty($_POST['id_cat_product'])) {
            $error['id_cat_product'] = "<span class='error'>(*) Bạn chưa chọn danh mục cho thương hiệu</span>";
        } else {
            $id_cat_product = $_POST['id_cat_product'];
        }

        // check error
        if (empty($error)) {
            $creator = user_login();
            $created_date = time();
            $data = array(
                "name_trademark" => $name_trademark,
                "img_trademark"  => $target_file,
                "id_cat_product" => $id_cat_product,
                "creator"        => $creator,
                "created_date"   => $created_date
            );
            add_trademark($data);
            $error['no'] = "<span id='success'>(*) Thêm thành công</span>";
            $data_view['notification'] = "<div class='success'></div>";
            $data_view['process'] = "success";
        }
    }
    $data_view['list_cat_product'] = $list_cat_product;
    load_view('add_trademark', $data_view);
}
// update info images
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
            $target_dir  = "public/uploads/products/trademarks/";
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


#update name
function update_nameAction()
{
    $id_trademark = $_POST['id_trademark'];
    $current_name = $_POST['current_name'];
    $name_new = $_POST['name_new'];
    $id_product_cat = $_POST['id_product_cat'];
    $data = array(
        "name_trademark" => $name_new,
        "id_cat_product" => $id_product_cat,
    );
    $process = update_name_trademark($data,$id_trademark);
    if($process) {
        $data_process = array(
            "status" => "success",
            "name_new" => $name_new
        );
    } else {
        $data_process = array(
            "status" => "error",
            "name_old" => $current_name
        );
    }
    echo json_encode($data_process);
}

#update category
function update_categoryAction()
{
    $type = $_GET['type'];
    if ($type == 'get_name_category') {
        $id_cat_product = $_POST['id_category'];
        $product_cat_item = get_product_cat_item($id_cat_product);
        $data = array(
            "name_post_cat" => $product_cat_item['name_productCat']
        );
        echo json_encode($data);
    } else {
        $id_trademark        = $_POST['id_trademark'];
        $id_product_cat_new  = $_POST['data_id_new'];
        $data = array(
            "id_cat_product" => $id_product_cat_new
        );
        $process = save_category($data, $id_trademark);
        if ($process) {
            $data_process = array(
                "status"  => "success",
                "notifi"  => "Cập nhật thành công",
            );
        } else {
            $data_process = array(
                "status" => "error",
                "notifi" => "Cập nhật không thành công"
            );
        }
        echo json_encode($data_process);
    }
}


#delete permanently
function delete_permanentlyAction()
{
    $action = $_POST['action'];
    if ($action == 'delete_item') {
        $data_id = (int) $_POST['data_id'];
        $path_img = get_path_img_file($data_id);
        $path_img = $path_img['img_trademark'];
        $unlink = $_POST['unlink'];
        $process = delete_trademark_item($data_id);
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
            $path_img = $path_img['img_trademark'];
            $process = delete_trademark_item($id_item);
            if ($process) {
                if ($unlink == 1) {
                    unlink($path_img);
                }
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

#load num status
function load_num_statusAction()
{
    $data = array(
        "num_all" => count(get_list_trademark())
    );
    echo json_encode($data);
}
#search
function searchAction()
{
    load('helper', 'format');
    load('helper', 'string');
    $type          = $_GET['type'];
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
    if ($option_search == 'id_cat_product' && check_product_cat_exists($q)) {
        $product_cat_item = get_product_cat_item_by_name($q);
        $q = (int) $product_cat_item['id_productCat'];
    }
    $search_result = search_trademark($q, $option_search);
    $num_list_trademark = count($search_result);
    $total_page = ceil($num_list_trademark / $num_per_page);
    $data_view = array(
        "total_page" => $total_page
    );
    echo json_encode($data_view);
}

// load data history search
function load_data_histoty_searchAction()
{
    load('helper', 'format');
    $list_history_search = get_list_search_history("tbl_trademark_product");
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
                        <span class="field">(<?php echo format_name_trademark($search_item['search_option']) ?>)</span>
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
                        <span class="field">(<?php echo format_name_trademark($search_item['search_option']) ?>)</span>
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


// list sub trademark 
function subTrademarkAction() {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
    $trademark_id = $_GET['id'];
    $trademark_item = get_trademark_item($trademark_id);
    $name_trademark = $trademark_item['name_trademark'];
    $list_product = get_list_product_by_id_trademark($trademark_id);
    $data = array(
        "trademark_id"   => $trademark_id,
        "name_trademark" => $name_trademark,
        "list_product"   => $list_product,
        "controller"     => $controller,
        "action"         => $action
    );
    load_view('sub_trademark',$data);
}

// sub trademark product
function list_productAction() {
    load_view('sub_trademark_product');
}