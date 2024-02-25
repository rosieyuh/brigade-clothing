<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . ".../admin_panel/database.php";
    
    $sql = sprintf("SELECT * FROM customer
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $customer = $result->fetch_assoc();

    if ($customer) 
    {
        
        if ($_POST["password"] == $customer["password"])
        {
            
            session_start();
            
 			session_regenerate_id();
            
            $_SESSION["user_id"] = $customer["customerid"];
            
            header("Location: admin_panel/home.php");
            exit;
        }
    }
    
    $is_invalid = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <?php include 'include/head.php';?>
    <link rel="stylesheet" href="css/login.css">
    	  <!-- font awesome cdn link  -->
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<!-- custom css file link  -->

<link rel="stylesheet" href="./admin_panel/css/components.css">
</head>
<body>
<?php include 'include/header.php';?>
    <section class="divider">
        <div class="login_container">
        <h1> LOGIN</h1>

        <?php if ($is_invalid): ?>
            <div class="invalid">Incorrect email or password</div>
        <?php endif; ?>

        <form method="post">
            <div class="formdivider">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required="required"
                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            </div>
            <div class="formdivider">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required="required">
            </div>

            <input type="submit" value="Sign in">
        </form>

        <p class="signup"> Don't have an account? <a href="signup.php">Register now!</a></p>
        </div>
    </section>


</body>
</html>

<?php include 'include/footer.php';?>