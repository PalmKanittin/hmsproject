<?php
$host = "localhost"; // หรือ IP address ของฐานข้อมูล
$username = "root";
$password = "";
$database = "hmsproject";

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($host, $username, $password, $database);

//ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($host, $username, $password, $database);
?>