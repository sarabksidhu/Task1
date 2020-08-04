@extends('layout.task')
<div class="row">
    <div class="col-md-4 offset-md-4 mt-4">
        <div class="card card-default">
            <div class="card-header">Login</div>
            
            <div class="card-body">
            	<div class="alert alert-danger d-none" role="alert" id="alert">
		            A simple danger alert—check it out!
		        </div>
				<form method="POST" action="{{ url('/api/logindetails') }}" id="form">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Email address</label>
				    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email') }}">				    
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Password</label>
				    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
				  </div>				  
				  <button type="submit" class="btn btn-primary" id="submitForm">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
	$('#submitForm').click(function(e){
		e.preventDefault();
		$.post($('#form').attr('action'),{
                email:$('#email').val(),
                password:$('#password').val()
            },
		function(response){
			//if(response.status == 'success'){
				if(response.status == 'error'){
		            $("#alert").html(response.message).removeClass('alert-success d-none').addClass('alert-danger');
		            setTimeout(function() {
		                $("#alert").addClass('d-none');
		            }, 3000);
		          }else{
		            $("#alert").html(response.message).removeClass('alert-danger d-none').addClass('alert-success');		            
		            window.location.href = '/userlist';		            
		          }
				
			//}
		})();
	});
</script>

