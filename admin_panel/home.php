<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('../login.php');
};

// if(isset($_POST['add_to_cart'])){


//    $productid = $_POST['productid'];
//    $productid = filter_var($productid, FILTER_SANITIZE_STRING);
//    $prodname = $_POST['prodname'];
//    $prodname = filter_var($prodname, FILTER_SANITIZE_STRING);
//    $unitprice = $_POST['unitprice'];
//    $unitprice = filter_var($unitprice, FILTER_SANITIZE_STRING);
//    $img = $_POST['img'];
//    $img = filter_var($img, FILTER_SANITIZE_STRING);
//    $quantity = $_POST['quantity']; // from order items t 
//    $quantity = filter_var($quantity, FILTER_SANITIZE_STRING); // from order items t 

//    $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE prodname = ? AND customerid =?");
//    $check_cart_numbers->execute([$prodname, $user_id]);

//    if($check_cart_numbers->rowCount() > 0){
//       $message[] = 'ALREADY ADDED TO CART';
//    }else{

//       $insert_cart = $conn->prepare("INSERT INTO `cart`(customerid, prodname, unitprice, quantity, img) VALUES(?,?,?,?,?)");
//       $insert_cart->execute([$user_id, $prodname, $unitprice, $quantity, $img]);
//       $message[] = 'ADDED TO CART';
//    }

// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/components.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">

</div>

<section class="home-category">

   <h1 class="title" style="font-family: 'roboto condensed','sans-serif'">shop by category</h1>

   <div class="box-container">

      <div class="box">
         <img src="img/img_categories/feature_1.jpg" alt="">
         
         
         <a href="shop.php#shirts" class="btn">SHIRTS</a>
      </div>

      <div class="box">
         <img src="img/img_categories/feature_2.jpg" alt="">
        
    
         <a href="shop.php#bags" class="btn">BAGS</a>
      </div>

      <div class="box">
         <img src="img/img_categories/feature_3.jpg" alt="">
        
      
         <a href="shop.php#jackets" class="btn">HOODIES</a>
      </div>

     

   </div>

</section>

<section class="products">

   <h1 class="title" style="font-family: 'roboto condensed','sans-serif'">latest products</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `product` LIMIT 6");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price">₱<span><?= $fetch_products['unitprice']; ?></span>/-</div>
      <a href="shop.php" class="fas fa-eye"></a>
      <img src="../img/products/<?= $fetch_products['img']; ?>" alt="">
      <div class="name"><?= $fetch_products['prodname']; ?></div> <!-- ung binago name thingy -->
      <input type="hidden" name="productid" value="<?= $fetch_products['productid']; ?>">
      <input type="hidden" name="prodname" value="<?= $fetch_products['prodname']; ?>">
      <input type="hidden" name="unitprice" value="<?= $fetch_products['unitprice']; ?>">
      <input type="hidden" name="img" value="<?= $fetch_products['img']; ?>">
    
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

   </div>

</section>







<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>