<?php
include('server/connection.php');

if (isset($_GET['product_id'])){

  $product_id = $_GET['product_id'] ;

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id =?");
  $stmt->bindParam(1, $product_id, PDO::PARAM_INT);

  $stmt->execute();
  
  $product = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Retrieve related products from the database
  $stmt_related = $conn->prepare("SELECT * FROM products WHERE product_id != ? && product_category='best_sellers' LIMIT 4");
  $stmt_related->bindParam(1, $product_id, PDO::PARAM_INT);
  $stmt_related->execute();
  $related_products = $stmt_related->fetchAll(PDO::FETCH_ASSOC);

} else {
  header('location: index.php');
  exit();
}

?>

<?php 
  include('layouts/header.php');
?>


<!--single product-->
<section class="single-product container my-5 pt-5">
  <div class="row mt-5">
    <?php
    foreach ($product as $row){
    ?>
    <div class="col-lg-5 col-md-6 col-sm-12">
      <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $row['product_image']; ?>" alt="">
    </div>
    <div class="col-lg-6 col-med-12 col-sm-12">
      <h6>Women/Perfumes</h6>
      <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
      <h2><?php echo $row['product_price']; ?> TND</h2>
      <form method="POST" action="cart.php">
        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
        <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
        <input type="number" name="product_quantity" value="1">
        <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
      </form>
      <h4 class="mt-5 mb-5">Product details</h4>
      <span><?php echo $row['product_description']; ?> </span>
    </div>
    <?php } ?>
  </div>
</section>

<!--Related products-->
<section id="related-products" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Related Articles</h3>
    <hr>
  </div>
  <div class="row mx-auto container-fluid">
    <?php foreach ($related_products as $related_product) { ?>
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/imgs/<?php echo $related_product['product_image']; ?>" />
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name"><?php echo $related_product['product_name']; ?></h5>
      <h4 class="p-price"><?php echo $related_product['product_price']; ?> TND</h4>
      <form method="POST" action="cart.php">
        <input type="hidden" name="product_id" value="<?php echo $related_product['product_id']; ?>">
        <input type="hidden" name="product_image" value="<?php echo $related_product['product_image']; ?>">
        <input type="hidden" name="product_name" value="<?php echo $related_product['product_name']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $related_product['product_price']; ?>">
        <input type="number" name="product_quantity" value="1">
        <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
      </form>
    </div>
    <?php } ?>
  </div>
</section>

<?php 
  include('layouts/footer.php');
?>
