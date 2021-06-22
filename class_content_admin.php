<?php
$classid=$_GET['classId'];
include "_dbconnect.php";
$sql = "SELECT * FROM `ClassroomInfo` WHERE `ClassId` = $classid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$classname=$row['ClassName'];
$uniquecode=$row['UniqueCode'];
?>
<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Benne&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Benne&family=Playfair+Display&display=swap" rel="stylesheet">

<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-top: 100px;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: darkgray;
  color: white;
}

.nopost{

font-size: 80px;
color: darkgrey;
    width: 1000px;
    border: 1px solid darkgray;
   font-weight: lighter;
    margin-top: 20px;
    margin-bottom: 20px;
    margin-left: 250px;
    margin:auto;
    box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
    
     min-height: 570px; 
    /* display: grid;
    grid-template-columns: 100px;  */
    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
    
}
a{
  color:black;
}
</style>

</head>
<body>

<!-- Sidebar -->
<div class="w3-sidebar w3-black w3-bar-block" style="width:20%; background-image:url('nightsky.webp')">
  <h1 class="w3-bar-item"></h1>
  <h1 class="w3-bar-item"><?php echo  nl2br($classname); ?></h1>
  <h1 class="w3-bar-item"></h1>
  <h3 class="w3-bar-item" style="color:yellow">Class Code : <?php echo $uniquecode; ?></h3>
  <h1 class="w3-bar-item"></h1>
  <a href="attendance.php?classId=<?php echo $classid ?>" class="w3-bar-item w3-button w3-border w3-border-light-grey w3-round-large"><center><h3>Mark Attendance</h3></center></a>
  <h1 class="w3-bar-item"></h1>
  <a href="total_attendance.php?classId=<?php echo $classid ?>" class="w3-bar-item w3-button w3-border w3-border-light-grey w3-round-large"><center><h3>Total Attendance</h3></center></a>
  <h1 class="w3-bar-item"></h1>
  <a href="poll.php?classId=<?php echo $classid ?>" class="w3-bar-item w3-button w3-border w3-border-light-grey w3-round-large"><center><h3>Create a Poll</h3></center></a>
  <h1 class="w3-bar-item"></h1>
  <h3 class="w3-bar-item"><center>Done with taking this class?</center></h3>
  <a href="delete_class.php?classId=<?php echo $classid ?>" class="w3-bar-item w3-button w3-border w3-border-light-grey w3-round-large" style="color:red"><center><h3>Delete Class</h3></center></a>
</div>

<!-- Page Content -->
<div style="margin-left:20% ">

<div class="w3-container w3-dark-grey">
  <h1><center>WELCOME TO THE CLASS</center></h1>
</div>
<div class="w3-container w3-dark-grey">
  <h1><center>THANKS FOR TEACHING :)</center></h1>
</div>

<br><br>

<div class="w3-container">
<?php

$sql3="select * from polls where ClassId=$classid";
$result3 = mysqli_query($conn,$sql3);
$num = mysqli_num_rows($result3);

if($num>=1)
{
    echo'<table id="customers">
  <tr>
    <th>See Poll Responses</th>
    <th>Due Date</th>
  </tr>';

  while($row3 = mysqli_fetch_assoc($result3))
  {
    $qid=$row3['QId'];
    $question=$row3['Question'];
    $dt=$row3['datetime'];
    $dtob=new DateTime($dt);
    $date=$dtob->format('d');
    $month=$dtob->format('m');
    $year=$dtob->format('Y');
    $dtob2=DateTime::createFromFormat('!m', $month);
    $monthname=$dtob2->format('F');
    $time=$dtob->format('h:i A');
    $t=$date . " " . $monthname . " " . $year;

    $currdatetime=date('Y-m-d h:i:s');
    echo '<tr>
    <td><a href="poll_response.php?queid=' .$qid. '&classId=' .$classid. '">' .nl2br($question). '</a></td>';
    if($currdatetime>$dt)
    echo' <td><span style="color:grey">poll is expired</span></td>';
    else
    echo'<td>'.$time. ' '.$t.'</td>';
 
   echo '</tr>';
  }
echo'</table>';
}
else{
  echo '<div class="nopost">
        <center> NO POLLS TO SHOW</center>
        <a href="poll.php?classId=' .$classid. '" class="btn btn-primary">CREATE A POLL</a>
     </div>';
}
?>

</div>

</div>
      
</body>
</html>