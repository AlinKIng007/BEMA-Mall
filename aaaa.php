<?php

require 'components/connect.php';



require 'components/prevention.php';
session_start();

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.min.css'>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
 
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/aaaa.css">
    <style>


    </style>

<body>

    <?php include 'components/user_header.php'; ?>

    <div class="home-bg">

        <section class="home">
            <div class="swiper home-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="images/home-img-1.png" alt="">
                        </div>
                        <div class="content">
                            <span>upto 50% off</span>
                            <h3>latest smartphones</h3>
                            <a href="shop.php" class="btn">shop now</a>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="images/home-img-2.png" alt="">
                        </div>
                        <div class="content">
                            <span>upto 50% off</span>
                            <h3>latest watches</h3>
                            <a href="shop.php" class="btn">shop now</a>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="images/home-img-3.png" alt="">
                        </div>
                        <div class="content">
                            <span>upto 50% off</span>
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


    <section class="counter-section">
        <div class="container">
            <h2 class="section-title">Our Achievements</h2>
            <div class="counters">
                <div class="counter-item">
                    <h3>Happy Customers</h3>
                    <div class="count-container">
                        <p class="count" data-target="1000">0</p>
                    </div>
                </div>
                <div class="counter-item">
                    <h3>Products Sold</h3>
                    <div class="count-container">
                        <p class="count" data-target="5000">0</p>
                    </div>
                </div>
                <div class="counter-item">
                    <h3>Years in Business</h3>
                    <div class="count-container">
                        <p class="count" data-target="10">0</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="home-products">
        <h1 class="heading">Latest Products</h1>

        <div class="swiper products-slider">
            <div class="swiper-wrapper">
                <?php
                $select_products = $conn->prepare("SELECT DISTINCT p.id, p.price, m.product_name AS main_name, m.image_1 AS main_image 
            FROM `products` p
            INNER JOIN `main_products` m ON p.main_product_id = m.id
            LIMIT 6");

                $select_products->execute();

                if ($select_products->rowCount() > 0) {
                    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <form action="" method="post" class="swiper-slide slide">
                            <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                            <input type="hidden" name="name" value="<?= $fetch_product['main_name']; ?>">
                            <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                            <input type="hidden" name="image" value="<?= $fetch_product['main_image']; ?>">
                            <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                            <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                            <img src="uploaded_img/<?= $fetch_product['main_image']; ?>" alt="<?= $fetch_product['main_name']; ?>">
                            <div class="name"><?= $fetch_product['main_name']; ?></div>
                            <div class="flex">
                                <div class="price">
                                    <span>$</span>
                                    <?= $fetch_product['price']; ?>
                                </div>
                                <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                            </div>
                            <input type="submit" value="Add to Cart" class="btn" name="add_to_cart">
                        </form>
                <?php
                    }
                } else {
                    echo '<p class="empty">No products added yet!</p>';
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="featured-products">
        <h2 class="section-title">Featured Products</h2>
        <div class="products-container">
            <!-- Placeholder for product items -->
            <div class="product-item">
                <img src="https://via.placeholder.com/250" alt="Featured Product 1">
                <h3>Product Name 1</h3>
                <p>$Price</p>
                <a href="#" class="btn">View Product</a>
            </div>
            <!-- Repeat for other featured products -->
        </div>
    </section>








    <section class="testimonials">
        <h2 class="section-title">What Our Customers Say</h2>
        <div class="testimonials-container">
            <!-- Placeholder for testimonial items -->
            <div class="testimonial-item">
                <img src="https://via.placeholder.com/150" alt="Customer Name">
                <blockquote>
                    "This is the best product I have ever used. Highly recommend it to everyone!"
                </blockquote>
                <cite>- Customer Name</cite>
            </div>
            <!-- Repeat for other testimonials -->
        </div>
    </section>

    <section class="latest-news">
        <h2 class="section-title">Latest News</h2>
        <div class="news-container">
            <!-- Placeholder for news items -->
            <div class="news-item">
                <img src="https://via.placeholder.com/250" alt="News Title">
                <h3>News Title 1</h3>
                <p>Short description of the news article...</p>
                <a href="#" class="btn">Read More</a>
            </div>
            <div class="news-item">
                <img src="https://via.placeholder.com/250" alt="News Title">
                <h3>News Title 2</h3>
                <p>Short description of the news article...</p>
                <a href="#" class="btn">Read More</a>
            </div>
            <!-- Repeat for other news articles -->
        </div>
    </section>

    <section class="events-section" data-aos="fade-up" data-aos-duration="1000">
        <h2 class="section-title">Upcoming Events</h2>
        <div class="events-container">
            <!-- Placeholder for event items -->
            <div class="event-item">
                <img src="https://via.placeholder.com/250" alt="Event Title">
                <h3>Event Title 1</h3>
                <p>Date & Time: February 29, 2024, 6:00 PM</p>
                <p>Location: Event Location</p>
                <a href="#" class="btn">Register</a>
            </div>
            <!-- Repeat for other events -->
        </div>
    </section>

    <?php include 'components/footer.php'; ?>
   <!--button-->
            <button onclick="toggleBot()" id="chat-circle" class="chatBtn btn btn-raised">
            <div id="chat-overlay"></div>
 <svg height="1.6em" fill="white" xml:space="preserve" viewBox="0 0 1000 1000" y="0px" x="0px" version="1.1">
<path d="M881.1,720.5H434.7L173.3,941V720.5h-54.4C58.8,720.5,10,671.1,10,610.2v-441C10,108.4,58.8,59,118.9,59h762.2C941.2,59,990,108.4,990,169.3v441C990,671.1,941.2,720.5,881.1,720.5L881.1,720.5z M935.6,169.3c0-30.4-24.4-55.2-54.5-55.2H118.9c-30.1,0-54.5,24.7-54.5,55.2v441c0,30.4,24.4,55.1,54.5,55.1h54.4h54.4v110.3l163.3-110.2H500h381.1c30.1,0,54.5-24.7,54.5-55.1V169.3L935.6,169.3z M717.8,444.8c-30.1,0-54.4-24.7-54.4-55.1c0-30.4,24.3-55.2,54.4-55.2c30.1,0,54.5,24.7,54.5,55.2C772.2,420.2,747.8,444.8,717.8,444.8L717.8,444.8z M500,444.8c-30.1,0-54.4-24.7-54.4-55.1c0-30.4,24.3-55.2,54.4-55.2c30.1,0,54.4,24.7,54.4,55.2C554.4,420.2,530.1,444.8,500,444.8L500,444.8z M282.2,444.8c-30.1,0-54.5-24.7-54.5-55.1c0-30.4,24.4-55.2,54.5-55.2c30.1,0,54.4,24.7,54.4,55.2C336.7,420.2,312.3,444.8,282.2,444.8L282.2,444.8z"></path>
</svg>
<span class="tooltip">Chat</span>
</button>











    
    
    
    
    <div id="chate" class="chat" style="display:none";>
      <div class="chat-title">
          <div class="left">
        <h1>Chat BOt</h1>
        </div>
        <div class="right">
        <button onclick="toggleBot()"<h1>X</h1></button>
        </div>
        <h2>i am customer support chat bot</h2>
        <figure class="avatar">
          <img src="C:\\Users\\dell\\Desktop\\new\\logo.jpg"/></figure>
      </div>
      <div class="messages">
        <div class="messages-content"></div>
        <div class="suggession">
         
        </div>
      </div>
      <form class="message-box" id="mymsg" method="POST">
        <input type="text" id="MSG" name="MSG" class="message-input" placeholder="Type message..." >
       
        <i class="fas fa-microphone" id="start-record-btn"></i>
        <button type="submit" class="message-submit">Send</button>
      </form>
      <h3 class="no-browser-support" hidden>Sorry, Your Browser Doesn't Support the Web Speech API. Try Opening This Demo In Google Chrome.</h3>
    </div>
    <div class="bg">
    </div>
    
    </div>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.concat.min.js'></script>
      

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>


    <script>
        var swiper = new Swiper(".home-slider", {
            loop: false,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });


        var swiper = new Swiper(".products-slider", {
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
        document.addEventListener('DOMContentLoaded', function() {
            const scrollTextAlt = document.querySelector('.scroll-text-alt p');
            scrollTextAlt.innerHTML = scrollTextAlt.innerHTML + ' ' + scrollTextAlt.innerHTML + ' ' + scrollTextAlt.innerHTML; // Duplicate the text
        });
    </script>
    <script>
        AOS.init();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function animateCounters() {
                const counters = document.querySelectorAll('.count');

                counters.forEach(counter => {
                    const target = +counter.getAttribute('data-target');
                    const speed = 700; // Adjust animation speed as needed
                    const increment = target / speed;

                    let count = 0;

                    const updateCount = () => {
                        const value = Math.ceil(count);
                        counter.innerText = value;

                        if (count < target) {
                            count += increment;
                            setTimeout(updateCount, 1);
                        } else {
                            counter.innerText = target;
                            counter.parentElement.classList.add('completed');
                        }
                    };

                    updateCount();
                });
            }

            function runCounterAnimationOnce() {
                let hasAnimated = false;
                return function() {
                    if (!hasAnimated) {
                        animateCounters();
                        hasAnimated = true;
                    }
                };
            }

            const runCounterAnimation = runCounterAnimationOnce();
            window.addEventListener('scroll', runCounterAnimation);
            window.addEventListener('resize', runCounterAnimation);

            // Trigger animation when counter section comes into view
            const counterSection = document.querySelector('.counter-section');
            const sectionPosition = counterSection.offsetTop;
            const windowHeight = window.innerHeight;

            function checkAnimation() {
                const scrollPosition = window.scrollY + windowHeight;

                if (scrollPosition > sectionPosition) {
                    document.querySelectorAll('.counter-item').forEach(item => {
                        item.classList.add('active');
                    });
                }
            }

            window.addEventListener('scroll', checkAnimation);
        });
    </script>

<script>
    function toggleBot(){
    console.log("hiii");
      console.log("hello");
        $(".chat").toggle();
     
    }
    </script>
    
        
    </body>
    <script>
        
var $messages = $('.messages-content');
var serverResponse = "wala";


var suggession;
//speech reco
try {
  var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
  var recognition = new SpeechRecognition();
}
catch(e) {
  console.error(e);
  $('.no-browser-support').show();
}

$('#start-record-btn').on('click', function(e) {
  recognition.start();
});

recognition.onresult = (event) => {
  const speechToText = event.results[0][0].transcript;
 document.getElementById("MSG").value= speechToText;
  //console.log(speechToText)
  insertMessage()
}


function listendom(no){
  console.log(no)
  //console.log(document.getElementById(no))
document.getElementById("MSG").value= no.innerHTML;
  insertMessage();
}

$(window).load(function() {
  $messages.mCustomScrollbar();
  setTimeout(function() {
    serverMessage("hello i am candy,how can I help you.");
  }, 100);

});

function updateScrollbar() {
  $messages.mCustomScrollbar("update").mCustomScrollbar('scrollTo', 'bottom', {
    scrollInertia: 10,
    timeout: 0
  });
}



function insertMessage() {
  msg = $('.message-input').val();
  if ($.trim(msg) == '') {
    return false;
  }
  $('<div class="message message-personal">' + msg + '</div>').appendTo($('.mCSB_container')).addClass('new');
  // fetchmsg() 
  
  $('.message-input').val(null);
  updateScrollbar();

}

document.getElementById("mymsg").onsubmit = (e)=>{
  e.preventDefault() 
  insertMessage();
  serverMessage("hello");
  speechSynthesis.speak( new SpeechSynthesisUtterance("hello"))
}

function serverMessage(response2) {


  if ($('.message-input').val() != '') {
    return false;
  }
  $('<div class="message loading new"><figure class="avatar"><img src="C:\\Users\\dell\\Desktop\\new\\logo.jpg" /></figure><span></span></div>').appendTo($('.mCSB_container'));
  updateScrollbar();
  

  setTimeout(function() {
    $('.message.loading').remove();
    $('<div class="message new"><figure class="avatar"><img src="C:\\Users\\dell\\Desktop\\new\\logo.jpg" /></figure>' + response2 + '</div>').appendTo($('.mCSB_container')).addClass('new');
    updateScrollbar();
  }, 100 + (Math.random() * 20) * 100);

}


function fetchmsg(){

     var url = 'http://localhost:5000/send-msg';
      
      const data = new URLSearchParams();
      for (const pair of new FormData(document.getElementById("mymsg"))) {
          data.append(pair[0], pair[1]);
          console.log(pair)
      }
    
      console.log("abc",data)
        fetch(url, {
          method: 'POST',
          body:data
        }).then(res => res.json())
         .then(response => {
          console.log(response);
        //  serverMessage(response.Reply);
          speechSynthesis.speak( new SpeechSynthesisUtterance(response.Reply))
        
          
         })
          .catch(error => console.error('Error h:', error));

}

    </script>
</body>

</html>