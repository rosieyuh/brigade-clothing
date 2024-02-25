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

      <header class="header">
      
         <div class="flex">

         <img src="trans_logo.png" alt="logo" class="logo">
            
            <nav class="navbar">
                  <a href="admin_page.php">HOME</a>
                  <a href="admin_products.php">PRODUCTS</a>
                  <a href="admin_orders.php">ORDERS</a>
                  <a href="admin_users.php">USERS</a>
                  <a href="admin_contacts.php">MESSAGES</a>
                  <a href="admin_reports.php">REPORTS</a>

            </nav>

            <div class="icons">
               <div id="menu-btn" class="fas fa-bars"></div>
               <div id="user-btn" class="fas fa-user"></div>

            </div>

            <div class="profile">
                  <?php if (isset($admin_id)) { ?>
                     <?php 
                           $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
                           $select_profile->execute([$admin_id]);
                           $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC); 
                     ?>
                     <p><?= $fetch_profile['username']; ?></p>
                     <a href="admin_update_profile.php" class="btn">UPDATE PROFILE</a>
                     <a href="logoutmin.php" class="delete-btn">LOGOUT</a>
                  <?php } else { ?>
                     <div class="flex-btn">
                           <a href="../admin_panel/admin_login.php" class="option-btn">LOGIN</a>
                           <!-- <a href="register.php" class="option-btn">REGISTER</a> -->
                     </div>
                  <?php } ?>
                     </div>
                  </div>
            
         </div>

      </header>

    
      <script src="js/script.js"></script>



