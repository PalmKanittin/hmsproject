<?php
include('../include/config.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if(isset($_POST['submit'])) {
    $id = $_GET['id'];
    $drugname = $_POST['drugname'];
    $detail = $_POST['detail'];
    $sql = "UPDATE drugs SET drugname='$drugname', detail='$detail' WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('อัปเดตข้อมูลสำเร็จ!');</script>";
        echo "<script>window.location = 'manage-drugs.php';</script>";
        $msg = "Drugs updated successfully";  
        exit();
    } else {
        $msg = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Edit Drugs Details</title>
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
                                <h1 class="mainTitle">Admin | Edit Drugs Info</h1>
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
                                                <h5 class="panel-title">Edit Drugs Info</h5>
                                            </div>
                                            <div class="panel-body">
                                            <?php
                                                include('../include/config.php'); 
                                                if(isset($_GET['id'])) {
                                                    $id = $_GET['id'];
                                                    $sql=mysqli_query($conn,"SELECT * FROM drugs where id='$id'");
                                                    $data=mysqli_fetch_array($sql);
                                                    
                                                    $drugname = $_POST['drugname'];
                                                    $detail = $_POST['detail'];                                                            
                                            ?>

                                                <form role="form" name="addd" method="post" onSubmit="return valid();">
                                                    <div class="form-group">
                                                        <label for="drugname">Drug name</label>
                                                        <input type="text" name="drugname" class="form-control"
                                                            value="<?php echo htmlentities($data['drugname']);?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="detail">Drug detail</label>
                                                        <input type="text" name="detail" class="form-control"
                                                            value="<?php echo htmlentities($data['detail']);?>">
                                                    </div>                                            

                                                    <button type="submit" name="submit" class="btn btn-primary" style="float: right;">Update</button>
                                                    <a href="manage-drugs.php" class="btn btn-danger" style="float: right; margin-right: 10px;">Cancel</a>

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