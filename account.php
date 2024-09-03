<?php
session_start();
include('server/connection.php');
//if user didn't log in yet
if(!isset($_SESSION['logged_in'])){
  header('location: login.php');
  exit;
}

//logout
if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location: login.php');
    exit;
  }
}

//change password
if(isset($_POST['change_password'])){
  $password = $_POST['password'] ;
  $confirm_password = $_POST['confirmpassword'] ;
  $user_email = $_SESSION['user_email'];

  //conditions on password
  if ($password !== $confirm_password) {
    header('location: account.php?error=passwords dont match');
    exit;
  } else if (strlen($password) < 6) {
    header('location: account.php?error=passwords must be at least 6 characters');
    exit;
  } else {
    $stmt= $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
    $password_hash = md5($password);
    $stmt->bindParam(1, $password_hash, PDO::PARAM_STR);
    $stmt->bindParam(2, $user_email, PDO::PARAM_STR);

    if($stmt->execute()){
      header('location: account.php?message=password has been updated successfully!');
    } else {
      header('location: account.php?error=could not update password');
    }
  }
}


//get orders
if (isset($_SESSION['logged_in'])) {
  $user_id = $_SESSION['user_id'];

  $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=:user_id");
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->execute();

  $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
}




?>


<?php 
  include('layouts/header.php');
?>


<section class="my-5 py-5">
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <h3 class="font-weight-bold">Account info</h3>
            <hr class="mx-auto">
            <div class="account-info">
               <p style="color:green;" class="text-center"> <?php if (isset($_GET['login_success'])) {echo $_GET['login_success'] ;}?></p>

                <p>Name: <span><?php if (isset($_SESSION['user_name'])) {echo $_SESSION['user_name'] ;}?></span></p>
                <p>Email: <span><?php if (isset($_SESSION['user_email'])) {echo $_SESSION['user_email'] ;} ?></span></p>
                <p><a href="#orders" id="orders-btn">Your Orders</a></p>
                <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>

            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <form action="" id="account-form" method="POST" action="account.php">
                <p style="color:red ;" class="text-center"> <?php if (isset($_GET['error'])) {echo $_GET['error'] ;}?></p>
                <p style="color:green;" class="text-center"> <?php if (isset($_GET['message'])) {echo $_GET['message'] ;}?></p>

                <h3>Change Password</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control" id="account-password" placeholder="password" name="password" required>
                </div>
                <div class="form-group">
                    <label >Confirm Password</label>
                    <input type="password" class="form-control" id="account-password-confirm" placeholder="confirm password" name="confirmpassword" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn">
                </div>
            </form>
        </div>





    </div>
</section>

<!--ORDERS--->
  <section id ="orders" class="cart container my-5 py-3">
        <div class="container mt-2" >
            <h2 class="font-weight-bolde text-center">Your Orders</h2>
            <hr class="mx-auto">
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Order id</th>
                <th>Order cost</th>
                <th>Order status</th>
                 <th>Order Date</th>
                 <th>Order Details</th>

            </tr>

            <?php foreach ($orders as $row) : ?>
                  <tr>
                      <td>
                          <span><?php echo $row['order_id']; ?></span>
                      </td>
                    

                      <td>
                          <span><?php echo $row['order_cost']; ?></span>
                      </td>

                      <td>
                          <span><?php echo $row['order_status']; ?></span>
                      </td>

                      <td>
                          <span><?php echo $row['order_date']; ?></span>
                      </td>

                      <td>
                          <form action="order_details.php" method="POST">
                            <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status">
                            <input type="hidden" value="<?php echo $row['order_id']; ?>"   name="order_id">
                            <input type="submit" class="btn order-details-btn" value="details" name="order_details_btn">
                          </form>

                     </td>



                  </tr>
            <?php endforeach; ?>

            
        </table>

 



      </section>



 <?php 
  include('layouts/footer.php');
?>











