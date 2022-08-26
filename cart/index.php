<?php
include('../model/database.php');
include('../model/products_db.php');
include('../model/users_db.php');
include('../model/order_db.php');
include('../model/promotions_db.php');
include('../model/cart.php');
include('../model/validate.php');
include('../model/fields.php');

$validate = new Validate();
$fields = $validate->getFields();

$fields->addField('phone');
$fields->addField('address');

error_reporting(0);
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'view_cart';
    }
}
session_start();
switch ($action) {
    case 'view_cart':
        $cart = cart_get_items();
        include('cart_view.php');
        break;
    case 'buy':
        $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
        cart_add_item($product_id, $quantity);
        $cart = cart_get_items();
        include('cart_view.php');
        break;

    case 'delete_all':
        clear_cart();
        include('cart_view.php');
        break;
    case 'update':
        $message = 'Cập nhật thành công';

        $items = filter_input(
            INPUT_POST,
            'items',
            FILTER_DEFAULT,
            FILTER_REQUIRE_ARRAY
        );
        foreach ($items as $product_id => $quantity) {
            cart_update_item($product_id, $quantity);
        }
        $cart = cart_get_items();
        include('cart_view.php');
        break;
    case 'delete':
        $message = 'Xóa thành công';
        $product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);
        cart_remove_item($product_id);
        $cart = cart_get_items();
        include('cart_view.php');
        break;
    case 'view_order':
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user']['userId'];
            $user = get_user_by_id($user_id);
        }
        $cart = cart_get_items();
        if (!isset($_SESSION['user'])) {
            $message = 'Bạn cần đăng nhập để có thể đặt hàng';
            include('cart_view.php');
        } else {
            include('payment.php');
        }
        break;
    case 'order':
        $user_id = filter_input(INPUT_POST, 'user_id');
        $subtotal = filter_input(INPUT_POST, 'subtotal');
        $code_name = filter_input(INPUT_POST, 'code_name');
        $code_value = filter_input(INPUT_POST, 'code_value');

        $phone = filter_input(INPUT_POST, 'phone');
        $address = filter_input(INPUT_POST, 'address');

        $validate->text('address', $address);
        $validate->phone('phone', $phone, true);

        if ($fields->hasErrors()) {
            if (isset($_SESSION['user'])) {
                $user_id = $_SESSION['user']['userId'];
                $user = get_user_by_id($user_id);
            }
            $cart = cart_get_items();
            include('payment.php');
            break;
        }

        $order_id =  add_order($user_id, $subtotal, $code_name, $code_value, $phone, $address);


        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $product = get_product_by_id($product_id);
            $price = $product['price'];
            $product_name = $product['productName'];
            $discount = $product['discount'];
            add_detail_order($order_id, $quantity, $price, $product_name, $discount);
            update_bought($product_id, $quantity);
            update_quantity($product_id, $quantity);
        }
        unset($_SESSION['cart']);
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        include('payment_success.php');
        break;
    case 'enter_code':
        $code_name = filter_input(INPUT_POST, 'code');
        $code_value = get_code_by_name($code_name);
        if (check_code($code_name)) {
            $message = 'Nhập mã giảm giá thành công';
        } else {
            $error_message = 'Nhập mã giảm giá thất bại';
        }
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user']['userId'];
            $user = get_user_by_id($user_id);
        }
        $cart = cart_get_items();
        include('payment.php');
        break;
}
