<?php
require 'components/connect.php';
session_start();
require 'components/prevention.php';

// Fetch products from the database
try {
    // Prepare the SQL statement
    $sql = "
    SELECT 
        mp.product_name,
        p.amount,
        p.price,
        p.id,
        p.barcode
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
        m.id = ? AND p.barcode = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind mall ID parameter
    $stmt->bindParam(1, $_SESSION['mall_id'], PDO::PARAM_INT);

    // Bind barcode parameter
    $barcode = $_POST['barcode']; // Get the barcode from POST data
    $stmt->bindParam(2, $barcode, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Fetch all products as an associative array
    
    while ($products = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
        echo json_encode($products);
    }
        
    

    
} catch (PDOException $e) {
    // Handle errors gracefully
    echo json_encode(['error' => 'Error fetching products: ' . $e->getMessage()]);
}
?>
