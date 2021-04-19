<?php
    //==== REGISTER ====//
    #check user exists
    function user_exists($username,$email){
        $user = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' AND `email` = '{$email}'");
        if($user > 0) return true;
        return false;
    }

    #check user not active
    function check_user_not_active($username,$email){
        if(user_exists($username,$email)){
            $active_curr = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' AND `email` = '{$email}'");
            if($active_curr['is_active'] == '0'){
                return true;
            } return false;
        }

    }
    #add user item
    function add_user($data){
        db_insert("tbl_users",$data);
    }
    #check active token exists
    function check_active_token($active_token){
        $check_token = db_num_rows("SELECT * FROM `tbl_users` WHERE `active_token` = '{$active_token}' AND `is_active` = '0'");
        if($check_token > 0) return true;
        return false;
    }
    #active user
    function active_user($active_token){
        db_update("tbl_users",array('is_active'=>1),"`active_token`='{$active_token}'");
    }

    //==== LOGIN ====//
    # check login
    function check_login($username,$password) {
        $username = escape_string($username);
        $password = md5(escape_string($password));
        $user = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' AND `password` = '{$password}' AND `is_active` = '1'");
        if($user > 0) return true;
        return false;
    }

    //==== GET PASSWORD ====//
    #check email exists
    function check_email($email){
        $check_email = db_num_rows("SELECT * FROM `tbl_users` WHERE `email` = '{$email}' AND `is_active` = '1'");
        if($check_email > 0) return true;
        return false;
    }

    #update reset password token
    function update_reset_token($data,$email) {
        db_update("tbl_users",$data,"`email` = '$email'");
    }

    #get data user
    function get_data_user($email){
        $user_getpass = db_fetch_row("SELECT * FROM `tbl_users` WHERE `email` = '{$email}'");
        return $user_getpass;
    }

    //==== RESET PASSWORD ACTION ====//
    #check reset token exists
    function check_reset_token_exists($reset_token){
        $check_token = db_num_rows("SELECT * FROM `tbl_users` WHERE `reset_pass_token` = '$reset_token' AND `is_active` = '1'");
        if($check_token > 0) return true;
        return false;
    }

    #update password user
    function update_pass_user($data_update,$reset_token){
        return db_update("tbl_users",$data_update,"`reset_pass_token` = '{$reset_token}'");
    }

    //==== CHANGE PASSWORD ACTION ====//
    #check password exist
    function password_exists($old_pass,$username) {
        $check_user = db_num_rows("SELECT * FROM `tbl_users` WHERE `password`= '{$old_pass}' AND `username` = '{$username}'");
        if($check_user > 0) return true;
        return false;
    }
    #update password new
    function update_pass_new($data,$username){
        return db_update("tbl_users",$data,"`username` = '{$username}'");
    }
    //==== UPDATE DATA USER ====//
    // update some field of user item 
    function update_user($data,$username){
        $process = db_update("tbl_users",$data,"`username` = '{$username}'");
        return $process;
    }

