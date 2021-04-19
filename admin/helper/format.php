<?php
function currency_format($number, $suffix = 'đ')
{
    return number_format($number) . $suffix;
}

// format gender
function format_gender($gender)
{
    $gender_vnm = array(
        "male"   => "Nam",
        "female" => "Nữ"
    );
    return $gender_vnm[$gender];
}

// format status
function format_status($status)
{
    $status_vnm = array(
        "publish" => "Hoạt động",
        "pending" => "Chờ duyệt",
        "trash"   => "Thùng rác"
    );
    return $status_vnm[$status];
}

function format_status_order($status)
{
    $status_vnm = array(
        "pending"  => "Chờ duyệt",
        "delivery" => "Đang giao",
        "complete" => "Hoàng thành",
        "canceled" => "Đã hủy"
    );
    return $status_vnm[$status];
}

// format date
function format_weekday($weekday)
{
    $weekday_vnm = array(
        "Monday"    => "Thứ 2",
        "Tuesday"   => "Thứ 3",
        "Wednesday" => "Thứ 4",
        "Thursday"  =>  "Thứ 5",
        "Friday"    => "Thứ 6",
        "Saturday"  => "Thứ 7",
        "Sunday"    => "Chủ nhật"
    );
    return $weekday_vnm[$weekday];
}
function format_mode_status($status)
{
    $mode = array(
        "publish" => "on",
        "pending" => "off",
        "trash"   => "off"
    );
    return $mode[$status];
}
# format name post in search history
function format_name_post($name)
{
    $name_vnm = array(
        "post_id"      => "Mã số",
        "post_title"   => "Tiêu đề",
        "post_cat_id"  => "Danh mục",
        "creator"      => "Người tạo",
        "created_date" => "Thời gian"
    );
    return $name_vnm[$name];
}
# format name product in search history
function format_name_product($name)
{
    $name_vnm = array(
        "id_product" => "ID",
        "code_product" => "Mã sản phẩm",
        "name_product" => "Tên sản phẩm",
        "id_cat_product" => "Danh mục",
        "trademark_product" => "Thương hiệu",
        "creator" => "Người tạo",
        "created_date" => "Thời gian"
    );
    return $name_vnm[$name];
}
# format name trademark in search history
function format_name_trademark($name)
{
    $name_vnm = array(
        "id_trademark"   => "Mã số",
        "name_trademark" => "Tên thương hiệu",
        "id_cat_product" => "Danh mục",
        "creator"        => "Người tạo",
        "created_date"   => "Thời gian"
    );
    return $name_vnm[$name];
}

# format name post cat in search history
function format_name_post_cat($name)
{
    $name_vnm = array(
        "id_postCat"   => "Mã số",
        "name_postCat" => "Danh mục",
        "creator"      => "Người tạo",
        "created_date" => "Thời gian"
    );
    return $name_vnm[$name];
}

#format name product cat in search history
function format_name_product_cat($name)
{
    $name_vnm = array(
        "id_productCat" => "ID danh mục",
        "name_productCat" => "Tên danh mục",
        "creator" => "Người tạo",
        "created_date" => "Thời gian"
    );
    return $name_vnm[$name];
}
#format name slider
function format_name_slider($name)
{
    $name_vnm = array(
        "id_slider" => "ID Slider",
        "name_slider" => "Tên slider",
        "numerical_order" => "STT Slider",
        "creator" => "Người tạo"
    );
    echo $name_vnm[$name];
}
#format name advt
function format_name_advt($name)
{
    $name_vnm = array(
        "id_advt" => "Id quảng cáo",
        "link_url" => "link quảng cáo",
        "creator" => "Người tạo"
    );
    echo $name_vnm[$name];
}

#format name order
function format_name_order($name)
{
    $name_vnm = array(
        "id_order"    => "ID đơn hàng",
        "code_order"  => "Mã đơn hàng",
        "customer_id" => "Khách hàng"
    );
    echo $name_vnm[$name];
}
function format_name_customer($name)
{
    $name_vnm = array(
        "id_customer"    => "ID khách hàng",
        "name_customer"  => "Tên khách hàng",
        "phone_customer" => "SĐT khách hàng",
        "email_customer" => "Email khách hàng",
    );
    echo $name_vnm[$name];
}
// format payment method
function format_payment_method($type_payment)
{
    $payment_method = array(
        1 => "Thanh toán tại cửa hàng",
        2 => "Thanh toán tại nhà"
    );
    return $payment_method[$type_payment];
}