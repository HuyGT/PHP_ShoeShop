<!---------------------------------------------------------------- New Products ---------------------------------------------------->

<h1 class="text-center">Sản phẩm nổi bật</h1>
<div class="container">
    <section class="row ml-2">
        <?php include('view/products.php') ?>
    </section>
</div> <br>
<div class="text-center">
    <a href="http://localhost/shopFigure/catalog?action=view_shop&amp;brand_id=&amp;sort_by=" class="btn btn-success">Xem thêm</a>
</div>
<!---------------------------------------------------------------- END Products ---------------------------------------------------->
<div class="container">
    <div class="row">
        <section class="ftco-section ftco-partner bg-white" style="padding: 1em;">
            <div class="container bg-white">
                <div class="row">
                    <div class="item mb-3 float-left"><a href="#"><img src="images/p1.png" style="width:200px; height:150px"></a></div>
                    <div class="item mb-3 float-left ml-4"><a href="#"><img src="images/p2.jpg" style="width:200px; height:150px"></a>
                    </div>
                    <div class="item mb-3 float-left ml-4"><a href="#"><img src="images/p3.png" style="width:200px; height:150px"></a></div>
                    <div class="item mb-3 float-left ml-4"><a href="#"><img src="images/p4.png" style="width:200px; height:150px"></a></div>
                    <div class="item mb-3 float-left ml-4"><a href="#"><img src="images/p5.jpg" style="width:200px; height:150px"></a></div>
                </div>
            </div>
        </section>
    </div>
</div>

<h1 class="text-center mt-3">Sản phẩm bán chạy</h1>
<div class="container">
    <div class="row ml-2">
        <?php foreach ($products_new as $product) : ?>

            <div class="card float-left m-3 " style="width: 15rem;border:none;">

                <div class="card-body " style="border:none;">
                    <a href="http://localhost/shopFigure/catalog?product_id=<?php echo $product['productId']; ?>"><img src="admin/Uploads/<?php echo $product['image']; ?>" class=" w-100 h-100 "></a>
                </div>
                <div class="card-footer bg-white" style="border:none;">
                    <h5 class="card-title ten"><?php echo $product['productName']; ?></h5>

                    <div class="d-flex align-items-baseline">
                        <div class="text-danger mr-3"><?php echo $product['price'] - ($product['price'] * ($product['discount'] / 100)); ?>$</div>

                        <div class=" mr-3"><del><?php echo $product['price']; ?>$</del></div>
                        <i class="fas fa-shopping-cart"><?php echo $product['product_bought']; ?></i>

                    </div>
                    <div class="mt-1">

                        <i class="far fa-eye float-right mt-1"><?php echo $product['product_view']; ?></i>
                        <style>
                            .rate .active {
                                color: #f5a623;
                            }
                        </style>
                        <?php $avg_star = round(get_avg_star($product['productId'])); ?>
                        <?php if ($avg_star == null) : ?>

                        <?php else : ?>
                            <div class="rate">
                                <i class="fa fa-star <?php if ($avg_star >= 1) echo 'active' ?>"></i>
                                <i class="fa fa-star <?php if ($avg_star >= 2) echo 'active' ?>"></i>
                                <i class="fa fa-star <?php if ($avg_star >= 3) echo 'active' ?>"></i>
                                <i class="fa fa-star <?php if ($avg_star >= 4) echo 'active' ?>"></i>
                                <i class="fa fa-star <?php if ($avg_star >= 5) echo 'active' ?>"></i>
                            </div>
                        <?php endif ?>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div> <br>
<div class="text-center">
    <a href="http://localhost/shopFigure/catalog?action=view_shop&amp;brand_id=&amp;sort_by=" class="btn btn-success">Xem thêm</a>
</div>