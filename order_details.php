<?php

//key words: not paid /delivered /shipped

include('server/connection.php');

if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {

    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id=:order_id");
    $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);
    $stmt->execute();

    $order_details = $stmt->fetchAll();

    $order_total_price = calculateTotalOrderPrice($order_details); // Stocke le résultat de la fonction dans une variable

} else {

    header('location: account.php');
    exit;
}

function calculateTotalOrderPrice($order_details)
{
    $total = 0;
    foreach ($order_details as $row) {
        $total = $total + ($row['product_price'] * $row['product_quantity']);
    }
    return $total;
}

?>




<?php 
  include('layouts/header.php');
?>


<!--order detail-->
    <section id ="orders" class="cart container my-5 py-5">
        <div class="container mt-5" >
            <h2 class="font-weight-bolde text-center">Order Details</h2>
            <hr class="mx-auto">
        </div>
        <table class="mt-5 pt-5 mx-auto">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
               

            </tr>

            <?php foreach ($order_details as $row) : ?>
                  <tr>
                      <td>
                          <div class="product-info">
                            <img src="assets/imgs/<?php echo $row['product_image'] ;?>" >

                          </div>
                          <div>
                            <p class="mt-3"><?php echo $row['product_name'] ;?></p>
                          </div>
                      </td>
                    

                      <td>
                          <span><?php echo $row['product_price'] ;?></span>
                      </td>

                      <td>
                          <span><?php echo $row['product_quantity'] ;?></span>
                      </td>

                     

                    


                  </tr>
            <?php endforeach; ?>

            
        </table>
        
        <?php if($order_status == "not paid"){ ?>
            <form style="float: right;" method="POST" action="payment.php">
                <input type="hidden" name="order_total_price" value="<?php echo $order_total_price ?>">
                <input type="hidden" name="order_status" value="<?php echo $order_status ?>">
                <input type="submit" name="order_pay_btn" value="Pay Now" class="btn btn-primary">
            </form>
        <?php } ?>


      </section>












      <?php 
  include('layouts/footer.php');
?>
