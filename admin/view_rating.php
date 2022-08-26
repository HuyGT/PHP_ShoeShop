<?php include('../view/admin/header.php'); ?>
<div id="wrapper">

    <!-- Sidebar -->
    <?php include('../view/admin/sidebar.php'); ?>
    <div id="content-wrapper">

        <div class="container-fluid">


            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table mt-3"></i>
                    <span>Users</span>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Product</th>
                                    <th>Comment</th>
                                    <th>Star</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($rates as $rate) : ?>
                                    <tr>
                                        <th><?php echo $rate['rate_id']; ?></th>
                                        <th><?php echo $rate['name']; ?></th>
                                        <th><?php echo $rate['productName']; ?></th>
                                        <th><?php echo $rate['comment']; ?></th>
                                        <th><i class="fa fa-star" style=" <?php if ($rate['star'] >= 1) echo 'color: #f5a623;' ?>"></i>
                                            <i class="fa fa-star" style=" <?php if ($rate['star'] >= 2) echo 'color: #f5a623;' ?>"></i>
                                            <i class="fa fa-star" style=" <?php if ($rate['star'] >= 3) echo 'color: #f5a623;' ?>"></i>
                                            <i class="fa fa-star" style=" <?php if ($rate['star'] >= 4) echo 'color: #f5a623;' ?>"></i>
                                            <i class="fa fa-star" style=" <?php if ($rate['star'] >= 5) echo 'color: #f5a623;' ?>"></i>
                                        </th>

                                        <form action="" method="POST">
                                            <input type="hidden" name="action" value="delete_rating">
                                            <input type="hidden" name="rate_id" value="<?php echo $rate['rate_id']; ?>">
                                            <th> <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa bình luận <?php echo $rate['rate_id']; ?> không ?')"></th>
                                        </form>
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