<?php
include('../include/config.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Patient | Medicalhistory</title>

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
                                <h1 class="mainTitle">Patient | Medicalhistory</h1>
                            </div>                            
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">

                        <div class="row">
                            <div class="col-md-12">
                                <p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
                                    <?php echo htmlentities($_SESSION['msg']="");?></p>
                                <table class="table table-hover" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th class="center">No.</th>
                                            <th>User Name</th>
                                            <th>Doctor Name</th>                                           
                                            <th>Drug Name</th>
                                            <th>Date</th>
                                            <th>Details</th>
                                            <th>Action</th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include('../include/config.php');
                                            $sql = "SELECT medicalhistory.id AS m_id, doctors.firstname AS doctor_fname, users.firstname AS user_fname, GROUP_CONCAT(drugs.drugname) AS d_name, medicalhistorydate, details FROM medicalhistory";
                                            $sql .= " LEFT JOIN users ON users.id=medicalhistory.id_users 
                                                    LEFT JOIN doctors ON doctors.id=medicalhistory.id_doctor 
                                                    LEFT JOIN drugs ON FIND_IN_SET(drugs.id, medicalhistory.id_drugs) > 0 
                                                    WHERE medicalhistory.id_users=".$_SESSION['id'];
                                            $sql .= " GROUP BY medicalhistory.id";
                            
											$data = mysqli_query($conn,$sql); 
											$count = 1;
											while($row = mysqli_fetch_assoc($data)) {
										?>

                                        <tr>
                                            <td class="center"><?php echo $count;?>.</td>
                                            <td><?php echo $row['user_fname'];?>
                                            <td><?php echo $row['doctor_fname'];?></td>                                           
                                            <td><?php echo $row['d_name'];?>
                                            <td><?php echo $row['medicalhistorydate'];?>
                                            <td><?php echo $row['details'];?>

                                            <td>
                                                <div class="visible-md visible-lg hidden-sm hidden-xs">

                                                    <a href="view-medicalhistory.php?id=<?php echo $row['m_id'];?>"
                                                        class="btn btn-primary btn-xs" tooltip-placement="top"
                                                        tooltip="Edit"><i class="fa fa-eye"></i>
                                                    </a>                                                 

                                                </div>                                               
                                            </td>
                                            
                                        </tr>

                                        <?php $count++; }?>
                                    </tbody>
                                </table>
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