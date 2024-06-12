<?php
include('../include/config.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if(isset($_POST['submit'])) {
    $id = $_GET['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $phonenum = $_POST['phonenum'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $congenital = $_POST['congenital'];
    $drugallergy = $_POST['drugallergy'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', gender='$gender', phonenum='$phonenum', birthdate='$birthdate', address='$address', congenital='$congenital', drugallergy='$drugallergy', password='$password' WHERE email='$email'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('อัปเดตข้อมูลสำเร็จ!');</script>"; 
        echo "<script>window.location = 'manage-users.php';</script>"; 
        exit();
    } else {
        $msg = "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Edit Patient</title>
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
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
                                <h1 class="mainTitle">Admin | Edit Patient Info</h1>
                            </div>                      
                        </div>
                    </section>

                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="color: green; font-size:18px; ">
                                    <?php if(isset($msg)) { echo htmlentities($msg);}?> </h5>
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Edit Patient Info</h5>
                                            </div>
                                            <div class="panel-body">
                                            <?php
                                                include('../include/config.php'); 
                                                if(isset($_GET['id'])) {
                                                    $id = $_GET['id'];
                                                    $sql=mysqli_query($conn,"SELECT * FROM users where id='$id'");
                                                    $data=mysqli_fetch_array($sql);
                                                    
                                                    $firstname = $_POST['firstname'];
                                                    $lastname = $_POST['lastname'];
                                                    $gender = $_POST['gender'];
                                                    $phonenum = $_POST['phonenum'];
                                                    $birthdate = $_POST['birthdate'];
                                                    $address = $_POST['address'];
                                                    $congenital = $_POST['congenital'];
                                                    $drugallergy = $_POST['drugallergy'];
                                                    $uemail = $_POST['uemail'];
                                            ?>
                                                <form role="form" name="addu" method="post" onSubmit="return valid();">
                                                    <div class="form-group">
                                                        <label for="firstname">Patient firstname</label>
                                                        <input type="text" name="firstname" class="form-control"
                                                            value="<?php echo htmlentities($data['firstname']);?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="lastname">Patient lastname</label>
                                                        <input type="text" name="lastname" class="form-control"
                                                            value="<?php echo htmlentities($data['lastname']);?>">
                                                    </div> 

                                                    <div class="form-group">
                                                        <label class="block">Gender</label>
                                                        <div class="clip-radio radio-primary">
                                                            <input type="radio" id="male" name="gender" value="male" <?php if ($data['gender'] == 'male') echo 'checked'; ?>>
                                                            <label for="male">Male</label>

                                                            <input type="radio" id="female" name="gender" value="female" <?php if ($data['gender'] == 'female') echo 'checked'; ?>>
                                                            <label for="female">Female</label>

                                                            <input type="radio" id="prefernottosay" name="gender" value="prefer not to say" <?php if ($data['gender'] == 'prefer not to say') echo 'checked'; ?>>
                                                            <label for="prefernottosay">Prefer not to say</label>
                                                        </div>
                                                    </div>                                       

                                                    <div class="form-group">
                                                        <label for="phonenum">Phonenumber</label>
                                                        <input type="text" name="phonenum" pattern="[0-9]*" class="form-control"
                                                            value="<?php echo htmlentities($data['phonenum']);?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="birthdate">Birthdate</label>
                                                        <input type="date" name="birthdate" class="form-control"
                                                            value="<?php echo htmlentities($data['birthdate']);?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" name="address" class="form-control"
                                                            value="<?php echo htmlentities($data['address']);?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="congenital">Congential</label>
                                                        <input type="text" name="congenital" class="form-control"
                                                            value="<?php echo htmlentities($data['congenital']);?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="drugallergy">Drugallergy</label>
                                                        <input type="text" name="drugallergy" class="form-control"
                                                            value="<?php echo htmlentities($data['drugallergy']);?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" class="form-control"
                                                            readonly="readonly"
                                                            value="<?php echo htmlentities($data['email']);?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" name="password" class="form-control"
                                                            value="<?php echo htmlentities($data['password']); ?>">
                                                    </div>

                                                    <button type="submit" name="submit" class="btn btn-primary" style="float: right;">Update</button>
                                                    <a href="manage-users.php" class="btn btn-danger" style="float: right; margin-right: 10px;">Cancel</a>

                                                </form>
                                                <?php
                                                }
                                                ?>
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