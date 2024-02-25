<?php

@include 'config.php';

session_start();

  $admin_id = $_SESSION['admin_id'];

 if(!isset($admin_id)){
    header('location:admin_login.php');
 };


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

 
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>


<body>

<?php include 'admin_header.php'; ?>


<section class="dashboard">

<h1 class="title">dashboard</h1>

<div class="box-container">

   <div class="box">
   <?php
      $total_pendings = 0;
      $select_pendings = $conn->prepare("SELECT * FROM `payment` WHERE paymentstatus = ?");
      $select_pendings->execute(['pending']);
      while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
         $total_pendings += $fetch_pendings['ordertotal'];
      };
   ?>
   <h3>₱<?= $total_pendings; ?>/-</h3>
   <p>TOTAL PENDINGS</p>
   <a href="admin_orders.php" class="btn">See Orders</a>
   </div>

   <div class="box">
   <?php
      $total_completed = 0;
      $select_completed = $conn->prepare("SELECT * FROM `payment` WHERE paymentstatus = ?");
      $select_completed->execute(['paid']);
      while($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)){
         $total_completed += $fetch_completed['ordertotal'];
      };
   ?>
   <h3>₱<?= $total_completed; ?>/-</h3>
   <p>COMPLETED ORDERS</p>
   <a href="admin_orders.php" class="btn">See Orders</a>
   </div>

   <div class="box">
   <?php
      $select_orders = $conn->prepare("SELECT * FROM `order`");
      $select_orders->execute();
      $number_of_orders = $select_orders->rowCount();
   ?>
   <h3><?= $number_of_orders; ?></h3>
   <p>ORDERS PLACED</p>
   <a href="admin_orders.php" class="btn">See Orders</a>
   </div>

   <div class="box">
   <?php
      $select_products = $conn->prepare("SELECT * FROM `product`");
      $select_products->execute();
      $number_of_products = $select_products->rowCount();
   ?>
   <h3><?= $number_of_products; ?></h3>
   <p>PRODUCTS ADDED</p>
   <a href="admin_products.php" class="btn">See Products</a>
   </div>

   <div class="box">
   <?php
      $select_users = $conn->prepare("SELECT * FROM `customer`");
      $select_users->execute();
      $number_of_users = $select_users->rowCount();
   ?>
   <h3><?= $number_of_users; ?></h3>
   <p>TOTAL CUSTOMER</p>
   <a href="admin_users.php" class="btn">See Accounts</a>
   </div>

   <div class="box">
   <?php
      $select_admins = $conn->prepare("SELECT * FROM `admin`");
      $select_admins->execute();
      $number_of_admins = $select_admins->rowCount();
   ?>
   <h3><?= $number_of_admins; ?></h3>
   <p>TOTAL ADMINS</p>
   <a href="admin_users.php" class="btn">See Accounts</a>
   </div>

   <div class="box">
   <?php

         $select_counts = $conn->prepare("
         SELECT 'customer' AS account_type, COUNT(*) AS account_count FROM `customer`
         UNION
         SELECT 'admin' AS account_type, COUNT(*) AS account_count FROM `admin`
      ");
      $select_counts->execute();
      $total_count = 0;
      while ($row = $select_counts->fetch()) {
         $account_type = $row['account_type'];
         $account_count = $row['account_count'];
         $total_count += $account_count;
      }
         ?>
         <h3><?= $total_count; ?></h3>
         <p>TOTAL ACCOUNTS</p>
         <a href="admin_users.php" class="btn">See Accounts</a>
         </div>

   <div class="box">
   <?php
      $select_messages = $conn->prepare("SELECT * FROM `messages`");
      $select_messages->execute();
      $number_of_messages = $select_messages->rowCount();
   ?>
   <h3><?= $number_of_messages; ?></h3>
   <p>TOTAL MESSAGES</p>
   <a href="admin_contacts.php" class="btn">See Messages</a>
   </div>

</div>









</section>





<script src="js/script.js"></script>

</body>
</html>