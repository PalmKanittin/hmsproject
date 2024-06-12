<?php
include_once('include/config.php');
if(isset($_POST['submit'])) 
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender=$_POST['gender'];
    $phonenum = $_POST['phonenum'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $congenital = $_POST['congenital'];
    $drugallergy = $_POST['drugallergy'];   
    $email = $_POST['email'];
    $password = md5($_POST['password']);


    $check_email_query = "SELECT email FROM users WHERE email = '$email'
    UNION ALL
    SELECT email FROM doctors WHERE email = '$email'
    UNION ALL
    SELECT email FROM admins WHERE email = '$email'";
    $check_email_result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($check_email_result) > 0) {

        echo "<script>alert('อีเมล์นี้มีอยู่ในระบบแล้ว โปรดกรอกข้อมูลใหม่');</script>";
    } else {
        $role = '';

        $sql = "INSERT INTO users (firstname, lastname, gender, phonenum, birthdate, address, congenital, drugallergy, email, password) 
                VALUES ('$firstname', '$lastname', '$gender', '$phonenum', '$birthdate', '$address', '$congenital', '$drugallergy', '$email', '$password')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('User added Successfully');</script>";
            echo "<script>window.location.href ='login.php'</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Patient | Register</title> 

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

    <script type="text/javascript">

    </script>


</head>

<body class="login">
    <div class="row">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">          
			<div class="margin-top-30">             
                    <h2 style="color: #2e71d6;">HMS | Patient Regiser</h2>              
            </div>
            <div class="box-register">
                <form name="register" id="register" method="post" onSubmit="return valid();">
                    <fieldset>
                        
                        <h4 style="color: #2e71d6;">Enter your personal details below:</h4>
                        <div class="form-group">
                            <label for="firstname"> User firstname </label>
                            <textarea type="text" name="firstname" class="form-control" placeholder="Enter User Name" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="lastname"> User lastname </label>
                            <textarea type="text" name="lastname" class="form-control" placeholder="Enter User Lastname" required></textarea>
                        </div>

                        <div class="form-group">
								<label class="block">User Gender</label>
								<div class="clip-radio radio-primary">
									<input type="radio" id="male" name="gender" value="male" required>
									<label for="male">Male</label>

									<input type="radio" id="female" name="gender" value="female" required>
									<label for="female">Female</label>

                                    <input type="radio" id="prefernottosay" name="gender" value="prefer not to say" required>
									<label for="female">Prefer not to say</label>
								</div>
						</div>

                        <div class="form-group">
                            <label for="phonenum">User Phone Number ( กรอกเป็นตัวเลขเท่านั้น ไม่ต้องใส่ - )</label>
                            <input type="text" name="phonenum" class="form-control" placeholder="Enter User Phone Number" pattern="[0-9]*" title="Please enter numbers only" required>                        
                        </div>


                        <div class="form-group">
                            <label for="birthdate">Birthdate</label>
                            <input type="date" name="birthdate" id="birthdate" class="form-control" required>
                            <div id="dateError" style="color: red;"></div>
                        </div>

                        <script>
                            document.getElementById("birthdate").addEventListener("change", function() {
                            var selectedDate = new Date(this.value);
                            var currentDate = new Date();

                            if (selectedDate > currentDate) {
                                document.getElementById("dateError").innerHTML = "Please select a valid birthdate.";
                                this.value = '';
                            } else {
                                document.getElementById("dateError").innerHTML = '';
                                this.setCustomValidity("");
                            }
                        });
                        </script>

                        <div class="form-group">
                            <label for="address"> Address </label>
                            <textarea name="address" class="form-control" placeholder="Enter User address" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="congenital"> Congenital ( หากไม่มี ให้ใส่เครื่องหมาย - )</label>
                            
                            <textarea name="congenital" class="form-control" placeholder="Enter User congenital" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="drugallergy">Drugallergy ( หากไม่มี ให้ใส่เครื่องหมาย - )</label>
                            <textarea name="drugallergy" class="form-control" placeholder="Enter User drugallergy" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="email"> Email </label>
                            <input type="email" name="email" class="form-control" placeholder="Enter User email" required></input>
                        </div>                 

                        <div class="form-group form-actions">
                            <label for="password"> Password </label>
                            <input type="password" id="password" class="form-control password" name="password"
                                placeholder="Password">
                        </div>

						<br>
                    
                        <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">Submit </button>
						<div style="margin-top: 9px;"></div>
						<a href="home.php" class="btn btn-danger btn-block">Cancel</a>

                        <br>

						<div class="login">Already have an account?<a href="login.php"> Login </a></div>
												
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