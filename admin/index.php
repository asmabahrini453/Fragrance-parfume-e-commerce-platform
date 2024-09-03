<?php

include('header_admin.php');
include('side_bar.php');
?>

<?php
  
//get all orders

 

  $stmt = $conn->prepare("SELECT * FROM orders");
  $stmt->execute();

  $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);




?>




<!-- ORDERS -->
<div class="main-panel">
          <!-- content-wrapper ends -->
          <div class="content-wrapper">
            <div class="row">
                <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <p class="card-title">Cash deposits</p>
                    <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
                    <canvas id="cash-deposits-chart"></canvas>
                    </div>
                </div>
                </div>
                <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <p class="card-title">Total sales</p>
                    <h1>25000000 TND</h1>
                    <h4>Gross sales over the years</h4>
                    <p class="text-muted"> FRAGRANCE, has flourished in the world of business and economy, captivating customers and driving remarkable growth. </p>
                    <div id="total-sales-chart-legend"></div>                  
                    </div>
                    <canvas id="total-sales-chart"></canvas>
                </div>
                </div>
            </div>

       </div>
        
        
    <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Recent Purchases</p>

                  <?php if (isset($_GET['order_updated'])){ ?>
                        <p class="text-center" style="color:green ;"><?php echo $_GET['order_updated']; ?></p>

                    <?php }?>

                    <?php if (isset($_GET['order_failed'])){ ?>
                        <p class="text-center" style="color:red ;"><?php echo $_GET['order_failed']; ?></p>
                    <?php }?>


                    <?php if (isset($_GET['deleted_order_successfully'])){ ?>
                        <p class="text-center" style="color:green ;"><?php echo $_GET['deleted_order_successfully']; ?></p>

                    <?php }?>

                    <?php if (isset($_GET['deleted_order_failure'])){ ?>
                        <p class="text-center" style="color:red ;"><?php echo $_GET['deleted_order_failure']; ?></p>
                    <?php }?>






                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Order Status</th>
                            <th>User Id</th>
                            <th>Order Date</th>    
                            <th>User Phone</th>
                            <th>User Address</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($orders as $order){ ?>
                        <tr>
                            <td><?php echo  $order['order_id'] ;?></td>
                            <td><?php echo  $order['order_status'] ;?></td>
                            <td><?php echo  $order['user_id'] ;?></td>
                            <td><?php echo  $order['order_date'] ;?></td>
                            <td><?php echo  $order['user_phone'] ;?></td> 
                            <td><?php echo  $order['user_address'] ;?></td>
                            <td><a href="edit_order.php?order_id=<?php echo $order['order_id'] ;?>" class="btn btn-primary">Edit</a></td>
                            <td><a href="delete_order.php?order_id=<?php echo $order['order_id'] ;?>" class="btn btn-danger">Delete</a></td>

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





  <?php include('footer_admin.php') ; ?>





