<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `customer` WHERE customerid = ?");
   $delete_users->execute([$delete_id]);
   header('location:admin_users.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="user-accounts">

   <h1 class="title">customer accounts</h1>

   <div class="box-container">

      <?php
         $select_users = $conn->prepare("SELECT * FROM `customer`");
         $select_users->execute();
         while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box">
        
         <p> CUSTOMER ID : <span><?= $fetch_users['customerid']; ?></span></p>
         <p> NAME : <span><?= $fetch_users['fname']; ?> <?= $fetch_users['lname']; ?></span> </p>
         <p> CONTACT NO : <span><?= $fetch_users['contactno']; ?></span> </p>
         <p> EMAIL : <span><?= $fetch_users['email']; ?></span> </p>
         <a href="admin_users.php?delete=<?= $fetch_users['customerid']; ?>" onclick="return confirm('DELETE THIS USER?');" class="delete-btn">delete</a>
      </div>
      <?php
      }
      ?>
   </div>

</section>













<script src="js/script.js"></script>

</body>
</html>