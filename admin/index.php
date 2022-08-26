<?php
include('../model/database.php');
include('../model/products_db.php');
include('../model/categories_db.php');
include('../model/users_db.php');
include('../model/order_db.php');
include('../model/rating_db.php');
include('../model/promotions_db.php');
include('../model/fields.php');
include('../model/validate.php');

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('name_brand');
$fields->addField('name_product');
$fields->addField('price_product');
$fields->addField('quantity_product');
$fields->addField('sale_product');
$fields->addField('category_product');
$fields->addField('image');
$fields->addField('image_2');
$fields->addField('desc_product');
$fields->addField('code_name');
$fields->addField('code_value');


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'view_dashboard';
    }
}
if (!isset($_GET['show'])) {
    $show = 10;
} else {
    $show = $_GET['show'];
}
switch ($action) {
    case 'view_dashboard':
        $orders = count(get_orders());
        $users = count(get_users());
        $products = count(get_products());
        $revenue = get_revenue();
        include('dashboard.php');
        break;
    case 'logout':
        session_start();
        unset($_SESSION['user']);
        header("Location: http://localhost/shopFigure/");
        break;
        // =====================================================   Brands ======================================================
    case 'view_brands':
        $categories = get_categories();
        include('Brands/brands.php');
        break;
    case 'view_add_brand':
        include('Brands/add_brands.php');
        break;
    case 'add_brand':
        $name_brand = filter_input(INPUT_POST, 'name_brand');
        $validate->text('name_brand', $name_brand);
        if ($fields->hasErrors()) {
            include('Brands/add_brands.php');
        } elseif (check_category($name_brand)) {
            $error_message = 'Tên thương hiệu đã tồn tại';
            include('Brands/add_brands.php');
        } else {
            $message = "Thêm thương hiệu thành công";
            add_category($name_brand);
            $categories = get_categories();
            include('Brands/brands.php');
        }

        break;
    case 'delete_brand':
        $message = "Xóa thương hiệu thành công";
        $category_id = filter_input(INPUT_POST, 'category_id');
        $ratings = get_ratings_by_cat($category_id);
        foreach ($ratings as $rating) {
            $product_id = $rating['productId'];
            delete_rating_by_pid($product_id);
        }
        delete_product_by_cat($category_id);
        delete_category($category_id);
        $categories = get_categories();

        include('Brands/brands.php');
        break;
    case 'view_edit_brand':
        $category_id = filter_input(INPUT_GET, 'category_id');
        $category = get_category_by_id($category_id);
        include('Brands/edit_brand.php');
        break;
    case 'edit_brand':
        $category_id = filter_input(INPUT_POST, 'id_brand');
        $category_name = filter_input(INPUT_POST, 'name_brand');
        update_category($category_name, $category_id);
        $message = 'Cập nhật thành công';
        $category = get_category_by_id($category_id);
        include('Brands/edit_brand.php');
        break;

        // =====================================================  End Brands ======================================================



        // =====================================================  Products ======================================================

    case 'view_products':
        $products = get_products();
        include('Products/products.php');
        break;
    case 'view_add_product':
        $message = "";
        $name_product = "";
        $price_product = "";
        $quantity_product = "";
        $sale_product = "";
        $category_product = "";

        $categories = get_categories();
        include('Products/add_product.php');
        break;
    case 'add_product':
        $message = "Sản phẩm đã được thêm thành công";
        $name_product = filter_input(INPUT_POST, 'name_product');
        $price_product = filter_input(INPUT_POST, 'price_product');
        $quantity_product = filter_input(INPUT_POST, 'quantity_product');
        $sale_product = filter_input(INPUT_POST, 'sale_product');
        $category_product = filter_input(INPUT_POST, 'category_product');
        $desc_product = filter_input(INPUT_POST, 'desc_product');

        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
            $file_name = $file['name'];
            move_uploaded_file($file['tmp_name'], 'Uploads/' . $file_name);
        }
        if (isset($_FILES['image_2'])) {
            $file = $_FILES['image_2'];
            $file_name_2 = $file['name'];
            move_uploaded_file($file['tmp_name'], 'Uploads/' . $file_name_2);
        }

        // validate
        $validate->text('name_product', $name_product);
        $validate->number('price_product', $price_product);
        $validate->number('quantity_product', $quantity_product);
        $validate->number('sale_product', $sale_product, true, 1, 100);
        $validate->image('image', $file_name);
        $validate->image('image_2', $file_name_2);

        if ($fields->hasErrors()) {
            $categories = get_categories();
            include('Products/add_product.php');
            break;
        } else {
            add_product($name_product, $price_product, $quantity_product, $sale_product, $category_product, $desc_product, $file_name, $file_name_2);
            $products = get_products();
            include('Products/products.php');
        }
        break;
    case 'delete_product':
        $message = 'Sản phẩm đã được xóa thành công';
        $product_id = filter_input(INPUT_POST, 'product_id');
        delete_rating_by_pid($product_id);
        delete_product($product_id);
        $products = get_products();
        include('Products/products.php');
        break;
    case 'view_edit_product':
        $categories = get_categories();
        $product_id = filter_input(INPUT_GET, 'product_id');
        $product = get_product_by_id($product_id);
        include('Products/edit_product.php');
        break;
    case 'edit_product':
        $product_id = filter_input(INPUT_GET, 'product_id');
        $name_product = filter_input(INPUT_POST, 'name_product');
        $price_product = filter_input(INPUT_POST, 'price_product');
        $quantity_product = filter_input(INPUT_POST, 'quantity_product');
        $sale_product = filter_input(INPUT_POST, 'sale_product');
        $category_product = filter_input(INPUT_POST, 'category_product');
        $desc_product = filter_input(INPUT_POST, 'desc_product');

        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
            $file_name = $file['name'];
            move_uploaded_file($file['tmp_name'], 'Uploads/' . $file_name);
        }
        if (isset($_FILES['image_2'])) {
            $file = $_FILES['image_2'];
            $file_name_2 = $file['name'];
            move_uploaded_file($file['tmp_name'], 'Uploads/' . $file_name_2);
        }

        // validate
        $validate->text('name_product', $name_product);
        $validate->number('price_product', $price_product);
        $validate->number('quantity_product', $quantity_product);
        $validate->number('sale_product', $sale_product, true, 1, 100);


        if ($fields->hasErrors()) {
            $categories = get_categories();
            $product = get_product_by_id($product_id);
            include('Products/edit_product.php');
            break;
        } else {
            update_product($name_product, $price_product, $quantity_product, $sale_product, $category_product, $desc_product, $file_name, $file_name_2, $product_id);
            $message = 'Cập nhật thành công';
            $categories = get_categories();
            $product = get_product_by_id($product_id);
            include('Products/edit_product.php');
            break;
        }
        break;
        // =====================================================  End Products ======================================================

        // =====================================================  Orders ======================================================
    case 'view_orders':
        $orders = get_orders();
        include('Orders/orders.php');
        break;
    case 'view_order':
        $order_id = $_GET['order_id'];
        $details = get_detail_order($order_id);
        $subtotal = 0;
        include('Orders/view_order.php');
        break;
    case 'delete_order':
        $message = "Đơn hàng đã được hủy";
        $status = "Đã hủy";
        $order_id = filter_input(INPUT_POST, 'order_id');
        update_status_order($order_id,$status);
        $orders = get_orders();
        include('Orders/orders.php');
        break;
    case 'accept_order':
        $message = "Đơn hàng đã được xử lý";
        $status = "Đã xử lý";
        $order_id = filter_input(INPUT_POST, 'order_id');
        update_status_order($order_id,$status);
        $orders = get_orders();
        include('Orders/orders.php');
        break;
        // =====================================================  End Orders ======================================================

        // =====================================================  Users ======================================================

    case 'view_users':

        if (isset($_GET['search'])) {
            $users = search_users($_GET['search']);
            if ($users == null) {
                $users = search_gmail($_GET['search']);
            }
            $page_button = ceil(count($users) / $show);
            $user_lm = $users;
        } else {
            $users = get_users();
            $page_button = ceil(count($users) / $show);
            $user_lm = get_users_limit();
        }

        include('Users/users.php');
        break;
    case 'delete_user':
        $message = "Xóa thành viên thành công";
        $user_id = filter_input(INPUT_POST, 'user_id');
        $orders = get_orders();
        foreach ($orders as $order) {
            $order_id = get_orderId_by_userId($user_id);
            delete_detail_order($order_id);
            delete_order($order_id);
        }
        delete_rating_by_userId($user_id);
        delete_user($user_id);
        $users = get_users();
        $page_button = ceil(count($users) / $show);
        $user_lm = get_users_limit();
        include('Users/users.php');
        break;
    case 'view_edit_user':
        $user_id = filter_input(INPUT_GET, 'user_id');
        $user = get_user_by_id($user_id);
        include('Users/edit_user.php');
        break;
    case 'edit_user':
        $user_id = filter_input(INPUT_GET, 'user_id');
        $user_name = filter_input(INPUT_POST, 'user_name');
        $user_email = filter_input(INPUT_POST, 'user_email');
        $user_phone = filter_input(INPUT_POST, 'user_phone');
        $user_address = filter_input(INPUT_POST, 'user_address');
        $user_role = filter_input(INPUT_POST, 'user_role');
        update_user($user_id, $user_name, $user_email, $user_phone, $user_address, $user_role);
        $message = 'Cập nhật thành công';
        $user = get_user_by_id($user_id);
        include('Users/edit_user.php');
        break;
        // =====================================================  End Users ======================================================

    case 'view_rating':
        $rates = get_ratings();
        include('view_rating.php');
        break;
    case 'delete_rating':
        $rate_id = filter_input(INPUT_POST, 'rate_id');
        delete_rating($rate_id);
        $rates = get_ratings();
        include('view_rating.php');
        break;
        // =====================================================  Promotions ======================================================

    case 'view_promotions':
        $promotions = get_promotions();
        include('Promotions/view_promotions.php');
        break;
    case 'view_add_code':
        include('Promotions/add_code.php');
        break;
    case 'add_code':
        $code_name = filter_input(INPUT_POST, 'code_name');
        $code_value = filter_input(INPUT_POST, 'code_value');

        $validate->text('code_name', $code_name);
        $validate->number('code_value', $code_value, true, 1, 1000);

        if ($fields->hasErrors()) {
            include('Promotions/add_code.php');
        } elseif (check_code($code_name)) {
            $error_message = 'Mã giảm giá đã tồn tại';
            include('Promotions/add_code.php');
        } else {
            $message = "Thêm mã giảm giá thành công";
            add_code($code_name, $code_value);
            $promotions = get_promotions();
            include('Promotions/view_promotions.php');
        }

        break;
    case 'delete_code':
        $message = "Xóa mã giảm giá thành công";
        $code_id = filter_input(INPUT_POST, 'code_id');

        delete_code($code_id);
        $promotions = get_promotions();
        include('Promotions/view_promotions.php');
        break;
    case 'view_edit_code':
        $promotions = get_promotions();
        $code_id = filter_input(INPUT_GET, 'code_id');
        $code = get_code_by_id($code_id);
        include('Promotions/edit_code.php');
        break;
    case 'edit_code':
        $code_id = filter_input(INPUT_GET, 'code_id');
        $code_name = filter_input(INPUT_POST, 'code_name');
        $code_value = filter_input(INPUT_POST, 'code_value');
        $validate->text('code_name', $code_name);
        $validate->number('code_value', $code_value, true, 1, 1000);
        if ($fields->hasErrors()) {
            $code = get_code_by_id($code_id);
            include('Promotions/edit_code.php');
            break;
        } else {
            update_code($code_id, $code_name, $code_value);
            $message = 'Cập nhật thành công';
            $code = get_code_by_id($code_id);
            include('Promotions/edit_code.php');
            break;
        }

        // =====================================================  End Promotions ======================================================

}
