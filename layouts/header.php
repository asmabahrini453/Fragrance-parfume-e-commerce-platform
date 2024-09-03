<?php
 session_start();
//to display the number of products in the cart in all pages

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!--link of bootstrap css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--link of font awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <!--link of css-->
    <link rel="stylesheet" href="assets/css/style.css">


</head>
<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-3">
        <div class="container">
            <h2>Fragrance</h2>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="shop.php">Shop</a>
              </li>
             
              <li class="nav-item">
                <a class="nav-link" href="contact.php" >Contact</a>
              </li>
              <li class="nav-item">
                <a href="cart.php">
                    <i class="fas fa-shopping-bag">
                        <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] !=0 ) {?>
                            <span class="cart-quantity"><?php echo $_SESSION['quantity']; ?></span>

                        <?php } ?>
                    </i>
                </a>
                <a href="account.php" ><i class="fas fa-user"></i></a>
              </li>
             
            </ul>
            
          </div>
        </div>
      </nav>

