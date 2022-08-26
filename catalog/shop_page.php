<?php
include('../view/header.php');
include('../view/navbar.php');
?>


<section class="breadcrumb-section set-bg " style="background-image: url(../images/sp2.jpg); padding: 45px;">
    <div class="container ">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="">
                    <?php if ($brand_id == null) : ?>
                        <h2 style="font-size: 46px; font-weight: 700;" class="text-white">Shop Page</h2>
                    <?php else : ?>
                        <h2 style="font-size: 46px; font-weight: 700;" class="text-white"><?php echo $brand_name ?></< /h2>

                        <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-md-5 mt-5">
                <div class="sidebar ">
                    <h4><i class="fas fa-filter mb-3"></i>Bộ lọc tìm kiếm</h4>
                    <hr>
                    <h5><b>Thương hiệu</b></h5>
                    <ul style="list-style-type: none;">
                        <li class="mb-3"><a href="?action=view_shop&amp;sort_by=&amp;brand_id=" class="text-dark" style="text-decoration : none;">Tất cả</a></li>

                        <?php foreach ($categories as $category) : ?>
                            <li class="mb-3"><a href="?action=view_shop&amp;sort_by=&amp;brand_id=<?php echo $category['categoryId'] ?>" class="text-dark" style="text-decoration : none;"><?php echo $category['categoryName'] ?>(<?php echo count_product_by_cat($category['categoryId']) ?>)</a></li>
                        <?php endforeach; ?>
                    </ul>
                    <hr>
                    <h5><b>Đánh giá</b></h5>
                    <ul style="list-style-type: none;">
                        <?php for ($i = 5; $i >= 1; $i--) : ?>
                            <a href="?action=view_shop&amp;sort_by=star_<?php echo $i ?>&amp;brand_id=<?php echo $brand_id ?>" style="text-decoration: none;">
                                <li>
                                    <i class="fa fa-star" style=" <?php if ($i >= 1) echo 'color: #f5a623;' ?>"></i>
                                    <i class="fa fa-star" style=" <?php if ($i >= 2) echo 'color: #f5a623;' ?>"></i>
                                    <i class="fa fa-star" style=" <?php if ($i >= 3) echo 'color: #f5a623;' ?>"></i>
                                    <i class="fa fa-star" style=" <?php if ($i >= 4) echo 'color: #f5a623;' ?>"></i>
                                    <i class="fa fa-star" style=" <?php if ($i >= 5) echo 'color: #f5a623;' ?>"></i>
                                </li>
                            </a>

                        <?php endfor ?>
                    </ul>

                </div>
            </div>
            <div class="col-lg-9 col-md-7 mt-4">

                <div class="row mt-3">
                    <div class="">
                        Sắp xếp theo
                        <a href="?action=view_shop&amp;sort_by=&amp;brand_id=<?php echo $brand_id ?>" class="btn btn-danger">Phổ biến </a>
                        <a href="?action=view_shop&amp;sort_by=new_product&amp;brand_id=<?php echo $brand_id ?>" class="btn btn-danger">Mới nhất </a>
                        <a href="?action=view_shop&amp;sort_by=sales&amp;brand_id=<?php echo $brand_id ?>" class="btn btn-danger">Bán chạy </a>
                        <a href="?action=view_shop&amp;sort_by=hot&amp;brand_id=<?php echo $brand_id ?>" class="btn btn-danger">Nổi bật </a>

                        <div class="dropdown show float-right ml-2">
                            <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Giá
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a href="?action=view_shop&amp;sort_by=price_asc&amp;brand_id=<?php echo $brand_id ?>" class="dropdown-item">Giá thấp đến cao </a>
                                <a href="?action=view_shop&amp;sort_by=price_desc&amp;brand_id=<?php echo $brand_id ?>" class="dropdown-item">Giá cao đến thấp </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <?php include('../view/products.php') ?>



                </div>
                <nav aria-label="Page navigation example ">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $page_button; $i++) : ?>
                            <li class="page-item"><a class="page-link" href="?action=view_shop&amp;sort_by=<?php echo $sort_by ?>&amp;brand_id=<?php echo $brand_id ?>&amp;page_id=<?php echo $i ?>"><?php echo $i ?></a></li>
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


    </div>


</section>

<?php include('../view/footer.php'); ?>