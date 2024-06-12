<?php
include('../include/config.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if(isset($_POST['submit'])) {    
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $specialization = $_POST['specialization'];
    $phoneno = $_POST['phoneno'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql_check_email = "SELECT email FROM users WHERE email = '$email'
    UNION ALL
    SELECT email FROM doctors WHERE email = '$email'
    UNION ALL
    SELECT email FROM admins WHERE email = '$email'";
    $result_check_email = $conn->query($sql_check_email);

    if ($result_check_email->num_rows > 0) {
        echo "<script>alert('อีเมล์นี้มีอยู่ในระบบแล้ว โปรดกรอกข้อมูลใหม่');</script>";
    } 
    else {
        $sql_insert_doctor = "INSERT INTO doctors (firstname, lastname, gender, specialization, phoneno, birthdate, address, email, password) 
                            VALUES ('$firstname', '$lastname', '$gender', '$specialization', '$phoneno', '$birthdate', '$address', '$email', '$password')";

        if ($conn->query($sql_insert_doctor) === TRUE) {
            echo "<script>alert('เพิ่มข้อมูลสำเร็จ!');</script>";
            echo "<script>window.location.href ='manage-doctor.php'</script>";
        } else {
            echo "Error: " . $sql_insert_doctor . "<br>" . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Add Doctor</title>

    <link
        href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />

</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php');?>
        <div class="app-content">

            <?php include('include/header.php');?>

            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Admin | Add Doctor</h1>
                            </div>
                        </div>
                    </section>
 
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Add Doctor</h5>
                                            </div>
                                            <div class="panel-body">

                                                <form role="form" name="adddoc" method="post"
                                                    onSubmit="return valid();">

                                                    <div class="form-group">
                                                        <label for="firstname"> Doctor firstname </label>
                                                        <input type="text" name="firstname" class="form-control" placeholder="Enter Doctor Firstame" required></input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="lastname"> Doctor lastname </label>
                                                        <input type="text" name="lastname" class="form-control" placeholder="Enter Doctor Lastname" required></input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="block">Gender</label>
                                                            <div class="clip-radio radio-primary">
                                                                <input type="radio" id="male" name="gender" value="Male" >
                                                                <label for="male">Male</label>

                                                                <input type="radio" id="female" name="gender" value="Female">
                                                                <label for="female">Female</label>

                                                                <input type="radio" id="prefernottosay" name="gender" value="Prefer not to say" required>
									                            <label for="prefernottosay">Prefer not to say</label>
                                                            </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="specialization">Specialization</label>
                                                        <input name="specialization" class="form-control" placeholder="Enter Doctor Specialization" required></input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="phoneno">Phonenumber</label>
                                                        <input name="phoneno" class="form-control" pattern="[0-9]*" placeholder="Enter Doctor phoneno" required></input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="birthdate">Birthdate</label>
                                                        <input type="date" name="birthdate" id="birthdate" class="form-control" required>
                                                        <div id="dateError" style="color: red;"></div>
                                                    </div>

                                                                        <script>
                                                                            document.getElementById('birthdate').addEventListener('change', function() {
                                                                                var selectedDate = new Date(this.value);
                                                                                var currentDate = new Date();
                                                                                
                                                                                if (selectedDate > currentDate) {
                                                                                    document.getElementById('dateError').innerHTML = 'Please Select a Future Date and Time.';
                                                                                    this.value = '';
                                                                                } else {
                                                                                    document.getElementById('dateError').innerHTML = '';
                                                                                }
                                                                            });
                                                                        </script>

                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input name="address" class="form-control" placeholder="Enter Doctor address" required></input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input name="email" class="form-control" placeholder="Enter Doctor email" required></input>
                                                    </div>

                                                    <div class="form-group form-actions">
                                                        <label for="password"> Password </label>
                                                        <input type="password" id="password" class="form-control password" name="password"
                                                            placeholder="Password">
                                                    </div>                                         

                                                    <button type="submit" name="submit" id="submit"class="btn btn-primary" style="float: right;">Submit</button>
                                                    <a href="manage-doctor.php" class="btn btn-danger" style="float: right; margin-right: 10px;">Cancel</a>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>