function add_class_event()
{	//alert('clicked');
	var class_name = $("#class").val();
	//console.log(class_name);
	if(class_name.trim() == ""){
		$('#msg').html('<span class="alert alert-warning" role="alert">Please enter class name</sapan>');
	}else{
		$.ajax({
		url:'add_class.php',
		method:'POST',
		data:{
			file:"add_class",
			name:class_name,
		},
		success:function(data){
			console.log(data);
			$("#class").val("");
			if(data == "ok")
			{
				$('#load').html('<div class="spinner-border"></div>');
				$('#msg').html('<span class="alert alert-success" role="alert">Class Added...!!</sapan>');
				console.log("recorded");
				setTimeout(function(){
					window.location.href = "main.php";
				},1000);
				
			}else if(data == "fail"){
				$('#msg').html('<span class="alert alert-danger" role="alert">Not Added Class ...!!</sapan>');
				console.log("not recorded");
			}else if(data == 'already exist'){
				$('#msg').html('<span class="alert alert-danger" role="alert">Class Already exist ...!!</sapan>');
				console.log("not recorded");
			}

		}
	})
	}

	
}

function edit_class_event(id){
	$('#loader').html('');
	$('#msger').html('');
	$.ajax({
		url:'add_class.php',
		method:'POST',
		data:{
			file:"edit_class",
			class_id:id,
		},
		success:function(data){
			//console.log(data);
			var name = JSON.parse(data);
			//console.log(name.c_name);
			$('#update_class').val(name.c_name);
			$('#update_id').val(name.c_id);
		}
	});
	$('#updatemyModal').modal("show");
}


function update_class_event(){
	$('#loader').html('');
	$('#msger').html('');
	var c_name = $('#update_class').val();
	var c_id = $('#update_id').val();

	if(c_name.trim() == ""){
		$('#msger').html('<span class="alert alert-warning" role="alert">Please enter class name</sapan>');
	}else{
		$.ajax({
		url:'add_class.php',
		method:'POST',
		data:{
			update_file:"edit_class",
			c_name:c_name,
			c_id:c_id,
		},
		success:function(data){
			console.log(data);
			$("#update_class").val("");			
			if(data == "ok")
			{
				$('#loader').html('<div class="spinner-border"></div>');
				$('#msger').html('<span class="alert alert-success" role="alert">Class Updated...!!</sapan>');
				console.log("recorded");
				setTimeout(function(){
					window.location.href = "main.php";
				},1000);
				
			}else if(data == "fail"){
				$('#msger').html('<span class="alert alert-danger" role="alert">Not Added Class ...!!</sapan>');
				console.log("not recorded");
			}else if(data == 'already exist'){
				$('#msger').html('<span class="alert alert-danger" role="alert">Class Already exist ...!!</sapan>');
				console.log("not recorded");
			}

		}
	})
	}

}


function delete_class_event(id){
	var conf = confirm("Are you sure ");
	if(conf == true)
	{
		$.ajax({
			url:'add_class.php',
			method:'POST',
			data:{
				delete_file:"delete_class",
				delete_id:id,
			},
			success:function(data){
				console.log(data);
				if(data == "success")
				{
					window.location.href = "main.php";
				}
			}
		});
	}
}



$(document).ready(function(){
	var maxfields = 10;
	var add_btn = $('#add_field_button');

	var x = 1;
	$('#add_field_button').click(function(e){
		e.preventDefault();
		if(x < maxfields)
		{			
			var sub = 'subject'+x;
			//console.log(sub);
			$('#wrapper').append('<div class="input-group mb-3"><input id="'+sub+'" type="text" class="form-control sub_input" name="subject[]" placeholder="Enter subject Name" aria-label="Subject name" aria-describedby="button-addon2"><div id="remove_field" class="input-group-append"><button class="btn btn-outline-danger" type="button">Delete</button></div></div>');
			x++;
		}
	});

	$('#wrapper').on('click',"#remove_field",function(e){
		e.preventDefault();
		$(this).parent('div').remove();
		x--;
	});
});


//subject.php

function add_subject_event()
{
	var sub = $('.sub_input').val();
	if(sub == "")
	{
		$('#submsger').html('<span class="alert alert-danger" role="alert">Can not be blank...!!!</sapan>');
	}else{
		$.ajax({
		url:'subject.php',
		method:"POST",
		data:$('#add_sub').serialize(),
		success:function(data)
		{
			//alert(data);
			console.log(data);
			$('#submsger').html('<span class="alert alert-warning" role="alert">'+data+'</sapan>');
			console.log(data);
			if(data == 'success')
			{
				$('.sub_input').val('');
				$('#submsger').html('');
				$('#sub_bot_msg').html('<span class="alert alert-success" role="alert">Subjects Added Successfully...!!!</sapan>');
				setTimeout(function(){
					window.location.href = "subject_dashboard.php";
				},3000);
			}
			//$('#add_sub').[0].reset();
		}
	})	
	}
	
}

