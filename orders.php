<?php
require 'components/connect.php';
session_start();
require 'components/prevention.php';

if(isset($_POST['cancel']) && isset($_POST['order_time']) && isset($_POST['uid'])){
$order_time=$_POST['order_time'];
$uid=$_POST['uid'];

   $sql="
   update orders set status_id = 6 where id = ?
   ";
   $stmt = $conn->prepare("UPDATE orders SET status_id = 6 WHERE time_of_purchase = ? and user_id = ?");

   $stmt->execute([$order_time,$uid]);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<style>
   /* Additional Styles */
   body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
   }

   .orders {
      padding: 20px;
      max-width: 1200px;
      margin: 0 auto;
   }

   .heading {
      font-size: 24px;
      color: #333;
      margin-bottom: 30px;
      text-align: center;
   }

   .box-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
   }

   .box {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      transition: box-shadow 0.3s ease;
   }

   .box:hover {
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
   }

   .box p {
      margin: 0;
      margin-bottom: 10px;
      font-size: 16px;
      color: #555;
   }

   .box p span {
      font-weight: bold;
      color: #333;
   }

   .empty {
      text-align: center;
      color: #666;
      font-size: 18px;
      margin-top: 20px;
   }

   .payment-status {
      font-weight: bold;
      text-transform: capitalize;
   }

   .payment-status.pending {
      color: #e74c3c;
   }

   .payment-status.completed {
      color: #2ecc71;

   }
</style>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="orders">

      <h1 class="heading">placed orders</h1>

      <div class="box-container">

         <?php
         if ($user_id == '') {
            echo '<p class="empty">Please login to see your orders</p>';
         } else {
            $select_orders = $conn->prepare("
       SELECT 
           u.first_name,
           u.last_name,
           u.email,
           u.phone_number,
           u.address,
           u.id as uid,
           s.type AS status_type,
           s.level AS level,
           pm.method_name AS payment_method_name,
           p.price,
           mp.product_name,
           p.id AS product_id,
           o.amount,
           o.id as oid,
           o.time_of_purchase
       FROM 
           orders o
       INNER JOIN 
           users u ON o.user_id = u.id
       INNER JOIN 
           status s ON o.status_id = s.id
       INNER JOIN 
           payment_method pm ON o.payment_method_id = pm.id
       INNER JOIN 
           products p ON o.product_id = p.id
       INNER JOIN 
           main_products mp ON p.main_product_id = mp.id
       WHERE 
           user_id = ?
   ");
            $select_orders->execute([$user_id]);

            if ($select_orders->rowCount() > 0) {
               // Initialize an empty associative array to group orders by time_of_purchase
               $grouped_orders = [];

               while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                  // Get the time of purchase for the current order
                  $time = $fetch_orders['time_of_purchase'];

                  // Add the current order to the corresponding group based on time_of_purchase
                  $grouped_orders[$time][] = $fetch_orders;
               }

               // Iterate over the grouped orders
               foreach ($grouped_orders as $time => $orders) {
                  // Initialize total price variable for each group
                  $total_price_ = 0;
         ?>

                  <div class="box">
                     <form method="post">
                        <p>Placed on: <span><?= $time; ?></span></p>
                        <p>Product name:
                           <?php
                           // Display product names for orders with the same time of purchase
                           $product_names = array_column($orders, 'product_name');
                           $product_ids = array_column($orders, 'product_id');
                           $product_amounts = array_column($orders, 'amount');
                           echo implode(", ", array_map(function ($productName, $productId, $productAmount) {
                              return '<a href="quick_view.php?pid=' . $productId . '">' . '<span>' . $productName . '</span>' . '</a>' . '<span>' . ' x' . $productAmount . '</span>';
                           }, $product_names, $product_ids, $product_amounts));
                           ?>
                        </p>

                        <?php
                        // Display user details (name, email, phone number, address) only once for each group of orders
                        $first_order = reset($orders); // Get the first order in the group

                        ?>
                        <input hidden name="order_time" value="<?= $time; ?>" type="text">
                        <input hidden name="uid" value="<?= $first_order['uid']; ?>" type="text">
                        <p>Name: <span><?= $first_order['first_name'] . ' ' . $first_order['last_name']; ?></span></p>
                        <p>Email: <span><?= $first_order['email']; ?></span></p>
                        <p>Phone number: <span><?= $first_order['phone_number']; ?></span></p>
                        <p>Address: <span><?= $first_order['address']; ?></span></p>
                        <p>Status: <span style="color: <?php echo ($first_order['level'] == 3) ? 'red' : (($first_order['level'] == 1) ? 'blue' : 'limegreen'); ?>"><?php echo $first_order['status_type']; ?></span></p>


                        <p>Payment method: <span><?= $first_order['payment_method_name']; ?></span></p>

                        <?php
                        // Iterate over each order in the group to display order-specific details
                        foreach ($orders as $fetch_orders) {
                           // Accumulate total price for the group
                           $total_price_ += $fetch_orders['price'] * $fetch_orders['amount'];
                        }
                        ?>
                        <p>Total Price: $<span><?= $total_price_; ?></span></p>
                        <?php
                        if ($first_order['level'] === 1) {
                        ?>
                           <input name="cancel" value="CANCEL" type="submit" class="delete-btn btn" style="background-color: #e74c3c;">
                        <?php
                        }else{
                           ?>
                           <div class="delete-btn btn" style="background-color: rgb(150, 150, 150); cursor: not-allowed;">CANT CANCEL</div>
                           <?php
                        }
                        ?>
                     </form>
                  </div>

         <?php
               }
            } else {
               echo '<p class="empty">No orders placed yet!</p>';
            }
         }
         ?>






      </div>

   </section>

   <?php include 'components/footer.php'; ?>


   <script src="js/script.js"></script>

</body>

</html>