<?php

  session_start();

  if( !empty ($_SESSION['cart'])){
    //let user in checkout page



    //send user to index
  }else{
    header('location: index.php') ;
  }

?>


<?php 
  include('layouts/header.php');
?>


<!--checkout-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Checkout</h2>
        <hr class="mx-auto">
    </div>
    
    <div class="mx-auto container">
        <form action="server/place_order.php" method="POST" id="checkout-form">
          <p class="text-centre" style="color:red;">
              <?php  if(isset($_GET['message'])){echo $_GET['message'];} ?>
              <?php  if(isset($_GET['message'])){?>
                 <a href="login.php" class="btn btn-primary">Login</a>

              <?php } ?>
        </p>
            <div class="form-group checkout-small-element">
                <label >Name</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="name" required>
            </div>
            <div class="form-group checkout-small-element" >
                <label >Email</label>
                <input type="text" class="form-control" id="checkout-email" name="email" placeholder="email" required>
            </div>  
            <div class="form-group checkout-small-element">
                <label >Phone</label>
                <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="phone" required>
            </div>  
            <div class="form-group checkout-small-element">
                <label >City</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="city" required>
            </div>
            <div class="form-group checkout-large-element">
                <label >address</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="address" required>
            </div>  

            <div class="form-group checkout-btn-container">
                <p>Total amount: <?php echo $_SESSION['total'] ; ?> TND</p>
                <input type="submit" class="buy-btn" id="chekout-btn" name="place_order" value="Place Order">
            </div>

          
        </form>
    </div>






</section>



<?php 
  include('layouts/footer.php');
?>
