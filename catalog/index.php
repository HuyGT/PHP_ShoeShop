<?php
include('../model/database.php');
include('../model/products_db.php');
include('../model/categories_db.php');
include('../model/users_db.php');
include('../model/rating_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'view_detail_product';
    }
}

switch ($action) {
    case 'view_detail_product':
        $product_id = filter_input(INPUT_GET, 'product_id');
        $ratings = get_ratings($product_id);
        update_view($product_id);
        $avg_star = round(get_avg_star($product_id));
        $product = get_product_by_id($product_id);
        $new_price =  round($product['price'] * (1 - ($product['discount']) / 100), 2);
        $save = $product['price'] - $new_price;
        include('detail_product.php');
        break;
    case 'view_shop':
        if (isset($_GET['brand_id'])) {
            $brand_id = $_GET['brand_id'];
        }else{
            $brand_id = null;
        }
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
        }
        $brand_name = get_categoryName_by_id($brand_id);
        $categories = get_categories();
        $products_cat = get_products_by_cat($brand_id);
        $products = get_products_lm($brand_id);
        $page_button = ceil(count($products_cat) / 9);
        include('shop_page.php');
        break;
    case 'rate':
        $star = filter_input(INPUT_POST, 'star');
        $comment = filter_input(INPUT_POST, 'comment');
        $user_id = filter_input(INPUT_POST, 'user_id');
        $product_id = $_GET['product_id'];
        add_rating($product_id, $user_id, $star, $comment);
        $ratings = get_ratings($product_id);
        $avg_star = round(get_avg_star($product_id));
        $product = get_product_by_id($product_id);
        $new_price =  round($product['price'] * (1 - ($product['discount']) / 100), 2);
        $save = $product['price'] - $new_price;
        include('detail_product.php');
        break;
}
