<?php
include('../include/config.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor | Dashboard</title>

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
                                <h1 class="mainTitle">Doctor | Dashboard</h1>
                            </div>                          
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x"> <i
                                                class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                class="fa fa-list-ul fa-stack-1x fa-inverse"></i> 
                                        </span>
                                        <h2 class="StepTitle">My Appointments</h2>

                                        <p class="cl-effect-1">
                                            <a href="manage-appointment.php">
                                            <?php 
                                                include('../include/config.php');

                                                $sql = "SELECT COUNT(*) AS total_appointment FROM appointment WHERE id_doctor = ".$_SESSION['id'];
                                                $result = mysqli_query($conn, $sql);

                                                if($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $total_appointment = $row['total_appointment'];

                                                    echo "appointment : " . $total_appointment;
                                                } else {
                                                    
                                                    echo "no appointment";
                                                }
                                            ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x"> <i
                                                class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                class="fa fa-paperclip fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">My Medicalhistory</h2>

                                        <p class="links cl-effect-1">
                                            <a href="manage-users.php">
                                            <?php 
                                                include('../include/config.php');

                                                $sql = "SELECT COUNT(*) AS total_medicalhistory FROM medicalhistory WHERE id_doctor = ".$_SESSION['id'];
                                                $result = mysqli_query($conn, $sql);

                                                if($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $total_medicalhistory = $row['total_medicalhistory'];

                                                    echo "medicalhistory : " . $total_medicalhistory;
                                                } else {
                                                    
                                                    echo "no medicalhistory";
                                                }
                                            ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('include/footer.php');?>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>