<?php
include('../view/header.php');
include('../view/navbar.php');
?>
<link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/all.css">

<?php if (cart_product_count() == 0) : ?>
    <div class="text-center mt-5 mb-5">
        <i class="fas fa-cart-plus" style="font-size: 5em;"></i>
        <p>Không có sản phẩm nào trong giỏ hàng</p>
        <a href="http://localhost/shopFigure/" class="btn btn-danger mb-1">Quay về trang chủ</a>
        <p>Khi cần trợ giúp vui lòng gọi 1800.1060 hoặc 028.3622.1060 (7h30 - 22h)</p>
    </div>
<?php else : ?>
    <div class="container">
        <form action="." method="post">
            <input type="hidden" name="action" value="update">
            <h1 class="text-center">Giỏ hàng</h1>
            <?php if (!empty($message)) : ?>
                <div class="alert alert-success"><?php echo $message ?></div>
            <?php endif ?>
            <table id="cart" class="table table-bordered">
                <thead>
                    <tr id="cart_header">
                        <th class="right">Ảnh</th>
                        <th class="left">Tên</th>
                        <th class="left">Giảm giá</th>
                        <th class="right">Số lượng</th>
                        <th class="right">Kho</th>
                        <th class="right">Đơn Giá</th>
                        <th class="right">Thành tiền</th>
                        <th class="right">&nbsp;</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $product_id => $item) : ?>
                        <input type="hidden" name="product_id" value="<?php echo $item['id'] ?>">

                        <tr>
                            <td class="right">
                                <img src="../admin/Uploads/<?php echo $item['image']; ?>" class="" style="height: 50px; width: 50px;">
                            </td>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td class="right text-center">
                                <?php echo htmlspecialchars($item['discount']); ?>%
                            </td>
                            <td class="right">
                                <input id='quantity' min='1' name='items[<?php echo $product_id; ?>]' type='number' value='<?php echo $item['quantity']; ?>' style="width: 50px;" />
                            </td>
                            <td class="right">
                                <?php echo get_quantity($product_id); ?>
                            </td>
                            <td class="right">
                                <?php echo sprintf('$%.2f', $item['price']); ?>
                            </td>
                            <td class="right">
                                <?php echo sprintf('$%.2f', $item['line_price']); ?>
                            </td>
                            <td class="right">
                                <a href="?action=delete&amp;product_id=<?php echo $item['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
                <tfoot>


                    <tr id="cart_footer">
                        <td colspan="6" class="right"><b>Tổng</b></td>

                        <td class="right">
                            <?php echo (sprintf('$%.2f', cart_subtotal())); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="" class="right">
                            <input type="submit" value="Cập nhật" class="btn btn-facebook">
                        </td>

        </form>
        <td colspan="5">
            <form action="" method="POST">
                <input type="hidden" name="action" value="delete_all">
                <input type="submit" value="Xóa tất cả" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa giỏ hàng không ?')">
            </form>
        </td>
        <td>
            <form action="" method="POST">
                <input type="hidden" name="action" value="view_order">
                <input type="submit" value="Đặt hàng ngay" <?php if (get_quantity($product_id) < $item['quantity']) echo 'disabled' ?> class="btn btn-success">
            </form>
        </td>

        </tr>

        </tfoot>
        </table>
        <?php if (get_quantity($product_id) < $item['quantity']) : ?>
            <div class="alert alert-danger"><?php echo 'Bạn không thể đặt nhiều hơn trong kho'; ?></div>
        <?php endif ?>

    </div>

<?php endif; ?>




<?php include('../view/footer.php'); ?>