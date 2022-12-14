<?php
require_once('model/database.php');
require_once('model/products_db.php');
require_once('model/rating_db.php');

$products = get_products_have_inf(4);
$products_new = get_selling_products(4);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShopFigure</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css" />
  <link rel="stylesheet" href="main.css" type="text/css" media="screen" />

</head>

<body class="bg-white">
  <?php include('view/navbar.php') ?>

  <div class="container-xl ">

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators rounded-circle">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>

      <div class="carousel-inner " style="text-align: center;">
        <div class="carousel-item active">
          <img src="images/b1.jpg" class="img-fluid w-100" style="height: 700px;">
          <div class="carousel-caption d-none d-md-block">
            <h1 style="font-size: 13em; margin-bottom: 150px;" class="">Nike</h1>
          </div>
        </div>
        <div class="carousel-item">
          <img src="images/b2.jpg" class="img-fluid w-100" style="height: 700px;">
          <div class="carousel-caption d-none d-md-block">
            <h1 style="font-size: 13em; margin-bottom: 150px;" class="">Sneaker</h1>
          </div>

        </div>
        <div class="carousel-item">
          <img src="images/b3.jpg" class="img-fluid w-100" style="height: 700px;">
          <div class="carousel-caption d-none d-md-block">
            <h1 style="font-size: 13em; margin-bottom: 150px;" class="">Adidas</h1>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>


    </div>
  </div>

  <!---------------------------------------------------------------- PROMO AREA ---------------------------------------------------->
  <div class="promo-area ">
    <div class="zigzag-bottom"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6">
          <div class="single-promo promo1">
            <i class="fa fa-retweet"></i>
            <p>Nh???n h??ng 7 ng??y</p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="single-promo promo2">
            <i class="fa fa-truck"></i>
            <p>Free shipping</p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="single-promo promo3">
            <i class="fa fa-lock"></i>
            <p>Thanh to??n an to??n</p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="single-promo promo4">
            <i class="fa fa-gift"></i>
            <p>Qu?? t???ng</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!---------------------------------------------------------------- END PROMO AREA ---------------------------------------------------->

  <?php include('homepage.php') ?> <br>









  <!-- thanh cac dich vu :mien phi giao hang, qua tang mien phi ........ -->
  <section class="abovefooter text-white" style="background-color: #CF111A;">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-sm-6">
          <div class="dichvu d-flex align-items-center">
            <img src="images/icon-books.png" alt="icon-figure">
            <div class="noidung">
              <h3 class="tieude font-weight-bold">H??N 99.000 Figure ?????p</h3>
              <p class="detail">Tuy???n ch???n b???i ShopFigure</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="dichvu d-flex align-items-center">
            <img src="images/icon-ship.png" alt="icon-ship">
            <div class="noidung">
              <h3 class="tieude font-weight-bold">MI???N PH?? GIAO H??NG</h3>
              <p class="detail">T??? 50.000?? ??? TP.???? N???ng</p>
              <p class="detail">T??? 30.000?? ??? t???nh th??nh kh??c</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="dichvu d-flex align-items-center">
            <img src="images/icon-gift.png" alt="icon-gift">
            <div class="noidung">
              <h3 class="tieude font-weight-bold">QU?? T???NG MI???N PH??</h3>
              <p class="detail">T???ng Figure</p>
              <p class="detail">L??t chu???t</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="dichvu d-flex align-items-center">
            <img src="images/icon-return.png" alt="icon-return">
            <div class="noidung">
              <h3 class="tieude font-weight-bold">?????I TR??? NHANH CH??NG</h3>
              <p class="detail">H??ng b??? l???i ???????c ?????i tr??? nhanh ch??ng</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- footer  -->
  <footer>
    <div class="container py-4">
      <div class="row">
        <div class="col-md-3 col-xs-6">
          <div class="gioithieu">
            <h3 class="header text-uppercase font-weight-bold">V??? ShopFigure</h3>
            <a href="#">Gi???i thi???u v??? Shopfigure</a>
            <a href="#">Tuy???n d???ng</a>
          </div>
        </div>
        <div class="col-md-3 col-xs-6">
          <div class="hotrokh">
            <h3 class="header text-uppercase font-weight-bold">H??? TR??? KH??CH H??NG</h3>
            <a href="#">H?????ng d???n ?????t h??ng</a>
            <a href="#">Ph????ng th???c thanh to??n</a>
            <a href="#">Ph????ng th???c v???n chuy???n</a>
            <a href="#">Ch??nh s??ch ?????i tr???</a>
          </div>
        </div>
        <div class="col-md-3 col-xs-6">
          <div class="lienket">
            <h3 class="header text-uppercase font-weight-bold">H???P T??C V?? LI??N K???T</h3>
            <img src="images/dang-ky-bo-cong-thuong.png" alt="dang-ky-bo-cong-thuong">
          </div>
        </div>
        <div class="col-md-3 col-xs-6">
          <div class="ptthanhtoan">
            <h3 class="header text-uppercase font-weight-bold">Ph????ng th???c thanh to??n</h3>
            <img src="images/visa-payment.jpg" alt="visa-payment">
            <img src="images/master-card-payment.jpg" alt="master-card-payment">
            <img src="images/jcb-payment.jpg" alt="jcb-payment">
            <img src="images/atm-payment.jpg" alt="atm-payment">
            <img src="images/cod-payment.jpg" alt="cod-payment">
            <img src="images/payoo-payment.jpg" alt="payoo-payment">
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- nut cuon len dau trang -->
  <div class="fixed-bottom">
    <div class="btn btn-warning float-right rounded-circle " id="backtotop" href="#" style="background:#CF111A;"><i class="fa fa-chevron-up text-white"></i></div>
  </div>


  <!-- Footer -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>