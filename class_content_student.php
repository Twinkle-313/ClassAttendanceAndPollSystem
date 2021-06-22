<?php
session_start();
if(isset($_SESSION['userid']))
{
    $uid=$_SESSION['userid'];
}
$classid=$_GET['classId'];
include "_dbconnect.php";

$sql = "SELECT * FROM `ClassroomInfo` WHERE `ClassId` = $classid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$classname=$row['ClassName'];
$uniquecode=$row['UniqueCode'];
$adminid=$row['Admin'];
$sql2 = "SELECT * FROM `UserInfo` WHERE `UserId` = $adminid";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$adminname=$row2['Name'];
?>
<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

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
  background-color:darkgray;
  color: white;
}
</style>

</head>
<body>

<!-- Sidebar -->
<div class="w3-sidebar w3-black w3-bar-block" style="width:20%; background-image:url('nightsky.webp')">
  <h1 class="w3-bar-item"></h1>
  <h1 class="w3-bar-item"><center><?php echo  nl2br($classname); ?></center></h1>
  <h1 class="w3-bar-item"></h1>
  <h3 class="w3-bar-item" style="color:yellow">Teacher's Name : <?php echo nl2br($adminname); ?></h3>
  <h1 class="w3-bar-item"></h1>
  <h4 class="w3-bar-item"><center>Done with the semester?</center></h4>
  <a href="exit_class.php?classId=<?php echo $classid ?>" class="w3-bar-item w3-button w3-border w3-border-light-grey w3-round-large" style="color:red"><center><h3>Exit Class</h3></center></a>
  
</div>

<!-- Page Content -->
<div style="margin-left:20%">

<div class="w3-container w3-black">
  <h1><center>WELCOME TO THE CLASS</center></h1>
</div>
<div class="w3-container w3-black">
  <h2><center>Happy learning :)</center></h2>
</div>

<br><br>

<div class="w3-container">
<?php

$sql3="select * from polls where ClassId=$classid";
$result3 = mysqli_query($conn,$sql3);
$num = mysqli_num_rows($result);
if($num==0)
{
 echo'No Polls to show';
}
else
{
    echo'<table id="customers">
  <tr>
    <th>Polls</th>
    <th>Due Date</th>
    <th>Status</th>
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
    
    $sql4="select * from user_response where QId=$qid AND UserId=$uid";
    $result4 = mysqli_query($conn, $sql4);
    $num4 = mysqli_num_rows($result4);
    echo '<tr>';
    if($num4>=1)
   { echo'<td>' .nl2br($question). '</a></td>';
    if($currdatetime>$dt)
    echo' <td><span style="color:grey">poll is expired</span></td>';
    else
    echo'<td>'.$time. ' '.$t.'</td>';
    echo '<td><span style="color:green">Responded</span></td>';
   }
   else{
    if($currdatetime>$dt)
    {
        echo'<td>' .nl2br($question). '</a></td>';
        echo' <td><span style="color:grey">poll is expired</span></td>';
    }
    else
    {
        echo'<td><a href="poll_question.php?queid=' .$qid. '&classId=' .$classid. '">' .nl2br($question). '</a></td>';
        echo'<td>'.$time. ' '.$t.'</td>';
    }
    echo '<td><span style="color:red">Due</span></td>';
   }
   echo '</tr>';
  }
echo'</table>';
}
?>

</div>

</div>
      
</body>
</html>