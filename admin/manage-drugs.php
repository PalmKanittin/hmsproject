<?php
include('../include/config.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if(isset($_GET['del']) && isset($_GET['id'])) {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $sql = "DELETE FROM drugs WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location = 'manage-drugs.php';</script>";
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Manage Drugs</title>

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
                                <h1 class="mainTitle">Admin | Manage Drugs</h1>
                            </div>                          
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">


                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15"><a href="add-drugs.php" class="btn btn-primary">Create Drugs</a></h5>
                                <p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
                                    <?php echo htmlentities($_SESSION['msg']="");?></p>
                                <table class="table table-hover" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th class="center">No.</th>
                                            <th>Drug name</th>
                                            <th>Details</th>         
                                            <th>Action</th>                                  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include('../include/config.php');
											$sql=mysqli_query($conn,"SELECT * FROM drugs");
											$cnt=1;
											while($row=mysqli_fetch_array($sql))
											{
										?>

                                        <tr>
                                            <td class="center"><?php echo $cnt;?>.</td>
                                            <td><?php echo $row['drugname'];?></td>
                                            <td><?php echo $row['detail'];?></td>

                                            <td>
                                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                    <a href="edit-drugs.php?id=<?php echo $row['id'];?>"
                                                        class="btn btn-warning btn-xs" tooltip-placement="top"
                                                        tooltip="Edit"><i class="fa fa-pencil"></i>
                                                    </a>

                                                    <a href="manage-drugs.php?id=<?php echo $row['id']?>&del=delete"
                                                        onClick="return confirm('Are you sure you want to delete?')"
                                                        class="btn btn-danger btn-xs tooltips"
                                                        tooltip-placement="top" tooltip="Remove"><i
                                                            class="fa fa-times fa fa-white"></i>
                                                    </a>
                                                </div>                                               
                                            </td>
                                        </tr>
                                        <?php 
                                            $cnt=$cnt+1;
										}?>

                                    </tbody>
                                </table>
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