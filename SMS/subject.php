<?php include 'database.php'; ?>
<?php

if(isset($_POST["subject"]) && isset($_POST['class_id']))
{
	  $sql = "SELECT * FROM subjects";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        $newArray = array();
        while($row = mysqli_fetch_assoc($result)) {
        	$newArray[] = $row['sub_name'];
        }
        $compare_two_array = array_intersect($_POST['subject'],$newArray);
        if(count($compare_two_array) > 0)
        {
        	$string = implode(", ", $compare_two_array);
        	echo json_encode($string." Subjects already present");
        }else{
        	$num = count($_POST["subject"]);
			$c_id = $_POST['class_id'];

			if($num > 0)
			{
				for($i=0;$i<$num;$i++)
				{
					if(trim($_POST["subject"][$i]) != '')
					{
						$sub_name = mysqli_real_escape_string($conn,$_POST["subject"][$i]);

						$sql = "insert into subjects (c_id,sub_name) values ('$c_id','$sub_name')";
						mysqli_query($conn, $sql);
						//echo $sql."<br>";
					}
				}
			}

        	echo "success";
        }
    }
}else if(isset($_POST['subject_id'])){
	$sub_id = $_POST['subject_id'];
	$response = array();
	$query = "select * from subjects where sub_id = '$sub_id'";
	$result = mysqli_query($conn,$query);
		while($row = mysqli_fetch_assoc($result)) {
	 	$response = $row;
	}

	 echo json_encode($response);
}else if(isset($_POST['sub_name']) && isset($_POST['s_id'])){

	$subject_id = $_POST['s_id'];
	$subject_name = $_POST['sub_name'];
	$result = mysqli_query($conn, "select sub_name from subjects where sub_name = '$subject_name'");
	if (mysqli_num_rows($result) > 0) {
		echo "already exist";
	}else{
		$sql = "UPDATE subjects SET sub_name='$subject_name' WHERE sub_id='$subject_id'";
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
	$result = mysqli_query($conn, "delete from subjects where sub_id = '$did'");
	if($result)
	{
		echo "success";
	}else{
		echo "fail";
	}
}
?>