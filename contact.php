<?php

require 'components/connect.php';




session_start();

require 'components/prevention.php';


if(isset($_POST['send']) && isset($_POST['msg']) && isset($_POST['title'])){

   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);
   $title = $_POST['title'];
   $title = filter_var($msg, FILTER_SANITIZE_STRING);

   $user_id = $_SESSION['user_id'];
   

      $insert_message = $conn->prepare("INSERT INTO `tickets`(user_id, title, `subject`) VALUES(?,?,?)");
      $insert_message->execute([$user_id, $title, $msg]);

      $message[] = 'message sent successfully!';

   

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>


<section class="contact">

   <form action="" method="post">
      <h3>get in touch</h3>
      <input type="text"class="box" placeholder="enter the title" name="title">
      <textarea name="msg" class="box" placeholder="enter the subject" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>