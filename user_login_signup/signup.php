<?php

include '/admin_panel/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
	$contactno = $_POST["contactno"];
    $password = $_POST["password"];
    
    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM customer WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        die("Email already exists");
    }
    
    // Hash the password using PHP's built-in password_hash() function
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert user data into the database
    $stmt = $conn->prepare("INSERT INTO customer (fname, lname, email, contactno, password) VALUES (:fname, :lname, :email, :contactno, :password)");
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':email', $email);
	$stmt->bindParam(':contactno', $contactno);
    $stmt->bindParam(':password', $hash);
    $stmt->execute();
    
    // Redirect user to success page
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Signup</title>
	<?php include 'include/head.php';?>
	<?php include 'include/nav.php';?>
	<link rel="stylesheet" href="css/login.css">
</head>

<body>
	<section class="divider">
		<div class="signup_container">
		<h1>Register</h1>

			<form method="post">

				<?php if(isset($_GET['success'])){ ?>
					<div class="success"><?php echo $_GET['success']; ?></div>
					<?php } ?>

				<!-- <div class="success">
					Registration Successful!

				</div> -->

				<div class="formdivider">
					<label for="fname">FIRST NAME</label>
					<input type="text" id="fname" name="fname" required="required">
				</div>
				<div class="formdivider">
					<label for="lname">LAST NAME</label>
					<input type="text" id="lname" name="lname" required="required">
				</div>
				<div class="formdivider">
					<label for="email">EMAIL</label>
					<input type="email" id="email" name="email" required="required">
				</div>
				<div class="formdivider">
					<label for="contactno">CONTACT NO.</label>
					<input type="contactno" id="contactno" name="contactno" required="required" minlength="11" maxlength="11">
				</div>
				<div class="formdivider">
					<label for="password">PASSWORD</label>
					<label for="pwreq">*must contain at least 8 characters including letters and numbers</label>
					<input type="password" id="password" name="password" required="required">
				</div>
				<div class="formdivider">
					<label for="password">CONFIRM PASSWORD</label>
					<input type="password" id="confirm_password" name="confirm_password" required="required"  pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" oninput="check(this)" >
				</div>
				<script>
function check(input) {
  if (input.value != document.getElementById('password').value) {
    input.setCustomValidity('Passwords do not match');
  } else {
    input.setCustomValidity('');
  }
}
</script>
				<input type="submit" value="Submit">
			</form>

			<p class="login"> Already have an account? <a href="login.php">Login now!</a></p>
		</div>

</section>

</body>
</html>
