<?php
function construct()
{
    load_model('index');
}

// index view
function indexAction()
{
    load('helper', 'format');
    $data = array(
        "list_products_all" => get_list_products_by_status("all"),
        "list_products_not_trash" => get_list_products_by_status("all_not_trash"),
        "list_products_publish" => get_list_products_by_status("publish"),
        "list_products_pending" => get_list_products_by_status("pending"),
        "list_products_trash" => get_list_products_by_status("trash"),
        "list_search_history"     => get_list_search_history("tbl_products"),
    );
    load_view('index', $data);
}

// ===========
// pagination
// ===========
function paginationAction()
{
    load('helper', 'format');
    load('helper', 'string');
    $type = $_GET['type'];
    if ($type == 'get_total_page') {
        $status        = $_GET['status'];
        $num_per_page  = $_GET['num_per_page'];
        $data_id = !empty($_GET['data_id']) ? $_GET['data_id'] : null;
        $modules_action = !empty($_GET['modules_action']) ? $_GET['modules_action'] : null;
        if($data_id != null && $modules_action != null) {
            if( $modules_action == 'trademark' ) {
                $num_list_products = count(get_list_product_by_id_trademark($data_id));
            } else {
                $num_list_products = count(get_list_products_by_id_products_cat($data_id));
            }
        } else {
            $num_list_products = count(get_list_products_by_status($status));
            $list_products_trash = count(get_list_products_by_status("trash"));
            if ($status == 'all') {
                $num_list_products -= $list_products_trash;
            }
        }
        $total_page = ceil($num_list_products / $num_per_page);
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
            $data_id = !empty($_POST['data_id']) ? $_POST['data_id'] : null;
            $modules_action = !empty($_POST['modules_action']) ? $_POST['modules_action'] : null;
            $page_start = (int) ($curr_page - 1) * $num_per_page;

            if ( $data_id != null && $modules_action != null ) {
                if($modules_action == 'trademark') {
                    $list_products = get_list_page_products_by_trademark($page_start, $num_per_page, $status, $data_id);
                } else {
                    $list_products = get_list_page_products_by_pagination($page_start, $num_per_page, $status, $data_id);
                }
            } else {
                $list_products = get_list_page_products_by_pagination($page_start, $num_per_page, $status, null);
            }

        } else {
            $q = $_POST['q'];
            $option_search = $_POST['option_search'];
            $status_curr = $_POST['status_curr'];
            if ($option_search == 'id_cat_product' && check_product_cat_exists($q)) {
                $product_cate_item = get_product_cat_item_by_name($q);
                $q = (int) $product_cate_item['id_productCat'];
            }
            if ($option_search == 'trademark_product' && check_name_trademark_exists($q)) {
                $trademark_item = get_trademark_item_by_name($q);
                $q = (int) $trademark_item['id_trademark'];
            }
            $curr_page = $_POST['current_page'];
            $num_per_page = $_POST['num_per_page'];
            $page_start = (int) ($curr_page - 1) * $num_per_page;
            $list_products = get_list_page_products_by_search($q, $option_search, $page_start, $num_per_page, $status_curr);
        }
        if (!empty($list_products)) {
?>
            <thead>
                <tr>
                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                    <td><span class="thead-text">STT</span></td>
                    <td><span class="thead-text">Mã sản phẩm</span></td>
                    <td><span class="thead-text">Hình ảnh</span></td>
                    <td><span class="thead-text">Tên sản phẩm</span></td>
                    <td><span class="thead-text">Giá bán</span></td>
                    <td><span class="thead-text">Trong kho</span></td>
                    <td><span class="thead-text">Trạng thái</span></td>
                    <td><span class="thead-text">Người tạo</span></td>
                    <td><span class="thead-text">Tác vụ</span></td>
                    <td><span class="thead-text">Chi tiết</span></td>
                </tr>
            </thead>
            <tbody id="main-table">
                <?php
                $temp = 1;
                foreach ($list_products as $products_item) {
                ?>
                    <tr>
                        <td><input type="checkbox" name="checkItem[]" data-id="<?php echo $products_item['id_product'] ?>" class="checkItem"></td>
                        <td><span class="tbody-text num_order"><?php echo $temp; ?></span></td>
                        <td><span class="tbody-text"><?php echo $products_item['code_product'] ?></span></td>
                        <td>
                            <div class="tbody-thumb">
                                <img src="<?php echo $products_item['avatar_product'] ?>" alt="">
                            </div>
                        </td>
                        <td><span contenteditable="false" class="tbody-text hidden_text"><?php echo $products_item['name_product'] ?></span></td>
                        <td><span class="tbody-text"><?php echo currency_format($products_item['price_product'])  ?></span></td>
                        <td><span class="tbody-text"><small style="color: #8a8585;">Còn:</small> <strong><?php echo $products_item['qty_product'] ?></strong> SP</span></td>
                        <td><span class="tbody-text status" data-id_products="<?php echo $products_item['id_product'] ?>" data-status="<?php echo $products_item['status'] ?>"><?php echo format_status($products_item['status']) ?></span></td>
                        <td><span class="tbody-text"><?php echo $products_item['creator'] ?></span></td>
                        <td>
                            <span>
                                <ul class="list-operation d-flex" data-id_products="<?php echo $products_item['id_product'] ?>">
                                    <li><a href="?mod=products&action=update&lct=<?php echo $temp ?>&id=<?php echo $products_item['id_product'] ?>" data-id_products="<?php echo $products_item['id_product'] ?>" title="Update" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li class="delete-opt position-relative">
                                        <a <?php if ($products_item['status'] == 'trash') { ?> href="" data-option="permanently" title="Xóa vĩnh viễn" data-modules="products" <?php } ?> class="permanently delete d-inline-block">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        <?php
                                        if ($products_item['status'] != 'trash') {
                                        ?>
                                            <div class="option-delete position-absolute fa fa-caret-down">
                                                <a data-modules="products" href="" data-status="<?php echo $products_item['status'] ?>" class="goto-trash option-item" data-option="goto_trash">Thùng rác</a>
                                                <a data-modules="products" href="" class="permanently all option-item" data-option="permanently">Vĩnh viễn</a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </li>
                                    <li>
                                        <div class="switch status products">
                                            <?php
                                            if ($products_item['status'] == 'trash') {
                                            ?>
                                                <a href="" title="Khôi phục" style="font-size: 14px; padding: 5.8px 14px;" class="restore product fa fa-undo" data-option="restore"></a>
                                            <?php
                                            } else {
                                            ?>
                                                <label for="status" data-modules="products" class="btn-change-status" data-id_products="<?php echo $products_item['id_product'] ?>" data-active="<?php echo format_mode_status($products_item['status']) ?>">
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
                        <td class="text-center">
                            <a href="" class="see-detail" data-target="#modal_total_info_products" data-toggle="modal" title="xem chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
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
                    <td><span class="thead-text">Mã sản phẩm</span></td>
                    <td><span class="thead-text">Hình ảnh</span></td>
                    <td><span class="thead-text">Tên sản phẩm</span></td>
                    <td><span class="thead-text">Giá bán</span></td>
                    <td><span class="thead-text">Trong kho</span></td>
                    <td><span class="thead-text">Trạng thái</span></td>
                    <td><span class="thead-text">Người tạo</span></td>
                    <td><span class="thead-text">Tác vụ</span></td>
                    <td><span class="thead-text">Chi tiết</span></td>
                </tr>
            </tfoot>
        <?php
        } else {
        ?>
            <div class="notifi_process mx-auto">
                <span class="thumb-img"><img src="public/images/notFoundIcon.png" class="img-fluid" alt=""></span>
                <p class="txt_notifi">Hiện tại không tìm thấy bài viết nào ..!</p>
                <div class="add">
                    <a href="?mod=products&action=add" class="link-add text-center d-block">Thêm tại đây.!</a>
                </div>
            </div>
<?php
        }
    }
}

// upload img file action 
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
            $target_dir  = "public/uploads/products/products/";
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

// add view
function addAction()
{
    load('lib', 'validation_form');
    $data = array();
    $data['list_cate_products'] = get_list_cat_product("not_trash");
    $data['list_trademarks'] = get_list_trademark();
    if (isset($_POST['btn_add_product'])) {
        $error = array();
        global $error;
        // check name product
        if (empty($_POST['name_product'])) {
            $error['name_product'] = "<span class='error'>(*) Vui lòng không để trống tên của sản phẩm</?>";
        } else {
            $name_product = $_POST['name_product'];
        }

        // check price
        if (empty($_POST['price_product'])) {
            $error['price_product'] = "<span class='error'>(*) Vui lòng không để trống giá của sản phẩm</span>";
        } else {
            if (!is_number($_POST['price_product'])) {
                $error['price_product'] = "<span class='error'>(*) Giá không đúng định dạng, hệ thống chỉ chấp nhận những số từ 1 đến 9</span>";
            } else {
                $price_product = $_POST['price_product'];
            }
        }

        // check old price
        if (empty($_POST['price_old_product'])) {
            $price_old_product = null;
        } else {
            if (!is_number($_POST['price_old_product'])) {
                $error['price_old_product'] = "<span class='error'>(*) Giá cũ không đúng định dạng, hệ thống chỉ chấp nhận những số từ 1 đến 9</span>";
            } else {
                $price_old_product = $_POST['price_old_product'];
            }
        }

        // check code product
        if (empty($_POST['code_product'])) {
            $error['code_product'] = "<span class='error'>(*) Vui lòng để trống mã của sản phẩm</span>";
        } else {
            if (check_code_product_exists($_POST['code_product'])) {
                $error['code_product'] = "<span class='error'>(*) Mã này đã tồn tại trước đó</span>";
            } else {
                $code_product = $_POST['code_product'];
            }
        }

        // check qty product
        if (empty($_POST['qty_product'])) {
            $error['qty_product'] = "<span class='error'>(*) Vui lòng điền số lượng của sản phẩm</span>";
        } else {
            $qty_product = $_POST['qty_product'];
        }

        // check description
        if (!empty($_POST['desc_product'])) {
            $desc_product = $_POST['desc_product'];
        } else {
            $desc_product = "";
        }

        // check avatar product

        if (empty($_POST['thumbnail_url'])) {
            $error['thumbnail_url'] = "<span class='error'>(*) Vui lòng chọn một avatar cho sản phẩm</span>";
        } else {
            $avatar_product = $_POST['thumbnail_url'];
        }

        // check list img category products
        if (empty($_POST['relative_img'])) {
            $error['arr_img_relative'] = "<span class='error'>(*) Vui lòng chọn ít nhất một ảnh liên quan đến sản phẩm</span>";
        } else {
            $list_img_relative = array();
            $list_img_relative = $_POST['relative_img'];
        }

        // check content products
        if (empty($_POST['content_product'])) {
            $error['content_product'] = "<span class='error'>(*) Vui lòng điền nội dung cho sản phẩm</span>";
        } else {
            $content_product = $_POST['content_product'];
        }

        // check name detail info products
        if (!empty($_POST['name_detail'])) {
            $name_detail = array();
            $name_detail = $_POST['name_detail'];
        }

        // check value detail info products
        if (!empty($_POST['value_detail'])) {
            $value_detail = array();
            $value_detail = $_POST['value_detail'];
        }

        if (!empty($name_detail[0]) && !empty($value_detail[0])) {
            $list_info_detail = array();
            for ($i = 0; $i < count($name_detail); $i++) {
                if( !empty($name_detail[$i]) && !empty($value_detail[$i]) ) {
                    $list_info_detail[$name_detail[$i]] =  $value_detail[$i];
                }
            }
        } else {
            $error['list_info_detail'] = "<span class='error'>(*) Có vẽ như bạn chưa nhập một trường dữ liệu</span>";
        }
        // check category products
        if (empty($_POST['parent_id'])) {
            $error['parent_id'] = "<span class='error'>(*) Vui lòng chọn danh mục cho sản phẩm</span>";
        } else {
            $parent_id = $_POST['parent_id'];
        }

        // check trademark id products
        if (empty($_POST['trademark_id'])) {
            $error['trademark_id'] = "<span class='error'>(*) Vui lòng chọn thương hiện cho sản phẩm</span>";
        } else {
            $trademark_id = $_POST['trademark_id'];
        }

        // check status products
        if (empty($_POST['status'])) {
            $status =  'pending';
        } else {
            $status = $_POST['status'];
        }
        if (empty($error)) {
            $created_date = time();
            $creator = user_login();
            $data_db = array(
                "name_product"      => $name_product,
                "code_product"      => $code_product,
                "price_product"     => $price_product,
                "price_old_product" => $price_old_product,
                "qty_product"       => $qty_product,
                "desc_product"      => $desc_product,
                "avatar_product"    => $avatar_product,
                "arr_img_relative"  => $list_img_relative,
                "content_product"   => $content_product,
                "list_info_detail"  => $list_info_detail,
                "id_cat_product"    => (int) $parent_id,
                "trademark_product" => (int) $trademark_id,
                "status"            => $status,
                "created_date"      => $created_date,
                "creator"           => $creator
            );
            add_product($data_db);
            $error['no'] = "<span id='success'>(*) Thêm thành công</span>";
            $data['notification'] = "<div class='success'></div>";
            $data['process'] = "success";
        } else {
            if (isset($list_info_detail)) {
                $data['list_info_detail'] = $list_info_detail;
            }
        }
    }
    load_view('add_product', $data);
}
// upload multi img product
function upload_multi_relative_imgAction()
{
    if ($_SERVER['REQUEST_METHOD']) {
        $error = array();
        $num_img = count($_FILES['file']['name']);
        $target_dir = "public/uploads/products/products/";
        $list_img = array();
        $html_structure = "<ul class='list-img'>";
        for ($i = 0; $i < $num_img; $i++) {
            $target_file = $target_dir . basename($_FILES['file']['name'][$i]);
            $name_file   = pathinfo($_FILES['file']['name'][$i], PATHINFO_FILENAME);
            $exten_file  = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
            if (file_exists($target_file)) {
                $name_new = $name_file . " - Copy.";
                $path_file_new = $target_dir . $name_new . $exten_file;
                $k = 1;
                while (file_exists($path_file_new)) {
                    $name_new = $name_file . " - Copy({$k}).";
                    $path_file_new = $target_dir . $name_new . $exten_file;
                    $k++;
                }
                $target_file = $path_file_new;
            }
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_file)) {
                $html_structure .= "<li>";
                $html_structure .= "<span class='thumb-img'>";
                $html_structure .= "<input type='hidden' class='relative-img' name='relative_img[]' value='{$target_file}'></input>";
                $html_structure .= "<img src='{$target_file}' alt=''>";
                $html_structure .= "</span>";
                $html_structure .= "<span class='option-action'>";
                $html_structure .= "<a href='' class='rename' data-action='rename' title='Tên file: {$name_file}' data-extension='{$exten_file}'>";
                $html_structure .= "<i class='fa fa-pencil-square-o' aria-hidden='true'></i>";
                $html_structure .= "</a>";
                $html_structure .= "<a href='' class='delete' data-action='delete'><i class='fa fa-trash' aria-hidden='true'></i></a>";
                $html_structure .= "</span>";
                $html_structure .= "</li>";
            }
        }
        $html_structure .= "</ul>";
        $data = array(
            "html_structure" => $html_structure,
            "num_img" => $num_img,
            "name_file_img" => $name_file
        );
        echo json_encode($data);
    }
}
// handling some action of img ( rename and delete )
function img_actionAction()
{
    load('helper', 'string');
    $type = $_GET['type'];
    if ($type == 'update') {
        $name_new = create_slug($_POST['name_new']);
        $name_curr = $_POST['name_curr'];
        $exten_file = $_POST['exten_file'];
        $target_dir = "public/uploads/products/products/";
        $path_file_name_curr = $target_dir . $name_curr . "." . $exten_file;
        $path_file_name_new = $target_dir . $name_new . "." . $exten_file;
        $data = array(
            "path_file_name_curr" => $path_file_name_curr,
            "path_file_name_new" => $path_file_name_new
        );
        if (file_exists($path_file_name_new)) {
            $name_file_new = $name_new . " - Copy.";
            $path_file_name_exists = $target_dir . $name_file_new . $exten_file;
            $k = 1;
            while (file_exists($path_file_name_exists)) {
                $name_file_new = $name_new . " - Copy({$k}).";
                $path_file_name_exists = $target_dir . $name_file_new . $exten_file;
                $k++;
            }
            $path_file_name_new = $path_file_name_exists;
        }
        if (rename($path_file_name_curr, $path_file_name_new)) {
            $data = array(
                "status" => "success",
                "path_img" => $path_file_name_new
            );
        } else {
            $data = array(
                "status" => "error"
            );
        }
        echo json_encode($data);
    } else {
        $path_img_delete = $_POST['path_img_delete'];
        if (unlink($path_img_delete)) {
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
}
// load trademark by products
function load_trademarkAction()
{
    $product_cate_id = $_POST['product_cate_id'];
    $list_trademark = get_list_trademark_by_product_id($product_cate_id);
    $html_structure = "";
    if (!empty($list_trademark)) {
        $html_structure .= "<option value=''>-- Thương hiệu --</option>";
        foreach ($list_trademark as $trademark_item) {
            $html_structure .= "<option value='{$trademark_item['id_trademark']}'>{$trademark_item['name_trademark']}</option>";
        }
    } else {
        $html_structure .= "<option value='' disabled selected>Hiện tại không có thương hiệu nào</option>";
    }
    echo $html_structure;
}

// ====================================================================
// get info products and load view update products and update products
// ====================================================================
function updateAction()
{
    load('helper', 'format');
    load('helper', 'string');
    load('lib', 'validation_form');
    $product_id = (int) !empty($_GET['id']) ? $_GET['id'] : 0;
    $location = (int) !empty($_GET['lct']) ? $_GET['lct'] : 0;
    $product_item = get_product_item_by_id($product_id);
    $list_products_cat = get_list_cat_product("all");
    $trademark_item = get_trademark_item($product_item['trademark_product']);
    $list_info_detail = get_list_info_detail($product_id);
    $list_relative_img = get_list_relative_img($product_id);
    $data = getdate($product_item['created_date']);
    $product_item['created_date'] = "(" . format_weekday($data['weekday']) . ")  " . "{$data['mday']}/{$data['mon']}/{$data['year']} {$data['hours']}:{$data['minutes']}";
    $data_view = array(
        "location"          => $location,
        "product_item"      => $product_item,
        "list_products_cat" => $list_products_cat,
        "list_info_detail"  => $list_info_detail,
        "list_relative_img" => $list_relative_img,
        "trademark_item"    => $trademark_item
    );
    if (isset($_POST['btn_update_product'])) {
        $error = array();
        global $error;
        // check name products
        if (empty($_POST['name_product'])) {
            $error['name_product'] = "<span class='error'>(*) Vui lòng không bỏ trống tên của sản phẩm</span>";
        } else {
            $name_product = $_POST['name_product'];
        }

        // check code products
        if (empty($_POST['code_product'])) {
            $error['code_product'] = "<span class='error'>(*) Vui lòng không bỏ trống mã của sản phẩm</span>";
        } else {
            if ($product_item['code_product'] != $_POST['code_product']) {
                if (check_code_product_exists($_POST['code_product'])) {
                    $error['code_product'] = "<span class='error'>(*) Mã <strong>{$_POST['code_product']}</strong> đã được sử dụng trước đó vui lòng chọn một mã mới</span>";
                } else {
                    $code_product = $_POST['code_product'];
                }
            } else {
                $code_product = $_POST['code_product'];
            }
        }

        // check price product
        if (empty($_POST['price_product'])) {
            $error['price_product'] = "<span class='error'>(*) Vui lòng không bỏ trống giá của sản phẩm</span>";
        } else {
            if (!is_number($_POST['price_product'])) {
                $error['price_product'] = "<span class='error'>(*) Giá không đúng định dạng hệ thống chỉ chấp nhận định dạng số từ 1 đến 9</span>";
            } else {
                $price_product = $_POST['price_product'];
            }
        }

        // check price_old_product
        if (empty($_POST['price_old_product'])) {
            $price_old_product = null;
        } else {
            if (!is_number($_POST['price_old_product'])) {
                $error['price_old_product'] = "<span class='error'>(*) Giá cũ không định dạng hệ thốn chỉ chấp nhận định dạng số từ 1 đến 9</span>";
            } else {
                $price_old_product = $_POST['price_old_product'];
            }
        }

        // check qty
        if (empty($_POST['qty_product'])) {
            $error['qty_product'] = "<span class='error'>(*) Vui lòng không để trống số lượng của sản phẩm còn trong kho</span>";
        } else {
            $qty_product = $_POST['qty_product'];
        }

        // check description
        if (empty($_POST['desc_product'])) {
            $error['desc_product'] = "<span class='error'>(*) Vui lòng không để trống mô tả ngắn của sản phẩm</span>";
        } else {
            $desc_product = $_POST['desc_product'];
        }

        // check content product
        if (empty($_POST['content_product'])) {
            $error['content_product'] = "<span class='error'>(*) Vui lòng không để trống nội dung của sản phẩm</span>";
        } else {
            $content_product = $_POST['content_product'];
        }

        // check info detail
        // check name detail info products
        if (!empty($_POST['name_detail'])) {
            $name_detail = array();
            $name_detail = $_POST['name_detail'];
        }
        // check value detail info products
        if (!empty($_POST['value_detail'])) {
            $value_detail = array();
            $value_detail = $_POST['value_detail'];
        }
        // check total name detail and value detail info products
        if (!empty($name_detail[0]) && !empty($value_detail[0])) {
            $list_info_detail = array();
            for ($i = 0; $i < count($name_detail); $i++) {
                if( !empty($name_detail[$i]) && !empty($value_detail[$i]) ) {
                    $list_info_detail[$name_detail[$i]] =  $value_detail[$i];
                }
            }
        } else {
            $error['list_info_detail'] = "<span class='error'>(*) Có vẽ như bạn chưa nhập một trường dữ liệu</span>";
        }

        // check products cate 
        if (empty($_POST['parent_id'])) {
            $error['parent_id'] = "<span class='error'>(*) Vui lòng không bỏ trống danh mục của sản phẩm</span>";
        } else {
            $parent_id = $_POST['parent_id'];
        }

        // check trademark product
        if (empty($_POST['trademark_id'])) {
            $error['trademark_id'] = "<span class='error'>(*) vui lòng không để trống thương hiệu của sản phẩm</span>";
        } else {
            $trademark_id = $_POST['trademark_id'];
        }

        // check status products
        if (empty($_POST['status'])) {
            $status = "pending";
        } else {
            $status = $_POST['status'];
        }

        // check error if not exists error then start update list info product
        if (empty($error)) {
            $update_date = time();
            $creator = user_login();
            $data = array(
                "name_product" => $name_product,
                "code_product" => $code_product,
                "price_product" => $price_product,
                "price_old_product" => $price_old_product,
                "qty_product" => $qty_product,
                "status" => $status,
                "creator" => $creator,
                "update_date" => $update_date,
                "id_cat_product" => $parent_id,
                "trademark_product" => $trademark_id,
                "desc_product" => $desc_product,
                "content_product" => $content_product
            );
            update_products($data, $product_id);
            $product_item_by_id = get_product_item_by_id($product_id);
            $data = getdate($product_item_by_id['created_date']);
            $product_item_by_id['created_date'] = "(" . format_weekday($data['weekday']) . ")  " . "{$data['mday']}/{$data['mon']}/{$data['year']} {$data['hours']}:{$data['minutes']}";
            update_detail_info_product($product_id, $list_info_detail);
            $list_info_detail = get_list_info_detail($product_id);
            $data_view = array(
                "location"          => $location,
                "product_item"      => $product_item,
                "list_products_cat" => $list_products_cat,
                "list_info_detail"  => $list_info_detail,
                "list_relative_img" => $list_relative_img,
                "trademark_item"    => $trademark_item
            );
            // check see admin have change or not if changed then delete all info detail product after update info into tbl info detail product
            $error['no'] = "<span id='success'>(*) Thêm thành công</span>";
            $data_view['notification'] = "<div class='success'></div>";
            $data_view['process'] = "success";
            $error['process_success'] = "<span class='success update-post'>(*) Cập nhật thành công</span>";
        }
        $error['process_error'] = "<span class='error update-post'>(*) Cập nhật không thành công</span>";
    }
    load_view('update', $data_view);
}
//action update
function action_img_updateAction()
{
    $action = $_POST['action'];
    if ($action == 'delete') {
        $src_img = $_POST['src_img'];
        $id_img  = $_POST['id_img'];
        $process = delete_img_relative_products($id_img);
        if ($process == true) {
            unlink($src_img);
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
        $type_img = $_POST['type_img'];
        $name_curr = $_POST['name_curr'];
        $name_new = $_POST['name_new'];
        $id_change = $_POST['id_changes'];
        $exten_file = $_POST['exten_file'];
        $target_dir = "public/uploads/products/products/";
        $target_file = $target_dir . $name_new . $exten_file;
        if (file_exists($target_file)) {
            $name_file_new = $name_new . " - Copy";
            $path_file_new = $target_dir . $name_file_new .  $exten_file;
            $k = 1;
            while (file_exists($path_file_new)) {
                $name_file_new = $name_new . " - Copy({$k})";
                $path_file_new = $target_dir . $name_file_new .  $exten_file;
                $k++;
            }
            $target_file = $path_file_new;
        }
        $tbl = "";
        if ($type_img == 'avatar') {
            $tbl = "tbl_products";
        } else {
            $tbl = "tbl_img_relative_product";
        }
        $process = rename_relative_img($id_change, $tbl, $target_file);
        $target_file_old = $target_dir . $name_curr . $exten_file;
        if ($process == true) {
            $name_file = pathinfo($target_file, PATHINFO_FILENAME);
            rename($target_file_old, $target_file);
            $data = array(
                "status"    => "success",
                "path_file" => $target_file,
                "name_file" => $name_file
            );
        } else {
            $data = array(
                "status" => "error",
                "path_file" => $target_file_old
            );
        }
        echo json_encode($data);
    }
}
// update img ( change images )
function update_imgAction()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $target_dir = "public/uploads/products/products/";
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
// update img product
function upload_img_newAction()
{
    $src_img_curr = $_POST['src_img_curr'];
    $src_img_new = $_POST['src_img_new'];
    $data_id = $_POST['data_id'];
    $option_delete_img_old = $_POST['option_delete_img_old'];
    $type_image = $_POST['type_image'];
    $process = update_img_new($data_id, $type_image, $src_img_new);
    if ($process == true) {
        if ($option_delete_img_old == 'true') {
            unlink($src_img_curr);
        }
        $data = array(
            "status" => "success",
            "path_img" => $src_img_new
        );
    } else {
        $data = array(
            "status" => "error"
        );
    }
    echo json_encode($data);
}
//====================
// delete permanently
//====================

function delete_permanentlyAction()
{

    $action = $_POST['action'];
    if ($action == 'delete_item') {
        $data_id = (int) $_POST['data_id'];
        $path_img_avatar = get_product_item_by_id($data_id)['avatar_product'];
        $list_path_relative = get_list_relative_img($data_id);
        $unlink = $_POST['unlink'];
        $process = delete_product_item($data_id);
        if ($process == 1) {
            unlink($path_img_avatar);
            $list_img = array();
            foreach ($list_path_relative as $img_relative_item) {
                unlink($img_relative_item['name_img_relative']);
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
        $test = "";
        foreach ($list_checked as $id_item) {
            $product_item = get_product_item_by_id($id_item);
            $list_img_relative = get_list_relative_img($id_item);
            $process = delete_product_item($id_item);
            if ($process) {
                if ($unlink == 1) {
                    $path_img = $product_item['avatar_product'];
                    unlink($path_img);
                    foreach ($list_img_relative as $img_relative_item) {
                        unlink($img_relative_item['name_img_relative']);
                    }
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
//=================
// load num status
//=================

function load_num_statusAction()
{
    $data = array(
        "num_all"     => count(get_list_products_by_status("all")),
        "num_publish" => count(get_list_products_by_status("publish")),
        "num_pending" => count(get_list_products_by_status("pending")),
        "num_trash"   => count(get_list_products_by_status("trash")),
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
        update_status_product($data, $data_id);
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
                update_status_product($data_save_status, $key);
            }
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
        $process = update_status_product($data, $data_id);
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
            update_status_product($data, $id_item);
        }
    }
}

#get list info products
function get_list_info_productsAction()
{
    load('helper', 'format');
    $id_product = $_POST['id_product'];
    $product_item = get_product_item_by_id($id_product);
    $list_img_relative = get_list_relative_img($id_product);
    $product_cate_item = get_product_cat_item($product_item['id_cat_product']);
    $trademark_product_item = get_trademark_item($product_item['trademark_product']);
    $data = getdate($product_item['created_date']);
    $product_item['created_date'] = "(" . format_weekday($data['weekday']) . ")  " . "{$data['mday']}/{$data['mon']}/{$data['year']} {$data['hours']}:{$data['minutes']}";

    if ($product_item['update_date'] != null) {
        $data = getdate($product_item['update_date']);
        $product_item['update_date'] = "(" . format_weekday($data['weekday']) . ")  " . "{$data['mday']}/{$data['mon']}/{$data['year']} {$data['hours']}:{$data['minutes']}";
    }

    $data = array(
        "id_product" => $product_item['id_product'],
        "name_product" => $product_item['name_product'],
        "code_product" => $product_item['code_product'],
        "price_product" => currency_format($product_item['price_product']),
        "price_old_product" => currency_format($product_item['price_old_product']),
        "avatar_product" => $product_item['avatar_product'],
        "list_img_relative" => $list_img_relative,
        "qty_product" => $product_item['qty_product'],
        "status" => format_status($product_item['status']),
        "status_old" =>  !empty($product_item['status_old']) ? format_status($product_item['status_old']) : null,
        "creator" => $product_item['creator'],
        "created_date" => $product_item['created_date'],
        "update_date" => !empty($product_item['update_date']) ? $product_item['update_date'] : null,
        "product_cate_item" => $product_cate_item['name_productCat'],
        "trademark_product" => $trademark_product_item['name_trademark'],
    );
    echo json_encode($data);
}
//=========
// restore
//=========

function restoreAction()
{
    $action = $_POST['action'];
    if ($action == 'restore_item') {
        $data_id = $_POST['data_id'];
        $product_item = get_product_item_by_id($data_id);
        $status_old = $product_item['status_old'];
        $data = array(
            "status" => $status_old,
            "status_old" => null
        );
        update_status_product($data, $data_id);
    } else {
        $list_data_id = $_POST['data_id'];
        foreach ($list_data_id as $id_item) {
            $product_item = get_product_item_by_id($id_item);
            $status_old = $product_item['status_old'];
            $data_update_status = array(
                "status"     => $status_old,
                "status_old" => null
            );
            update_status_product($data_update_status, $id_item);
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
    if ($option_search == 'id_cat_product' && check_product_cat_exists($q)) {
        $product_cate_item = get_product_cat_item_by_name($q);
        $q = (int) $product_cate_item['id_productCat'];
    }
    if ($option_search == 'trademark_product' && check_name_trademark_exists($q)) {
        $trademark_item = get_trademark_item_by_name($q);
        $q = (int) $trademark_item['id_trademark'];
    }
    $search_result = search_product($q, $option_search, $status_curr);
    $num_list_products = count($search_result);
    $total_page = ceil($num_list_products / $num_per_page);
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
    $list_history_search = get_list_search_history("tbl_products");
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
                        <span class="field">(<?php echo format_name_product($search_item['search_option']) ?>)</span>
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
                        <span class="field">(<?php echo format_name_product($search_item['search_option']) ?>)</span>
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

// get total num product 
function get_num_total_productsAction() 
{
    $list_products = get_list_products_by_status("all");
    $data = array(
        "num" => count($list_products)
    );
    echo json_encode($data);
}