<?php
require 'components/connect.php';




session_start();

require 'components/prevention.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- Font Awesome CDN link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom CSS file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'components/user_header.php'; ?>

    <section class="checkout-orders">
        <form action="" method="POST">
            <h3>Your Cart Items</h3>

            <div class="display-orders">
                <?php
                $grand_total = 0;
                date_default_timezone_set('Asia/Baghdad');
                try {
                    // Fetch status type
                    $status_sql = "
                    SELECT 
                        id
                    FROM 
                        status
                    WHERE 
                        level = 1;
                ";

                    // Prepare and execute status SQL statement
                    $status_stmt = $conn->prepare($status_sql);
                    $status_stmt->execute();

                    // Fetch status results
                    $status_results = $status_stmt->fetchAll(PDO::FETCH_ASSOC);

                    // SQL query to fetch cart items
                    $sql = "
                    SELECT 
                        mp.product_name AS product_name,
                        p.price AS price,
                        p.amount AS amount,
                        p.id AS pid,
                        mp.image_1 AS image_1,
                        m.mall_name AS mall_name,
                        cart.id,
                        cart.amount as camount
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

                    // Prepare and execute cart SQL statement
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$_SESSION["user_id"], $_SESSION['mall_id']]);

                    // Fetch cart results
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);



                    // Output the cart items
                    foreach ($results as $row) {
                        $cart_items[] = $row['product_name'] . ' (' . '$' . $row['price'] . ' x ' . $row['camount'] . ') - ';
                        $total_products = implode($cart_items);
                        $grand_total += ($row['price'] * $row['camount']);
                ?>
                        <p>
                            <img style="width: 75px; height: 75px;" src="uploaded_img/<?= $row['image_1']; ?>" alt=""> <!-- Displaying image_1 -->
                            <br>
                            <?= $row['product_name']; ?>
                            <br>
                            <span><?= '$' . $row['price'] . '  x ' . $row['camount']; ?></span>
                        </p>
                <?php
                        if (isset($_POST['method']) && isset($_POST['order'])) {
                            $method = $_POST['method'];
                            try {
                                // Insert order into database
                                $insert_order = $conn->prepare("INSERT INTO `orders` (user_id, amount, time_of_purchase, status_id, payment_method_id, product_id) VALUES (?, ?, ?, ?, ?, ?)");
                                $insert_order->execute([$_SESSION['user_id'],  $row['camount'], date('Y-m-d H:i:s'), $status_results[0]['id'], $method, $row['pid']]);

                                $delete_cart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
                                $delete_cart->execute([$user_id]);
                                echo '<script>window.location.href = "home.php";</script>';
                            } catch (PDOException $e) {
                                echo '<p class="empty">error</p>';
                            }
                        }
                    }
                } catch (PDOException $e) {
                    // Handle database connection error
                    echo '<p class="empty">No products added yet!</p>';
                }
                ?>

                <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
                <div class="grand-total">Grand Total: <span>$<?= $grand_total; ?> </span></div>
            </div>
            <br>
            <div class="flex">
                <div class="inputBox" style="text-align: center; margin-left: 25%;">
                    <h1>Payment Method</h1>
                    <select name="method" class="box" style="text-align: center;" required>
                        <?php
                        // Fetch methods from the database and populate the dropdown
                        try {
                            $select_methods = $conn->prepare("SELECT id, method_name FROM `payment_method`");
                            $select_methods->execute();
                            while ($fetch_method = $select_methods->fetch(PDO::FETCH_ASSOC)) {
                                $method_id = $fetch_method["id"];
                                $method_name = $fetch_method["method_name"];
                                // Set the selected attribute if it matches the previously selected method
                                echo "<option value='$method_id'>$method_name</option>";
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br>
            <input type="submit" name="order" style="padding-bottom: 10px;padding-top: 10px;" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" value="Place Order">
        </form>
    </section>


    <?php include 'components/footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>