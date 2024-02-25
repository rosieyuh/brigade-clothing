<?php

require 'config.php';

session_start();

if(isset($_POST['submit'])){

   
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = ($_POST['password']);
    $password = filter_var($password, FILTER_SANITIZE_STRING);
 
    $sql = "SELECT * FROM `admin` WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $password]);
    $rowCount = $stmt->rowCount();  
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if($rowCount > 0){
 
       $_SESSION['admin_id'] = $row['id'];
       header('location:admin_page.php');
 
    }else{
       $message[] = 'INCORRECT USERNAME OR PASSWORD';
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/components.css">

</head>
<body>

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


<section class="form-container">

   <form action="" method="POST">
      <h3>admin login</h3>
      <input type="username" name="username" id="username"  class="box" placeholder="enter username" required>
      <input type="password" name="password" class="box" id="password" placeholder="enter password" required>
      <input type="submit" value="login now" class="btn" name="submit">
   </form>

</section>


</body>
</html>