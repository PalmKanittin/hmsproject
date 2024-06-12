<?php
include('../include/config.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    header("Location: ../login.php");
    exit();
}

if(isset($_POST['search'])) {
    $_SESSION['search_term'] = $_POST['search_term']; // บันทึกค่าคำค้นหาใน Session
} else {
    // ถ้าไม่มีการส่งคำค้นหาใหม่ ให้ใช้ค่าคำค้นหาจาก Session หากมี
    $_SESSION['search_term'] = isset($_SESSION['search_term']) ? $_SESSION['search_term'] : '';
}

if(isset($_GET['del']) && isset($_GET['id'])) {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $sql = "DELETE FROM appointment WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location = 'manage-appointment.php';</script>";
        echo "<script>window.location = 'manage-appointment.php';</script>";
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
    <title>Doctor | Manage Appointment</title>

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
                                <h1 class="mainTitle">Doctor | Manage Appointment</h1>
                            </div>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">

                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15"><a href="add-appointment.php"
                                        class="btn btn-primary">Make Appointment</a></h5>
                                <p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
                                    <?php echo htmlentities($_SESSION['msg']="");?></p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="post" class="form-inline" style="margin-bottom: 15px;">
                                            <div class="form-group">
                                                <input type="text" name="search_term" class="form-control" placeholder="ค้นหา" value="<?php echo $_SESSION['search_term']; ?>">
                                            </div>
                                            <button type="submit" name="search" class="btn btn-primary">Search</button>
                                        </form>
                                    </div>
                                </div>
                                <table class="table table-hover" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th class="center">No.</th>
                                            <th class="hidden-xs">Doctor firstname</th>
                                            <th>Doctor lastname</th>
                                            <th>Patient firstname</th>
                                            <th>Patient lastname</th>
                                            <th>Date</th>
                                            <th>Details</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include('../include/config.php');
                                            $sql = "SELECT appointment.id AS mn_id, doctors.firstname AS doctor_fname, doctors.lastname AS doctor_lname, users.firstname AS user_fname, users.lastname AS user_lname, appointmentdate, details FROM appointment";
                                            $sql .= " LEFT JOIN users ON users.id=appointment.id_users 
                                                    LEFT JOIN doctors ON doctors.id=appointment.id_doctor  
                                                    WHERE appointment.id_doctor=".$_SESSION['id'];
                                                    
                                        if($_SESSION['search_term'] !== '') { 
                                            $search_term = $_SESSION['search_term'];
                                                $sql .= " AND (appointment.id LIKE '%$search_term%' 
                                                            OR appointmentdate LIKE '%$search_term%' 
                                                            OR doctors.firstname LIKE '%$search_term%' 
                                                            OR doctors.lastname LIKE '%$search_term%'
                                                            OR users.firstname LIKE '%$search_term%'
                                                            OR users.lastname LIKE '%$search_term%'
                                                            OR users.firstname LIKE '%$search_term%' 
                                                            OR details LIKE '%$search_term%')";
                                                    }
                                                    $sql .= " GROUP BY appointment.id";
                            
                                                    $result = mysqli_query($conn, $sql);
                                                    if(mysqli_num_rows($result) > 0) {
                                                        $count = 1;
                                                        while($row = mysqli_fetch_assoc($result)) {
                                                            echo "<tr>";
                                                            echo "<td class='center'>$count.</td>";
                                                            echo "<td>".$row['doctor_fname']."</td>";
                                                            echo "<td>".$row['doctor_lname']."</td>";
                                                            echo "<td>".$row['user_fname']."</td>";
                                                            echo "<td>".$row['user_lname']."</td>";
                                                            echo "<td>".$row['appointmentdate']."</td>";
                                                            echo "<td>".$row['details']."</td>";
                                                            echo "<td>";
                                                            echo "<div class='visible-md visible-lg hidden-sm hidden-xs'>";
                                                            echo "<a href='view-appointment.php?id=".$row['mn_id']."' class='btn btn-primary btn-xs' tooltip-placement='top' tooltip='View'><i class='fa fa-eye'></i></a>";
                                                            echo "<a href='edit-appointment.php?id=".$row['mn_id']."' class='btn btn-warning btn-xs' tooltip-placement='top' tooltip='Edit'><i class='fa fa-pencil'></i></a>";
                                                            echo "<a href='manage-appointment.php?id=".$row['mn_id']."&del=delete' onClick='return confirm(\"Are you sure you want to delete?\")' class='btn btn-danger btn-xs tooltips' tooltip-placement='top' tooltip='Remove'><i class='fa fa-times fa fa-white'></i></a>";
                                                            echo "</div>";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                            $count++;
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='10'>ไม่พบข้อมูลที่ตรงกับคำค้นหา</td></tr>";
                                                    }
                                                    ?>
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