<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_order'])){

   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
   $update_orders = $conn->prepare("UPDATE `payment`
   SET paymentstatus = ? WHERE paymentID = ?");
   $update_orders->execute([$update_payment, $order_id]);
   $message[] = 'PAYMENT HAS BEEN UPDATED';

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_orders = $conn->prepare("DELETE FROM `order` WHERE orderID = ?");
   $delete_orders->execute([$delete_id]);
   header('location:admin_orders.php');

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
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

      <?php
         $select_orders = $conn->prepare("SELECT * FROM `order` o JOIN `customer` c ON o.customerid = c.customerid  JOIN `payment` p ON o.paymentid = p.paymentid LEFT JOIN `shipment` s ON s.trackingno = o.trackingno;");
         $select_orders->execute();
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box">
                <!-- customer and order table and payment and shipment -->
                <p> ORDER ID : <span><?= $fetch_orders['orderID']; ?></span> </p>
         <p> ORDER DATE : <span><?= $fetch_orders['orderdate']; ?></span> </p>
         <p> NAME : <span><?= $fetch_orders['fname']; ?> <?= $fetch_orders['lname']; ?></span> </p><!-- fname and lname should be concatinated -->
         
         <p> CONTACT NO : <span><?= $fetch_orders['contactno']; ?></span> </p> <!-- customer t -->
         <p> ORDER TOTAL : <span>$<?= $fetch_orders['ordertotal']; ?>/-</span> </p> <!-- payment t -->
         <p> PURCHASE METHOD : <span style="text-transform:uppercase;"><?= $fetch_orders['purchasemethod']; ?></span> </p> <!-- order t -->
         <p> PAYMENT STATUS : <span style="text-transform:uppercase;"><?= $fetch_orders['paymentstatus']; ?></span> </p> 
         <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?= $fetch_orders['paymentID'];?>">
               <select name="update_payment" class="drop-down">
                  <option value="" selected disabled ><?= $fetch_orders['paymentstatus']; ?></option>
                  <option value="PENDING">pending</option>
                  <option value="PAID">paid</option>
               </select>
               <div class="flex-btn">
                  <input type="submit" name="update_order" class="option-btn" value="UPDATE">
                  <a href="admin_orders.php?delete=<?= $fetch_orders['orderID']; ?>" class="delete-btn" onclick="return confirm('DELETE THIS ORDER?');">DELETE</a>
            
            </div>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">NO ORDERS PLACED YET</p>';
      }
      ?>

   </div>

</section>


<script src="js/script.js"></script>

</body>
</html>