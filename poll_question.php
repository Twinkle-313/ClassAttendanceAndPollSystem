<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
* { 
	margin: 0; 
	padding: 0; 
}
body { 
	font-size: 62.5%; 
	font-family: Georgia, serif;
	background:top center no-repeat #DDDDDD; 
}
label{
	padding: 10px;
	font-size: 2.0em;
    line-height:40px;
	color:black;
    margin:auto;
}
fieldset {
	margin: 115px auto;
	width: 40%;
	padding: 15px 15px 15px 15px;
	border: 5px outset black;
	}
input.largerCheckbox {
            width: 20px;
            height: 20px;
        }
legend {
        margin:auto;
		padding: 15px 15px 15px 15px;
		border: 5px outset black;
		font-size: 2.0em;
		color: black;
		font-style: italic;
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
  text-decoration: none;}
</style>
</head>
<body>
<?php
session_start();
if(isset($_GET['queid']))
{$qid=$_GET['queid'];
}
$uid=$_SESSION['userid'];

if(isset($_GET['classId']))
{$classid=$_GET['classId'];
}
include "_dbconnect.php";
$sql2="SELECT * from `user_response` where QId=$qid AND UserId=$uid";
$result2=mysqli_query($conn,$sql2);
$num = mysqli_num_rows($result2);
if($num==1)
{
  echo "already responded";
  header("location:content.php?classId=$classid");
}

if(isset($_POST['submit']))
{
  $sql3="INSERT INTO `user_response`( `QId`, `UserId`) VALUES ($qid, $uid)";
  $result3=mysqli_query($conn,$sql3);
  if($result3)
  {
    header("location:content.php?classId=$classid");
  }
  else{
    
  }
  $opid=$_POST['check'];
  $sql4="UPDATE `poll_options` set Numbers=Numbers+1 where QId=$qid AND OptionId=$opid";
  $result4=mysqli_query($conn,$sql4);
  if($result4)
  {
      
 }
  else{

  }
}

$sql="SELECT * from poll_options where QId=$qid";
$result=mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
$sql1="SELECT * from polls where QId=$qid";
$result1=mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_assoc($result1);
$question=$row1['Question'];
echo '<fieldset>';
echo '<legend>'.$question.'</legend><br>';
echo '<form action ="poll_question.php?queid=' .$qid. '&classId=' .$classid. '" method="post" id="form1">';
echo '<script>
$(document).ready(function(){
    $("input:checkbox").click(function() {
        $("input:checkbox").not(this).prop("checked", false);
    });
});
</script>';
if($num>0){
    while($row = mysqli_fetch_assoc($result)){
        $option=$row['Option'];
        $opid=$row['OptionId']; 
        echo'<input type="checkbox" name="check" value="'.$opid.'" class="largerCheckbox"> <label>'.$option.'</label><br>';
    }
echo '<center><input type="submit" name="submit" value="Submit" class="btn"></form><center>';
echo '</form></fieldset>';
}
else{
    echo "no options";
}

?>
</body>
</html>