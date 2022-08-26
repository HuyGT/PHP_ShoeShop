<?php
include('../model/database.php');
include('../model/users_db.php');
include('../model/fields.php');
include('../model/validate.php');
include('../model/order_db.php');
include('../model/products_db.php');

error_reporting(0);
$validate = new Validate();
$fields = $validate->getFields();

// add fields form register
$fields->addField('email');
$fields->addField('full_name');
$fields->addField('phone');
$fields->addField('address');
$fields->addField('password_1');
$fields->addField('password_2');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'view_login_page';
    }
}

switch ($action) {
    case 'view_login_page':
        $email = '';
        $password = '';
        include('login_page.php');
        break;
    case 'login':
        session_start();
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $remember =  $_POST['remember'];
        if ($remember == 1) {
            setcookie('email', $email, time() + 60 * 60 * 24, "/");
            setcookie('password', $password, time() + 60 * 60 * 24, "/");
        }
        if ($email == null || $password == null) {
            $error_message = "Bạn cần nhập đầy đủ tất cả thông tin";
            include('login_page.php');
        } else {
            if (get_user_by_email_password($email, $password)) {
                $_SESSION['user'] = get_user_by_email_password($email, $password);
                header("Location: http://localhost/shopFigure/");
            } else {
                $error_message = "Sai tên đăng nhập hoặc mật khẩu.";
                include('login_page.php');
            }
        }
        
        break;
    case 'logout':
        session_start();
        unset($_SESSION['user']);
        header("Location: http://localhost/shopFigure/");
        break;
    case 'view_edit_account':
        $user_id = filter_input(INPUT_GET, 'user_id');
        $user = get_user_by_id($user_id);
        include('edit_account.php');
        break;
    case 'edit_account':

        $user_id = $_GET['user_id'];
        $full_name = filter_input(INPUT_POST, 'fullName');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        $address = filter_input(INPUT_POST, 'address');
        // validate
        $validate->email('email', $email);
        $validate->phone('phone', $phone, true);
        $validate->text('full_name', $full_name);
        $validate->text('address', $address);

        if ($fields->hasErrors()) {
            $user = get_user_by_id($user_id);
            include('edit_account.php');
            break;
        } else {
            $message = 'Cập nhật thông tin thành công';
            edit_user($full_name, $email, $phone, $address, $user_id);
            $user = get_user_by_id($user_id);
            include('edit_account.php');
        }
        break;
    case 'view_register_page':
        $error_message = "";
        $full_name = "";
        $email = "";
        $phone = "";
        $password_1 = "";
        $password_2 = "";
        include('register_page.php');
        break;
    case 'register':
        $full_name = filter_input(INPUT_POST, 'full_name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        $password_1 = filter_input(INPUT_POST, 'password_1');
        $password_2 = filter_input(INPUT_POST, 'password_2');


        // validate
        $validate->email('email', $email);
        $validate->text('full_name', $full_name);
        $validate->phone('phone', $phone, true);
        $validate->text('password_1', $password_1, true, 6, 30);
        $validate->text('password_2', $password_2, true, 6, 30);

        if ($full_name == null || $email == null || $phone == null || $password_1 == null || $password_2 == null) {
            $error_message = "Bạn cần nhập đầy đủ tất cả thông tin";
            include('register_page.php');
        } elseif ($fields->hasErrors()) {
            include 'register_page.php';
        } elseif ($password_1 !== $password_2) {
            $error_message = 'Mật khẩu không trùng khớp.';
            include 'register_page.php';
        } elseif (check_email($email)) {
            $error_message = 'Email đã tồn tại';
            include 'register_page.php';
        } elseif(check_phone($phone)){
            $error_message = 'Số điện thoại đã tồn tại';
            include 'register_page.php';
        } else {
            add_new_user($full_name, $phone, $email, $password_1);
            $message = 'Đăng ký thành công';
            include 'register_page.php';
        }
        break;
    case 'view_orders':
        $user_id = $_GET['user_id'];
        $orders = get_orders_by_user($user_id);
        include('view_orders.php');
        break;
    case 'view_order':
        $order_id = $_GET['order_id'];
        $details = get_detail_order($order_id);
        include('view_order.php');
        break;
    case 'delete_order':
        $message = "Đơn hàng đã được hủy";
        $status = "Đã hủy";
        $order_id = filter_input(INPUT_POST, 'order_id');
        update_status_order($order_id,$status);
        $user_id = $_GET['user_id'];
        $orders = get_orders_by_user($user_id);
        include('view_orders.php');
        break;
    case  'view_edit_password':
        include('edit_password.php');
        break;
    case 'edit_password':
        $user_id = $_GET['user_id'];
        $now_password = filter_input(INPUT_POST, 'now_password');
        $new_password_1 = filter_input(INPUT_POST, 'new_password_1');
        $new_password_2 = filter_input(INPUT_POST, 'new_password_2');
        if (get_password($user_id) != $now_password) {
            $message_1 = 'Sai mật khẩu';
        } elseif (strlen($new_password_1) < 6 || strlen($new_password_2) < 6) {
            $message_2 = 'Mật khẩu phải trên 6 ký tự';
        } elseif ($new_password_1 != $new_password_2) {
            $message_2 = 'Mật khẩu không trùng khớp';
        } else {
            $message = 'Cập nhật mật khẩu thành công';
            update_password($new_password_1, $user_id);
        }
        include('edit_password.php');
        break;
}
