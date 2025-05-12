<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    @keyframes slideInFromLeft {
        0% {
            transform: translateX(-100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideInFromRight {
        0% {
            transform: translateX(100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideInFromBottom {
        0% {
            transform: translateY(100%);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }
    


    .footer {
        opacity: 0; /* Start footer as invisible */
        animation-fill-mode: forwards;
        animation-duration: 1s; /* Adjust duration to control speed */
        animation-name: slideInFromBottom; /* Animation for footer */
    }

    .footer .box {
        opacity: 0; /* Start elements as invisible */
        animation-fill-mode: forwards;
        animation-duration: 1s; /* Adjust duration to control speed */
    }

    /* Apply different animations to each box */
    .footer .box:nth-child(1) {
        animation-name: slideInFromLeft;
        animation-delay: 0.2s; /* Delay to stagger the animations */
    }

    .footer .box:nth-child(2) {
        animation-name: slideInFromBottom;
        animation-delay: 0.4s;
    }

    .footer .box:nth-child(3) {
        animation-name: slideInFromBottom;
        animation-delay: 0.6s;
    }

    .footer .box:nth-child(4) {
        animation-name: slideInFromRight;
        animation-delay: 0.8s;
    }

</style>




<meta name="viewport" content="width=device-width, initial-scale=1.0">
<footer class="footer">

   <section class="grid">

      <div class="box">
         <h3>quick links</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
         <a href="shop.php"> <i class="fas fa-angle-right"></i> shop</a>
         <a href="contact.php"> <i class="fas fa-angle-right"></i> contact</a>
      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="login.php"> <i class="fas fa-angle-right"></i> login</a>
         <a href="signup.php"> <i class="fas fa-angle-right"></i> register</a>
         <a href="cart.php"> <i class="fas fa-angle-right"></i> cart</a>
         <a href="orders.php"> <i class="fas fa-angle-right"></i> orders</a>
      </div>

      <div class="box">
         <h3>contact us</h3>
         <a href="#"><i class="fas fa-phone"></i> +123 456 7899</a>
         <a href="#"><i class="fas fa-phone"></i> +111 222 3333</a>
         <a href="bemamall@gmail.com"><i class="fas fa-envelope"></i> bemamall@gmail.com</a>
         <a href="#"><i class="fas fa-map-marker-alt"></i> Erbil Iraq </a>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#"><i class="fab fa-facebook-f"></i>facebook</a>
         <a href="#"><i class="fab fa-twitter"></i>twitter</a>
         <a href="#"><i class="fab fa-instagram"></i>instagram</a>
         <a href="#"><i class="fab fa-linkedin"></i>linkedin</a>
      </div>

   </section>



</footer>

</body>

</html>