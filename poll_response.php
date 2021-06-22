<HTML>
 <head>
<style>
    #customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width:50%;
    margin:auto;
    margin-top: 80px;
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
    border: 1px solid darkgray;
   font-weight: lighter;
    margin:auto;
    margin-top: 80px;
    box-shadow: 0 10px 40px 0 rgba(0,0,0,0.3);
    
    /* min-height: 570px; */
    /* display: grid;
    grid-template-columns: 100px;  */
    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
    
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
include "_dbconnect.php";
$qid=$_GET['queid'];
//echo $qid;
$classid=$_GET['classId'];

if(array_key_exists('delbutton',$_POST))
{
    $sql1="delete from polls where QId=$qid";
    $result1=mysqli_query($conn,$sql1);
    if($result1)
    {
        //header("location: class_content.php?classId=$classid");
        echo "pollquestion deleted";
    }
    else{
        echo "not successful";
    }

    $sql4="delete from poll_options where QId=$qid";
    $result4=mysqli_query($conn,$sql4);
    if($result4)
    {
        //header("location: class_content.php?classId=$classid");
        echo "polloption deleted";
    }
    else{
        echo "not successful";
    }


    $sql5="delete from user_response where QId=$qid";
    $result5=mysqli_query($conn,$sql5);
    if($result5)
    {
        header("location:content.php?classId=$classid");
        echo "pollresponse deleted";
    }
    else{
        echo "not successful";
    }

}

echo '<div class="nopost">
<center> Want to delete this poll?
<form method="post">
<input type="submit" name="delbutton" value="Click here" class="btn" />
</form></center>
</div>';


$sql="select * from poll_options where QId=$qid";
$result=mysqli_query($conn,$sql);
echo'<table id="customers">
<tr>
  <th>Option</th>
  <th>Numbers of student who chose the option</th>
</tr>';
while($row = mysqli_fetch_assoc($result))
{
    $option=$row['Option'];
    $number=$row['Numbers'];
  
    echo '<br>';
    echo'
    <tr>
      <td>'.$option.'</th>
      <td>'.$number.'</th>
    </tr>';
}
echo '</table>';



?>
</body>
</HTML>