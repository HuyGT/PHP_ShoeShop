<?php include('../view/header.php') ?>
<?php include('../view/navbar.php') ?>



<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-3">
            <div class="list-group">
                <a href="?action=view_edit_account&amp;user_id=<?php echo $_SESSION['user']['userId']; ?>" class="list-group-item active">Thông tin tài khoản</a>
                <a href="?action=view_orders&amp;user_id=<?php echo $_SESSION['user']['userId']; ?>" class="list-group-item">Xem hóa đơn</a>
                <a href="?action=view_edit_password&amp;user_id=<?php echo $_SESSION['user']['userId']; ?>" class="list-group-item ">Đổi mật khẩu</a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-9">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table mt-3"></i>
                    <span>Orders</span>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date_order</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <?php if (!empty($message)) : ?>
                                <div class="alert alert-success"><?php echo $message ?></div>
                            <?php endif ?>
                            <tbody>
                                <?php foreach ($orders as $order) : ?>

                                    <tr>
                                        <th><?php echo $order['orderId']; ?></th>
                                        <th><?php echo $order['email']; ?></th>
                                        <th><?php echo $order['total']; ?>$</th>
                                        <th>
                                            <?php if ($order['status'] == 'Đã xử lý') : ?>
                                                <p class="btn btn-success">Đã xử lý</p>
                                            <?php elseif ($order['status'] == 'Đã hủy') : ?>
                                                <p class="btn btn-danger"><?php echo $order['status']; ?></p>
                                            <?php else : ?>
                                                <p class="btn btn-info"><?php echo $order['status']; ?></p>
                                            <?php endif ?>
                                        </th>
                                        <th><?php echo $order['dateOrder']; ?></th>

                                        <th>
                                            <div class="row ml-1">
                                                <a href="?action=view_order&amp;order_id=<?php echo $order['orderId']; ?>"><button class="btn btn-success"><i class="fas fa-search"></i></button></a>

                                                <form action="" method="POST">
                                                    <input type="hidden" name="action" value="delete_order">
                                                    <input type="hidden" name="order_id" value="<?php echo $order['orderId']; ?>">
                                                    <button class="btn btn-danger " type="submit" <?php if ($order['status'] == 'Đã xử lý' || $order['status'] == 'Đã hủy') echo 'disabled'; ?> onclick="return confirm('Bạn có muốn hủy đơn hàng <?php echo $order['orderId']; ?> không ? ')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </th>

                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div>


    </div>

</div>

<?php include('../view/footer.php') ?>