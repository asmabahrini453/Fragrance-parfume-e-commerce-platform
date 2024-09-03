<?php

include('header_admin.php');
include('side_bar.php');
?>

<?php
  
//get all products

  $stmt = $conn->prepare("SELECT * FROM products");
  $stmt->execute();

  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>





      <!-- partial -->
      <div class="main-panel">
        
          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Products</p>
                    <?php if (isset($_GET['edit_success_message'])){ ?>
                        <p class="text-center" style="color:green ;"><?php echo $_GET['edit_success_message'] ;?></p>
                    <?php }?>

                    <?php if (isset($_GET['edit_failure_message'])){ ?>
                        <p class="text-center" style="color:red ;"><?php echo $_GET['edit_failure_message']; ?></p>
                    <?php }?>


                    <?php if (isset($_GET['deleted_successfully'])){ ?>
                        <p class="text-center" style="color:green ;"><?php echo $_GET['deleted_successfully']; ?></p>

                    <?php }?>

                    <?php if (isset($_GET['deleted_failure'])){ ?>
                        <p class="text-center" style="color:red ;"><?php echo $_GET['deleted_failure']; ?></p>
                    <?php }?>


                    <?php if (isset($_GET['product_created'])){ ?>
                        <p class="text-center" style="color:green ;"><?php echo $_GET['product_created']; ?></p>

                    <?php }?>

                    <?php if (isset($_GET['product_failed'])){ ?>
                        <p class="text-center" style="color:red ;"><?php echo $_GET['product_failed']; ?></p>
                    <?php }?>


                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                            <th>Product Id</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Order Category</th>    
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($products as $product){ ?>
                        <tr>
                            <td><?php echo  $product['product_id'] ;?></td>
                            <td><img src="<?php echo"../assets/imgs/".$product['product_image'] ; ?>" style="width:70px ; height:70px ;"></td>
                            <td><?php echo  $product['product_name'] ;?></td>
                            <td><?php echo  $product['product_price'] ;?> TND</td>
                            <td><?php echo  $product['product_category'] ;?></td> 
                            <td><a class="btn btn-primary" href="edit_products.php?product_id=<?php echo $product['product_id'];?>">Edit</a></td>

                            <td><a href="delete_product.php?product_id=<?php echo $product['product_id'];?>" class="btn btn-danger">Delete</a></td>

                        </tr>
                       


                        <?php }?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->




  <?php include('footer_admin.php') ; ?>





