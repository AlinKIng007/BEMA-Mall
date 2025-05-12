<?php
require 'components/connect.php';
session_start();


if (isset($_POST['user']) && isset($_POST['pass'])) {
  $userinput = $_POST['user'];
  $passinput = $_POST['pass'];
  $select_salt = $conn->prepare("
  SELECT
	departments.mall_id AS mall_id,
	COALESCE ( titles.allowance, 0 ) AS role_id,
	users.id AS id,
	users.username AS username,
	users.email AS email,
	users.salt AS salt,
	users.hash AS hash,
  employees.id as emp_id 
FROM
	users
	LEFT JOIN employees ON users.id = employees.user_id
	LEFT JOIN roles ON employees.id = roles.employee_id
	LEFT JOIN titles ON roles.title_id = titles.id
	LEFT JOIN department_employee ON employees.id = department_employee.employee_id
	LEFT JOIN departments ON department_employee.department_id = departments.id 
WHERE
  username = ? or email = ?;
  ");
  $select_salt->execute([$userinput, $userinput]); // Pass an array containing the user input twice
  $salt_row = $select_salt->fetch(PDO::FETCH_ASSOC);
  if ($select_salt->rowCount() > 0) {


    $hash = $salt_row['hash'];
    $salt = $salt_row['salt'];
    $user_id = $salt_row['id'];
    $role_id = $salt_row['role_id'];

    // Combine salt, password, and a pepper string
    $fullhash = $salt . $passinput . "G>;5jc}$6MyVeJk42~N<";
    // Verify the password
    if (password_verify($fullhash, $hash)) {

      $_SESSION['user_id'] = $user_id;
      $_SESSION['username'] = $userinput;
      $_SESSION['role_id'] = $role_id;
      $_SESSION['mall_id'] = 1;
      if (isset($salt_row['mall_id']) && $role_id == 1) {
        $_SESSION['mall_id'] = $salt_row['mall_id'];
        $_SESSION['is_emp'] = 1;
        $_SESSION['emp_id'] = $salt_row['emp_id'];
      } elseif (isset($salt_row['mall_id'])) {
        $_SESSION['mall_id'] = $salt_row['mall_id'];
        $_SESSION['is_emp'] = 0;
        $_SESSION['emp_id'] = $salt_row['emp_id'];
      } else {
        $_SESSION['mall_id'] = 1;
        $_SESSION['is_emp'] = 0;
        $_SESSION['emp_id'] = $salt_row['emp_id'];
      }


      if ($role_id === 4 || $role_id === 5) {
        header('location:admin/dashboard.php');
        exit(); // Always exit after redirecting

      } elseif (isset($role_id) && $role_id <= 0) {
        header('location:home.php');
        exit(); // Always exit after redirecting
      }elseif (isset($role_id) && $role_id === 1) {
        header('location:cashier.php');
        exit(); // Always exit after redirecting
      }
       else {
       
        // Display popup message using JavaScript
        echo '<script>document.getElementById("loginForm").insertAdjacentHTML("afterend", "<div style=\'color: red;\'>Username or password is wrong</div>");</script>';
      }
    }
  } else {
    // Display popup message using JavaScript
    echo '<script>document.getElementById("loginForm").insertAdjacentHTML("afterend", "<div style=\'color: red;\'>Username or password is wrong</div>");</script>';
  }
}
?>


<!DOCTYPE html>

<html lang="en" dir="ltr">

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
      background: -webkit-linear-gradient(bottom, orange, rgb(255, 217, 0));
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

    #signup-button {
      text-decoration: none;
      color: orangered;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="container">
    <header>Login Form</header>
    <div class="form-outer">
      <form id="loginForm" method="post">
        <div class="page slide-page">
          <div class="title">
            Enter your information:
          </div>
          <div class="field">
            <div class="label">
              Username
            </div>
            <input type="text" name="user">
          </div>
          <div class="field">
            <div class="label">
              Password
            </div>
            <input type="password" name="pass">
          </div>
          <div class="field">
            <button class="submit">Login</button>

          </div>
          <div class="signup-link">
            Not a Member Already? <a id="signup-button" href="signup.php">Signup now</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script>
    const slidePage = document.querySelector(".slide-page");
    const submitBtn = document.querySelector(".submit");

    submitBtn.addEventListener("click", function() {
      setTimeout(function() {
        alert("Login successful!");
        location.reload();
      }, 800);
    });
    const errorMessage = '<?php echo isset($_POST["user"]) && isset($_POST["pass"]) ? "<div style=\'color: red;\'>Username or password is wrong</div>" : "" ?>';

    // Insert error message after the form
    document.getElementById("loginForm").insertAdjacentHTML("afterend", errorMessage);
  </script>
</body>

</html>