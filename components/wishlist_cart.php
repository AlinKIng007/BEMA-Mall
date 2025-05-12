<?php
include 'connect.php';

include 'prevention.php';

$user_id = $_SESSION['user_id'];

if(isset($_POST['add_to_wishlist'])) {

   if($user_id == ''){
      header('location:login.php');
   } else {

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);

      // Fetch product details including product name from main_products table
      $product_info = $conn->prepare("SELECT product_name, image_1 FROM `main_products` WHERE id = ?");
      $product_info->execute([$pid]);
      $product_data = $product_info->fetch(PDO::FETCH_ASSOC);

      $name = $product_data['product_name'];
      $image = $product_data['image_1'];

      // Fetch price from products table
      $product_price = $conn->prepare("SELECT price FROM `products` WHERE main_product_id = ?");
      $product_price->execute([$pid]);
      $price_data = $product_price->fetch(PDO::FETCH_ASSOC);
      $price = $price_data['price'];

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE product_id = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$pid, $user_id]);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE product_id = ? AND user_id = ?");
      $check_cart_numbers->execute([$pid, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $message[] = 'already added to wishlist!';
      } elseif($check_cart_numbers->rowCount() > 0){
         $message[] = 'cannot be added to wishlist becasue its already added to cart!';
      } else {
         $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, product_id) VALUES(?,?)");
         $insert_wishlist->execute([$user_id, $pid]);
         
         $message[] = 'added to wishlist!';
      }
   }
}

if(isset($_POST['add_to_cart'])) {

   if($user_id == ''){
      header('location:login.php');
   } else {
      $qty = $_POST['qty'];
      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);

      // Fetch product details including product name from main_products table
      $product_info = $conn->prepare("SELECT product_name, image_1 FROM `main_products` WHERE id = ?");
      $product_info->execute([$pid]);
      $product_data = $product_info->fetch(PDO::FETCH_ASSOC);

      $name = $product_data['product_name'];
      $image = $product_data['image_1'];

      // Fetch price from products table
      $product_price = $conn->prepare("SELECT price FROM `products` WHERE main_product_id = ?");
      $product_price->execute([$pid]);
      $price_data = $product_price->fetch(PDO::FETCH_ASSOC);
      $price = $price_data['price'];
      



      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE product_id = ? AND user_id = ?");
      $check_cart_numbers->execute([$pid, $user_id]);

      if($check_cart_numbers->rowCount() > 0){
         $message[] = 'already added to cart!';
      } else {

         $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE product_id = ? AND user_id = ?");
         $check_wishlist_numbers->execute([$pid, $user_id]);

         if($check_wishlist_numbers->rowCount() > 0){
            $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE product_id = ? AND user_id = ?");
            $delete_wishlist->execute([$pid, $user_id]);
         }

         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, product_id,  amount) VALUES(?,?,?)");
         $insert_cart->execute([$user_id, $pid, $qty]);
         $message[] = 'added to cart!';
      }
   }
}


