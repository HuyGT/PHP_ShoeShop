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
                    <div class="row">
                        <div class="col-9">
                            <div class="dropdown ">
                                <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Hiển thị
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a href="?action=view_users&amp;show=5" class="dropdown-item">5 </a>
                                    <a href="?action=view_users&amp;show=10" class="dropdown-item">10 </a>
                                    <a href="?action=view_users&amp;show=25" class="dropdown-item">25 </a>
                                    <a href="?action=view_users&amp;show=50" class="dropdown-item">50 </a>

                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <form action="" method="GET">
                                <input type="hidden" name="action" value="view_users">
                                <label for="">Search</label>
                                <input type="text" name="search">
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <?php if (!empty($message)) : ?>
                                <div class="alert alert-success"><?php echo $message ?></div>
                            <?php endif ?>
                            <thead>
                                <tr>
                                    <th>ID
                                        <a href="?action=view_users&amp;sort_by=id_desc"><i class="fas fa-long-arrow-alt-down float-right"></i></a>
                                        <a href="?action=view_users&amp;sort_by=id_asc"><i class="fas fa-long-arrow-alt-up float-right"></i></a>
                                    </th>
                                    <th>Name
                                        <a href="?action=view_users&amp;sort_by=name_desc"><i class="fas fa-long-arrow-alt-down float-right"></i></a>
                                        <a href="?action=view_users&amp;sort_by=name_asc"><i class="fas fa-long-arrow-alt-up float-right"></i></a>
                                    </th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Role
                                        <a href="?action=view_users&amp;sort_by=role_desc"><i class="fas fa-long-arrow-alt-down float-right"></i></a>
                                        <a href="?action=view_users&amp;sort_by=role_asc"><i class="fas fa-long-arrow-alt-up float-right"></i></a>
                                    </th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($user_lm as $user) : ?>
                                    <tr>
                                        <th><?php echo $user['userId']; ?></th>
                                        <th><?php echo $user['name']; ?></th>
                                        <th><?php echo $user['phone']; ?></th>
                                        <th><?php echo $user['email']; ?></th>
                                        <th><?php echo $user['role']; ?></th>
                                        <th><a href="?action=view_edit_user&amp;user_id=<?php echo $user['userId'] ?>" class="btn btn-success">Edit</a></th>
                                        <th>
                                            <form action="" method="POST">
                                                <input type="hidden" name="action" value="delete_user">
                                                <input type="hidden" name="user_id" value="<?php echo $user['userId']; ?>">
                                        <th> <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa thành viên <?php echo $user['userId']; ?> không ?')"></th>
                                        </form>
                                        </th>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example ">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <?php for ($i = 1; $i <= $page_button; $i++) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?action=view_users&amp;show=<?php echo $show ?>&amp;page_id=<?php echo $i ?>"><?php echo $i ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
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