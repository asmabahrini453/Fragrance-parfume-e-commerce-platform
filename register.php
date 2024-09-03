<?php
session_start();
include('server/connection.php');

if (isset($_POST['logged_in'])) {
  header('location: account.php');
  exit;
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Conditions on password
    if ($password !== $confirm_password) {
        header('location: register.php?error=passwords dont match');
        exit;
    } else if (strlen($password) < 6) {
        header('location: register.php?error=passwords must be at least 6 characters');
        exit;
    } else {
        // Check whether there is a user with this email or not 
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_email=:email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $num_rows = $stmt->fetchColumn();

        // If there is a user already registered with this email
        if ($num_rows !== 0) {
            header('location: register.php?error=user already exists');
            exit;
        } else {
            // Create a new user
            $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (:name, :email, :password)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $hashed_password = md5($password); // md5 to hash the password
            $stmt->bindParam(':password', $hashed_password);

            // If account was created successfully
            if ($stmt->execute()) {
              $user_id = $conn->lastInsertId();
              $_SESSION['user_id'] = $user_id;
              $_SESSION['user_email'] = $email;
              $_SESSION['user_name'] = $name;
              $_SESSION['logged_in'] = true;
              header('location: account.php?register=You registered successfully!');
              exit;
            } else {
                // Account could not be created
                header('location: register.php?error=could not create an account at the moment!');
                exit;
            }
        }
    }
}
?>

<?php 
  include('layouts/header.php');
?>

<?php 
  include('layouts/header.php');
?>



<!--REGISTER-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Register</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">

        <form action="register.php"  method="POST" id="register-form">
          <p style="color: red ;"><?php if (isset( $_GET['error'])){echo $_GET['error'] ;} ?></p>
            <div class="form-group">
                <label >Name</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="name" required>
            </div>
            <div class="form-group">
                <label >Email</label>
                <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required>
            </div>  
            <div class="form-group">
                <label >Password</label>
                <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required>
            </div>  
            <div class="form-group">
                <label >Confirm Password</label>
                <input type="password" class="form-control" id="register-confirm-password" name="confirm password" placeholder="confirm password" required>
            </div>  

            <div class="form-group">
                <input type="submit" class="buy-btn" id="register-btn" name="register" value="Register">
            </div>

            <div class="form-group">
                <a id="login-url" class="btn" href="login.php">Do you have an account? Login</a>
            </div>


        </form>
    </div>






</section>




<?php 
  include('layouts/footer.php');
?>
