<?php
session_start();
include('include/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
		$_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 'user';
        header("Location: users/dashboard.php");
        exit();
    }
    

	$sql = "SELECT * FROM doctors WHERE email = '$email' AND password = '$password'"; 
	$result = $conn->query($sql);

    if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 'doctor';
        header("Location: doctor/doctorhome.php");
        exit();
    }

    
    $sql = "SELECT * FROM admins WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 'admin';
        header("Location: admin/adminhome.php");
        exit();
    }

    $error = "***Email or Password Incorrect.***";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>HMS | Login</title>

    <link
        href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
</head>

<body class="login">
    <div class="row">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            
			<div class="margin-top-30">
                    <h2 style="color: #2e71d6;"> HMS | Login</h2>
            </div>

            <div class="box-login">
                <form class="form-login" method="post">
                    <fieldset>
                        <h4 style="color: #2e71d6;">Please enter your name and password to log in.<br />
                            <?php if(isset($error)) { ?>
                        		<h3 style="color: #d62e2e"><?php echo $error; ?></h3>
                        	<?php } ?>
							</h4>

                        <div class="form-group">
                            <label for="email"> Email </label>
                            <input type="text" id="email" class="form-control" name="email" placeholder="Email">
                        </div>

                        <div class="form-group form-actions">
                            <label for="password"> Password </label>
                            <input type="password" id="password" class="form-control password" name="password"
                                placeholder="Password">
                        </div>
						<br>

						<div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block" value="Login">Login</button>
                        </div>
						
						<div style="margin-top: 9px;"></div>

						<div class="d-grid">
							<a href="home.php" class="btn btn-danger btn-block">Cancel</a>
                        </div>


                        <br>
                        <div class="new-account">Don't have an account yet?<a href="register.php"> Create an account </a></div>
                    </fieldset>

                </form>


            </div>

        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>

    <script src="assets/js/main.js"></script>

    <script src="assets/js/login.js"></script>


</body>


</html>