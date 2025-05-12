<?php

require 'components/connect.php';




session_start();

require 'components/prevention.php';

if($selected_mall === 0){
  $selected_mall = 1;
}else{
$selected_mall = $_POST['selected_mall'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-s~cale=1.0">
  <title>Octoberfest</title>
  <link href="https://fonts.googleapis.com/css?family=Courgette|Open+Sans&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="css/styles.css">
</head>
<style>

body, html {
      margin: 0;
      padding: 0;
      height: 100%;
    }

    .container {
      height: 100%;
      overflow: auto;
    }






  .alert-container {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 20px;
  background-color: #ffffff;
  border: 1px solid #cccccc;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  z-index: 9999;
}

.alert {
  font-family: Arial, sans-serif;
  font-size: 16px;
  color: #333333;
}

.alert-title {
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 10px;
}

.alert-buttons {
  margin-top: 20px;
}

.alert-buttons button {
  padding: 10px 20px;
  margin-right: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.alert-buttons button.ok {
  background-color: #4caf50;
  color: #ffffff;
}

.alert-buttons button.cancel {
  background-color: #f44336;
  color: #ffffff;
}



.button-87 {
  margin: 10px;
  padding: 15px 30px;
  text-align: center;
  text-transform: uppercase;
  transition: 0.5s;
  background-size: 200% auto;
  color: white;
  border-radius: 10px;
  display: block;
  border: 0px;
  font-weight: 700;
  box-shadow: 0px 0px 14px -7px #f09819;
  background-image: linear-gradient(45deg, #FF512F 0%, #F09819  51%, #FF512F  100%);
  cursor: pointer;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-87:hover {
  background-position: right center;
  /* change the direction of the change here */
  color: #fff;
  text-decoration: none;
}

.button-87:active {
  transform: scale(0.95);
}











/* select mall */
.popup {
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  backdrop-filter: blur(10px); /* Adjust the blur radius as needed */
  -webkit-backdrop-filter: blur(10px); /* For Safari */
  background-color: rgba(0, 0, 0, 0); /* Transparent background */
  z-index: 9999;
  animation: fadeIn 0.5s ease forwards;
}



.popup-content {
  background-color: #333;
  width: 700px;
  padding: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) scale(0.8);
  animation: scaleIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
}

.popup-content h2 {
  color: #333;
  text-align: center;
  font-size: 28px;
  margin-bottom: 20px;
}


  #mallSelector {
  width: 100%;
  padding: 15px;
  margin-bottom: 30px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

#confirmSelectionBtn {
  margin: 10px;
  padding: 15px 30px;
  text-align: center;
  text-transform: uppercase;
  transition: 0.5s;
  background-size: 200% auto;
  color: white;
  border-radius: 10px;
  display: block;
  border: 0px;
  font-weight: 700;
  box-shadow: 0px 0px 14px -7px #f09819;
  background-image: linear-gradient(45deg, #FF512F 0%, #F09819  51%, #FF512F  100%);
  cursor: pointer;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

#confirmSelectionBtn:hover {
  background-color: #45a049;
}



.popup-content .close {
  font-size: 24px; /* Increase the font size */
  padding: 5px; /* Add padding to*/
}

@keyframes scaleIn {
  from {
    transform: translate(-50%, -50%) scale(0.8);
  }
  to {
    transform: translate(-50%, -50%) scale(1);
  }
}
@media only screen and (max-width: 768px) {
      /* Adjustments for smaller devices */
      .gallery {
        flex-direction: column;
        align-items: center;
      }

      .button-87 {
        margin: 10px 0;
      }

      .card {
        margin-bottom: 20px;
      }

      .leaf,
      .leaf1,
      .leaf2 {
        display: none;
      }
    }
option{
  color:orange;
  background-color: #333;

}
#mallSelector option:hover {
    background-color: red; /* Change to whatever color you desire */
  }



</style>
<body>

 
<section>

  <div class="leaf">
    <div><img src="http://www.pngmart.com/files/1/Fall-Autumn-Leaves-Transparent-PNG.png" height="75px" width="75px"></div>
    <div><img src="http://www.pngmart.com/files/1/Autumn-Fall-Leaves-Pictures-Collage-PNG.png" height="75px" width="75px"></div>
    <div><img src="http://www.pngmart.com/files/1/Autumn-Fall-Leaves-Clip-Art-PNG.png" height="75px" width="75px"></div>
    <div><img src="http://www.pngmart.com/files/1/Green-Leaves-PNG-File.png" height="75px" width="75px"></div>
    <div><img src="http://www.pngmart.com/files/1/Realistic-Autumn-Fall-Leaves-PNG.png" height="75px" width="75px"></div>
    

  </div>

  <div class="leaf leaf1">
    <div><img src="http://www.pngmart.com/files/1/Fall-Autumn-Leaves-Transparent-PNG.png" height="75px" width="75px"></div>
    <div><img src="http://www.pngmart.com/files/1/Autumn-Fall-Leaves-Pictures-Collage-PNG.png" height="75px" width="75px"></div>
    <div><img src="http://www.pngmart.com/files/1/Autumn-Fall-Leaves-Clip-Art-PNG.png" height="75px" width="75px"></div>
    <div><img src="http://www.pngmart.com/files/1/Green-Leaves-PNG-File.png" height="75px" width="75px"></div>
    <div><img src="http://www.pngmart.com/files/1/Transparent-Autumn-Leaves-Falling-PNG.png" height="75px" width="75px"></div>
    <div><img src="http://www.pngmart.com/files/1/Realistic-Autumn-Fall-Leaves-PNG.png" height="75px" width="75px"></div>
  </div>

  <div class="leaf leaf2">
    <div><img src="http://www.pngmart.com/files/1/Fall-Autumn-Leaves-Transparent-PNG.png" height="75px" width="75px"></div>
    <div><img src="http://www.pngmart.com/files/1/Autumn-Fall-Leaves-Pictures-Collage-PNG.png" height="75px" width="75px"></div>
    <div><img src="http://www.pngmart.com/files/1/Autumn-Fall-Leaves-Clip-Art-PNG.png" height="75px" width="75px"></div>
    <div><img src="http://www.pngmart.com/files/1/Green-Leaves-PNG-File.png" height="75px" width="75px"></div>
    <div><img src="http://www.pngmart.com/files/1/Realistic-Autumn-Fall-Leaves-PNG.png" height="75px" width="75px"></div>
  </div>

</section>


<!-- Popup for mall selection -->
<div class="popup" id="mallSelectionPopup">
  <div class="popup-content">
    <span class="close" id="closePopup" style="cursor: pointer;">&times;</span>
    <h1>Select Mall</h1>
    <select id="mallSelector">
      <?php
        // Fetch malls from the database and populate the dropdown
        try {
            $select_malls = $conn->prepare("SELECT id, mall_name FROM `malls` where has_2d = 1");
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
    <button id="confirmSelectionBtn">Confirm</button>
  </div>
</div>

<!-- JavaScript to handle the selection and display of the selected mall name -->
<script>


document.getElementById("closePopup").addEventListener("click", function() {
  window.location.href = "home.php";
});

document.getElementById("confirmSelectionBtn").addEventListener("click", function() {
  var selectedMallId = document.getElementById("mallSelector").value;
  if (selectedMallId === "") {
    alert("Please select a mall before proceeding.");
    return;
  }
  // Redirect the user to the selected mall page
  window.location.href = "2dMall" + selectedMallId + ".php";
});

</script>


</body>








</html>