<?php
@include 'config.php';

session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

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
   $image_folder = '../img/products/'.$img;

   $select_products = $conn->prepare("SELECT * FROM `product` WHERE prodname = ?");
   $select_products->execute([$prodname]);

   if($select_products->rowCount() > 0){
      $message[] = 'PRODUCT NAME ALREADY EXISTS';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `product`(prodname, unitprice, stock, category, img) VALUES(?,?,?,?,?)");
      $insert_products->execute([$prodname, $unitprice, $stock, $category, $img]);

      if($insert_products){
         if($image_size > 4000000){
            $message[] = 'image is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'NEW PRODUCT ADDED';
         }

      }

   }

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = $conn->prepare("SELECT img FROM `product` WHERE productid = ?");
   $select_delete_image->execute([$delete_id]);
   $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
   unlink('../img/products/'.$fetch_delete_image['img']);
   $delete_products = $conn->prepare("DELETE FROM `product` WHERE productid = ?");
   $delete_products->execute([$delete_id]);
   $message[] = 'PRODUCT DELETED';
   header('location:admin_products.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="add-products">

   <h1 class="title">ADD NEW PRODUCT</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
         <input type="text" name="prodname" class="box" required placeholder="ENTER PRODUCT NAME">
         <select name="category" class="box" required>
            <option value="" selected disabled>SELECT CATEGORY</option>
               <option value="SHIRT">SHIRT</option>
               <option value="BAG">BAG</option>
               <option value="HOODIE">HOODIE</option>
         </select>
         </div>
         <div class="inputBox">
         <input type="number" min="0" name="unitprice" class="box" required placeholder="ENTER PRODUCT PRICE">
         <input  type="file" name="img" required class="box" accept="img/jpg, img/jpeg, img/png">
         </div>
      </div>
      <input type="number" min="0" name="stock" class = "box" required placeholder="ENTER STOCKS">
      <input type="submit" class="btn" value="ADD PRODUCT" name="add_product">
   </form>

</section>

<section class="show-products">

   <h1 class="title">PRODUCTS ADDED</h1>

   <div class="box-container">

   <?php
      $show_products = $conn->prepare("SELECT * FROM `product`");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <div class="unitprice">₱<?= $fetch_products['unitprice']; ?>/-</div>
      <img src="../img/products/<?= $fetch_products['img']; ?>" alt="product_image">
      <div class="prodname"><?= $fetch_products['prodname']; ?></div>
      <div class="cat" style="text-transform:uppercase; ">CATEGORY: <?= $fetch_products['category']; ?></div>
      <div class="stock">STOCKS: <?= $fetch_products['stock']; ?></div>
      <div class="flex-btn">
         <a href="admin_update_product.php?update=<?= $fetch_products['productid']; ?>" class="option-btn">UPDATE</a>
         <a href="admin_products.php?delete=<?= $fetch_products['productid']; ?>" class="delete-btn" onclick="return confirm('DELETE THIS PRODUCT?');">DELETE</a>
      </div>
     
     
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">NO PRODUCTS ADDED YET</p>';
   }
   ?>

   </div>

</section>











<script src="js/script.js"></script>

</body>
</html>