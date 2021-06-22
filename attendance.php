<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<style>
    #customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 50%;
  margin:auto;
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
.nopost{

font-size: 20px;
color: darkgrey;
    width: 200px;
  
   font-weight: lighter;
    margin:auto;
    margin-top:40px;
  
    
    /* min-height: 570px; */
    /* display: grid;
    grid-template-columns: 100px;  */
    
    
}
input.largerCheckbox {
            width: 20px;
            height: 20px;
        }
        .btn {
  background: #d0d7db;
  background-image: -webkit-linear-gradient(top, #d0d7db, #546169);
  background-image: -moz-linear-gradient(top, #d0d7db, #546169);
  background-image: -ms-linear-gradient(top, #d0d7db, #546169);
  background-image: -o-linear-gradient(top, #d0d7db, #546169);
  background-image: linear-gradient(to bottom, #d0d7db, #546169);
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  -webkit-box-shadow: 0px 1px 3px #666666;
  -moz-box-shadow: 0px 1px 3px #666666;
  box-shadow: 0px 1px 3px #666666;
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
}
    
</style>
</head>
<body>
<?php
$classid=$_GET['classId'];
echo '<br>';
include "_dbconnect.php";
$sql = "SELECT * FROM `Participants` WHERE `ClassId` = $classid";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
echo '<div class="wrapper fadeInDown">';
echo '<div id="formContent">';
echo '<form action ="mark_attendance.php?classId='.$classid.'" method="post">';
echo '<div class="nopost">
<center><h3>ATTENDANCE</h3></center>
</div>';
echo'<table id="customers">
<tr>
  <th>Student</th>
  <th>Mark Present</th>
</tr>';
if($num>0){
while($row = mysqli_fetch_assoc($result)){
$userid=$row['UserId'];

$sql2 ="SELECT * FROM `UserInfo` WHERE `UserId` = $userid" ;
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$name=$row2['Name'];

echo'<tr>
<td><label>'.$name.'</label></td>
<td><input type="checkbox" name="check_list[]" class="largerCheckbox" value="'.$userid.'"></td></tr><br> ';

}
echo '</table><br><br>';
echo '<center><input type="submit" name="submit" class="btn" value="Submit"></center>';
echo '</form>';

}
else echo "No students to show"; 



?>


</body>
</html>