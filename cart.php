<?php

require 'components/connect.php';




session_start();

require 'components/prevention.php';


if (isset($_POST['delete'])) {
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if (isset($_GET['delete_all'])) {
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart.php');
}

if (isset($_POST['update_qty'])) {
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET amount = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart amount updated';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<style>
   .box {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      overflow: hidden;
      position: relative;
      transition: transform 0.3s ease;
   }

   .box:hover {
      transform: translateY(-5px);
   }

   .box img {
      width: 100%;
      height: auto;
      display: block;
   }

   .box .name {
      padding: 10px;
      font-weight: bold;
   }

   .box .flex {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px;
   }

   .box .price {
      flex-grow: 1;
      font-weight: bold;
   }

   .box .qty {
      width: 60px;
      text-align: center;
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 5px;
      margin: 0 10px;
   }

   .box .sub-total {
      padding: 10px;
   }

   .box .delete-btn {
      background-color: red;
      color: #fff;
      border: none;
      padding: 8px 15px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
   }

   .box .delete-btn:hover {
      background-color: #ff6b6b;
   }

   .cart-total {
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
   }

   .empty {
      text-align: center;
      font-weight: bold;
      padding: 20px;
   }

   .price {
      font-family: Arial, sans-serif;
      font-size: 16px;
      color: #333;
      /* Adjust color as needed */
      background-color: #f5f5f5;
      /* Adjust background color as needed */
      padding: 10px;
      /* Adjust padding as needed */
      border-radius: 5px;
      /* Adjust border radius as needed */
      border: 1px solid #ccc;
      /* Adjust border properties as needed */
      display: inline-block;
      /* Display as inline-block to fit content width */
   }

   .button {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-color: rgb(20, 20, 20);
      border: none;
      font-weight: 600;
      display: flex;
      margin: 10px;
      align-items: center;
      justify-content: center;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
      cursor: pointer;
      transition-duration: .10s;
      overflow: hidden;
      position: relative;
   }

   .svgIcon {
      width: 12px;
      transition-duration: .10s;
   }

   .svgIcon path {
      fill: white;
   }

   .button:hover {
      width: 140px;
      border-radius: 50px;
      transition-duration: .3s;
      background-color: rgb(255, 69, 69);
      align-items: center;
   }

   .button:hover .svgIcon {
      width: 50px;
      transition-duration: .10s;
      transform: translateY(60%);
   }

   .button::before {
      position: absolute;
      top: -20px;
      content: "Delete";
      color: white;
      transition-duration: .10s;
      font-size: 2px;
   }

   .button:hover::before {
      font-size: 13px;
      opacity: 1;
      transform: translateY(30px);
      transition-duration: .10s;
   }
</style>

<body>

   <!-- Header Section -->
   <?php include 'components/user_header.php'; ?>

   <!-- Shopping Cart Section -->
   <section class="products shopping-cart">
      <h3 class="heading">Shopping Cart</h3>
      <div class="box-container">
         <?php
         $grand_total = 0;
         $amount_of_items = 1;





         try {
            // SQL query
            $sql = "
            SELECT 
            mp.product_name AS product_name,
            p.price AS price,
            p.amount AS pamount,
            p.id AS pid,
            mp.image_1 AS image_1,
            m.mall_name AS mall_name,
            cart.*,
            cart.amount
        FROM 
            main_products mp
        INNER JOIN 
            products p ON mp.id = p.main_product_id
        INNER JOIN 
            positions pos ON p.position_id = pos.id
        INNER JOIN 
            shelves sh ON pos.shelf_id = sh.id
        INNER JOIN 
            shops s ON sh.shop_id = s.id
        INNER JOIN 
            floors f ON s.floor_id = f.id
        INNER JOIN 
            malls m ON f.mall_id = m.id
        INNER JOIN 
            cart ON p.id = cart.product_id
        WHERE 
            cart.user_id = ? and m.id = ?
        
                 ";

            // Prepare the SQL statement
            $stmt = $conn->prepare($sql);

            // Execute the SQL statement
            $stmt->execute([$_SESSION['user_id'],$_SESSION['mall_id']]);

            // Fetch all rows as associative array
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Output the results
            foreach ($results as $row) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="cart_id" value="<?= $row['id']; ?>">
                  <img onclick="quick_view('<?= $row['pid']; ?>')" style="width: 340px; height: 200px;" src="uploaded_img/<?= $row['image_1']; ?>" alt="">
                  <div class="name"><?= $row['product_name']; ?></div>
                  <div class="name"><?= $row['mall_name']; ?></div>
                  <div class="container light-mode" id="content"><span>Amount in Storage: <?= $row['pamount']; ?></span></div>
                  <div class="flex">

                     <div class="price">$<?= $row['price']; ?> </div>
                     <input type="number" name="qty" class="qty" min="1" max="<?= $row['pamount']; ?>" value="1" onkeypress="if(this.value.length == 2) return false;" value="<?= $row['amount']; ?>">

                     <button type="submit" class="fas fa-edit" name="update_qty"></button>
                  </div>
                  <div class="sub-total">total: <span>$<?= $sub_total = ($row['price'] * $row['amount']); ?></span></div>
                  <button class="button" onclick="return confirm('Delete this from cart?');" name=delete>
                     <svg viewBox="0 0 448 512" class="svgIcon">
                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                     </svg>
                  </button>





               </form>
         <?php
               $grand_total += $sub_total;
               $amount_of_items += 1;
            }
         } catch (PDOException $e) {
            // Handle database connection error
            echo '<p class="empty">No products added yet!</p>';
         }


         $select_cart = $conn->prepare("SELECT cart.*, products.price, main_products.product_name, main_products.image_1 AS image FROM `cart` 
         LEFT JOIN `products` ON cart.product_id = products.main_product_id 
         LEFT JOIN `main_products` ON products.main_product_id = main_products.id 
         WHERE cart.user_id = ?");
         $select_cart->execute([$user_id]);
         if ($select_cart->rowCount() > 0) {
            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
            }
         } else {
            echo '<p class="empty">Your cart is empty</p>';
         }
         ?>
      </div>
      <div class="cart-total">
         <p>Grand Total: <span>$<?= $grand_total; ?></span></p>
         <a href="shop.php" class="option-btn">Continue Shopping</a>
         <a href="cart.php?delete_all" class="delete-btn <?= ($amount_of_items > 1) ? '' : 'disabled'; ?>" onclick="return confirm('Delete all from cart?');">Delete All Items</a>
         <a href="checkout.php" class="btn <?= ($amount_of_items > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
      </div>
   </section>

   <!-- Footer Section -->
   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
   <script>
      function quick_view(id) {
         window.location.href = "quick_view.php?pid=" + id;
      }
   </script>
</body>

</html>