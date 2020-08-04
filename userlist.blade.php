@extends('layout.task')

<div class="row">
    <div class="col-md-8 offset-md-2 mt-4">
        <div class="card card-default">
            <div class="card-header">UserList
              <div class="panel-heading mt-3 float-right"><a href="{{url('/useradd')}}" class="btn btn-primary float-right mr-4"><i class="fa fa-plus"></i>&nbsp;Add User</a></div>
            </div>
          <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>   
                    <th scope="col">Action</th>   
                  </tr>
                </thead>
                <tbody id='ulist'>
                      
                </tbody>
              </table>
          </div>
      </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    var tableContent = '';
      $.ajax({
          url: "/api/fetch-userlist",
          type: "GET",          
          success: function(response) {            
            if(response.data.length > 0){                
                $.each(response.data, function (key, val) {
                    var counter = key+1;
                    tableContent += '<tr><th scope="row">'+counter+'</th><td>'+val.name+'</td><td>'+val.email+'</td><td><a href="/useredit/'+val.id+'" role="button" title="Edit">EDIT</a></td></tr>';
                });
            }
            $("#ulist").html(tableContent);
          },
        });
  });
</script>