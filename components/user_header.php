<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<style>
    .icon-link {
        position: relative;
        display: inline-block;
    }

    .notification-badge {
        position: absolute !important;
        top: -8px !important;
        right: -8px !important;
        background-color: red !important;
        color: white !important;
        border-radius: 50% !important;
        font-size: 12px !important;
    }

    @media only screen and (max-width: 768px) {
        .hide-on-mobile {
            display: none!important;
        }
    }
    #choosemallbtn:hover{
background-color: transparent !important;
transition: color 0.3s ease;
    }

</style>

<body>


    <?php
    if ($_SESSION['mall_id'] === null) {
        $_SESSION['mall_id'] = 1;
    }


    // Your PHP code here
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    if (isset($message) && !empty($message)) {
        echo '
    <div class="custom-notification-container" id="notificationContainer">
        <div class="custom-notification-box" id="notificationBox">
            <div class="custom-notification-content">';
        foreach ($message as $msg) {
            echo $msg;
        }
        echo '
            </div>
        </div>
    </div>
    ';
    }



    if (isset($_POST['confirmSelectionBtn'])) {

        if (isset($_POST['selectedOption'])) {

            $_SESSION['mall_id'] = $_POST['selectedOption'];
        } else {
            $_SESSION['mall_id'] = 1;
        }
    }
    ?>
    <style>
        /* Notification Badge Styles */
    </style>

    <header class="header">
        <section class="flex">
            <a href="home.php" class="logo">Bema Mall</a>
            <nav class="navbar">
                <a href="home.php">Home</a>
                <a href="orders.php">Orders</a>
                <a href="shop.php">Shop</a>
                <a href="contact.php">Contact</a>
                <a href="grid.php">Grid</a>
                <?php
                if (isset($_SESSION['is_emp']) && $_SESSION['is_emp'] === 1) {
                } else {
                ?>
                    <li class="nav-item dropdown">
                        <a id="choosemallbtn" class="dropdown-toggle  btn-primary" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
                            Choose Mall
                        </a>
                        <form method="post">
                            <div class="dropdown-menu">
                                <select class="form-select" name="selectedOption" style="background-color: transparent; color: gray">
                                    <?php

                                    try {
                                        $select_malls = $conn->prepare("SELECT id, mall_name FROM `malls`");
                                        $select_malls->execute();
                                        while ($fetch_mall = $select_malls->fetch(PDO::FETCH_ASSOC)) {
                                            $mall_id = $fetch_mall["id"];
                                            $mall_name = $fetch_mall["mall_name"];
                                            // Set the selected attribute if it matches the previously selected mall
                                            echo "<option value='$mall_id'>$mall_name</option>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-primary" name="confirmSelectionBtn">Confirm</button>
                            </div>
                        </form>
                    </li>

                <?php
                }
                ?>

                <a href="buttons.php" id="modelsButton"><i class="material-icons">3d_rotation</i>3d Models</a>

                <a href="2dButtons.php" id="mapButton"><i class="material-icons">map</i>Map</a>
            </nav>

            <div class="icons">
                <?php
                $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                $count_wishlist_items->execute([$user_id]);
                $total_wishlist_counts = $count_wishlist_items->rowCount();

                $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $count_cart_items->execute([$user_id]);
                $total_cart_counts = $count_cart_items->rowCount();
                ?>
                <!-- Dark Mode Toggle Button -->
                <button id="darkModeToggle" class="dark-mode-toggle">
                    <i class="fas fa-moon" id="icon-moon"></i>
                    <i class="fas fa-sun" id="icon-sun" style="display: none;"></i>
                </button>


                <div id="menu-btn" class="fas fa-bars"></div>
                <a href="search_page.php" class="icon-link"><i class="fas fa-search"></i></a>
                <a href="wishlist.php" class="icon-link heart-icon">
                    <i class="fas fa-heart"></i>
                    <span class="notification-badge"><?= $total_wishlist_counts; ?></span>
                </a>

                <a href="cart.php" class="icon-link cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="notification-badge cart-badge"><?= $total_cart_counts; ?></span>
                </a>
                <div id="user-btn" class="fas fa-user"></div>
            </div>

            <div class="profile">
                <?php
                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile->execute([$user_id]);
                if ($select_profile->rowCount() > 0) {
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                    <p><?= $username ?></p>
                    <a href="update_user.php" class="btn">update profile</a>
                    <div class="flex-btn">
                        <?php
                        if (!isset($username)) {
                        ?>
                            <a href="signup.php" class="option-btn">register</a>
                            <a href="login.php" class="option-btn">login</a>
                        <?php
                        }
                        ?>



                    </div>
                    <a href="components/logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a>
                <?php
                } else {
                ?>
                    <p>please login or register first!</p>
                    <div class="flex-btn">
                        <a href="signup.php" class="option-btn">register</a>
                        <a href="login.php" class="option-btn">login</a>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>
    </header>
    <script>
        // select mall
        // document.addEventListener("DOMContentLoaded", function() {
        //     // Event listener for the confirm button
        //     document.getElementById("confirmSelectionBtn").addEventListener("click", function() {
        //         var selectedMallId = document.getElementById("mallSelector").value;
        //         if (selectedMallId === "" || selectedMallId === 0) {
        //             alert("Please select a mall before proceeding.");
        //             return;
        //         }

        //         // Send AJAX request to set the session variable
        //         var xhr = new XMLHttpRequest();
        //         xhr.open("GET", "", true); // Empty string represents the same page
        //         xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        //         xhr.onreadystatechange = function() {
        //             if (xhr.readyState === 4 && xhr.status === 200) {
        //                 console.log(xhr.responseText); // Log the response from the server
        //                 // Optionally, you can reload the page to reflect the changes
        //                 window.location.reload();
        //             }
        //         };
        //         xhr.send("selected_mall" + selectedMallId);
        //     });
        // });






        // Get references to elements
        const darkModeToggle = document.getElementById('darkModeToggle'); // Dark mode toggle button
        const body = document.body; // Body element
        const iconMoon = document.getElementById('icon-moon'); // Moon icon
        const iconSun = document.getElementById('icon-sun'); // Sun icon

        // Function to toggle dark mode
        function toggleDarkMode() {
            // Toggle dark mode class on body
            body.classList.toggle('dark-mode');
            // Toggle display of moon and sun icons based on dark mode class
            if (body.classList.contains('dark-mode')) {
                iconMoon.style.display = 'none';
                iconSun.style.display = 'inline-block';
            } else {
                iconMoon.style.display = 'inline-block';
                iconSun.style.display = 'none';
            }
            // Save the current mode in localStorage
            localStorage.setItem('darkMode', body.classList.contains('dark-mode') ? 'enabled' : 'disabled');
        }

        // Event listener for the dark mode toggle button
        darkModeToggle.addEventListener('click', toggleDarkMode);

        // Check localStorage for dark mode preference and apply it
        if (localStorage.getItem('darkMode') === 'enabled') {
            // If dark mode is enabled, apply dark mode styles
            body.classList.add('dark-mode');
            iconMoon.style.display = 'none';
            iconSun.style.display = 'inline-block';
        } else {
            // If dark mode is disabled or not set, apply light mode styles
            iconMoon.style.display = 'inline-block';
            iconSun.style.display = 'none';
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get notification box and container
            const notificationBox = document.getElementById('notificationBox');
            const notificationContainer = document.getElementById('notificationContainer');

            // Close notification box when clicked
            notificationBox.addEventListener('click', function() {
                notificationBox.style.animation = 'slideOutRight 0.5s forwards';

                // After animation completes, remove the notification box from the DOM
                setTimeout(function() {
                    notificationContainer.removeChild(notificationBox);
                }, 500); // Animation duration
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the dropdown toggle button
            var dropdownToggle = document.querySelector(".dropdown-toggle");

            // Get the dropdown menu
            var dropdownMenu = document.querySelector(".dropdown-menu");

            // Toggle the dropdown menu when the button is clicked
            dropdownToggle.addEventListener("click", function() {
                dropdownMenu.classList.toggle("show");
            });

            // Hide the dropdown menu when user clicks outside of it
            document.addEventListener("click", function(event) {
                if (!dropdownMenu.contains(event.target) && event.target !== dropdownToggle) {
                    dropdownMenu.classList.remove("show");
                }
            });
        });
    </script>
<script>
    function isMobile(){
        return window.innerWidth <= 768;
    }
    
    function hideButtonOnMobile(){
        var modelsButton = document.getElementById('modelsButton');
        var mapButton = document.getElementById('mapButton');
        var choosemallbtn = document.getElementById('choosemallbtn');
        if (isMobile()){
            modelsButton.classList.add('hide-on-mobile');
            mapButton.classList.add('hide-on-mobile');
            choosemallbtn.classList.add('hide-on-mobile');
        } else {
            modelsButton.classList.remove('hide-on-mobile');
            mapButton.classList.remove('hide-on-mobile');
            choosemallbtn.classList.remove('hide-on-mobile');
        }
    }
    
    hideButtonOnMobile();
    
    window.addEventListener('resize', function(){
        hideButtonOnMobile();
    });
</script>

</body>

</html>