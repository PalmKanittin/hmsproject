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
    <title class="print-title">Admin | View Medical History</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tohoma";
        }

        .page {
            width: 21cm;
            overflow: hidden;
            min-height: 29.7cm;
            padding: 2.5cm;
            margin-left: auto;
            margin-right: auto;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .TableData {
            background: #ffffff;
            font: 11px;
            width: 100%;
            border-collapse: collapse;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 12px;
            border: thin solid #d3d3d3;
        }

        .TableData TH {
            background: rgba(0, 0, 255, 0.1);
            text-align: center;
            font-weight: bold;
            color: #000;
            border: solid 1px #ccc;
            height: 24px;
        }

        .TableData TR {
            height: 24px;
            border: thin solid #d3d3d3;
        }

        .TableData TR TD {
            padding-right: 2px;
            padding-left: 2px;
            border: thin solid #d3d3d3;
        }

        .TableData TR:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .TableData .cotSTT {
            text-align: center;
            width: 10%;
        }

        .TableData .cotTenSanPham {
            text-align: left;
            width: 40%;
        }

        .TableData .cotGia {
            text-align: right;
            width: 120px;
        }

        .TableData .cotSoLuong {
            text-align: center;
            width: 50px;
        }

        .TableData .cotSo {
            text-align: right;
            width: 120px;
        }

        .TableData .tong {
            text-align: right;
            font-weight: bold;
            text-transform: uppercase;
            padding-right: 4px;
        }

        .TableData .cotSoLuong input {
            text-align: center;
        }

        /* Print button style */
        .print-btn {
            margin-top: 20px;
            text-align: center;
        }

        .print-btn button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-btn button:hover {
            background-color: #0056b3;
        }

        @media print {
            .print-title {
                display: none;
            }       
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="app-content">       
            <div class="main-content">
                <div class="wrap-content container" id="container">                        
                    <div class="page">     
                    <img src="assets/images/hms.png" alt="Hospital Logo" style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); width: 150px; height: auto;">                  
                        <div class="container-fluid container-fullw bg-white">                    
                            <div>
                                <tr>
                                    <td>โรงพยาบาล HMS | Hospital Management System</td> <br>
                                    <td>169 ถนนลงหาดบางแสน   ตำบลแสนสุข อำเภอเมือง จังหวัดชลบุรี 20131</td> <br>
                                    <td>โทรศัพท์ 095-950-8184</td> <br>
                                </tr>                        
                            </div>
                                <div class="row">                               
                                    <div class="col-md-12">                                                               
                                        <?php
                                        $aid=$_GET['id'];
                                        include('../include/config.php');
                                        $sql = mysqli_query($conn,"SELECT appointment.id AS a_id, doctors.firstname AS doctor_fname, doctors.lastname AS doctor_lname, users.firstname AS user_fname, users.lastname AS user_lname, appointmentdate, details FROM appointment                                          
                                        INNER JOIN users ON users.id=appointment.id_users 
                                        INNER JOIN doctors ON doctors.id=appointment.id_doctor 
                                        WHERE appointment.id = '$aid'"); 
                                        ?> 

                                    <table border="1" class="TableData table table-bordered">
                                    <tr align="center">
                                        <td colspan="4" style="font-size:20px;">Appointment Details</td>
                                    </tr>

                                    <?php while ($row = mysqli_fetch_assoc($sql)) { ?>

                                    <tr>
                                        <th scope>Patient Name</th>
                                        <td><?php  echo $row['user_fname'];?>              
                                            <?php  echo $row['user_lname'];?></td>
                                    </tr>

                                    <tr>
                                        <th scope>Docter Name</th>
                                        <td><?php  echo $row['doctor_fname'];?>
                                            <?php  echo $row['doctor_lname'];?></td>
                                    </tr>

                                    <tr>
                                        <th scope>Appointmentdate</th>
                                        <td><?php  echo $row['appointmentdate'];?></td>
                                    </tr>

                                    <tr>
                                        <th scope>Details</th>
                                        <td><?php  echo $row['details'];?></td>
                                    </tr>       

                                    <?php }?>
                                </table>                                  
                                    </div>
                                </div>
                            </div>
                            <br>
                        <div style="float: right;">
                            <a href="appointment.php" class="btn btn-primary">Back</a>
                            <button onclick="window.print()" class="btn btn-warning" style="margin-right: 10px;">Print</button>                        
                        </div>                           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
