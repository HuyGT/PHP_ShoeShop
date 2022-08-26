<?php foreach ($products as $product) : ?>

    <div class="card float-left m-3 " style="width: 15rem;border:none;">

        <div class="card-body">
            <a href="http://localhost/shopFigure/catalog?product_id=<?php echo $product['productId']; ?>"><img src="http://localhost/shopFigure/admin/Uploads/<?php echo $product['image']; ?>" class=" w-100 h-100"></a>
        </div>
        <div class="card-footer bg-white" style="border:none;">
            <h5 class="card-title ten"><?php echo $product['productName']; ?></h5>

            <div class="d-flex align-items-baseline">
                <div class="text-danger mr-3"><?php echo $product['price'] - ($product['price'] * ($product['discount'] / 100)); ?>$</div>

                <div class=" mr-3"><del><?php echo $product['price']; ?>$</del></div>
                <i class="fas fa-shopping-cart "><?php echo $product['product_bought']; ?></i>

            </div>
            <div class="mt-1">

                <i class="far fa-eye float-right mt-1"><?php echo $product['product_view']; ?></i>

                <?php $avg_star = round(get_avg_star($product['productId'])); ?>
                <?php if ($avg_star == null) : ?>

                <?php else : ?>
                    <div class="rate">
                        <i class="fa fa-star " style=" <?php if ($avg_star >= 1) echo 'color: #f5a623;' ?>"></i>
                        <i class="fa fa-star " style=" <?php if ($avg_star >= 2) echo 'color: #f5a623;' ?>"></i>
                        <i class="fa fa-star " style=" <?php if ($avg_star >= 3) echo 'color: #f5a623;' ?>"></i>
                        <i class="fa fa-star " style=" <?php if ($avg_star >= 4) echo 'color: #f5a623;' ?>"></i>
                        <i class="fa fa-star " style=" <?php if ($avg_star >= 5) echo 'color: #f5a623;' ?>"></i>
                    </div>
                <?php endif ?>
            </div>

        </div>
    </div>

<?php endforeach; ?>