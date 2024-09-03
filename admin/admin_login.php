<?php
  include('../server/connection.php');

  if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email = :email AND admin_password = :password LIMIT 1");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($row) {
        $_SESSION['admin_id'] = $row['admin_id'];
        $_SESSION['admin_name'] = $row['admin_name'];
        $_SESSION['admin_email'] = $row['admin_email'];
        $_SESSION['admin_logged_in'] = true;

        header('location: index.php?login_success=logged in successfully!');
        exit;
      } else {
        header('location: admin_login.php?error=Could not verify your account!');
        exit;
      }
    } else {
      exit;
    }
  }
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Login </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h3>FRAGRANCE</h3>
              <hr>
              <h4>Hello Admin!</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>



              <form class="pt-3" id="login-form" method="POST" action="admin_login.php">
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
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                 
                <div class="mb-2">
                  
                     <a href="https://www.facebook.com/" class="bg-facebook "><i class="mdi mdi-facebook me-2"></i>Connect using facebook</a>
                 
                </div>
           
          </form>


            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  
  <?php include('footer_admin.php') ; ?>