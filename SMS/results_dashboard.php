<?php
include 'database.php';
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Custom links -->    
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2010073636.js"></script>
    
    

    <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>School Management</title>
    <style type="text/css">
      *{margin:0;padding: 0;box-sizing: border-box;font-family: 'Josefin Sans', sans-serif;}
      .maindiv{
        width: 100vw;
        height: 100vh;
      }

      .main_table{
            background-color: #b9cbda;;
            color: black;
            border-radius: 10px;
            width: 62%;
            margin: auto;
      }
      .add_cls_btn{margin-left: 20%;}
    </style>
  </head>
  <body>
    

    <div class="maindiv">

      <!-- Modal form start-->
      <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Student Marks</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form name="add_stu_marks" id="add_stu_marks"> 
          <div class="form-group">
          <label for="exampleFormControlSelect1">Student select</label>
          <select class="form-control" id="exampleFormControlSelect1" name="student_id">
            <?php
               $sql = "SELECT * FROM students";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        
        while($row = mysqli_fetch_assoc($result)) {
            echo '<option value="'.$row['stu_id'].'">'.$row['stu_name'].'</option>';
        }
    }
            ?>            
          </select>
        </div>           
          <div class="form-group">
          <label for="exampleFormControlSelect1">Subject select</label>
          <select class="form-control" id="exampleFormControlSelect1" name="subject_id">
            <?php
               $sql = "SELECT * FROM subjects";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        
        while($row = mysqli_fetch_assoc($result)) {
            echo '<option value="'.$row['sub_id'].'">'.$row['sub_name'].'</option>';
        }
    }
            ?>            
          </select>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Out_of_Marks</span>
            </div>
            <input type="number" class="form-control" id="student_out_of_marks" name="student_out_of_marks" placeholder="Enter out of marks..." aria-label="Username" aria-describedby="basic-addon1">
          </div> 
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Obtained_Marks</span>
            </div>
            <input type="number" class="form-control" id="student_obt_marks" name="student_obt_marks" placeholder="Enter obtained marks..." aria-label="Username" aria-describedby="basic-addon1">
          </div>                      
          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">                   
          <span id="student_marks_msg"></span>
          <button type="button" class="btn btn-primary mt-3" onclick="add_marks_event()">Add Student Marks</button>
          <button type="button" class="btn btn-danger mt-3" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
      <!-- Modal form end-->

   


     <div class="container">
      <div class="section_header py-5">
            <h1 class="text-center"> Results </h1>
            <hr class="w-25 border-dark m-auto">
        </div>
        <button style="margin-left:5%;" type="button" class="btn btn-outline-primary my-2 add_cls_btn" data-toggle="modal" data-target="#myModal"><span><i class="fas fa-plus-square"></i></span><span> </span>Add Student Marks</button>
        <a href="Dashboard.php" class="btn btn-success"><span><i class="fas fa-users-cog"></i></span><span> </span>Dashboard</a>
       <div class="main_table" style="width: 93%;">
         <div class="row">
         <div class="col-10 mx-auto">            
      <table class="table table-hover">
  <thead>
     <tr>
              <th scope="col">Sr.no</th>
              <th scope="col">Name</th>
              <th scope="col">Subject</th>
              <th scope="col">Class</th>
              <th scope="col">O_Marks</th>
              <th scope="col">T_Marks</th>
              <th scope="col">Result</th>
              <th scope="col">Action</th>
     </tr>
  </thead>
  <tbody>

    <?php
      $sql = "select marks.*,students.*,subjects.sub_name,class.c_name from 
marks,students,subjects,class where marks.stu_id=students.stu_id and subjects.sub_id=marks.sub_id and students.c_id=class.c_id order by m_id desc;";
      $r = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $count = 1;
        while($row = mysqli_fetch_assoc($r)) {
         // echo "<pre>";
         // print_r($row);  
         if($row['obtained_marks']>50)
         {
          $result = '<div class="alert alert-success" role="alert">Promoted</div>';
         }
         else{
          $result = '<div class="alert alert-danger" role="alert">Not Promoted</div>';
         }        
          ?>
            <tr>
              <th scope="col"><?php echo $count++; ?></th>
              <td><?php echo $row['stu_name']?></td>
              <td><?php echo $row['sub_name']?></td>
              <td><?php echo $row['c_name']?></td>
              <td><?php echo $row['obtained_marks']?></td>
              <td><?php echo $row['out_of_marks']?></td>
              <td style="padding-top: 5px;"><?php echo $result; ?></td>
              <td><button class="btn btn-danger" onclick="delete_student_marks_event('<?php echo $row['m_id']?>')"><span><i class="fas fa-trash-alt"></i></span><span> </span>Delete</button></td>
            </tr>
          <?php      
        }
      } else {
        echo "Data not found";
      }

    ?>
    
  </tbody>
</table>
         </div>
       </div>
       </div>
     </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="javascript.js"></script>
    <script type="text/javascript">
      function add_marks_event(){

  var soutm = $('#student_out_of_marks').val();
  var sobtm = $('#student_obt_marks').val();

  if(soutm.trim() == "" && sobtm.trim() == "")
  {
    $('#student_marks_msg').html('<span class="alert alert-danger" role="alert">Can not be blank...!!!</sapan>');
  }
  else if(soutm > 100){
    $('#student_marks_msg').html('<span class="alert alert-danger" role="alert">Out of marks can not be greater than 100</sapan>');         
  }

  else if(soutm > sobtm){
    $('#student_marks_msg').html('<span class="alert alert-danger" role="alert">Allways Out of marks are greater than obtained marks</sapan>');
  }



  else{
    $.ajax({
    url:'result.php',
    method:"POST",
    data:$('#add_stu_marks').serialize(),
    success:function(data)
    {
      if(data == 'ok')
      {
        $('#student_out_of_marks').val('');
        $('#student_obt_marks').val('');
        $('#student_marks_msg').html('<span class="alert alert-success" role="alert">Student Marks Added Successfully</span>');
        setTimeout(function(){
          window.location.href = "results_dashboard.php";
        },3000);
      }else if(data == 'exist')
      {
        $('#student_marks_msg').html('<span class="alert alert-warning" role="alert">This Student subject and marks are already exist</span>');
      }
      //$('#add_sub').[0].reset();
    }
  })  
  }
  
}


function delete_student_marks_event(id){

  var conf = confirm("Are you sure ");
  if(conf == true)
  {
    $.ajax({
      url:'result.php',
      method:'POST',
      data:{
        delete_id:id,
      },
      success:function(data){
        console.log(data);
        if(data == "success")
        {
          window.location.href = "results_dashboard.php";
        }
      }
    });
  }
}


    </script>
  </body>
</html>