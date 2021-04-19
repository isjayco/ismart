<?php
function construct()
{
    load_model('index');
}

// Index
function indexAction()
{
    load('helper', 'format');
    $dataId = !empty($_GET['id']) ? $_GET['id'] : 0;
    $numPerPage    = 6;
    $listPosts     = getListPostsByPagination(0,$numPerPage,$dataId);
    $postCatItem   = getPostCatItemById($dataId);
    $dataSendView  = array(
        "listPosts"   => $listPosts,
        "postCatItem" => $postCatItem,
        "dataId"      => $dataId
    );
    load_view('index', $dataSendView);
}

// detail 
function detailAction()
{
    load('helper','format');
    $dataId = !empty($_GET['id']) ? $_GET['id'] : 0;
    $postItem = getPostsItemById($dataId);
    $data['postItem'] = $postItem;
    load_view('detailBlog',$data);
}




// ==================== //
// ==== AJAX ACTION === //
// ==================== //

// ------- posts ------ //

#get total page
function getTotalPageAction()
{
    $numPerPage = $_POST['numPerPage'];
    $dataId     = $_POST['dataId'];
    $listPost = getListPostsByPostCatId($dataId);
    $totalPage =  count($listPost) / $numPerPage;
    $data['totalPage'] = ceil($totalPage);
    echo json_encode($data);
}
#load data page
function loadDataPageAction()
{
    $numPerPage  = $_POST['numPerPage'];
    $currentPage = $_POST['currentPage'];
    $dataId     = $_POST['dataId'];
    $pageStart   = (int) ($currentPage - 1) * $numPerPage;
    $listPosts    = getListPostsByPagination($pageStart, $numPerPage, $dataId);
    if (!empty($listPosts)) {
?>
        <ul class="list-item">
            <?php
            foreach ($listPosts as $postItem) {
                $postItem['post_img']     = "admin/" . $postItem['post_img'];
                $postItem['url_detail']   = "?mod=posts&action=detail&id={$postItem['post_id']}";
                $data                     = getdate($postItem['created_date']);
                $postItem['created_date'] = "{$data['mday']}/{$data['mon']}/{$data['year']}";
            ?>
                <li class="clearfix">
                    <a href="<?php echo $postItem['url_detail'] ?>" title="" class="thumb fl-left">
                        <img src="<?php echo $postItem['post_img'] ?>" alt="">
                    </a>
                    <div class="info fl-right">
                        <a href="<?php echo $postItem['url_detail'] ?>" title="" class="title"><?php echo $postItem['post_title'] ?></a>
                        <span class="create-date"><?php echo $postItem['created_date'] ?></span>
                        <p class="desc"><?php echo $postItem['post_desc'] ?></p>
                    </div>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
    } else {
    ?>
        <p>Hiện tại không có bài viết nào</p>
<?php
    }
}
