<?php
include('../include/config.php');
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if(isset($_POST['submit'])) {
    $id = $_GET['id'];
    $id_users = $_POST['id_users'];
    $id_doctor = $_POST['id_doctor'];
    $id_drugs = implode(',', $_POST['id_drugs']);
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $bloodpressure = $_POST['bloodpressure'];
    $medicalhistorydate = $_POST['medicalhistorydate'];
    $details = $_POST['details'];
    $sql = "UPDATE medicalhistory SET id_users='$id_users', id_doctor='$id_doctor', id_drugs='$id_drugs', height='$height', weight='$weight', bloodpressure='$bloodpressure', medicalhistorydate='$medicalhistorydate', details='$details' WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('อัปเดตข้อมูลสำเร็จ!');</script>";
        echo "<script>window.location = 'manage-medicalhistory.php';</script>";
        $msg = "Medicalhistory updated successfully";  
        exit();
    } 
    else {
        $msg = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Edit Medical History</title>
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
                                <h1 class="mainTitle">Admin | Edit Medical History Details</h1>
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
                                                <h5 class="panel-title">Edit Medical History Info</h5>
                                            </div>
                                            <div class="panel-body">
                                            <?php
                                                include('../include/config.php'); 
                                                if(isset($_GET['id'])) {
                                                    $id = $_GET['id'];
                                                    $sql=mysqli_query($conn,"SELECT * FROM medicalhistory WHERE id=".$id);
                                                    $data=mysqli_fetch_array($sql);                                           
                                            ?>
                                                <form role="form" name="adddoc" method="post" onSubmit="return valid();">
                                                    <div class="form-group">
                                                        <label for="id_doctor">Doctor Name</label>
                                                        <select name="id_doctor" id="id_doctor" required class="form-control" style="height: 40px;">
                                                            <option value="" disabled>---Select Doctor---</option>

                                                            <?php $sql = mysqli_query($conn,"SELECT * FROM doctors"); 
                                                            while($row = mysqli_fetch_assoc($sql)) { 
                                                            ?>
                                                            <option value="<?php echo $row['id'];?>" 
                                                                <?php if($row['id'] == $data['id_doctor']) { echo 'selected';} ?>>
                                                                <?php echo $row['firstname'];?>
                                                                <?php echo $row['lastname'];?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="id_users">Patient Name</label>
                                                        <select name="id_users" id="id_users" required class="form-control" style="height: 40px;">
                                                            <option value="" disabled>---Select Patient---</option>

                                                            <?php $sql = mysqli_query($conn,"SELECT * FROM users"); 
                                                            while($row = mysqli_fetch_assoc($sql)) { 
                                                            ?>
                                                            <option value="<?php echo $row['id'];?>" 
                                                                <?php if($row['id'] == $data['id_users']) { echo 'selected';} ?>>
                                                                <?php echo $row['firstname'];?>
                                                                <?php echo $row['lastname'];?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>                                            
                                           

                                                    <div class="form-group" id="drug-list">
                                                        <label for="id_drugs">Drug Name</label><br>
                                                        <?php 
                                                        $sql_drugs = mysqli_query($conn, "SELECT * FROM drugs"); 
                                                        $selected_drugs_array = explode(',', $data['id_drugs']);
                                                        for ($i = 0; $i < count($selected_drugs_array); $i++) {
                                                            $selected_drug_id = $selected_drugs_array[$i];
                                                            ?>
                                                            <div class="form-group drug-container">
                                                                <select name="id_drugs[]" class="form-control mt-2" style="height: 40px;">
                                                                    <option value="" disabled>---Select Drug---</option>
                                                                    <?php 
                                                                    while($row_drugs = mysqli_fetch_assoc($sql_drugs)) {
                                                                        ?>
                                                                        <option value="<?php echo $row_drugs['id']; ?>" <?php echo ($selected_drug_id == $row_drugs['id']) ? 'selected' : ''; ?>><?php echo $row_drugs['drugname']; ?></option>
                                                                        <?php 
                                                                    }
                                                                    mysqli_data_seek($sql_drugs, 0);
                                                                    ?>
                                                                </select>  
                                                                <?php if ($i === 0) { ?>
                                                                <button type="button" class="btn btn-primary" onclick="addDrug()">Add</button>
                                                                <?php } else { ?>
                                                                <button type="button" class="btn btn-danger my-2" onclick="removeDrug(this)">Remove</button>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
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
                                                                                document.getElementById('drug-list').appendChild(drugContainer);

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
                                                            value="<?php echo htmlentities($data['height']);?>" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="weight">Weight</label>
                                                        <input type="weight" name="weight" class="form-control"
                                                            value="<?php echo htmlentities($data['weight']);?>" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="bloodpressure">Bloodpressure</label>
                                                        <input type="bloodpressure" name="bloodpressure" class="form-control"
                                                            value="<?php echo htmlentities($data['bloodpressure']);?>" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="medicalhistorydate">Medicalhistorydate</label>
                                                        <input type="datetime-local" name="medicalhistorydate" class="form-control"
                                                            value="<?php echo htmlentities($data['medicalhistorydate']);?>" required>
                                                    </div>                                                                       

                                                    <div class="form-group">
                                                        <label for="details">Details</label>
                                                        <input type="details" name="details" class="form-control"
                                                            value="<?php echo htmlentities($data['details']);?>" required>
                                                    </div>

                                                    <button type="submit" name="submit" class="btn btn-primary" style="float: right;">Update</button>
                                                    <a href="manage-medicalhistory.php" class="btn btn-danger" style="float: right; margin-right: 10px;">Cancel</a>

                                                </form>
                                                <?php } ?>
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