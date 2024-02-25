<?php
// Define user_id variable
$user_id = $_SESSION['user_id'] ?? null;
?>

<header class="header">
   <div class="container">
   <div class="flex">
   <img src="admin_panel/trans_logo.png" alt="logo" class="logo";>
      <nav class="navbar">
         <a href="admin_panel/home.php">HOME</a>
         <a href="admin_panel/shop.php">SHOP</a>
         <a href="admin_panel/orders.php">ORDERS</a>
         <a href="admin_panel/about.php">ABOUT</a>
         <a href="">CONTACT</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>

      </div>



      <div class="profile">
      <?php if (isset($user_id)) { ?>
         <?php
            $select_profile = $conn->prepare("SELECT * FROM customer WHERE customerid = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['fname']; ?></p>
         <a href="user_profile_update.php" class="btn">update profile</a>
         <a href="../logout.php" class="delete-btn">logout</a>

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