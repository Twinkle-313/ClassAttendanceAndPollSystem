<?php
session_start();
$uid=$_SESSION['userid'];
$classid=$_GET['classId'];
echo $classid;
include "_dbconnect.php";
    $sql2="DELETE from Participants where UserID=$uid AND ClassId=$classid";
    $result2 = mysqli_query($conn, $sql2);
    if($result2)
    {
        echo 'left the class';
        header("location: home.php");
    }
?>