<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
    </div>
    <div id="content" class="fl-right">
        <div class="container-fluid">
            <div id="wp-box-content" class="row changpass">
                <div class="title-content col-md-12 mx-auto text-center sticky-top">
                        <h3 class="title-page">Danh sách vị trí</h3>
                </div>
                <?php
                if(!empty($list_province)) {
                ?>
                <div class="main-content col-md-3 mx-auto location" id="province">
                    <div class="title-content">
                        <h2>Tỉnh / Thành phố</h2>
                    </div>
                    <div class="boby-content">
                        <ul class="list-location">
                            <?php
                            foreach($list_province as $province_item) {
                            ?>
                            <li>
                                <span title="Việt Nam" class="location-item" data-id_location="<?php echo $province_item['id_location'] ?>" data-level_location="<?php echo $province_item['level_location'] ?>"><?php echo $province_item['name_location'] ?></span>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="main-content col-md-3 mx-auto location" id="district">
                    <div class="title-content">
                        <h2>Quận / Huyện</h2>
                    </div>
                    <div class="boby-content">
                        <ul class="list-location">
                            <?php
                            foreach($list_district as $district_item) {
                                $province_item = get_location_by_id($district_item['parent_id']);
                            ?>
                            <li>
                                <span title="Thuộc Tỉnh / Thành phố '<?php echo $province_item['name_location'] ?>'" class="location-item" data-id_location="<?php echo $district_item['id_location'] ?>" data-level_location="<?php echo $district_item['level_location'] ?>"><?php echo $district_item['name_location'] ?></span>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="main-content col-md-3 mx-auto location" id="street">
                    <div class="title-content">
                        <h2>Xã / Phường</h2>
                    </div>
                    <div class="boby-content">
                        <ul class="list-location">
                            <?php
                            foreach($list_street as $street_item) {
                                $district_item = get_location_by_id($street_item['parent_id']);
                                $province_item = get_location_by_id($district_item['parent_id']);
                            ?>
                            <li>
                                <span title="Thuộc Tỉnh / Thành phố '<?php echo $province_item['name_location'] ?>' Quận / Huyện '<?php echo $district_item['name_location'] ?>'" class="location-item" data-id_location="<?php echo $street_item['id_location'] ?>" data-level_location="<?php echo $street_item['level_location'] ?>"><?php echo $street_item['name_location'] ?></span>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <?php
                } else {
                    ?>
                        <div class="notifi_process mx-auto">
                            <span class="thumb-img"><img src="public/images/notFoundIcon.png" class="img-fluid" alt=""></span>
                            <p class="txt_notifi">Hiện tại có vị trí nào ..!</p>
                            <div class="add">
                                <a href="?mod=location&action=add" class="link-add text-center d-block">Thêm tại đây.!</a>
                            </div>
                        </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>