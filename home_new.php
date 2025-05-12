<?php
require 'components/connect.php';



session_start();
require 'components/prevention.php';


include 'components/wishlist_cart.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bema Mall</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/homestyle.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<style>
        .vesitable-img {
        height: 200px !important; /* Set a fixed height */
        display: flex !important;
        align-items: stretch !important;
    }

    .vesitable-img img {
        object-fit: cover !important; /* Ensure the image covers the entire container */
        width: 100% !important;
        height: 100% !important; /* Take up the full height of the container */
    }
</style>




    <?php include 'components/user_header.php'; ?>

    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-header">Bema Mall</h4>
                    <h1 class="mb-5 display-3 text-header2">one of the best malls in iraq</h1>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded" style="height: 30.3rem!important;">
                                <img src="images/neno.png" class="img-fluid w-100 h-100  rounded" alt="First slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">eggs</a>
                            </div>
                            <div class="carousel-item rounded" style="height: 30.3rem !important;">
                                <img src="img/partysizelays.jpg" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">chips</a>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Featurs Section Start -->
    <div class="container-fluid featurs py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded featurs-bg p-4">
                        <div class="featurs-icon btn-square rounded-circle square-bg-featurs mb-5 mx-auto">
                            <i class="fas fa-car-side fa-3x text-icon"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Free Shipping</h5>
                            <p class="mb-0">Free on order over $300</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded featurs-bg p-4">
                        <div class="featurs-icon btn-square rounded-circle square-bg-featurs mb-5 mx-auto">
                            <i class="fas fa-user-shield fa-3x text-icon"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Security Payment</h5>
                            <p class="mb-0">100% security payment</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded featurs-bg p-4">
                        <div class="featurs-icon btn-square rounded-circle square-bg-featurs mb-5 mx-auto">
                            <i class="fas fa-exchange-alt fa-3x text-icon"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>30 Day Return</h5>
                            <p class="mb-0">30 day money guarantee</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded featurs-bg p-4">
                        <div class="featurs-icon btn-square rounded-circle square-bg-featurs mb-5 mx-auto">
                            <i class="fa fa-phone-alt fa-3x text-icon"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>24/7 Support</h5>
                            <p class="mb-0">Support every time fast</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs Section End -->


    <!-- products Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Our Products</h1>
                    </div>
                    <div class="col-lg-8 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-allproducts rounded-pill active" data-bs-toggle="pill" href="#">
                                    <span class="text-dark" style="width: 130px;">All Products</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img" style="height: 176px;">
                                                <img src="/img/dress.jpg " class=" w-100 " style="height: 175px;" alt="">
                                            </div>
                                            <div class="text-white cards-cat-btn px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">dress</div>
                                            <div class="p-4  cards-border border-top-0 rounded-bottom">
                                                <h4>dress</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="price-text fs-5 fw-bold mb-0">$4.99</p> <span class="text-amount">amount: <i class="amount-number">20</i></span>
                                                    <a href="#" class="btn  cards-border rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
    <!-- products Shop End-->


    <!-- Featurs Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-service rounded service-border">
                            <img src="img/jalapeno cheese.jpg" style="height: 22.3rem;" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-service2 text-center p-4 rounded">
                                    <h5 class="text-service"> Chesse</h5>
                                    <h3 class="mb-0">20% OFF</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-service rounded service-border ">
                            <img src="img/raw-rashers-of-bacon-in-package.jpg" style="height: 22.3rem;" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-service2 text-center p-4 rounded">
                                    <h5 class="text-service">Tasty Meat</h5>
                                    <h3 class="mb-0">Free delivery</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-service rounded service-border ">
                            <img src="img/Chobani Plain Yogurt.jpg" style="height: 22.3rem;" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-service2 text-center p-4 rounded">
                                    <h5 class="text-service">Yogurt</h5>
                                    <h3 class="mb-0">Discount 30$</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs End -->


    <!-- Vesitable Shop Start-->
    <div class="container-fluid vesitable py-5">
        <div class="container py-5">
            <h1 class="mb-0">Best products</h1>
            <div class="owl-carousel vegetable-carousel justify-content-center">

                <?php
                // Place your database connection code here
                // Assuming $conn is your PDO connection object
                $mall_id = $_SESSION['mall_id'];
                try {
                    // SQL query
                    $sql = "
    SELECT 
    mp.id AS id,
    mp.product_name,
    mp.description,
    p.price AS price,
    p.amount AS amount,
    p.date_added AS date_added,
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
ORDER BY 
    date_added desc
limit 
    10;

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
                        <form method="post">
                            <input type="hidden" name="pid" value="<?= $row['id']; ?>">
                            <input type="hidden" name="name" value="<?= $row['product_name']; ?>">
                            <input type="hidden" name="price" value="<?= $row['price']; ?>">
                            <input type="hidden" name="image" value="<?= $row['image_1']; ?>">
                            <input type="hidden" name="qty" value="1">
                            <div class=" border-Vesitable rounded position-relative vesitable-item" >
                                <div class="vesitable-img" style="height: 200px; ">
                                    <img src="uploaded_img/<?= $row['image_1']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                <div class=" cat-text  cat-bg px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?= $row['product_name']; ?></div>
                                <div class="p-4 rounded-bottom">
                                    <h4><?= $row['product_name']; ?></h4>
                                    <p><?= $row['description']; ?></p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="price-text fs-5 fw-bold mb-0"><?= $row['price']; ?></p><span class="text-amount">amount: <i class="amount-number"><?= $row['amount']; ?></i></span>
                                        <button class="fas fa-heart" style="background-color: transparent;" type="submit" name="add_to_wishlist"></button>
                                        <input type="submit" value="Add to Cart" class="btn add-to-cart-btn" name="add_to_cart">
                                    </div>
                                </div>
                            </div>

                            


                        </form>
                <?php
                    }
                } catch (PDOException $e) {
                    // Handle database connection error
                    echo '<p class="empty">No products added yet!</p>';
                }
                ?>

            </div>
        </div>
    </div>
    <!-- Vesitable Shop End -->




    <!-- Bestsaler Product Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                <h1 class="display-4">Bestseller Products</h1>
                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-bestsaler">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="img/camera-1.webp" style="height: 150px;" class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">camera</a>

                                <h4 class="mb-3">3.12 $</h4> <span class="text-amount">amount: <i class="amount-number">20</i></span>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary Bestsaler-add-btn"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-bestsaler">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="img/laptop-1.webp" style="height: 150px;" class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">laptop</a>

                                <h4 class="mb-3">3.12 $</h4><span class="text-amount">amount: <i class="amount-number">20</i></span>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary Bestsaler-add-btn"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-bestsaler">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="img/watch-1.webp" style="height: 150px;" class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">watch</a>

                                <h4 class="mb-3">3.12 $</h4><span class="text-amount">amount: <i class="amount-number">20</i></span>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary Bestsaler-add-btn"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-bestsaler">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="img/Heinz-Tomato-Ketchup.jpg" style="height: 150px;" class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Heinz Tomato Ketchup</a>

                                <h4 class="mb-3">3.12 $</h4><span class="text-amount">amount: <i class="amount-number">20</i></span>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary Bestsaler-add-btn"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-bestsaler">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="img/Chobani Plain Yogurt.jpg" style="height: 150px;" class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Chobani Plain Yogurt</a>

                                <h4 class="mb-3">3.12 $</h4><span class="text-amount">amount: <i class="amount-number">20</i></span>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary Bestsaler-add-btn"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-bestsaler">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="img/eggs.jpg" style="height: 150px;" class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">eggs</a>

                                <h4 class="mb-3">3.12 $</h4><span class="text-amount">amount: <i class="amount-number">20</i></span>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary Bestsaler-add-btn"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="img/tv-01.webp" style="height: 150px;" class="img-fluid rounded" alt="">
                        <div class="py-4">
                            <a href="#" class="h5">tv</a>

                            <h4 class="mb-3">3.12 $</h4><span class="text-amount">amount: <i class="amount-number">20</i></span>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary Bestsaler-add-btn"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="img/shoes.jpg" style="height: 150px;" class="img-fluid rounded" alt="">
                        <div class="py-4">
                            <a href="#" class="h5">shoes</a>

                            <h4 class="mb-3">3.12 $</h4><span class="text-amount">amount: <i class="amount-number">20</i></span>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary Bestsaler-add-btn"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="img/Mustard Bottle.jpg" style="height: 150px;" class="img-fluid rounded" alt="">
                        <div class="py-4">
                            <a href="#" class="h5">Mustard Bottle</a>

                            <h4 class="mb-3">3.12 $</h4><span class="text-amount">amount: <i class="amount-number">20</i></span>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary Bestsaler-add-btn"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="img/jalapeno cheese.jpg" style="height: 150px;" class="img-fluid rounded" alt="">
                        <div class="py-2">
                            <a href="#" class="h5">jalapeno cheese</a>

                            <h4 class="mb-3">3.12 $</h4><span class="text-amount">amount: <i class="amount-number">20</i></span>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary Bestsaler-add-btn"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bestsaler Product End -->


    <!-- Fact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="bg-fact p-5 rounded">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-fact2 rounded p-5">
                            <i class="fa fa-users "></i>
                            <h4>satisfied customers</h4>
                            <h1 class="fact-num">1963</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-fact2 rounded p-5">
                            <i class="fa fa-users "></i>
                            <h4>quality of service</h4>
                            <h1 class="fact-num">99%</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-fact2 rounded p-5">
                            <i class="fa fa-users "></i>
                            <h4>quality certificates</h4>
                            <h1 class="fact-num">33</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-fact2 rounded p-5">
                            <i class="fa fa-users "></i>
                            <h4>Available Products</h4>
                            <h1 class="fact-num">789</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact Start -->


    <!-- Tastimonial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="testimonial-header text-center">
                <h4 class="text-primary">Our Testimonial</h4>
                <h1 class="display-5 mb-5 text-testimonial">Our Client Saying!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item img-border-radius  rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-testimonial-item rounded">
                                <img src="img/profile-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item img-border-radius  rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-testimonial-item rounded">
                                <img src="img/profile-2.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item img-border-radius  rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-testimonial-item rounded">
                                <img src="img/profile-3.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tastimonial End -->






    <!-- Back to Top -->
    <a href="#" class="btn  border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

    <?php include 'components/footer.php'; ?>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/homemain.js"></script>
</body>

</html>