<?php
require 'components/connect.php';

session_start();
require 'components/prevention.php';

// Fetch products from the database
try {
    // Prepare the SQL statement
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
        m.mall_name AS mall_name,
        c.name AS category_name,
        pc.name AS parent_category_name
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
        categories c ON mp.category_id = c.id
    INNER JOIN 
        categories pc ON c.category_id = pc.id
    WHERE
        m.id = ?;";
    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind mall ID parameter
    $stmt->bindParam(1, $_SESSION['mall_id'], PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch all products as an associative array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if products array is empty
    if (empty($products)) {
        // No products found, return empty array
        echo json_encode([]);
    } else {
        // Output products as JSON
        echo json_encode($products);
    }
} catch (PDOException $e) {
    // Handle errors gracefully
    die("Error fetching products: " . $e->getMessage());
}
?>
