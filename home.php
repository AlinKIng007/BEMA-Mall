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

   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      span,
      h3 {
         display: block;
      }

  .home {
    text-align: center;
    padding: 50px 0;
  }

  .swiper-slide {
    display: inline-block;
    vertical-align: top;
    margin-right: 20px;
  }

  .image img {
    max-width: 100%;
    height: auto;
  }

  .content {
    margin-top: 20px;
  }

  .content h3 {
    margin-right: 20px;
  }

  .btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: orange;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }

  .btn:hover {
    background-color: #ff8c00;
  }
  h1 span {
    color: #fff;
    position: relative;
}
h1 span::before {
    content: "";
    height: 30px;
    width: 2px;
    position: absolute;
    top: 50%;
    right: -8px;
    background: #fff;
    transform: translateY(-45%);
    animation: blink 0.7s infinite;
}
h1 span.stop-blinking::before {
    animation: none;
}
@keyframes blink {
    50% { opacity: 0 }
}
#loader {
   position: fixed;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
   background-color: rgba(255, 255, 255, 0.7);
   z-index: 9999;
   display: flex;
   justify-content: center;
   align-items: center;
}

#loader {
   position: fixed;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
   background-color: rgba(255, 255, 255, 1);
   z-index: 9999;
   display: flex;
   justify-content: center;
   align-items: center;
}

.loader {
   border: 8px solid #f3f3f3;
   border-radius: 50%;
   border-top: 8px solid #3498db;
   width: 50px;
   height: 50px;
   animation: spin 2s linear infinite;
}

@keyframes spin {
   0% { transform: rotate(0deg); }
   100% { transform: rotate(360deg); }
}


   </style>
</head>

<body>
<div id="loader">
  <div class="loader"></div>
