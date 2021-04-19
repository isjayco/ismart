<?php

    function is_login(){
        if(!empty($_SESSION['is_login'])) {
            return true;
        } return false;
    }

    function user_login() {
        if(!empty($_SESSION['user_login'])){
            return $_SESSION['user_login'];
        } return false;
    }

    function info_user($field = "username") {
        if(is_login()) {
            $user = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$_SESSION['user_login']}' ");
            if($user > 0){
                $user_item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$_SESSION['user_login']}'");
                if(array_key_exists($field,$user_item)){
                    return $user_item[$field];
                }
            }
        }
    }


?>