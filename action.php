<?php
include "_dbconnect.php";
$qid=$_GET['queid'];
	$userData = count($_POST['name']);
	if ($userData > 0) {
	    for ($i=0; $i <$userData; $i++) { 
		if (trim($_POST['name'] != '')) {
			$name   = $_POST['name'][$i];
            $query="INSERT INTO `poll_options`(`QId`,`OptionId`,`Option`) VALUES ($qid, $i,'$name')";
			$result = mysqli_query($conn, $query);
		  }
	    }
	    echo "Data inserted successfully";
	}else{
	    echo "No data";
	}

?>


