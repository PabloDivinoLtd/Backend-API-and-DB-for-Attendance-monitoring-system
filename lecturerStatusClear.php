<?php
/**
 * Created by PhpStorm.
 * User: landtanin
 * Date: 4/19/2017 AD
 * Time: 1:27 PM
 */

$servername = "localhost";
$user = "root";
$pass = "Jv42Lgz?Ogi6";
$dbname = "attendance_monitoring";


// Create connection
$conn = new mysqli($servername, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error){
    die("Connecction failed: " . $conn->connect_error);
}


echo "Connected successfully"."<br>";

if(isset($_POST['status']) && $_POST['status'] != ''
    && isset($_POST['module_id']) && $_POST['module_id'] != ''){

    $status = $_POST['status']; // String - checked, late, and absent
    $module_id = $_POST['module_id']; // String
    $sql = "UPDATE studentmodule SET status = '$status' WHERE Module_id = '$module_id'";
    $sql2 = "UPDATE studentinfo SET AttendanceStatus = '$status' WHERE Student_id IN (SELECT Student_id FROM `StudentModule` WHERE Module_id = '$module_id')";

}else{

    echo "invalid input";

}

//$db->QueryExec($sql);


if (($conn->query($sql) === TRUE) && ($conn->query($sql2) === TRUE)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
// -------------------------------------------------------------------------------------


// close the connection
$conn->close();

?>
