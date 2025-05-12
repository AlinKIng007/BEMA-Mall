<?php
require 'components/connect.php';

if (isset($_GET['q']) && !empty($_GET['q'])) {
    $search = htmlspecialchars($_GET['q']);
    $stmt = $conn->prepare("SELECT main_products.*, products.price AS price FROM `main_products` LEFT JOIN `products` ON main_products.id = products.main_product_id WHERE main_products.product_name LIKE ?");
    $stmt->execute(["%$search%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        foreach ($results as $row) {
            echo "<div class='product-card'>";
            echo "<img src='uploaded_img/" . htmlspecialchars($row['image_1']) . "' alt=''>";
            echo "<div class='product-name'>" . htmlspecialchars($row['product_name']) . "</div>";
            echo "<div class='product-price'>$" . htmlspecialchars($row['price']) . "</div>";
            echo "</div>";
        }
    } else {
        echo "No products found.";
    }
} else {
    echo "Please enter a search query.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<style>
   .product-card {
    border: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}
.product-card img {
    width: 100px; /* Adjust as needed */
    height: 100px; /* Adjust as needed */
    margin-right: 10px;
}
.product-name, .product-price {
    margin: 0;
}
</style>
<body>
<div class="search-box">
    <input type="text" id="searchQuery" placeholder="Search products..." onkeyup="fetchProducts()">
</div>
<div id="searchResults"></div>

<script>
function fetchProducts() {
    var query = document.getElementById('searchQuery').value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('searchResults').innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "fetch_products.php?q=" + query, true);
    xhttp.send();
}
</script>
</body>
</html>