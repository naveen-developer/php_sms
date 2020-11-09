<?php
include 'database.php';

if(isset($_POST['name']))
{
	$name = $_POST['name'];

	$result = mysqli_query($conn, "select c_name from class where c_name = '$name'");
	if (mysqli_num_rows($result) > 0) {
		echo "already exist";
	}else{
		$sql = "INSERT INTO class (c_name) VALUES ('$name')";

		if (mysqli_query($conn, $sql)) {
		  echo "ok";
		} else {
		  echo "fail";
		}	
	}	
}else if(isset($_POST['file']) && isset($_POST['class_id']))
{
	$cid = $_POST['class_id'];
	//echo "This is cid ".$cid;
	$response = array();
	$query = "select * from class where c_id = '$cid'";
	$result = mysqli_query($conn,$query);
		while($row = mysqli_fetch_assoc($result)) {
	 	$response = $row;
	}

	 echo json_encode($response);
	//echo "<pre>";
	//print_r($response);

}else if(isset($_POST['c_name']) && isset($_POST['c_id'])){

	$c_name = $_POST['c_name'];
	$c_id = $_POST['c_id'];

	$result = mysqli_query($conn, "select c_name from class where c_name = '$c_name'");
	if (mysqli_num_rows($result) > 0) {
		echo "already exist";
	}else{
		$sql = "UPDATE class SET c_name='$c_name' WHERE c_id='$c_id'";

		if (mysqli_query($conn, $sql)) {
		  echo "ok";
		} else {
		  echo "fail";
		}	
	}	


}else if(isset($_POST['delete_file']) && isset($_POST['delete_id'])){
	$did = $_POST['delete_id'];
	//echo "This is delete id ".$did;
	$result = mysqli_query($conn, "delete from class where c_id = '$did'");
	if($result)
	{
		echo "success";
	}else{
		echo "fail";
	}
}




?>