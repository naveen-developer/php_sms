<?php include 'database.php'; ?>
<?php
if(isset($_POST['student']) && isset($_POST['class_id']))
{
	$name = $_POST['student'];
	$id = $_POST['class_id'];
	$q = "select stu_name from students where stu_name = '$name' and c_id = '$id'";


	 $result = mysqli_query($conn, $q);
	 if (mysqli_num_rows($result) > 0) {
	 	echo "already exist";
	 }else{
	 	$sql = "INSERT INTO students (c_id,stu_name) VALUES ('$id','$name')";

	 	if (mysqli_query($conn, $sql)) {
	 	  echo "ok";
	 	} else {
	 	  echo "fail";
	 	}	
	 }	
}

else if(isset($_POST['student_id'])){

	$stu_id = $_POST['student_id'];
	$response = array();
	$query = "select * from students where stu_id = '$stu_id'";
	$result = mysqli_query($conn,$query);
		while($row = mysqli_fetch_assoc($result)) {
	 	$response = $row;
	}

	 echo json_encode($response);
}

else if(isset($_POST['stu_name']) && isset($_POST['stu_id'])){

	$student_id = $_POST['stu_id'];
	$student_name = $_POST['stu_name'];
	$result = mysqli_query($conn, "select stu_name from students where stu_name = '$student_name'");
	if (mysqli_num_rows($result) > 0) {
		echo "already exist";
	}else{
		$sql = "UPDATE students SET stu_name='$student_name' WHERE stu_id='$student_id'";
		//echo $sql;
		 if (mysqli_query($conn, $sql)) {
		   echo "ok";
		 } else {
		   echo "fail";
		 }	
	}	
}

else if(isset($_POST['delete_id'])){
	$did = $_POST['delete_id'];
	//echo "This is delete id ".$did;
	$result = mysqli_query($conn, "delete from students where stu_id = '$did'");
	if($result)
	{
		echo "success";
	}else{
		echo "fail";
	}
}

?>