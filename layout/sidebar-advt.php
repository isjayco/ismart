<?php
$advtItem = getAdvtItemByStutus("publish");
if (!empty($advtItem)) {
    $advtItem['img_url'] = "admin/" . $advtItem['img_url'];
?>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="<?php echo $advtItem['link_url'] ?>" title="" class="thumb" target="_blank">
                <img src="<?php echo $advtItem['img_url'] ?>" alt="">
            </a>
        </div>
    </div>
<?php
}
?>