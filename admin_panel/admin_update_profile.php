<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

$fetch_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
$fetch_profile->execute([$admin_id]);
$fetch_profile = $fetch_profile->fetch();

if(isset($_POST['update_profile'])){

   $username = $_POST['username'];
   $username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   $update_profile = $conn->prepare("UPDATE `admin` SET username = ? WHERE id = ?");
   $update_profile->execute([$username, $admin_id]);

   $old_pass = $_POST['old_pass'];
   $update_pass = $_POST['update_pass'];
   $update_pass = filter_var($update_pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $new_pass = ($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $confirm_pass = ($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   if(!empty($update_pass) AND !empty($new_pass) AND !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'INCORRECT OLD PASSWORD';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'CONFIRM PASSWORD NOT MATCHED';
      }else{
         $update_pass_query = $conn->prepare("UPDATE `admin` SET password = ? WHERE id = ?");
         $update_pass_query->execute([$confirm_pass, $admin_id]);
         $message[] = 'PASSWORD UPDATED SUCCESSFULLY';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update admin profile</title>
   
  
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/components.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>


<section class="update-profile">


    <h1 class="title">UPDATE PROFILE</h1>
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>USERNAME:</span>
            <input type="text" name="username" value="<?= $fetch_profile['username']; ?>" placeholder="update username" required class="box"> 
        
         </div>
         <div class="inputBox">
         <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
            <span>OLD PASSWORD:</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>NEW PASSWORD:</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>CONFIRM PASSWORD:</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>
      </div>
      <div class="flex-btn">
         <input type="submit" class="btn" value="UPDATE" name="update_profile">
         <a href="admin_page.php" class="option-btn">CANCEL</a>
      </div>
   </form>


<script src="js/script.js"></script>

</body>
</html>