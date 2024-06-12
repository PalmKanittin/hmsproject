<?php
include('../include/config.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if(isset($_POST['submit'])) {	
    $drugname=$_POST['drugname'];
    $detail=$_POST['detail'];   
    $sql=mysqli_query($conn,"insert into drugs(drugname,detail) values('$drugname','$detail')");

    if($sql)
{
echo "<script>alert('Drugs added Successfully');</script>";
echo "<script>window.location.href ='manage-drugs.php'</script>";

}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Add Drugs</title>

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
                                <h1 class="mainTitle">Admin | Add Drugs</h1>
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
                                                <h5 class="panel-title">Add Drugs</h5>
                                            </div>
                                            <div class="panel-body">

                                                <form role="form" name="addd" method="post"
                                                    onSubmit="return valid();">

                                                    <div class="form-group">
                                                        <label for="drugname"> Drug name </label>
                                                        <input type="text" name="drugname" class="form-control" placeholder="Enter Drug Name" required></input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="detail"> Drug details </label>
                                                        <input type="text" name="detail" class="form-control" placeholder="Enter Drug detail" required></input>
                                                    </div>            

                                                    <button type="submit" name="submit" id="submit"class="btn btn-primary" style="float: right;">Submit</button>
                                                    <a href="manage-drugs.php" class="btn btn-danger" style="float: right; margin-right: 10px;">Cancel</a>

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