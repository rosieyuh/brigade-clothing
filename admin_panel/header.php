
<header class="header">
   
   <div class="flex">
   <img src="trans_logo.png" alt="logo" class="logo">
      <nav class="navbar">
         <a href="home.php">HOME</a>
         <a href="shop.php">SHOP</a>
         <a href="orders.php">ORDERS</a>
         <a href="about.php">ABOUT</a>
         <a href="contact.php">CONTACT</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <a href="search_page.php" class="fas fa-search"></a>
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE customerid = ?");
            $count_cart_items->execute([$user_id]);
         ?>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
      </div>
         
      

      <div class="profile">
      <?php if (isset($user_id)) { ?>
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `customer` WHERE customerid = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['fname']; ?></p>
         <a href="user_profile_update.php" class="btn">update profile</a>
         <a href="logouthome.php" class="delete-btn">logout</a>
               
         <?php } else { ?>
                     <div class="flex-btn">
                           <a href="../login.php" class="option-btn">LOGIN</a>
                           <a href="../signup.php" class="option-btn">REGISTER</a>
                     </div>
                  <?php } ?>
         </div>
        
      </div>

   </div>

</header>
<?php



if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}



?>