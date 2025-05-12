<?php

require 'components/connect.php';




session_start();

require 'components/prevention.php';

$role_id = $_SESSION['role_id'];
$username = $_SESSION['username'];

// if(!isset($role_id)){
//    header('location:dashboard.php');
// };

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   

   $get_data = $conn->prepare("SELECT * FROM `users` WHERE username = ? and hash = ?");
   $get_data->execute([$name,$old_pass]);
   $row = $get_data->rowCount();
if(isset($row)){
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

if($new_pass != $confirm_pass){
      $message[] = 'confirm password not matched!';
   }elseif($new_pass != $old_pass){
         $update_admin_pass = $conn->prepare("UPDATE `users` SET hash = ? WHERE username = ?");
         $update_admin_pass->execute([$confirm_pass, $name]);
         $message[] = 'password updated successfully!';
   }
      else{
         $message[] = 'please enter a new password!';
      }
   }
}
   



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>update profile</h3>
      <input type="text" name="name" value="<?= $username ?>" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="old_pass" placeholder="enter old password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="enter new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="confirm_pass" placeholder="confirm new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="update now" class="btn" name="submit">
   </form>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>