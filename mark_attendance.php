<HTML>
 <head>
<style>
    #customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 30%;
  margin:auto;
  margin-top:80px;
  text-align:center;
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
  text-align:center;
}
.nopost{

font-size: 20px;
color: darkgrey;
    width: 200px;
    border: 1px solid darkgray;
   font-weight: lighter;
    margin:auto;
    margin-top:80px;
    box-shadow: 0 30px 30px 0 rgba(0,0,0,0.3);
    
    /* min-height: 570px; */
    /* display: grid;
    grid-template-columns: 100px;  */
    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
    
}
</style>
</head>
<body>
<?php
include "_dbconnect.php";
$classid=$_GET['classId'];
if(isset($_POST['submit']))
{
    if(!empty($_POST['check_list']))
    {
        echo '<div class="nopost">
       <center> students who are present today</center>
       </div>';
        
       
        echo'<table id="customers">
        <tr>
       <th>Student</th>
      </tr>';

      $sql = "UPDATE `ClassroomInfo` SET Numbers=Numbers+1 WHERE ClassId=$classid";
      $result = mysqli_query($conn, $sql);
        foreach($_POST['check_list'] as $uid)
        {
            $sql2 ="SELECT * FROM `UserInfo` WHERE `UserId` = $uid" ;
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $name=$row2['Name'];
            echo'
           <tr>
           <td>'.$name.'</th>
           </tr>';
            $sql3="update Participants set Attendance=Attendance+1 where ClassId=$classid AND UserId=$uid";
            $result3=mysqli_query($conn,$sql3);
          
        }
        echo '</table>';
         $sql3="select * from Participants where ClassId=$classid";
         $result3=mysqli_query($conn,$sql3);
         $num=mysqli_num_rows($result3);
        $total_present=count($_POST['check_list']);
        echo '<div class="nopost">
       <center> TOTAL Present:'.$total_present.'/'.$num.'</center>
       </div>';
        
    }
}



?>