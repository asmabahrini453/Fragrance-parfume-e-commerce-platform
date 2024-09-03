<?php


include('server/connection.php');

$stmt= $conn->prepare("SELECT * FROM products ");

$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);





?>

<?php 
  include('layouts/header.php');
?>



<!--SHOP-->
<section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <hr>
        <h3>Our Featured</h3>
        <hr>
        <p>here you can check out our new featured perfumes</p>
    </div>
    <div class="row mx-auto container-fluid"> <!--mx-auto:to center it /container-fluid:add some space from right and left-->
    <?php foreach ($products as $row): ?>
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
        <a  class="btn buy-btn" href="<?php echo "single product.php?product_id=".$row['product_id'] ; ?>"> Buy Now</a>
      </div>
    <?php endforeach; ?>
    


        <nav aria-label="Page navigation example">
            <ul class="pagination mt=5">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>

            </ul>
        </nav>

      


    </div>
</section>







<?php 
  include('layouts/footer.php');
?>
