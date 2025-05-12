<?php

include 'components/connect.php';

session_start();

require 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quick view</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<style>
    
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f0f0f0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

.quick-view {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.heading {
  font-size: 24px;
  margin-bottom: 20px;
  color: #333;
}

.box {
  margin-bottom: 20px;
}

.row {
  display: flex;
}

.image-container {
  flex: 1;
}

.main-image img {
  max-width: 100%;
  height: auto;
  margin-bottom: 10px;
  border-radius: 8px;
}

.sub-image {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 10px;
}

.sub-image img {
  width: 100px; /* Adjust as needed */
  height: 100px !important;
  margin-right: 10px; /* Adjust spacing between small images */
  border-radius: 8px;
}

.content {
  flex: 2;
  padding-left: 20px;
  display: flex;
  flex-direction: column; /* Stack text elements vertically */
}

.name {
  font-size: 20px;
  margin-bottom: 10px;
}

.price {
  font-size: 18px;
  color: #007bff;
}

.qty {
  width: 50px;
  margin-left: 10px;
}

.details {
  margin-top: 10px;
  margin-bottom: 20px;
}

.flex-btn {
  display: flex;
  flex-direction: column; /* Stack buttons vertically */
}

.btn {
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-bottom: 10px;
}

.option-btn {
  padding: 10px 20px;
  background-color: #28a745;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-bottom: 10px;
}

.empty {
  color: #f00;
}

/* Responsive styles */
@media screen and (max-width: 768px) {
  .row {
    flex-direction: column;
  }

  .content {
    padding-left: 0;
    margin-top: 20px;
  }

  .qty {
    margin-left: 0;
    margin-top: 10px;
  }

  .flex-btn {
    flex-direction: column;
  }

  .btn,
  .option-btn {
    width: 100%;
    margin-right: 0;
    margin-bottom: 10px;
  }

  .sub-image {
    margin-top: 0;
    margin-right: 50px;
  }
  .image-container {
    flex-direction: column; /* Stack main images vertically */
    align-items: flex-start; /* Align main images to the left */
    margin-left: -45px; /* Adjust the left margin to bring the container closer to the left edge */

  }

  .sub-images {
    flex-direction: column; /* Stack sub-images vertically */
    align-items: flex-start; /* Align sub-images to the left */
    margin-left: -45px; /* Adjust the left margin to bring the container closer to the left edge */

  }
  .main-image img{
    margin-left: -30px; /* Adjust the left margin to bring the container closer to the left edge */

  }

}

</style>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="quick-view">

   <h1 class="heading">quick view</h1>

   <?php
if(!isset($_GET['pid'])){
    
    ?>
    <script>
        window.location.href = "home.php";
    </script>
    <?php
}else{
try {
    $pid = $_GET['pid'];

    // SQL query
    $sql = "
        SELECT 
            mp.product_name AS product_name,
            p.price AS price,
            p.id AS id,
            p.amount AS amount,
            mp.image_1 AS image_1,
            mp.image_2 AS image_2,
            mp.image_3 AS image_3,
            mp.description AS description,
            m.mall_name AS mall_name
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
        WHERE
            p.id = ?;";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Execute the SQL statement
    $stmt->execute([$pid]);

    // Fetch all rows as associative array
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the results
    foreach ($results as $row) {
?>
    <form action="" method="post" class="box">
        <input type="hidden" name="pid" value="<?= $row['id']; ?>">
        <input type="hidden" name="name" value="<?= $row['product_name']; ?>">
        <input type="hidden" name="price" value="<?= $row['price']; ?>">
        <input type="hidden" name="image" value="<?= $row['image_1']; ?>">
        <div class="row">
            <div class="image-container">
                <div class="main-image" style="margin-left: 100px;">
                    <img src="uploaded_img/<?= $row['image_1']; ?>" alt="">
                </div>
                <div class="sub-image" style="justify-content: start; margin-left: 100px;">
                    <img src="uploaded_img/<?= $row['image_1']; ?>" alt="">
                    <img src="uploaded_img/<?= $row['image_2']; ?>" alt="">
                    <img id="img3" src="uploaded_img/<?= $row['image_3']; ?>" alt="">
                </div>

            </div>
            <div class="content">
                <div class="name"><?= $row['product_name']; ?></div>
                <div class="flex">
                    <div class="price"><span>$</span><?= $row['price']; ?><span> </span></div>
                    <input type="number" name="qty" class="qty" min="1" max="<?= $row['amount']; ?>" onkeypress="if(this.value.length == 2) return false;" value="1">
                </div>
                <div class="details"><?= $row['description']; ?></div>
                <br>
                <div class="flex-btn">
                    <input type="submit" value="Add to Cart" class="btn" name="add_to_cart">
                    <input type="submit" class="option-btn" name="add_to_wishlist" value="Add to Wishlist">
                </div>
            </div>
        </div>
    </form>
<?php
    }
} catch(PDOException $e) {
    // Handle database connection error
    echo '<p class="empty">No products added yet!</p>';
}
}
?>


</section>













<?php include './components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>