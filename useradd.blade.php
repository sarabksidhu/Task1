@extends('layout.task')
<div class="col-md-12 pt-4 pl-6"><a href="/userlist">Back</a></div>
<div class="row">
    <div class="col-md-6 offset-md-3 mt-4">
        <div class="card card-default">        	
        	<div class="card-header">Add Details</div>
                        
            <div class="card-body">
            	<div class="alert alert-danger d-none" role="alert" id="alert">
		            A simple danger alert—check it out!
		        </div>
				<form method="POST" action="{{ url('/api/add-user') }}" id="form">
					{{ csrf_field() }}
				  <div class="form-group">
				    <label>Name</label>
				    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
				  </div>
				  <div class="form-group">
				    <label>Email</label>
				    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
				  </div>
				  <div class="form-group">
				    <label>Password</label>
				    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
				  </div>
				  <div class="form-group">
				    <label>Confirme Password</label>
				    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
				  </div>
				  <button type="submit" class="btn btn-primary" id="submit">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
	$('#submit').click(function(e){
		e.preventDefault();
		var form = $('#form');
		$.ajax({
			type : form.attr('method'),
			url : form.attr('action'),
			data : form.serialize(),
			success:function(response){
				if(response.status == 'error'){
		            $("#alert").html(response.message).removeClass('alert-success d-none').addClass('alert-danger');
		            setTimeout(function() {
		                $("#alert").addClass('d-none');
		            }, 3000);
		          }else{
		            $("#alert").html(response.message).removeClass('alert-danger d-none').addClass('alert-success');		            
		          }
			}
		});
	});
</script>