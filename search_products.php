<?php

require 'components/connect.php';
session_start();

require 'components/prevention.php';

$mall_id = $_SESSION['mall_id'];
if (isset($_POST['search_box'])) {
    $search = $_POST['search_box'];
} else {
    $search = "";
}
try {
    // Prepare the SQL statement
    $stmt = $conn->prepare("CALL search_products(?, ?)");

    // Execute the stored procedure with parameters
    $stmt->execute([$search, $mall_id]);

    // Fetch all rows as associative array
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the results
    foreach ($results as $row) {
?>
        <form method="post" class="box">
            <input type="hidden" name="pid" value="<?= $row['id']; ?>">
            <input type="hidden" name="name" value="<?= $row['product_name']; ?>">
            <input type="hidden" name="price" value="<?= $row['price']; ?>">
            <input type="hidden" name="image" value="<?= $row['image_1']; ?>">
            <img src="uploaded_img/<?= $row['image_1']; ?>" alt="" style="cursor: pointer;" onclick="taketoqv(<?= $row['id']; ?>)">
            <div class="name"><?= $row['product_name']; ?></div>
            <div class="flex">
                <div class="price"><span >$</span><?= $row['price']; ?><span> </span></div>
                <input type="number" name="qty" class="qty" min="1" max="<?= $row['amount']; ?>" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <input type="submit" value="Add to Cart" class="btn" name="add_to_cart">
        </form>
<?php
    }
} catch (PDOException $e) {
    // Handle database connection error
    echo '<p class="empty">No products added yet!</p>';
}
?>