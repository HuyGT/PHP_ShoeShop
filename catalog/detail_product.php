<?php
include('../view/header.php');
include('../view/navbar.php');

?>
<style>
    .rating-css input {
        display: none;
    }

    .rating-css input+label {
        font-size: 15px;
        text-shadow: 1px 1px 0 #ffe400;
        cursor: pointer;
        color: #ffe400;
    }

    .rating-css input:checked+label~label {
        color: gray;
    }

    .rating-css label:active {
        transform: scale(0.8);
        transition: 0.3s ease;
    }
</style>

<!-- nội dung của trang  -->
<section class="product-page mb-4 ">
    <div class="container ">
        <!-- chi tiết 1 sản phẩm -->
        <div class="product-detail  p-4">
            <div class="row">
                <!-- ảnh  -->
                <div class="col-md-7 ">
                    <div class=" mb-4  box-hover " style="border:none;">
                        <a href="#"><img src="../admin/Uploads/<?php echo $product['image'] ?>" alt="" class="<?php if ($product['image_2'] != null) echo 'img-change' ?> w-100 h-100"></a>
                        <?php if ($product['image_2'] != null) : ?>
                            <a href="#"><img src="../admin/Uploads/<?php echo $product['image_2'] ?>" alt="" class="w-100 h-100"></a>
                        <?php endif ?>
                    </div>
                    <div class="">
                        <div class="img-nho float-left mb-4">
                            <a href="#"><img src="../admin/Uploads/<?php echo $product['image'] ?>" class="img-fluid " style="height: 100px;"></a>
                        </div>
                        <?php if ($product['image_2'] != null) : ?>

                            <div class="img-nho float-left ml-3">
                                <a href="#"><img src="../admin/Uploads/<?php echo $product['image_2'] ?>" class="img-fluid " style="height: 100px;"></a>
                            </div>
                        <?php endif ?>

                    </div>
                </div>

                <!-- thông tin sản phẩm: tên, giá bìa giá bán tiết kiệm, các khuyến mãi, nút chọn mua.... -->
                <div class="col-md-5 khoithongtin ">
                    <div class="row">
                        <div class="col-md-12 header">
                            <h4 class="ten"><?php echo $product['productName'] ?>
                                <i class="far fa-eye float-right "><?php echo $product['product_view'] ?></i>
                            </h4>
                            <?php if ($avg_star != null) : ?>
                                <div class="rate">
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star <?php if ($avg_star >= 2) echo 'active' ?>"></i>
                                    <i class="fa fa-star <?php if ($avg_star >= 3) echo 'active' ?>"></i>
                                    <i class="fa fa-star <?php if ($avg_star >= 4) echo 'active' ?>"></i>
                                    <i class="fa fa-star <?php if ($avg_star >= 5) echo 'active' ?>"></i>
                                </div>
                            <?php endif ?>
                            <hr>
                        </div>
                        <div class="">
                            <div class="gia">
                                <div class="giabia">Giá bán hiện tại:<span class="giacu ml-2"><?php echo $product['price'] ?>$</span><span class="text-danger font-weight-bold ml-2"><?php echo $new_price ?>$</span>
                                </div>
                                <div class="giaban">Giảm giá: <span class="text-warning font-weight-bold"><?php echo $product['discount'] ?>%</span>
                                </div>
                                <div class="tietkiem">Tiết kiệm: <b><?php echo $save ?>$</b>
                                </div>
                                <div>Số lượng: <?php echo $product['quantity'] ?></div>
                            </div>
                            <div class="uudai my-3">
                                <h6 class="header font-weight-bold">Khuyến mãi & Ưu đãi tại ShopSS:</h6>
                                <ul>
                                    <li><b>Miễn phí giao hàng </b> từ 50.000đ ở TP.Đà Nẵng và 30.000đ ở
                                        Tỉnh/Thành khác <a href="#">>> Chi tiết</a></li>
                                    <li><b>Combo giày HOT - GIẢM 20% </b><a href="#">>>Xem ngay</a></li>
                                    <li>Tặng phụ kiện cho mỗi đơn hàng</li>
                                    <li>Đặt giày (theo yêu cầu)</li>
                                </ul>
                            </div>
                            <?php if ($product['quantity'] > 0) : ?>
                                <span class="text-success"><b>Còn hàng</b></span>
                            <?php else : ?>
                                <span class="text-danger "><b>Sản phẩm hiện đang hết hàng</b></span>
                            <?php endif; ?>
                            <form action="../cart/" method="POST">

                                <input onclick="var result = document.getElementById('quantity'); var qty = result.value; if( !isNaN(qty) &amp (qty > 1) ) result.value--;return false;" type='button' value='-' style="width: 30px;"/>
                                <input id='quantity' min='1' name='quantity' type='number' value='1' style="width: 50px;"/>
                                <input onclick="var result = document.getElementById('quantity'); var qty = result.value; if( !isNaN(qty)) result.value++;return false;" type='button' value='+' style="width: 30px;"/>

                                <input type="hidden" name="action" value="buy" />
                                <input type="hidden" name="product_id" value="<?php echo $product['productId']; ?>" />
                                <input type="submit" value="Chọn mua" class="nutmua btn w-100 text-uppercase mt-1" <?php if ($product['quantity'] <= 0) echo 'disabled' ?> />
                            </form>
                            <a class="huongdanmuahang text-decoration-none" href="#">(Vui lòng xem hướng dẫn mua
                                hàng)</a>


                        </div>
                        <!-- thông tin khác của sản phẩm:  tác giả, ngày xuất bản, kích thước ....  -->
                        <div class="">
                            <div class="thongtinsach">
                                <ul>
                                    <li>Thương hiệu: <a href="#" class="tacgia"><?php echo $product['categoryName'] ?></a></li>
                                    <li>Ngày nhập: <b></b><?php echo $product['dateAdd'] ?></li>
                                    <li>Size: <b>42</b></li>
                                    <li>Cân nặng: <b>1 kg</b></li>
                                    <li>Phiên bản: <b>Giới hạn</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- decripstion của 1 sản phẩm: giới thiệu , đánh giá độc giả  -->
                <div class="product-description col-md-9">
                    <!-- 2 tab ở trên  -->
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active text-uppercase" id="nav-gioithieu-tab" data-toggle="tab" href="#nav-gioithieu" role="tab" aria-controls="nav-gioithieu" aria-selected="true">Giới thiệu</a>
                            <a class="nav-item nav-link text-uppercase" id="nav-danhgia-tab" data-toggle="tab" href="#nav-danhgia" role="tab" aria-controls="nav-danhgia" aria-selected="false">Đánh
                                giá </a>
                        </div>
                    </nav>
                    <!-- nội dung của từng tab  -->
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active ml-3" id="nav-gioithieu" role="tabpanel" aria-labelledby="nav-gioithieu-tab">
                            <?php echo $product['description'] ?>
                        </div>
                        <div class="tab-pane fade" id="nav-danhgia" role="tabpanel" aria-labelledby="nav-danhgia-tab">
                            <div class="row">

                                <div class="col-md-5">
                                    <form action="" method="POST">
                                        <input type="hidden" name="action" value="rate">
                                        <div class="formdanhgia">
                                            <h6 class="tieude text-uppercase">GỬI ĐÁNH GIÁ CỦA BẠN</h6>
                                            <span class="danhgiacuaban">Đánh giá của bạn về sản phẩm này:</span>

                                            <div class="rating-css">
                                                <div class="star-icon">
                                                    <input type="radio" name="star" id="rating1" value="1">
                                                    <label for="rating1" class="fa fa-star"></label>
                                                    <input type="radio" name="star" id="rating2" value="2">
                                                    <label for="rating2" class="fa fa-star"></label>
                                                    <input type="radio" name="star" id="rating3" value="3">
                                                    <label for="rating3" class="fa fa-star"></label>
                                                    <input type="radio" name="star" id="rating4" value="4">
                                                    <label for="rating4" class="fa fa-star"></label>
                                                    <input type="radio" name="star" id="rating5" value="5">
                                                    <label for="rating5" class="fa fa-star"></label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['userId'] ?>">
                                            <?php if (isset($_SESSION['user'])) echo $_SESSION['user']['email'] ?>
                                            <div class="form-group">
                                                <input type="text" class="txtComment w-100" placeholder="Đánh giá của bạn về sản phẩm này" name="comment">
                                            </div>
                                            <button type="submit" onclick="return alert('Gửi đánh giá thành công')" <?php if (!isset($_SESSION['user'])) echo 'disabled' ?>>Gửi đánh giá</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- het tab nav-danhgia  -->
                    </div>
                    <!-- het tab-content  -->
                    <h2>Bình luận:</h2>
                    <?php foreach ($ratings as $rating) : ?>
                        <div class="rate">
                            <?php echo $rating['email'] ?> |
                            <?php for ($i = 1; $i <= $rating['star']; $i++) : ?>
                                <i class="fa fa-star " style="color: #ffe400; font-size: 15px;"></i>
                            <?php endfor ?>
                        </div>
                        <?php echo $rating['comment'] ?>
                        <hr>
                    <?php endforeach; ?>
                </div>
                <!-- het product-description -->

            </div>
            <!-- het row  -->
        </div>
    </div>
</section>

<?php include('../view/footer.php'); ?>