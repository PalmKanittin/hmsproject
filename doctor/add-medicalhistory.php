<?php
include('../include/config.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    header("Location: ../login.php");
    exit();
}

if(isset($_POST['submit'])) {	
    $id_users=$_POST['id_users'];
    $id_doctor=$_POST['id_doctor'];
    $id_drugs=$_POST['id_drugs'];
    $height=$_POST['height'];
    $weight=$_POST['weight'];
    $bloodpressure=$_POST['bloodpressure'];
    $medicalhistorydate=$_POST['medicalhistorydate'];
    $details=$_POST['details'];

    $id_drugs_str = implode(',', $id_drugs);

    $sql=mysqli_query($conn,"INSERT INTO medicalhistory(id_users, id_doctor, id_drugs, height, weight, bloodpressure, medicalhistorydate, details) 
    values('$id_users','$id_doctor','$id_drugs_str','$height','$weight','$bloodpressure','$medicalhistorydate','$details')");
    

if($sql){

echo "<script>alert('เพิ่มข้อมูลสำเร็จ');</script>";
echo "<script>window.location.href ='manage-medicalhistory.php'</script>";
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor | Add Medicalhistory</title>

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
                                <h1 class="mainTitle">Doctor | Add Medicalhistory</h1>
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
                                                <h5 class="panel-title">Add Medicalhistory</h5>
                                            </div>
                                            <div class="panel-body">

                                                <form role="form" name="adddoc" method="post"
                                                    onSubmit="return valid();">
                                           
                                                    <div class="form-group">
                                                        <label for="id_doctor">Doctor name</label>
                                                        <select name="id_doctor" id="id_doctor" required class="form-control" style="height: 40px;">                                                          
                                                            <?php 
                                                                $docname = $_SESSION['id']; 
                                                                $sql = mysqli_query($conn, "SELECT * FROM doctors WHERE id = $docname"); 
                                                                $row = mysqli_fetch_assoc($sql);
                                                            ?>
                                                            <option value="<?php echo $row['id'];?>">
                                                                <?php echo $row['firstname'];?>
                                                                <?php echo $row['lastname'];?>
                                                            </option>
                                                        </select>
                                                    </div> 

                                                    <div class="form-group">
                                                        <label for="id_users">Patient name</label>
                                                        <select name="id_users" id="id_users" required class="form-control" style="height: 40px;">
                                                            <option value="" disabled selected>---Select Patient---</option>
                                                            <?php 
                                                            $sql = mysqli_query($conn,"SELECT * FROM users"); 
                                                            while($row = mysqli_fetch_assoc($sql)) { 
                                                            ?>
                                                            <option value="<?php echo $row['id'];?>">
                                                                <?php echo $row['firstname'];?>
                                                                <?php echo $row['lastname'];?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>  
                                                    
                                                    <div class="form-group">
                                                        <label for="id_drugs">Drug name</label><br>
                                                        <button type="button" class="btn btn-primary" onclick="addDrug()">Add</button>                                                        
                                                        <select name="id_drugs[]" id="id_drugs" class="form-control mt-2" style="height: 40px;">
                                                            <option value="" disabled selected>---Select Drug---</option>
                                                            <?php 
                                                            $sql = mysqli_query($conn, "SELECT * FROM drugs"); 
                                                            while($row = mysqli_fetch_assoc($sql)) { 
                                                            ?>
                                                            <option value="<?php echo $row['id'];?>"><?php echo $row['drugname'];?></option>
                                                            <?php } ?>
                                                        </select>                                                      
                                                    </div>


                                                                        <script>
                                                                            function addDrug() {
                                                                                var selectHTML = '<div class="form-group">' +
                                                                                                    '<label for="id_drugs"></label>' +
                                                                                                    '<select name="id_drugs[]" class="form-control" style="height: 40px;">' +
                                                                                                        '<option value="" disabled selected>---Select Drug---</option>';
                                                                                <?php 
                                                                                $sql = mysqli_query($conn, "SELECT * FROM drugs"); 
                                                                                while($row = mysqli_fetch_assoc($sql)) { 
                                                                                ?>
                                                                                selectHTML += '<option value="<?php echo $row['id'];?>"><?php echo $row['drugname'];?></option>';
                                                                                <?php } ?>
                                                                                selectHTML += '</select>' +
                                                                                                '<button type="button" class="btn btn-danger my-2" onclick="removeDrug(this)">Remove</button>' +
                                                                                            '</div>';
                                                                                
                                                                                var drugContainer = document.createElement('div');
                                                                                drugContainer.className = 'drug-container';
                                                                                drugContainer.innerHTML = selectHTML;
                                                                                document.getElementById('id_drugs').parentNode.appendChild(drugContainer);
                                                                            }

                                                                            function removeDrug(button) {
                                                                                if (document.getElementsByClassName('drug-container').length > 1) {
                                                                                    button.parentNode.remove();
                                                                                } else {
                                                                                    alert('At least one drug selection must remain.');
                                                                                }
                                                                            }
                                                                        </script>
                                                                                                    

                                                    <div class="form-group">
                                                        <label for="height">Height</label>
                                                        <input type="height" name="height" class="form-control"
                                                            value="" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="weight">Weight</label>
                                                        <input type="weight" name="weight" class="form-control"
                                                            value="" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="bloodpressure">Bloodpressure</label>
                                                        <input type="bloodpressure" name="bloodpressure" class="form-control"
                                                            value="" required>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="medicalhistorydate">Medicalhistorydate</label>
                                                        <input type="datetime-local" name="medicalhistorydate" id="medicalhistorydate" class="form-control" required>
                                                        <div id="dateError" style="color: red;"></div>
                                                    </div>
                                                    <script src="../assets/js/date-medical.js"></script>

                                                    <div class="form-group">
                                                        <label for="details">Details</label>
                                                        <input type="details" name="details" class="form-control"
                                                            value="" required>
                                                    </div>


                                                    <button type="submit" name="submit" class="btn btn-primary" style="float: right;">Add</button>
                                                    <a href="manage-medicalhistory.php" class="btn btn-danger" style="float: right; margin-right: 10px;">Cancel</a>
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
