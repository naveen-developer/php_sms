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
          <h4 class="modal-title">Add Student</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form name="add_stu" id="add_stu">            
          <div class="form-group">
          <label for="exampleFormControlSelect1">Select class</label>
          <select class="form-control" id="exampleFormControlSelect1" name="class_id">
            <?php
               $sql = "SELECT * FROM class";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        
        while($row = mysqli_fetch_assoc($result)) {
            echo '<option value="'.$row['c_id'].'">'.$row['c_name'].'</option>';
        }
    }
            ?>            
          </select>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Student</span>
            </div>
            <input type="text" class="form-control" id="student" name="student" placeholder="Enter student name..." aria-label="Username" aria-describedby="basic-addon1">
          </div>                       
          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">                   
          <span id="student_msg"></span>
          <button type="button" class="btn btn-primary" onclick="add_student_event()">Add Student</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
      <!-- Modal form end-->

      <!-- Update Modal-->
            <!-- Modal form start-->
      <div class="modal fade" id="updatemyModal">
    <div class="modal-dialog">
      <div class="modal-content">
              <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Student</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Student</span>
            </div>
            <input type="hidden" id="stu_update_id" />
            <input type="text" class="form-control" id="update_student" placeholder="Enter class name..." aria-label="Username" aria-describedby="basic-addon1">
          </div>
          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">         
          <span id="update_stu_msger"></span>
          <button type="button" class="btn btn-primary" onclick="update_student_event()">Update Student</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
      <!-- Modal form end-->


     <div class="container">
      <div class="section_header py-5">
            <h1 class="text-center"> Students </h1>
            <hr class="w-25 border-dark m-auto">
        </div>
        <button type="button" class="btn btn-outline-primary my-2 add_cls_btn" data-toggle="modal" data-target="#myModal"><span><i class="fas fa-plus-square"></i></span><span> </span>Add Student</button>
         <a href="Dashboard.php" class="btn btn-success"><span><i class="fas fa-users-cog"></i></span><span> </span>Dashboard</a>
       <div class="main_table">
         <div class="row">
         <div class="col-10 mx-auto">            
      <table class="table table-hover">
  <thead>
     <tr>
              <th scope="col">Sr.no</th>
              <th scope="col">Class</th>
              <th scope="col">Name</th>
              <th scope="col">Action</th>
     </tr>
  </thead>
  <tbody>

    <?php
      $sql = "select students.*,class.c_name from students,class where students.c_id=class.c_id order by stu_id desc";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $count = 1;
        while($row = mysqli_fetch_assoc($result)) {
         // echo "<pre>";
         // print_r($row);          
          ?>
            <tr>
              <th scope="col"><?php echo $count++; ?></th>
              <td><?php echo $row['c_name']?></td>
              <td><?php echo $row['stu_name']?></td>
              <td><button type="button" class="btn btn-outline-secondary" onclick="edit_student_event('<?php echo $row['stu_id']?>')"><span><i class="fas fa-edit"></i></span><span> </span>Edit</button><span> </span><button class="btn btn-danger" onclick="delete_student_event('<?php echo $row['stu_id']?>')"><span><i class="fas fa-trash-alt"></i></span><span> </span>Delete</button></td>
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
  </body>
</html>