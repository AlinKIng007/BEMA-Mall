<?php

require 'components/connect.php';




session_start();

require 'components/prevention.php';


include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<style>
   body.dark-mode {
      background-color: #333;
      color: #fff;
   }

   .search-form input[type="text"],
   .search-form button {
      background-color: azure;
      color: black;
      border: none;
      padding: 10px;
      border-radius: 5px;
   }

   .search-btn {
      background: none;
      border: none;
      cursor: pointer;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 0;
   }


   .box-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;

   }

   .box {
      width: calc(100% - 20px);
      /* Adjust the width as needed */
      margin-bottom: 20px;
      padding: 20px;
      text-align: center;
      background-color: whitesmoke;
      /* Dark mode card background color */
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
      border: 1px solid gray;
   }

   .box img {
      max-width: 100%;
      height: 300px;

   }

   .name {
      margin-top: 10px;
      font-weight: bold;
   }

   .flex {
      display: flex;
      justify-content: space-between;
      align-items: center;
   }

   .price {
      font-size: 18px;
      color: black;
   }

   .qty {
      width: 50px;
      text-align: center;
      background-color: aliceblue;
      color: black;
      border: 1px solid lightblue;
      border-radius: 5px;
   }

   .btn {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
   }

   .btn:hover {
      background-color: #0056b3;
   }

   .empty {
      color: #fff;
   }
</style>

<body>

   <?php include 'components/user_header.php'; ?>
   <section class="search-form">
      <input value="" type="text" id="search_box" name="search_box" placeholder="Search here..." maxlength="100" class="box">
   </section>

   <section class="products" style="padding-top: 0; min-height:100vh;">
      <div class="box-container" id="product_results">
         <!-- Product results will be displayed here -->
      </div>
   </section>


   <button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>

   <?php include 'components/footer.php'; ?>



   <script>
window.onload = searchAndUpdateResults();
// Function to send AJAX request when user types in the search box
function searchAndUpdateResults() {
    // Get the value from the search box
    var searchValue = document.getElementById('search_box').value;

    // Create an AJAX object
    var xhttp = new XMLHttpRequest();

    // Define the function to handle the AJAX response
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Update the product results container with the response
            document.getElementById('product_results').innerHTML = this.responseText;
        }
    };

    // Open a POST request to your PHP script
    xhttp.open("POST", "search_products.php", true);

    // Set the content type header
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Send the AJAX request with the search value as parameter
    xhttp.send("search_box=" + searchValue);
}

// Call the search function to fetch results on page load
searchAndUpdateResults();

// Attach the event listener for the change event on the search box
document.getElementById('search_box').addEventListener('keyup', searchAndUpdateResults);

   </script>
   <script>
      function taketoqv(id) {
         window.location.href = "quick_view.php?pid=" + id;
      }
   </script>


   <script>
      const darkModeToggle = document.querySelector('.dark-mode-toggle');

      darkModeToggle.addEventListener('change', () => {
         document.body.classList.toggle('dark-mode');
      });

      // JavaScript function for smooth scrolling to top
      function scrollToTop() {
         // Smooth scrolling animation
         const scrollToTop = () => {
            const c = document.documentElement.scrollTop || document.body.scrollTop;
            if (c > 0) {
               window.requestAnimationFrame(scrollToTop);
               window.scrollTo(0, c - c / 8);
            }
         };
         scrollToTop();
      }

      // Show/hide scroll-to-top button based on scroll position
      window.onscroll = function() {
         scrollFunction();
      };
      

      function scrollFunction() {
         const scrollToTopBtn = document.getElementById("scrollToTopBtn");
         if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollToTopBtn.style.display = "block";
         } else {
            scrollToTopBtn.style.display = "none";
         }
      }



   </script>
</body>

</html>