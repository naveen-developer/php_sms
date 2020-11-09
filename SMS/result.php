<?php
include 'database.php';

if(isset($_POST['student_id']) && isset($_POST['subject_id']) && isset($_POST['student_out_of_marks']) && isset($_POST['student_obt_marks']))
{
	$stu_id = $_POST['student_id'];
	$sub_id = $_POST['subject_id'];
	$out_of_marks = $_POST['student_out_of_marks'];
	$obt_marks = $_POST['student_obt_marks'];


	$result = mysqli_query($conn, "select stu_id from marks where stu_id='$stu_id' and sub_id='$sub_id'");
	if (mysqli_num_rows($result) > 0) {
		echo "exist";
	}else{
		$sql = "INSERT INTO marks (stu_id, sub_id, obtained_marks, out_of_marks) VALUES ('$stu_id', '$sub_id', '$obt_marks', '$out_of_marks')";
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
	$result = mysqli_query($conn, "delete from marks where m_id = '$did'");
	if($result)
	{
		echo "success";
	}else{
		echo "fail";
	}
}
?>