<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $conn = require __DIR__ . "/admin_panel/config.php";
    
    $stmt = $conn->prepare("SELECT * FROM customer
                    WHERE email = :email");
    $stmt->bindParam(':email', $_POST["email"]);
    $stmt->execute();
    
    $user = $stmt->fetch();

    if ($user) 
    {
        
        if ($_POST["password"] == $user["password"])
        {
            
            session_start();
            
 			session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
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
    <?php include 'include/nav.php';?>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
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


