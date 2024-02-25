<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_product'])){

   $productid = $_POST['productid'];
   $prodname = $_POST['prodname'];
   $prodname = filter_var($prodname, FILTER_SANITIZE_STRING);
   $unitprice = $_POST['unitprice'];
   $unitprice = filter_var($unitprice, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $stock = $_POST['stock'];
   $stock = filter_var($stock, FILTER_SANITIZE_STRING);
   
   $img = $_FILES['img']['name'];
   $img = filter_var($img, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['img']['size'];
   $image_tmp_name = $_FILES['img']['tmp_name'];
   $image_folder = '../img/category/'.$img;
   $old_image = $_POST['old_image'];

   $update_product = $conn->prepare("UPDATE `product` SET prodname = ?, unitprice = ?, stock = ?, category = ? WHERE productid = ?");
   $update_product->execute([$prodname, $unitprice, $stock, $category, $productid]);

   $message[] = 'PRODUCT UPDATED SUCCESSFULLY';

   if(!empty($img)){
      if($image_size > 2000000){
         $message[] = 'image size is too large';
      }else{

         $update_image = $conn->prepare("UPDATE `product` SET img = ? WHERE productid = ?");
         $update_image->execute([$img, $productid]);

         if($update_image){
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('../img/category/'.$old_image);
            $message[] = 'IMAGE UPDATED SUCCESSFULLY';
         }
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
   <title>update products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="update-product">

   <h1 class="title">update product</h1>   

   <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `product` WHERE productid = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_image" value="<?= $fetch_products['img']; ?>">
      <input type="hidden" name="productid" value="<?= $fetch_products['productid']; ?>">
      <img src="../img/category/<?= $fetch_products['img']; ?>" alt="product_image">
      <input type="text" name="prodname" placeholder="ENTER PRODUCT NAME" required class="box" value="<?= $fetch_products['prodname']; ?>">
      <input type="number" name="unitprice" min="0" placeholder="ENTER PRODUCT PRICE" required class="box" value="<?= $fetch_products['unitprice']; ?>">
      <select name="category" class="box" required>
         <option selected><?= $fetch_products['category']; ?></option>
         <option value="SHIRT">SHIRT</option>
            <option value="BAG">BAG</option>
            <option value="HOODIE">HOODIE</option>
      </select>
      <input type="number" min="0" name="stock" class = "box" required placeholder="ENTER STOCKS">
      <input type="file" name="img" class="box" accept="img/jpg, img/jpeg, img/png">
      
      <div class="flex-btn">
         <input type="submit" class="btn" value="UPDATE PRODUCT" name="update_product">
         <a href="admin_products.php" class="option-btn">CANCEL</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products found!</p>';
      }
   ?>

</section>













<script src="js/script.js"></script>

</body>
</html>