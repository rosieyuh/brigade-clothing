<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('../login.php');
};

if(isset($_POST['add_to_cart'])){


   $productid = $_POST['productid'];
   $productid = filter_var($productid, FILTER_SANITIZE_STRING);
   $prodname = $_POST['prodname'];
   $prodname = filter_var($prodname, FILTER_SANITIZE_STRING);
   $unitprice = $_POST['unitprice'];
   $unitprice = filter_var($unitprice, FILTER_SANITIZE_STRING);
   $img = $_POST['img'];
   $img = filter_var($img, FILTER_SANITIZE_STRING);
   $quantity = $_POST['quantity']; // from order items t 
   $quantity = filter_var($quantity, FILTER_SANITIZE_STRING); // from order items t 

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE prodname = ? AND customerid =?");
   $check_cart_numbers->execute([$prodname, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = 'ALREADY ADDED TO CART';
   }else{

      $insert_cart = $conn->prepare("INSERT INTO `cart`(customerid, productid, prodname, unitprice, quantity, img) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $productid, $prodname, $unitprice, $quantity, $img]);
      $message[] = 'ADDED TO CART';
   }

}

?>
<html>
<head>
	<?php include '../include/head.php';?>
   
	<title>shop</title>
    <script src="js/cart.js" async></script>
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" href="css/admin_style.css">
	<link rel="stylesheet" href="css/components.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-black">

   <?php include 'header.php';?>


<section class="products">
	<h2 id="shirts" class="section-header" style="display:none" >SHIRTS</h2>
	<div class="box-container">
	
      <?php
         $select_products = $conn->prepare("SELECT * FROM product where category = 'shirt'");
         $select_products->execute();
         if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){  
      ?>
            <form action="" class="box" method="POST">
            <div class="price">₱<?= $fetch_products['unitprice']; ?>/-</div>
            <img src="../img/products/<?= $fetch_products['img']; ?>" alt="product_image">
            <div class="name"><?= $fetch_products['prodname']; ?></div>
            <input type="hidden" name="productid" value="<?= $fetch_products['productid']; ?>">
            <input type="hidden" name="prodname" value="<?= $fetch_products['prodname']; ?>">
            <input type="hidden" name="unitprice" value="<?= $fetch_products['unitprice']; ?>">
            <input type="hidden" name="img" value="<?= $fetch_products['img']; ?>">
            <input type="number" min="1" value="1" name="quantity" class="qty">
            <!-- <div class="flex-btn"> -->
            <input type="submit" value="add to cart" class="btn" name="add_to_cart">
            <!-- </div> -->
         
         </form>
      <?php
            }
         }else{
            echo '<p class="empty">NO PRODUCTS ADDED YET</p>';
         }
         ?>
     
      </div>
      </section>
      <section class="products">
      <h2 id="jackets" class="section-header" style="display:none">HOODIES</h2>
         <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM product where category = 'hoodie' ");
         $select_products->execute();
         if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){  
      ?>
      <form action="" class="box" method="POST">

            <div class="price">₱<?= $fetch_products['unitprice']; ?>/-</div>
            <img src="../img/products/<?= $fetch_products['img']; ?>" alt="product_image">
            <div class="name"><?= $fetch_products['prodname']; ?></div>
            <input type="hidden" name="productid" value="<?= $fetch_products['productid']; ?>">
            <input type="hidden" name="prodname" value="<?= $fetch_products['prodname']; ?>">
            <input type="hidden" name="unitprice" value="<?= $fetch_products['unitprice']; ?>">
            <input type="hidden" name="img" value="<?= $fetch_products['img']; ?>">
            <input type="number" min="1" value="1" name="quantity" class="qty">
            <!-- <div class="flex-btn"> -->
            <input type="submit" value="add to cart" class="btn" name="add_to_cart">
            <!-- </div> -->
            </form>
      
           
      <?php
            }
         }else{
            echo '<p class="empty">NO PRODUCTS ADDED YET</p>';
         }
         ?>

      </div>
      </section>
      <section class="products">
      <h2 id="bags" class="section-header" style="display:none">BAGS</h2>
         <div class="box-container">
      <?php
         $select_products = $conn->prepare("SELECT * FROM product where category = 'bag'");
         $select_products->execute();
         if($select_products->rowCount() > 0)
         {
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC))
         {  
      ?>
      <form action="" class="box" method="POST">
         
            <div class="price">₱<?= $fetch_products['unitprice']; ?>/-</div>
            <img src="../img/products/<?= $fetch_products['img']; ?>" alt="product_image">
            <div class="name"><?= $fetch_products['prodname']; ?></div>
            <input type="hidden" name="productid" value="<?= $fetch_products['productid']; ?>">
            <input type="hidden" name="prodname" value="<?= $fetch_products['prodname']; ?>">
            <input type="hidden" name="unitprice" value="<?= $fetch_products['unitprice']; ?>">
            <input type="hidden" name="img" value="<?= $fetch_products['img']; ?>">
            <input type="number" min="1" value="1" name="quantity" class="qty">
            <!-- <div class="flex-btn"> -->
            <input type="submit" value="add to cart" class="btn" name="add_to_cart">
            <!-- </div> -->
         
         </form>
      <?php
            }
         }
         else
         {
            echo '<p class="empty">NO PRODUCTS ADDED YET</p>';
         }
      ?>

</div>
</section>
</body>
</html>