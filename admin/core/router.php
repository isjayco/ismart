<?php
//Triệu gọi đến file xử lý thông qua request
$request_path = MODULESPATH . DIRECTORY_SEPARATOR . get_module() . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . get_controller().'Controller.php';
if (file_exists($request_path)) {
    require $request_path;
} else {
    echo "Không tìm thấy:$request_path ";
}

$action_name = get_action().'Action';

call_function(array('construct', $action_name));

$page_allow = array('login','register','getpass','resetpass','process_notifi');
if(!is_login() && !in_array(get_action(),$page_allow) ){
    redirect("?mod=users&action=login");
} else {
    if(isset($_COOKIE['is_login'])){
        $_SESSION['is_login'] = true;
        $_SESSION['user_login'] = $_COOKIE['user_login'];
    }
}