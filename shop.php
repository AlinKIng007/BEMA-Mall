<?php

require 'components/connect.php';




session_start();

require 'components/prevention.php';


include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<style>

</style>
<body>
   
<?php include 'components/user_header.php'; ?>



<section class="home-products">

   <h1 class="heading">latest products</h1>


   <div class="box-container">
   <?php
// Place your database connection code here
// Assuming $conn is your PDO connection object
$mall_id = $_SESSION['mall_id'];
try {
    // SQL query
    $sql = "
        SELECT 
            mp.id AS id,
            mp.product_name AS product_name,
            p.price AS price,
            p.amount AS amount,
            mp.image_1 AS image_1
        FROM 
            main_products mp
        JOIN 
            products p ON mp.id = p.main_product_id
        JOIN 
            positions pos ON p.position_id = pos.id
        JOIN 
            shelves sh ON pos.shelf_id = sh.id
        JOIN 
            shops s ON sh.shop_id = s.id
        JOIN 
            floors f ON s.floor_id = f.id
        JOIN 
            malls m ON f.mall_id = m.id
        WHERE 
            m.id = ?
            ";
    
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    
    // Execute the SQL statement
    $stmt->execute([$mall_id]);
    
    // Fetch all rows as associative array
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Output the results
    foreach ($results as $row) {
       ?>
       <div class="slide">
          <form action="" method="post" class="add-to-cart-form">
             <input type="hidden" name="pid" value="<?= $row['id']; ?>">
             <input type="hidden" name="name" value="<?= $row['product_name']; ?>">
             <input type="hidden" name="price" value="<?= $row['price']; ?>">
             <input type="hidden" name="image" value="<?= $row['image_1']; ?>">
            
             <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
             <a href="quick_view.php?pid=<?= $row['id']; ?>" class="fas fa-eye"></a>
             <img src="uploaded_img/<?= $row['image_1']; ?>" alt="<?= $row['product_name']; ?>">
             <div class="name"><?= $row['product_name']; ?></div>
             <div class="container light-mode" id="content">
        total amount: <span><?= $row['amount']; ?></span>
    </div>
             <div class="flex">
                <div class="price"><span>$</span><?= $row['price']; ?></div>
                <input type="number" name="qty" class="qty" min="1" max="<?= $row['amount']; ?>" onkeydown="if(event.keyCode != 38 && event.keyCode != 40) return false;" value="1">
             </div>
             <input type="submit" value="Add to Cart" class="btn add-to-cart-btn" name="add_to_cart">
          </form>
       </div>
       <?php
    }

 } catch(PDOException $e) {
    // Handle database connection error
    echo '<p class="empty">No products added yet!</p>';
 }
 ?>


   </div>

</section>


<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>
<!-- <script>
      function searchProducts() {
         let input = document.getElementById('searchbar').value.toLowerCase();
         let products = document.getElementsByClassName('slide');

         for (let product of products) {
            let name = product.querySelector('.name').textContent.toLowerCase();
            let price = product.querySelector('.price').textContent.toLowerCase();

            if (name.includes(input) || price.includes(input)) {
               product.style.display = "block";
            } else {
               product.style.display = "none";
            }
         }
      }
   </script> -->
</body>
</html>