</div>


   <?php include 'components/user_header.php'; ?>

   <div class="home-bg">
   <h1 style="text-align: center;"><span></span></h1>

   <section class="home">
  <div class="swiper home-slider">
    <div class="swiper-wrapper">
      <div class="swiper-slide slide">
        <div class="image">
          <img src="images/home-img-1.png" alt="">
        </div>
        <div class="content">
          <h3>latest smartphones</h3>
          <a href="shop.php" class="btn">shop now</a>
        </div>
      </div>

      <div class="swiper-slide slide">
        <div class="image">
          <img src="images/home-img-2.png" alt="">
        </div>
        <div class="content">
          <h3>latest watches</h3>
          <a href="shop.php" class="btn">shop now</a>
        </div>
      </div>

      <div class="swiper-slide slide">
        <div class="image">
          <img src="images/home-img-3.png" alt="">
        </div>
        <div class="content">
          <h3>latest headsets</h3>
          <a href="shop.php" class="btn">shop now</a>
        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</section>

      <div class="scroll-text-container-alt">
         <div class="scroll-text-alt">
            <p>Welcome to Bema mall | Get the best deals on the best products</p>
         </div>
      </div>

   </div>


   <section class="home-products" data-aos="fade-up" data-aos-duration="1000">
      <h1 class="heading">Latest Products</h1>

      <div class="swiper products-slider">
         <div class="swiper-wrapper">
            <?php
            // Place your database connection code here
            // Assuming $conn is your PDO connection object
            $mall_id = $_SESSION['mall_id'];
            try {
               // SQL query
               $sql = "
    SELECT 
    mp.id AS id,
    mp.product_name AS product_name,
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
                  <div class="swiper-slide slide" style="margin:10px">
                     <form action="" method="post" class="add-to-cart-form">
                        <input type="hidden" name="pid" value="<?= $row['id']; ?>">
                        <input type="hidden" name="name" value="<?= $row['product_name']; ?>">
                        <input type="hidden" name="price" value="<?= $row['price']; ?>">
                        <input type="hidden" name="image" value="<?= $row['image_1']; ?>">

                        <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                        <a href="quick_view.php?pid=<?= $row['id']; ?>" class="fas fa-eye"></a>
                        <img src="uploaded_img/<?= $row['image_1']; ?>" alt="<?= $row['product_name']; ?>">
                        <div class="name"><?= $row['product_name']; ?></div>
                        <div class="container light-mode" id="content">
                           total amount: <span><?= $row['amount']; ?></span>
                        </div>
                        <div class="flex">
                           <div class="price">$<?= $row['price']; ?></div>
                           <input type="number" name="qty" class="qty" min="1" max="<?= $row['amount']; ?>" onkeydown="if(event.keyCode != 38 && event.keyCode != 40) return false;" value="1">
                        </div>
                        <input type="submit" value="Add to Cart" class="btn add-to-cart-btn" name="add_to_cart">
                     </form>
                  </div>
            <?php
               }
            } catch (PDOException $e) {
               // Handle database connection error
               echo '<p class="empty">No products added yet!</p>';
            }
            ?>
         </div>
         <div class="swiper-pagination"></div>
      </div>
   </section>




   <button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>

   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="js/script.js"></script>

   <script>
      document.addEventListener('DOMContentLoaded', function() {
         const scrollTextAlt = document.querySelector('.scroll-text-alt p');
         scrollTextAlt.innerHTML = scrollTextAlt.innerHTML + ' ' + scrollTextAlt.innerHTML + ' ' + scrollTextAlt.innerHTML; // Duplicate the text
      });
   </script>
   <script>
      AOS.init();
   </script>
   <script>
      var swiperHome = new Swiper(".home-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
      });


      var swiperProducts = new Swiper(".products-slider", {
         loop: false,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            550: {
               slidesPerView: 2,
            },
            768: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
      });
   </script>
   <script>
      // Add this JavaScript code at the end of your page, just before the closing </body> tag
      window.onscroll = function() {
         scrollFunction()
      };

      function scrollFunction() {
         if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("scrollToTopBtn").style.display = "block";
         } else {
            document.getElementById("scrollToTopBtn").style.display = "none";
         }
      }

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
   </script>
  <script>
      const dynamicText = document.querySelector("h1 span");
      const words = ["Welcome to Bema mall"];

      // Variables to track the position and deletion status of the word
      let wordIndex = 0;
      let charIndex = 0;
      let isDeleting = false;
      let animationPaused = false;

      const typeEffect = () => {
         if (!animationPaused) {
            const currentWord = words[wordIndex];
            const currentChar = currentWord.substring(0, charIndex);
            dynamicText.textContent = currentChar;
            dynamicText.classList.add("stop-blinking");

            if (!isDeleting && charIndex < currentWord.length) {
               // If condition is true, type the next character
               charIndex++;
               setTimeout(typeEffect, 200);
            } else if (isDeleting && charIndex > 0) {
               // If condition is true, remove the previous character
               charIndex--;
               setTimeout(typeEffect, 100);
            } else {
               // If word is deleted then switch to the next word
               isDeleting = !isDeleting;
               dynamicText.classList.remove("stop-blinking");
               wordIndex = !isDeleting ? (wordIndex + 1) % words.length : wordIndex;
               setTimeout(typeEffect, 1200);
            }
         }
      }

      typeEffect();

      // Pause typing animation on scroll
      window.addEventListener('scroll', function() {
         // Check if the user has scrolled down
         if (window.scrollY > 0) {
            animationPaused = true; // Pause the animation
         } else {
            animationPaused = false; // Resume the animation
            typeEffect(); // Restart typing animation if it was paused
         }
      });
   </script>
<script>
// JavaScript code to show and hide loader
document.onreadystatechange = function () {
   if (document.readyState === "loading") {
      showLoader();
   } else if (document.readyState === "interactive") {
      // Page partially loaded
   } else {
      hideLoader();
   }
};

window.addEventListener('load', function() {
    hideLoader();
});

function showLoader() {
   document.getElementById("loader").innerHTML = '<div class="loader"></div>';
}

function hideLoader() {
   document.getElementById("loader").style.display = "none";
}

</script>
</body>

</html>

