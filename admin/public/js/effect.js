$(() => {

    setTimeout(()=> {
        init();
    },900);

    function init() {
        // total product
        get_total("?mod=products&action=get_num_total_products", ".main-content-box.num_products");
        // total customer
        get_total("?mod=sales&controller=customer&action=get_total_customer", ".main-content-box.num_customer");
        // total post
        get_total("?mod=posts&action=get_num_total_posts", ".main-content-box.posts");
        // total order
        get_total("?mod=sales&action=get_total_order", ".main-content-box.num_order");
    }
    
    // get total
    function get_total(baseURL, place_append) {
        $.ajax({
            url : baseURL,
            method : "POST",
            dataType : "json",
            success : (data) => {
                let num = data.num;
                let i = 0;
                setInterval(() => {
                    i ++;
                    if( i <= num ) {
                        $("#main-content-wp.main-home").find(place_append).children('.num-data').text(i);
                    }
                },5);
            },
            error : (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }
})