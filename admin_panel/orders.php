<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('../login.php');
}

  

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

   <?php

         // SELECT * FROM `order` o left JOIN `customer` c ON o.customerid = c.customerid  LEFT JOIN `payment` p ON o.paymentid = p.paymentid left JOIN `shipment` s ON s.trackingno = o.trackingno where 'customerid' = ?" 

      $select_orders = $conn->prepare("SELECT * FROM `order` o left JOIN `customer` c ON o.customerid = c.customerid  LEFT JOIN `payment` p ON o.paymentid = p.paymentid left JOIN `shipment` s ON s.trackingno = o.trackingno where o.customerid = ?" );
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
         <p> ORDER DATE : <span><?= $fetch_orders['orderdate']; ?></span> </p>
         <p> NAME : <span style="text-transform:capitalize"><?= $fetch_orders['fname']; ?> </span><span style="text-transform:capitalize"><?= $fetch_orders['lname']; ?></span> </p>
         <p> EMAIL : <span><?= $fetch_orders['email']; ?></span> </p> <!-- customer t -->
         <p> CONTACT NO : <span><?= $fetch_orders['contactno']; ?></span> </p> <!-- customer t -->
      <p> ADDRESS : <span><?= $fetch_orders['homeAdrs']; ?></span> </p>
      <p> PURCHASE METHOD : <span style="text-transform:capitalize"><?= $fetch_orders['purchasemethod']; ?></span> </p>
      <p> ORDER TOTAL : <span>$<?= $fetch_orders['ordertotal']; ?>/-</span> </p> 
      <p> PAYMENT STATUS : <span style="color:<?php if($fetch_orders['paymentstatus'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['paymentstatus']; ?></span> </p>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no orders placed yet!</p>';
   }
   ?>

   </div>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>