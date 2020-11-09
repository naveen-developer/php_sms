<?php
include 'database.php';

$no_students = "";
$no_subjects = "";
$no_class = "";
$no_marks = "";

$result = mysqli_query($conn, "select * from students");
$no_students = mysqli_num_rows($result);
//echo $no_students;

$result1 = mysqli_query($conn, "select * from subjects");
$no_subjects = mysqli_num_rows($result1);
//echo $no_subjects;

$result2 = mysqli_query($conn, "select * from class");
$no_class = mysqli_num_rows($result2);
//echo $no_class;

$result3 = mysqli_query($conn, "select * from marks");
$no_marks = mysqli_num_rows($result3);
//echo $no_marks;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
   <script src="https://kit.fontawesome.com/2010073636.js"></script>



  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style type="text/css">
  	*{margin: 0;padding: 0;font-family: 'Josefin Sans', sans-serif;box-sizing: border-box;}
  	.maindiv{
  		width: 100vw;
  		height: 100vh;
  		display: grid;
  		place-items:center;
  	}
  	.innerdiv{
  		width: 90vw;
  		height: 85vh;
  		background: linear-gradient(217deg, #88c2ea8f, #3950a2);;
  	}
  	.dashboard_div{
  		    height: 67vh;
    width: 60vw;
    background: white!important;
    border-radius: 225px 0px 0px 225px;
    margin: 48px 0px;
  	}
  	.img_desc_div{
  		    height: 50vh;
		    width: 60vh;
		    position: relative;
		    background: white;
		    top: 50%;
		    transform: translateY(-50%);
		    left: -83px;
		    border-radius: 10px;
  	}
  	.imd_div{
  		height: 35vh;
  		background-image: url('5514.jpg');
  		background-size: cover;
  		border-radius: 10px;
  		box-shadow: 2px 2px 2px 2px #808080cc;
  	}
  	blockquote p{
  		font-size: 15px;
  	}
  	.heading{
  		    padding: 45px 0;
  	}
  	.card-body{
  		padding-bottom: 0;
  	}
  	.card1{
  		background: lightsteelblue;
  	}
  	.card2{
  		background: lightgray;
  	}
  	.card3{
  		background: lightblue;
  	}
  	.card4{
  		background: lightgreen;
  	}
  	
  </style>
</head>
<body>

<div class="maindiv">
	<div class="innerdiv">
		<div class="container-fluid">
			<dir class="row">
			<div class="col-sm-3 col-md-3 col-lg-3">
				<div class="img_desc_div">
					<div class="imd_div">
						
					</div>
					<div class="desc_div pr-3 pb3 pt-1">
						<blockquote class="blockquote text-right">
						  <p class="mb-0">Education is the most powerful weapon which you can use to change the world.</p>
						  <footer class="blockquote-footer">Nelson Mandela</footer>
						</blockquote>
					</div>
					<!-- <img src="5514.jpg" class="rounded" alt="Cinque Terre" style="    width: 394px;position: absolute;top: 100px;left: -100px;"> -->
				</div>
			</div>
			<div class="col-sm-9 col-md-9 col-lg-9">
					<div class="dashboard_div">
						<div class="heading">
							<h2 class="text-center">School Management</h2>
							<hr class="w-25 border-dark m-auto">
						</div>
						<div class="row d-flex justify-content-center align-items-center">							
							<div class="col-md-4 col-lg-4">
								<div class="card my-2 card1">
								  <div class="card-body">
								  	<div class="row">
								  		<div class="col-8">
								  			<p><a href="student_dashboard.php">Students</a></p>
								  			<h3><?php echo $no_students; ?></h3>	
								  		</div>
								  		<div class="col-4">
								  			<span><i class="fas fa-3x fa-user-graduate"></i></span>	
								  		</div>
								  	</div>								  	
								  	
								  </div>
								  
								</div>
							</div>
							<div class="col-md-4 col-lg-4">
								<div class="card my-2 card2">
								  <div class="card-body">
								  	<div class="row">
								  		<div class="col-8">
								  			<p><a href="subject_dashboard.php">Subjects</a></p>
								  			<h3><?php echo $no_subjects; ?></h3>	
								  		</div>
								  		<div class="col-4">
								  			<span><i class="fas fa-3x fa-book-open"></i></span>	
								  		</div>
								  	</div>								  	
								  	
								  </div>
								  
								</div>
							</div>
						</div>
						<div class="row d-flex justify-content-center align-items-center">							
							<div class="col-md-4 col-lg-4">
								<div class="card my-2 card3">
								  <div class="card-body">
								  	<div class="row">
								  		<div class="col-8">
								  			<p><a href="main.php">Class</a></p>
								  			<h3><?php echo $no_class; ?></h3>	
								  		</div>
								  		<div class="col-4">
								  			<span><i class="fas fa-3x fa-chalkboard-teacher"></i></span>	
								  		</div>
								  	</div>								  	
								  	
								  </div>
								  
								</div>
							</div>
							<div class="col-md-4 col-lg-4">
								<div class="card my-2 card4">
								  <div class="card-body">
								  	<div class="row">
								  		<div class="col-8">
								  			<p><a href="results_dashboard.php">Results</a></p>
								  			<h3><?php echo $no_marks; ?></h3>	
								  		</div>
								  		<div class="col-4">
								  			<span><i class="fas fa-3x fa-graduation-cap"></i></span>	
								  		</div>
								  	</div>								  	
								  	
								  </div>
								  
								</div>
							</div>
						</div>
					</div>
			</div>
		</dir>
		</div>
	</div>
</div>

</body>
</html>