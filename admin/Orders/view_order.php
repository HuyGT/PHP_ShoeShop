<?php include('../view/admin/header.php'); ?>
<div id="wrapper">

    <!-- Sidebar -->
    <?php include('../view/admin/sidebar.php'); ?>
    <div id="content-wrapper">

        <div class="container-fluid">


            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table mt-3"></i>
                    <span>Order</span>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Sale</th>
                                    <th>Total</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($details as $detail) : ?>

                                    <tr>
                                        <th><?php echo $detail['detailOrderId']; ?></th>
                                        <th><?php echo $detail['productName']; ?></th>
                                        <th><?php echo $detail['price']; ?>$</th>
                                        <th><?php echo $detail['detailQuantity']; ?></th>
                                        <th><?php echo $detail['discount']; ?>%</th>
                                        <th><?php echo $detail['price'] * $detail['detailQuantity'] * ((100 - $detail['discount'])/100); ?>$</th>
                                    </tr>

                                <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                                <tr id="cart_footer">
                                    <td colspan="" class="right"><b>Mã giảm giá</b></td>

                                    <td class="right" colspan="4">
                                        <b><?php echo $detail['code_name']; ?></b>
                                    </td>
                                    <td class="right">
                                        <b><?php echo $detail['code_value']; ?>$</b>
                                    </td>
                                </tr>
                                <tr id="cart_footer">
                                    <td colspan="5" class="right"><b>Tổng</b></td>

                                    <td class="right">
                                        <b><?php echo $detail['total'] ; ?>$</b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        Thông tin giao hàng:
                        <p>SDT: <b><?php echo $detail['phone_customer']; ?></b></p>
                        <p>Address: <b><?php echo $detail['address_shipping']; ?></b></p>

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