function edit_subject_event(id)
{
	$('#sub_update_msg').html('');
	$.ajax({
		url:'subject.php',
		method:'POST',
		data:{
			subject_id:id,
		},
		success:function(data){			
			var result = JSON.parse(data);			
			$('#subject_input').val(result.sub_name);
			$('#sub_update_id').val(result.sub_id);
		}
	});
	$('#update_subject_Modal').modal("show");	
}

function update_subject_event()
{
	var subject_name = $('#subject_input').val();
	var subject_id = $('#sub_update_id').val();

	if(subject_name.trim() == ""){
		$('#sub_update_msg').html('<span class="alert alert-warning" role="alert">Please enter subject name</sapan>');
	}else{
		$.ajax({
		url:'subject.php',
		method:'POST',
		data:{
			sub_name:subject_name,
			s_id:subject_id,
		},
		success:function(data){
			console.log(data);			
			if(data == "ok")
			{
				$('#sub_update_msg').html('<span class="alert alert-success" role="alert">Subject Updated...!!</sapan>');
				setTimeout(function(){
					window.location.href = "subject_dashboard.php";
				},3000);
				
			}else if(data == "fail"){
				$('#sub_update_msg').html('<span class="alert alert-danger" role="alert">Not Added Subject ...!!</sapan>');
			}else if(data == 'already exist'){
				$('#sub_update_msg').html('<span class="alert alert-danger" role="alert">Subject Already exist ...!!</sapan>');			
			}

		}
	})
	}	
}

function delete_subject_event(id)
{
	var conf = confirm("Are you sure ");
	if(conf == true)
	{
		$.ajax({
			url:'subject.php',
			method:'POST',
			data:{
				delete_file:"delete_class",
				delete_id:id,
			},
			success:function(data){
				console.log(data);
				if(data == "success")
				{
					window.location.href = "subject_dashboard.php";
				}
			}
		});
	}
}













function add_student_event()
{
	var stu = $('#student').val();
	if(stu == "")
	{
		$('#student_msg').html('<span class="alert alert-danger" role="alert">Can not be blank...!!!</sapan>');
	}else{
		$.ajax({
		url:'student.php',
		method:"POST",
		data:$('#add_stu').serialize(),
		success:function(data)
		{
			console.log(data);
			 if(data == 'ok')
			 {
			 	$('#student_msg').html('<span class="alert alert-success" role="alert">Subjects Added Successfully...!!!</sapan>');
			 	setTimeout(function(){
			 		window.location.href = "student_dashboard.php";
			 	},3000);
			 }
			 else if(data == 'already exist')
			 {
				$('#student_msg').html('<span class="alert alert-warning" role="alert">Already added student in class</sapan>');	 	
			 }
			//$('#add_sub').[0].reset();
		}
	})	
	}
	
}

function edit_student_event(id){
	$('#update_stu_msger').html('');
	$.ajax({
		url:'student.php',
		method:'POST',
		data:{
			student_id:id,
		},
		success:function(data){		
		console.log(data);	
			var result = JSON.parse(data);			
			$('#update_student').val(result.stu_name);
			$('#stu_update_id').val(result.stu_id);
		}
	});
	$('#updatemyModal').modal("show");
}

function update_student_event()
{
	var student_name = $('#update_student').val();
	var student_id = $('#stu_update_id').val();

	if(student_name.trim() == ""){
		$('#update_stu_msger').html('<span class="alert alert-warning" role="alert">Please Enter Student Name</sapan>');
	}else{
		$.ajax({
		url:'student.php',
		method:'POST',
		data:{
			stu_name:student_name,
			stu_id:student_id,
		},
		success:function(data){
			console.log(data);			
			if(data == "ok")
			{
				$('#update_stu_msger').html('<span class="alert alert-success" role="alert">Student Updated...!!</sapan>');
				setTimeout(function(){
					window.location.href = "student_dashboard.php";
				},3000);
				
			}else if(data == "fail"){
				$('#update_stu_msger').html('<span class="alert alert-danger" role="alert">Not Added Student ...!!</sapan>');
			}else if(data == 'already exist'){
				$('#update_stu_msger').html('<span class="alert alert-danger" role="alert">Student Already exist ...!!</sapan>');			
			}

		}
	})
	}	
}

function delete_student_event(id)
{
	var conf = confirm("Are you sure ");
	if(conf == true)
	{
		$.ajax({
			url:'student.php',
			method:'POST',
			data:{
				delete_id:id,
			},
			success:function(data){
				console.log(data);
				if(data == "success")
				{
					window.location.href = "student_dashboard.php";
				}
			}
		});
	}
}














function add_marks_event()
{
	alert();
}