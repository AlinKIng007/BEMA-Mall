<?php
require 'components/connect.php';
session_start();

if (
  isset($_POST['firstName']) &&
  isset($_POST['lastName']) &&
  isset($_POST['email']) &&
  isset($_POST['phone']) &&
  isset($_POST['city']) &&
  isset($_POST['country']) &&
  isset($_POST['address']) &&
  isset($_POST['zip']) &&
  isset($_POST['username']) &&
  isset($_POST['password'])
) {
  // Assign form values to variables
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $city = $_POST['city'];
  $country = $_POST['country'];
  $address = $_POST['address'];
  $zip = $_POST['zip'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $check_user = $conn->prepare("SELECT id FROM `users` WHERE email = ? OR username = ?");
  $check_user->execute([$email, $username]);
  $check_row = $check_user->fetch(PDO::FETCH_ASSOC);
  
  if ($check_row) {
    echo "<script>alert('Username and/or Email Already Taken');</script>";

  } else {    
      $salt = bin2hex(random_bytes(10));
      $options = ['cost' => 12];
      $peper = "G>;5jc}$6MyVeJk42~N<";
      $readypass = $salt . $password . $peper;
      $hash = password_hash($readypass, PASSWORD_BCRYPT, $options);
  
      // Insert user data into the database
      $insert_user = $conn->prepare("INSERT INTO `users` (first_name, last_name, email, phone_number, city, country_id, address, zip_code, username, hash, salt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $insert_user->execute([$firstName, $lastName, $email, $phone, $city, $country, $address, $zip, $username, $hash, $salt]);
  
      // Fetch the user ID of the newly inserted user
      $user_id = $conn->lastInsertId();
  
      // Store user details in session and redirect to home page
      $_SESSION['user_id'] = $user_id;
      $_SESSION['username'] = $username;
      $_SESSION['role_id'] = 0;
      $_SESSION['mall_id'] = 1;
      header("location: home.php");
      exit();
  }
}
?>

<!DOCTYPE html <html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>bema mall</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    * {
      margin: 0;
      padding: 0;
      outline: none;
      font-family: 'Poppins', sans-serif;
    }

    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      overflow: hidden;
      background: url("bg.png"), -webkit-linear-gradient(bottom, orange, rgb(255, 217, 0));
    }

    ::selection {
      color: #fff;
      background: orange;
    }

    .container {
      width: 330px;
      background: #fff;
      text-align: center;
      border-radius: 5px;
      padding: 50px 35px 10px 35px;
    }

    .container header {
      font-size: 35px;
      font-weight: 600;
      margin: 0 0 30px 0;
    }

    .container .form-outer {
      width: 100%;
      overflow: hidden;
    }

    .container .form-outer form {
      display: flex;
      width: 400%;
    }

    .form-outer form .page {
      width: 25%;
      transition: margin-left 0.3s ease-in-out;
    }

    .form-outer form .page .title {
      text-align: left;
      font-size: 25px;
      font-weight: 500;
    }

    .form-outer form .page .field {
      width: 330px;
      height: 45px;
      margin: 45px 0;
      display: flex;
      position: relative;
    }

    form .page .field .label {
      position: absolute;
      top: -30px;
      font-weight: 500;
    }

    form .page .field input {
      height: 100%;
      width: 100%;
      border: 1px solid lightgrey;
      border-radius: 5px;
      padding-left: 15px;
      font-size: 18px;
    }

    form .page .field button {
      width: 100%;
      height: calc(100% + 5px);
      border: none;
      background: orange;
      margin-top: -20px;
      border-radius: 5px;
      color: #333;
      cursor: pointer;
      font-size: 18px;
      font-weight: 500;
      letter-spacing: 1px;
      text-transform: uppercase;
      transition: 0.5s ease;
    }

    form .page .field button:hover {
      background: #333;
      color: orange;
    }

    form .page .btns button {
      margin-top: -20px !important;
    }

    form .page .btns button.prev {
      margin-right: 3px;
      font-size: 17px;
    }

    form .page .btns button.next {
      margin-left: 3px;
    }

    .container .progress-bar {
      display: flex;
      margin: 40px 0;
      user-select: none;
    }

    .container .progress-bar .step {
      text-align: center;
      width: 100%;
      position: relative;
    }

    .container .progress-bar .step p {
      font-weight: 500;
      font-size: 18px;
      color: #000;
      margin-bottom: 8px;
    }

    .progress-bar .step .bullet {
      height: 25px;
      width: 25px;
      border: 2px solid #000;
      display: inline-block;
      border-radius: 50%;
      position: relative;
      transition: 0.2s;
      font-weight: 500;
      font-size: 17px;
      line-height: 25px;
    }

    .progress-bar .step .bullet.active {
      border-color: orange;
      background: orange;
    }

    .progress-bar .step .bullet span {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }

    .progress-bar .step .bullet.active span {
      display: none;
    }

    .progress-bar .step .bullet:before,
    .progress-bar .step .bullet:after {
      position: absolute;
      content: '';
      bottom: 11px;
      right: -51px;
      height: 3px;
      width: 44px;
      background: #262626;
    }

    .progress-bar .step .bullet.active:after {
      background: orange;
      transform: scaleX(0);
      transform-origin: left;
      animation: animate 0.3s linear forwards;
    }

    @keyframes animate {
      100% {
        transform: scaleX(1);
      }
    }

    .progress-bar .step:last-child .bullet:before,
    .progress-bar .step:last-child .bullet:after {
      display: none;
    }

    .progress-bar .step p.active {
      color: orange;
      transition: 0.2s linear;
    }

    .progress-bar .step .check {
      position: absolute;
      left: 50%;
      top: 77%;
      font-size: 15px;
      transform: translate(-50%, -50%);
      display: none;
    }

    .progress-bar .step .check.active {
      display: block;
      color: #fff;
    }
    #login-button{
      text-decoration: none;
      color: orangered;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="container">

    <header>Signup Form <br>
    <span style="display: none; color: red; font-family: 'Courier New', Courier, monospace; font-weight: bolder; font-size:15px;" id="error">Fill All of the Fields First!</span>
  </header>

    <div class="progress-bar">
      <div class="step">
        <p>
          Name
        </p>
        <div class="bullet">
          <span>1</span>
        </div>
        <div class="check fas fa-check"></div>
      </div>
      <div class="step">
        <p>
          Contact
        </p>
        <div class="bullet">
          <span>2</span>
        </div>
        <div class="check fas fa-check"></div>
      </div>
      <div class="step">
        <p>
          Address
        </p>
        <div class="bullet">
          <span>3</span>
        </div>
        <div class="check fas fa-check"></div>
      </div>
      <div class="step">
        <p>
          Submit
        </p>
        <div class="bullet">
          <span>4</span>
        </div>
        <div class="check fas fa-check"></div>
      </div>
    </div>




    <div class="form-outer">
      <form id="signupForm" method="post">
        <div class="page slide-page">
          <div class="title">
            Basic Info:
          </div>
          <div class="field">
            <div class="label">
              First Name
            </div>
            <input type="text" name="firstName" onclick="hideError()">
          </div>
          <div class="field">
            <div class="label">
              Last Name
            </div>
            <input type="text" name="lastName" onclick="hideError()">
          </div>

          <div class="field">
            <button class="firstNext next">Next</button>
          </div>
        </div>
        <div class="page">
          <div class="title">
            Contact Info:
          </div>
          <div class="field">
            <div class="label">
              Email Address
            </div>
            <input type="email" name="email" onclick="hideError()">
          </div>
          <div class="field">
            <div class="label">
              Phone Number
            </div>
            <input type="phone" name="phone" onclick="hideError()">
          </div>




          <div class="field btns">
            <button class="prev-1 prev">Previous</button>
            <button class="next-1 next">Next</button>
          </div>
        </div>
        <div class="page">
          <div class="title">
            address information
          </div>
          <div class="field">
            <div class="label">
              City and Country
            </div>
            <input type="text" name="city" onclick="hideError()">
            <select name="country">
            <?php
                        // Fetch methods from the database and populate the dropdown
                        try {
                            $select_country = $conn->prepare("select id,name from countries order by name asc");
                            $select_country->execute();
                            while ($fetch_country = $select_country->fetch(PDO::FETCH_ASSOC)) {
                                $country_id = $fetch_country["id"];
                                $country_name = $fetch_country["name"];
                                // Set the selected attribute if it matches the previously selected method
                                echo "<option style='text-align:center;' value='$country_id'>$country_name</option>";
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>
            </select>
          </div>
          <div class="field">
            <div class="label">
              Address and Zip Code
            </div>
            <input type="text" name="address" onclick="hideError()">
            <input type="text" name="zip" onclick="hideError()">
          </div>
          <div class="field btns">
            <button class="prev-2 prev">Previous</button>
            <button class="next-2 next">Next</button>
          </div>
        </div>
        <div class="page">
          <div class="title">
            Login Details:
          </div>
          <div class="field">
            <div class="label">
              Username
            </div>
            <input type="text" name="username" onclick="hideError()">
          </div>
          <div class="field">
            <div class="label">
              Password
            </div>
            <input type="password" name="password" onclick="hideError()">
          </div>
          <div class="field btns">
            <button class="prev-3 prev">Previous</button>
            <button class="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
    <div class="signup-link">
            Already a Member? <a id="login-button" href="login.php">Login now</a>
          </div>
  </div>
  <script>
    const slidePage = document.querySelector(".slide-page");
    const nextBtnFirst = document.querySelector(".firstNext");
    const prevBtnSec = document.querySelector(".prev-1");
    const nextBtnSec = document.querySelector(".next-1");
    const prevBtnThird = document.querySelector(".prev-2");
    const nextBtnThird = document.querySelector(".next-2");
    const prevBtnFourth = document.querySelector(".prev-3");
    const submitBtn = document.querySelector(".submit");
    const progressText = document.querySelectorAll(".step p");
    const progressCheck = document.querySelectorAll(".step .check");
    const bullet = document.querySelectorAll(".step .bullet");
    let current = 1;

    nextBtnFirst.addEventListener("click", function(event) {
      event.preventDefault();
      if (validateForm(current)) {
        slidePage.style.marginLeft = "-25%";
        bullet[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");
        current += 1;
      }
    });

    nextBtnSec.addEventListener("click", function(event) {
      event.preventDefault();
      if (validateForm(current)) {
        slidePage.style.marginLeft = "-50%";
        bullet[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");
        current += 1;
      }
    });

    nextBtnThird.addEventListener("click", function(event) {
      event.preventDefault();
      if (validateForm(current)) {
        slidePage.style.marginLeft = "-75%";
        bullet[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");
        current += 1;
      }
    });

    submitBtn.addEventListener("click", function(event) {
      event.preventDefault();
      if (validateForm(current)) {
        bullet[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");
        current += 1;
        setTimeout(function() {

          var form = document.getElementById("signupForm");

          form.submit();
        }, 800);
      }
    });

    prevBtnSec.addEventListener("click", function(event) {
      event.preventDefault();
      slidePage.style.marginLeft = "0%";
      bullet[current - 2].classList.remove("active");
      progressCheck[current - 2].classList.remove("active");
      progressText[current - 2].classList.remove("active");
      current -= 1;
    });

    prevBtnThird.addEventListener("click", function(event) {
      event.preventDefault();
      slidePage.style.marginLeft = "-25%";
      bullet[current - 2].classList.remove("active");
      progressCheck[current - 2].classList.remove("active");
      progressText[current - 2].classList.remove("active");
      current -= 1;
    });

    prevBtnFourth.addEventListener("click", function(event) {
      event.preventDefault();
      slidePage.style.marginLeft = "-50%";
      bullet[current - 2].classList.remove("active");
      progressCheck[current - 2].classList.remove("active");
      progressText[current - 2].classList.remove("active");
      current -= 1;
    });

    function validateForm(step) {
      let isValid = true;
      const form = document.getElementById("signupForm");
      const inputs = form.querySelectorAll(".page:nth-child(" + step + ") input");
      inputs.forEach(input => {
        if (input.value.trim() === "") {
          isValid = false;
          showError();
        }
      });
      return isValid;
    }

    document.getElementById("phone").addEventListener("keydown", function(event) {
      // Allow: backspace, delete, tab, escape, enter, and .
      if ([46, 8, 9, 27, 13, 110, 190].includes(event.keyCode) ||
        // Allow: Ctrl+A, Command+A
        (event.keyCode == 65 && (event.ctrlKey === true || event.metaKey === true)) ||
        // Allow: home, end, left, right, down, up
        (event.keyCode >= 35 && event.keyCode <= 40)) {
        // Let it happen, don't do anything
        return;
      }
      // Ensure that it is a number and stop the keypress
      if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) &&
        (event.keyCode < 96 || event.keyCode > 105)) {
        event.preventDefault();
      }
    });


    // Show the error message
    function showError() {
      document.getElementById("error").style.display = "block";
    }

    // Hide the error message
    function hideError() {
      document.getElementById("error").style.display = "none";
    }

  </script>
</body>

</html>