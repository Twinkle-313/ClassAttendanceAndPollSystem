<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Benne&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Benne&family=Playfair+Display&display=swap" rel="stylesheet">
<style>
     .myDiv {
    width:50%;
    padding:30px;
    line-height:30px;
    margin:auto;
    border: 5px outset red;
    background-color: lightblue;    
    text-align: center;
    }
     a{
         text-decoration:none;
         color:white;
     }
     .btn:hover
     {
      background-color:black;
     }
     .top-left {
         padding:5px;
  position: absolute;
  top: 8px;
  left: 16px;
  font-family: 'Benne', serif;
font-family: 'Playfair Display', serif;
line-height:20px;
font-weight:bold;
}
.left {
    padding:10px;
  position: absolute;
  top: 45px;
  left: 16px;
  font-family: 'Benne', serif;
  line-height:20px;
  font-size:25px;
}
.left-right {
    padding:10px;
  position: absolute;
  top: 70px;
  left: 16px;
  line-height:20px;
  font-family: 'Benne', serif;
  font-size:25px;
}
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <form class="form-inline" background-color="black">
    <button class="btn btn-outline-success" class="btn" type="button" style="margin-left:1170px" ><a href="create_classroom.php">CREATE CLASSROOM</a></button>
    <button class="btn btn-outline-success" class="btn" type="button"><a href="join_classroom.php">JOIN CLASSROOM</a></button>
  </form>
</nav>
<br>

<?php

session_start();
$uid=$_SESSION['userid'];
include "_dbconnect.php";
$sql="SELECT * FROM `Participants` WHERE UserId = $uid";
$result = mysqli_query($conn, $sql);
$noResult = true;
echo '<div class="container">';
echo ' <div class="row align-items-start">';
while($row = mysqli_fetch_assoc($result)){
    $Cid=$row['ClassId'];
    $noResult = false;
    $sql2 = "SELECT * FROM `ClassroomInfo` WHERE ClassId = $Cid";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $name= $row2['ClassName'];
    $Cid=$row2['ClassId'];
    $adminid=$row2['Admin'];
    $sql3="SELECT * FROM `UserInfo` WHERE UserId = $adminid";
    $result3 = mysqli_query($conn, $sql3);
    $row3=mysqli_fetch_assoc($result3);
    $aname=$row3['Name'];
    echo '
    <div class="card" style="width: 18rem; margin:50px;">
    <img src="class.jpg" class="card-img-top" >
      <h3 class="top-left" class="card-title">'.$name.'</h3>
      <span class="left">Professor : </span><span class="left-right" class="card-title">'.$aname.'</span>
    <div class="card-body">
      <a href="content.php?userid=' .$uid. '&classId=' .$Cid. '" class="btn btn-primary">ENTER CLASS</a>
    </div>
    </div>';
}
echo '</div>';
echo '</div>';
$sql3="SELECT * FROM `ClassroomInfo` WHERE Admin = $uid";
$result3 = mysqli_query($conn, $sql3);
echo '<div class="container">';
echo ' <div class="row align-items-start">';
while($row3 = mysqli_fetch_assoc($result3)){
    $Cid=$row3['ClassId'];
    $noResult = false;
    $name= $row3['ClassName'];
    echo '
    <div class="card" style="width: 18rem;margin:50px;">
    <img src="class.jpg" class="card-img-top" >
    <h3 class="top-left" class="card-title">'.$name.'</h3>
    <span class="left-right" class="card-title">Class created by you</span>
    <div class="card-body">
     <a href="content.php?userid=' .$uid. '&classId=' .$Cid. '" class="btn btn-primary">ENTER CLASS</a>
    </div>
    </div>';
}
echo '</div>';
echo '</div>';
if($noResult==true)
{
    echo '<div class="myDiv">
    <h2>NO CLASSES TO SHOW</h2>
    <h5>Want to Join Class? Click JOIN CLASSROOM button</h5>
    <h5>Want to Create Class? Click CREATE CLASSROOM button</h5>
  </div>';
}
?>


</body>
</html>