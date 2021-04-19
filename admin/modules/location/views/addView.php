<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
    </div>
    <div id="content" class="fl-right">
        <div class="container-fluid">
            <div id="wp-box-content" class="row changpass">
                <div class="main-content col-md-5 mx-auto" id="changepass">
                    <form action="" class="form-page" method="POST" id="form-add-location">
                        <div class="main-content">
                            <h4 class="title">
                                <span class="fa fa-pencil-square-o icon"></span>
                                <span>Thêm vị trí</span>
                            </h4>
                            <div class="form-group">
                                <label for="name_location">Nhập tên vị trí</label>
                                <input type="name_location" spellcheck="false" name="name_location" id="name_location" class="form-control shadow-none" value="<?php echo set_value("name_location") ?>">
                                <?php echo form_error("name_location") ?>
                            </div>
                            <div class="form-group">
                                <label for="type_location">Loại cấp</label>
                                <select name="type_location" id="type_location" class="form-control shadow-none">
                                    <option <?php if(empty(set_value("type_location"))) { ?> selected <?php } ?> value="0">-- Loại cấp --</option>
                                    <option <?php if(set_value("type_location") == 1)   { ?> selected <?php } ?> value="1">Tỉnh / Thành phố</option>
                                    <option <?php if(set_value("type_location") == 2)   { ?> selected <?php } ?> value="2">Quận / Huyện</option>
                                    <option <?php if(set_value("type_location") == 3)   { ?> selected <?php } ?> value="3">Phường / Xã</option>
                                </select>
                                <?php echo form_error("type_location") ?>
                            </div>
                            <div class="form-group province m-0">
                                <?php
                                if(!empty(set_value("parent_id_province"))) {
                                    $province_item = get_province_item_by_id(set_value("parent_id_province"));
                                ?>
                                <label for="type_province">Chọn Tỉnh / Thành phố</label>
                                <input type="hidden" name="parent_id_province" value="<?php echo $province_item['id_location'] ?>">
                                <input type="text" name="province" id="type_province" spellcheck="false" class="form-control shadow-none" list="province_modal" value="<?php echo $province_item['name_location'] ?>" autocomplete="off">
                                <?php
                                }
                                ?>
                            </div>
                            <div class="form-group district m-0">
                                <?php
                                if ( !empty(set_value("parent_id_district")) ){ 
                                ?>
                                <label for="type_district">Chọn Quận / Huyện</label>
                                <input type="hidden" name="parent_id_district" value="">
                                <input type="text" name="district" id="type_district" spellcheck="false" class="form-control shadow-none" list="district_modal" autocomplete="off">
                                <datalist id="district_modal">
                                    <option data-id="" value="Khánh Hòa"></option>
                                </datalist>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btn_add_address" class="btn btn-block btn-update-pass shadow-none">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>