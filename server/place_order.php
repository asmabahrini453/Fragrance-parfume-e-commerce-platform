<?php
 session_start();

 include('connection.php');
 //if user is not logged in 
 if(!isset($_SESSION['logged_in'])){
        header('location: ../checkout.php?message=please login/register to place an order');
        exit ;
    //if user is logged in    
 }else{
    
        if(isset($_POST['place_order'])){
            //1.get user info and store it in DB
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city = $_POST['city'];
            $address = $_POST['address'];
            $order_cost = $_SESSION['total'];
            $order_status = "not paid";
            $user_id = $_SESSION['user_id'] ;
            $order_date = date('Y-m-d H:i:s');

            $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                            VALUES (?,?,?,?,?,?,?); "); //?: protection 

            $stmt->bindParam(1, $order_cost, PDO::PARAM_INT);
            $stmt->bindParam(2, $order_status, PDO::PARAM_STR);
            $stmt->bindParam(3, $user_id, PDO::PARAM_INT);
            $stmt->bindParam(4, $phone, PDO::PARAM_STR);
            $stmt->bindParam(5, $city, PDO::PARAM_STR);
            $stmt->bindParam(6, $address, PDO::PARAM_STR);
            $stmt->bindParam(7, $order_date, PDO::PARAM_STR);

            $stmt_status=$stmt->execute();
            if(!$stmt_status){
                header('location: index.php');
                exit ;
            }


            //2.issue next order and store order in DB

            $order_id = $conn->lastInsertId();


            //3.get products from cart (from session)
            foreach($_SESSION['cart'] as $key=> $value ){
                $product = $_SESSION['cart'][$key];
                $product_id = $product['product_id'];
                $product_name = $product['product_name'];
                $product_image = $product['product_image'];
                $product_price = $product['product_price'];
                $product_quantity = $product['product_quantity'];

                $stmt1 = $conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
                                VALUES (?,?,?,?,?,?,?,?); ");
            //4.store each single item in order_item DB

                $stmt1->bindParam(1, $order_id, PDO::PARAM_INT); // Utilisez PARAM_INT car les ID sont des entiers
                $stmt1->bindParam(2, $product_id, PDO::PARAM_INT);
                $stmt1->bindParam(3, $product_name, PDO::PARAM_STR);
                $stmt1->bindParam(4, $product_image, PDO::PARAM_STR);
                $stmt1->bindParam(5, $product_price, PDO::PARAM_STR); // PARAM_INT doit être remplacé par PARAM_STR pour les montants avec des décimales
                $stmt1->bindParam(6, $product_quantity, PDO::PARAM_INT);
                $stmt1->bindParam(7, $user_id, PDO::PARAM_INT);
                $stmt1->bindParam(8, $order_date, PDO::PARAM_STR);

                $stmt1->execute();

            }
            
            




            //5.inform user whether everything is fine or there is a pblm

            header('Location: ../payment.php?order_status=order placed successfully!');


        }

 }
 

   
?>
