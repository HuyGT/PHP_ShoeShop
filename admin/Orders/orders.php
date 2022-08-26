<?php include('../view/admin/header.php'); ?>
<div id="wrapper">

    <!-- Sidebar -->
    <?php include('../view/admin/sidebar.php'); ?>
    <div id="content-wrapper">

        <div class="container-fluid">


            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table mt-3"></i>
                    <span>Orders</span>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <?php if (!empty($message)) : ?>
                                <div class="alert alert-success"><?php echo $message ?></div>
                            <?php endif ?>
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
                                                    <input type="hidden" name="action" value="accept_order">
                                                    <input type="hidden" name="order_id" value="<?php echo $order['orderId']; ?>">
                                                    <button class="btn btn-success " type="submit" <?php if ($order['status'] == 'Đã xử lý' || $order['status'] == 'Đã hủy') echo 'disabled'; ?> onclick="return confirm('Bạn có muốn xử lý đơn hàng <?php echo $order['orderId']; ?> không ? ')">
                                                        <i class="fas fa-check-circle"></i>
                                                    </button>
                                                </form>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="action" value="delete_order">
                                                    <input type="hidden" name="order_id" value="<?php echo $order['orderId']; ?>">
                                                    <button class="btn btn-danger " type="submit" <?php if ($order['status'] == 'Đã xử lý' || $order['status'] == 'Đã hủy') echo 'disabled'; ?> onclick="return confirm('Bạn có muốn xóa đơn hàng <?php echo $order['orderId']; ?> không ? ')">
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
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Your Website 2018</span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->
<?php include('../view/admin/footer.php'); ?>