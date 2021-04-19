<?php
function construct()
{
    load_model('index');
}
function indexAction()
{
    $list_province = get_location_by_level(1);
    $list_district = get_location_by_level(2);
    $list_street   = get_location_by_level(3);
    $data = array(
        "list_province" => $list_province,
        "list_district" => $list_district,
        "list_street"   => $list_street
    );
    load_view('index',$data);
}
function addAction()
{
    load('lib', 'validation_form');
    if (isset($_POST['btn_add_address'])) {
        $error = array();
        global $error;
        if (empty($_POST['name_location'])) {
            $error['name_location'] = "<span class='error'>(*) Bạn vui lòng điền một vị trí</span>";
        } else {
            if (check_name_location_exists($_POST['name_location'])) {
                $error['name_location'] = "<span class='error'>(*) Vị trí nãy đã được bạn thêm vào trước đó</span>";
            } else {
                if ($_POST['type_location'] == 0) {
                    $error['type_location'] = "<span class='error'>(*) Bạn vui lòng chọn một cấp cho vị trí</span>";
                    echo $_POST['type_location'];
                } else {
                    $name_location = $_POST['name_location'];
                    $type_location = $_POST['type_location'];
                    if ($type_location == 1) {
                        $data = array(
                            "name_location" => trim($name_location),
                            "level_location" => 1
                        );
                        add_location($data);
                    } else if ($type_location == 2) {
                        if (empty($_POST['parent_id_province'])) {
                            $error['parent_id_province'] = "<span class='error'>(*) Vui lòng chọn một Tỉnh hoặc Thành phố</span>";
                        } else {
                            $data = array(
                                "name_location" => trim($name_location),
                                "level_location" => 2,
                                "parent_id" => (int) $_POST['parent_id_province']
                            );
                            add_location($data);
                        }
                    } else {
                        if (empty($_POST['parent_id_district'])) {
                            $error['parent_id_district'] = "<span class='error'>(*) Vui lòng chọn một Quận / Huyện</span>";
                        } else {
                            $data = array(
                                "name_location" => trim($name_location),
                                "level_location" => 3,
                                "parent_id" => (int) $_POST['parent_id_district']
                            );
                            add_location($data);
                        }
                    }
                }
            }
        }
    }
    load_view('add');
}
#load province
function load_provinceAction()
{
    $list_province = get_list_province();
    echo json_encode($list_province);
}

#search key word location
function search_key_word_locationAction()
{
    $type = $_GET['type'];
    $q = $_POST['q'];
    if ($type == 'province') {
        $keyTolowercase = explode(' ', strtolower($q));
        if ($keyTolowercase[0] == 'hồ' || $keyTolowercase[0] == 'ho') {
            $q = "TP HCM";
        }
        $key_word = search_key_word(trim($q), 1);
        $data = array(
            "q" => $key_word['name_location'],
            "id" => $key_word['id_location']
        );
    } else {
        $key_word = search_key_word(trim($q), 2);
        $data = array(
            "q" => $key_word['name_location'],
            "id" => $key_word['id_location']
        );
    }
    echo json_encode($data);
}

#load list distrist
function load_districtAction()
{
    $type = $_GET['by'];
    if ($type == 'distrist') {
        $list_district = get_list_distrist();
    } else {
        $id = $_POST['id'];
        $list_district = get_list_distrist($type, $id);
    }
    echo json_encode($list_district);
}
#load province item
function load_province_itemAction()
{
    $id = $_POST['id'];
    if (!empty($id)) {
        $distrist_item = get_distrist_item_by_id($id);
        $id_province = $distrist_item['parent_id'];
        $province_item = get_province_item_by_id($id_province);
        $data = array(
            "id" => $province_item['id_location'],
            "name" => $province_item['name_location']
        );
    } else {
        $data = array(
            "id" => "",
            "name" => ""
        );
    }
    echo json_encode($data);
}
