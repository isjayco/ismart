<?php
    function table_index($table){
        $table_index = array(
            "tbl_postcat" => 1,
            "tbl_page"    => 2,
            "tbl_users"   => 3
        );
        return $table_index[$table];
    }
?>