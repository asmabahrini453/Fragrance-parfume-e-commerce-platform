
<?php 
  include('layouts/header.php');
?>
 <!--Home section-->
 <section id="home">
    <div class="container">
        <h5>NEW ARRIVALS</h5>
        <h1><span> Best Prices</span> This Season</h1>
        <p>FRAGRANCE,A symphony of scents, a gateway to allure.</p>
        <a href="shop.php"><button>Shop Now </button></a>
    </div>
   
 </section>

 <!--Bands-->
 <section id="brand" class="container">
    <div class="row">
      <div class="col-lg-1 col-md-1 col-sm-1"></div>
      <img class="img-fluid col-lg-2 col-md-2 col-sm-2" src="assets/imgs/Boss.jpg" />
      <img class="img-fluid col-lg-2 col-md-2 col-sm-2" src="assets/imgs/givenchy.jpg" />
      <img class="img-fluid col-lg-2 col-md-2 col-sm-2" src="assets/imgs/ysl.jpg" />
      <img class="img-fluid col-lg-2 col-md-2 col-sm-2" src="assets/imgs/dior.jpg" />
      <img class="img-fluid col-lg-2 col-md-2 col-sm-2" src="assets/imgs/chanel.jpg" />
    

      <div class="col-lg-1 col-md-1 col-sm-1"></div>
    </div>
  </section>

  <!--New Products-->
  <section id="new" class="w-100">
    <!-- p-0 : no padding/ m-0 : no margin -->
    <div class="row p-0 m-0">
        <!--One-->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/5.jpeg" >
            <div class="details">
                <h2>Find your perfect fragrance match</h2>
                <a href="shop.php"><button  class="text-uppercase">Shop Now </button></a>
            </div>
        </div>
        <!--end One-->
        <!--Two-->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/6.jpeg" >
            <div class="details">
                <h2>the most elegant scents</h2>
                <a href="shop.php"><button  class="text-uppercase">Shop Now </button></a>
            </div>
        </div>
        <!--end Two-->
        <!--Three-->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/7.webp" >
            <div class="details">
                <h2>50% OFF first purshase</h2>
                <a href="shop.php"><button  class="text-uppercase">Shop Now </button></a>
            </div>
        </div>
        <!--end Three-->
    </div>
  </section>

<!--Featured Products-->
<section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <h3>Our Featured</h3>
        <hr>
        <p>here you can check out our new featured perfumes</p>
    </div>
     <!--mx-auto:to center it /container-fluid:add some space from right and left-->
     <div class="row mx-auto container-fluid">
    <?php 
        include ('server/get_featured_products.php');
        foreach ($featured_products as $row) { 
    ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="imf-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'] ; ?>" />
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>

            </div>
            <h5 class="p-name"><?php echo $row['product_name'] ; ?></h5>
            <h4 class="p-price"><?php echo $row['product_price'] ; ?> TND</h4>
            
            <a href="<?php echo "single product.php?product_id=".$row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
        </div>
    <?php } ?>

    </div>



</section>


<!--Best sellers-->
<section id="featured" class="my-5">
    <div class="container text-center mt-5 py-5">
        <h3>Best Sellers</h3>
        <hr>
        <p>here you can check out our best sellers </p>
    </div>
    <div class="row mx-auto container-fluid"> <!--mx-auto:to center it /container-fluid:add some space from right and left-->

    <?php 
        include ('server/get_bestsellers.php');
        foreach ($best_sellers as $row) { 
    ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="imf-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'] ; ?>" />
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>

            </div>
            <h5 class="p-name"><?php echo $row['product_name'] ; ?></h5>
            <h4 class="p-price"><?php echo $row['product_price'] ; ?>D</h4>
            <a href="<?php echo "single product.php?product_id=".$row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
        </div>

        <?php } ?>

    </div>
</section>

<?php 
  include('layouts/footer.php');
?>



