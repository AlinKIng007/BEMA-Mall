<?php

require 'components/connect.php';
session_start();

require 'components/prevention.php';

$mall_id = $_SESSION['mall_id'];
$shelf_id = $_POST['shelf_id'];

try {
    $select_shops = $conn->prepare("SELECT
    mp.product_name AS product_name,
    sh.height,
    sh.width,
    pos.z,
    pos.x,
    p.id AS id
FROM 
    shelves sh
INNER JOIN  
    positions pos ON sh.id = pos.shelf_id
LEFT JOIN 
    products p ON pos.id = p.position_id
inner JOIN 
    main_products mp ON p.main_product_id = mp.id
INNER JOIN  
    shops s ON sh.shop_id = s.id
INNER JOIN 
    floors f ON s.floor_id = f.id
INNER JOIN 
    malls m ON f.mall_id = m.id
WHERE
    m.id = ? AND sh.id = ?
");
    $select_shops->execute([$mall_id, $shelf_id]);
    
    // Fetch all rows
    $fetch_shops = $select_shops->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($fetch_shops);
} catch (PDOException $e) {
    echo json_encode(array("error" => $e->getMessage()));
}
