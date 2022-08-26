<?php
include('../view/header.php');
include('../view/navbar.php');
?>

<h1 class="text-center">Đặt hàng</h1>
<div class="container">
    <?php if (!empty($message)) : ?>
        <div class="alert alert-success"><?php echo $message ?></div>
    <?php endif ?>
    <?php if (!empty($error_message)) : ?>
        <div class="alert alert-danger"><?php echo $error_message ?></div>
    <?php endif ?>
    <div class="row m-5">
        <div class="col-6 ">
            <form action="" method="POST">
                <input type="hidden" name="action" value="order">
                <input type="hidden" name="user_id" value="<?php echo $user['userId']; ?>">
                <h3 class="text-center">Danh sách sản phẩm</h3>
                <?php foreach ($cart as $product_id => $item) : ?>
                    <img src="../admin/Uploads/<?php echo $item['image']; ?>" class="float-left " style="height: 50px; width: 50px;">
                    <div class="">
                        <?php echo htmlspecialchars($item['name']); ?>
                    </div>
                    <div class="">
                        Giá: <?php echo sprintf('$%.2f', $item['price']); ?> |
                        Khuyến mãi: <?php echo htmlspecialchars($item['discount']); ?>% |
                        Số lượng: <?php echo htmlspecialchars($item['quantity']); ?>
                    </div>
                    <hr>
                <?php endforeach; ?>
                <input type="hidden" name="subtotal" value="<?php echo (cart_subtotal() - $code_value); ?>">
                <input type="hidden" name="code_value" value="<?php echo  $code_value; ?>">
                <input type="hidden" name="code_name" value="<?php if(!empty(check_code($code_name))) echo $code_name; ?>">
                <input type="hidden" name="code_id" value="<?php echo  $code_id; ?>">


                <h3>Tổng : <?php echo sprintf('$%.2f', cart_subtotal()); ?></h3>
                <h3>Mã giảm giá : $<?php echo  $code_value; ?></h3>
                <h3>Tổng thành tiền: <?php echo sprintf('$%.2f', cart_subtotal() - $code_value); ?></h3>

                <a href="?action=view_cart" class="btn btn-success mt-3">Trở về</a>

        </div>
        <div class="col-6 ">
            <h3 class="text-center">Thông tin khách hàng</h3>
            <label for="">Họ và tên: </label>
            <input type="text" name="fullName" value="<?php echo $user['name']; ?>" disabled class="form-control"> <br>
            <label for="">Email: </label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" disabled class="form-control"> <br>
            <label for="">Số điện thoại: 
                <label class="text-danger"><?php echo $fields->getField('phone')->getHTML(); ?></label>
            </label>
            <input type="text" name="phone" value="<?php echo $user['phone']; ?>" class="form-control"> <br>
            <label for="">Địa chỉ: 
                <label class="text-danger"><?php echo $fields->getField('address')->getHTML(); ?></label>
            </label>
            <input type="text" name="address" value="<?php echo $user['address']; ?>" class="form-control"> <br>
            <button class="btn btn-danger" >Đặt hàng ngay</button>
        </div>

        </form>
        <form action="" method="POST">
            <input type="hidden" name="action" value="enter_code">
            <input type="text" name="code" placeholder="Nhập mã giảm giá ">
            <input type="submit" value="Xác nhận" class="btn btn-facebook">
        </form>


    </div>
</div>
<?php include('../view/footer.php'); ?>