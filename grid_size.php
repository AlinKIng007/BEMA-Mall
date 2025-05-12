<?php

require 'components/connect.php';
session_start();

require 'components/prevention.php';

$mall_id = $_SESSION['mall_id'];
$shop_id = $_POST['shop_id'];

try {
    $select_shops = $conn->prepare("SELECT
            s.shop_name AS name,
            s.east_in_meters AS width,
            s.north_in_meters AS height,
            sh.id AS shid,
            sh.from_north AS southFrom,
            sh.to_north AS southTo,
            sh.from_east AS eastFrom,
            sh.to_east AS eastTo 
        FROM
            malls m
            INNER JOIN floors f ON m.id = f.mall_id
            INNER JOIN shops s ON f.id = s.floor_id
            INNER JOIN shelves sh ON s.id = sh.shop_id
    WHERE
        m.id = ? AND s.id = ?");
    $select_shops->execute([$mall_id, $shop_id]);
    
    // Fetch all rows
    $fetch_shops = $select_shops->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($fetch_shops);
} catch (PDOException $e) {
    echo json_encode(array("error" => $e->getMessage()));
}
