<?php
session_start();
include('server/connection.php');

if(isset($_POST['logged_in'])){
  header('location: account.php');
  exit ;
}
if (isset($_POST['login_btn'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = :email LIMIT 1");
  $stmt->bindParam(':email', $email);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if($row && $row['user_password'] == $password) {
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['user_name'] = $row['user_name'];
    $_SESSION['user_email'] = $row['user_email'];
    $_SESSION['logged_in'] = true;

    header('location: account.php?login_success=logged in successfully!');
  } else {
    
    header('location: login.php?error=Could not verify your account!');
  }
}

?>

<?php 
  include('layouts/header.php');
?>


<!--Login-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Login</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">

        <form action="" id="login-form" action="login.php" method="POST">
            <p style="color:red; text-align:center;"><?php if (isset($_GET['error'])) { echo $_GET['error']; } ?></p>
            <div class="form-group">
                <label >Email</label>
                <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
            </div>  
            <div class="form-group">
                <label >Password</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
            </div>  
            <div class="form-group">
                <input type="submit" class="buy-btn" id="login-btn" name="login_btn" value="Login">
            </div>

            <div class="form-group">
                <a id="register-url" class="btn" href="register.php">Dont't have account? Register</a>
            </div>


        </form>
    </div>






</section>




<?php 
  include('layouts/footer.php');
?>
