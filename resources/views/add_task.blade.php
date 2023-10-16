<?php
if (session_status() == PHP_SESSION_ACTIVE) {
    ;
  }
  else
  {
    
  
  session_start();
  }
  ?>

<!-- Start: Add Task Modal -->
<div class="modal fade" role="dialog" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #e0e5f5;">
                <h5 class="fs-6 fw-bold text-primary mb-0">Add New Task</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
         
        <div class="modal-body" style="background: rgba(255,255,255,0);">
            <div class="card shadow" style="margin-right: auto;margin-left: auto;width: auto;">
                <div class="card-body">
                    <p class="card-text"></p>
                    <form id="add_task"  method="post">
                        @csrf

                        
                        <label class="form-label" style="font-weight: bold;">Task Name</label><span style="color: var(--bs-red);font-weight: bold;">*</span>
                        <input id="task" class="border rounded border-secondary form-control form-control-sm" type="text" placeholder="Task Name" name="task" autocomplete="on"  >
                        <span id="task1" class="text-danger ">
              
</br>
             </span>
             <br>
                        <label class="form-label mt-2" style="font-weight: bold;">Task Status</label><span style="color: var(--bs-red);font-weight: bold;">*</span>
                        <input id="status" class="border rounded border-secondary form-control form-control-sm" type="text" placeholder="Task Status" name="status" autocomplete="on" >
                        <span id="status1"class="text-danger mt-2">
               
             </span>
                        <button id="myaddcat" class="btn btn-outline-dark btn-sm text-center border rounded-pill border-secondary float-end" type="submit" style="margin-right: auto;margin-left: auto;margin-top: 20px;font-weight: bold;" name="myaddcat">Add Task</button></form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<!--AJAX Script for Create Task REST API-->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
    $(document).ready(function(){
   
		$('#add_task').submit(function(event){
               
            
     
               event.preventDefault();

			   var formData=$(this).serialize();
         
           token ="<?=(isset($_SESSION["token"])?$_SESSION["token"]:"")?>";
        
           
        
			   $.ajax({

              
		          url: "http://127.0.0.1:8000/api/Task",
              headers :
                  { "Authorization" : "Bearer " +token,
                    "Accept" : "application/json", 
                  },
                    
						type: "POST",
						data: formData,
						success: function(data1)
						{
							var data2=JSON.stringify(data1);
							var obj = JSON.parse(data2);

                            if(obj.status==false)
                              {
                                
                                
                                if(obj.message.task)
                                {
                                $("#task1").html(obj.message.task);
                                }
                                else
                                {
                                    $("#task1").html("");    
                                }
                                if(obj.message.status)
                                {
                                $("#status1").html(obj.message.status);
                                }
                                else
                                {
                                    $("#status1").html("");  
                                }

                                
                               
               

						}
                        else
                        {
                            if(obj.message)
                                {
                                   alert(obj.message); 
                             
                                window.location.href = "{{URL::to('/Task_Dashboard')}}"
                              }
                        }
                    }
			
			
			       });

		});



	});

	</script>

<!--AJAX Script for Create Task REST API-->



<!-- End: Add Task Modal -->



 <!-- Start: Edit Task Modal -->
<div class="modal fade" role="dialog" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-2">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #e0e5f5;">
                <h5 class="fs-6 fw-bold text-primary mb-0">Edit Task</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body" style="background: rgba(255,255,255,0);">
            <div class="card shadow" style="margin-right: auto;margin-left: auto;width: auto;">
                <div class="card-body">
                    <p class="card-text"></p>
                    <form id="edit_form"  method="PUT">
                         @csrf
                      <input type="hidden" name="task_id" @if(isset($task1))
                        value="{{$task1->id}}"
                        @endif>
                        <label class="form-label" style="font-weight: bold;">Task Name</label><span style="color: var(--bs-red);font-weight: bold;">*</span>
                        <input id="edit_task" class="border rounded border-secondary form-control form-control-sm" type="text" placeholder="Task Name" name="Task_Name" autocomplete="on"  @if(isset($task1))
                        value="{{$task1->Task_Name}}"
                        @endif><br>
                        
                       
                            
                        <label class="form-label" style="font-weight: bold;">Task Status</label><span style="color: var(--bs-red);font-weight: bold;">*</span>
                        <input id="edit_status" class="border rounded border-secondary form-control form-control-sm" type="text" placeholder="Task Priority" name="Task_Status" autocomplete="on" @if(isset($task1))
                        value="{{$task1->Task_Status}}"
                        @endif >
                        
                        <button id="myaddcat" class="btn btn-outline-dark btn-sm text-center border rounded-pill border-secondary float-end" type="submit" style="margin-right: auto;margin-left: auto;margin-top: 20px;font-weight: bold;" name="myaddcat">Edit Task</button>
                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!--AJAX Script for Update Task REST API-->

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
    $(document).ready(function(){
   
		$('#edit_form').submit(function(event){
               
           
            event.preventDefault();

var formData=$(this).serialize();

token ="<?=(isset($_SESSION["token"])?$_SESSION["token"]:"")?>";

$.ajax({

              
url: "http://127.0.0.1:8000/api/Task/update",
headers :
{ "Authorization" : "Bearer " +token,
  "Accept" : "application/json", 
},
  
      type: "PUT",
      data: formData,
      success: function(data1)
      {
             var data2=JSON.stringify(data1);
             var obj = JSON.parse(data2);

                           
                            if(obj.message)
                                {
                                   alert(obj.message); 
                             
                                window.location.href = "{{URL::to('/Task_Dashboard')}}"
                              }
                        }
                    
			
			
			       });

		});



	});

	</script>

    <!--AJAX Script for Create Task REST API-->
<!-- End: Edit Task Modal -->




<!-- Start: View Task Modell -->
<div class="modal fade" role="dialog" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" id="view_model">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #e0e5f5;">
                <h5 class="fs-6 fw-bold text-primary mb-0">View Task</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body" style="background: rgba(255,255,255,0);">
            <div class="card shadow" style="margin-right: auto;margin-left: auto;width: auto;">
                <div class="card-body">
                    <p class="card-text"></p>
                    
                        <label class="form-label" style="font-weight: bold;">Task Name</label><span style="color: var(--bs-red);font-weight: bold;">*</span>
                        <input id="edit_task" class="border rounded border-secondary form-control form-control-sm" type="text" placeholder="Task Name" name="Task_Name" autocomplete="on"  @if(isset($task1))
                        value="{{$task1->Task_Name}}"
                        @endif readonly><br>
                        
                       
                            
                        <label class="form-label" style="font-weight: bold;">Task Status</label><span style="color: var(--bs-red);font-weight: bold;">*</span>
                        <input id="edit_status" class="border rounded border-secondary form-control form-control-sm" type="text" placeholder="Task Priority" name="Task_Status" autocomplete="on" @if(isset($task1))
                        value="{{$task1->Task_Status}}"
                        @endif  readonly>
                        
                        <a href="/Task_Dashboard" class="btn btn-outline-dark btn-sm text-center border rounded-pill border-secondary float-end" type="submit" style="margin-right: auto;margin-left: auto;margin-top: 20px;font-weight: bold;" name="myaddcat">Close</a>
                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


<!-- End: View Task Modal -->


<!-- Delete alert modal box for  Task -->                                   
<div id="delete_model" class="modal fade" role="dialog" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Confirmation Message</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="background: #fff;box-shadow: 0px 0px 20px 0px var(--bs-gray-200);">
                <p style="text-align:justify;">Do you really want to delete this Category?</p>
            </div>
            <div class="modal-footer">
                <a href="/Task_Dashboard" type="button" type="button" class="btn btn-outline-dark btn-sm border rounded border-1 border-dark shadow-sm">Cancel</a>
                <form id="del_task" method="POST">
                    @csrf
                    <input type="hidden" name="tid" value="<?php echo (isset($_SESSION["task_id"])?$_SESSION["task_id"]:"")?>">
                <button href="#" type="submit" class="btn btn-outline-danger btn-sm border rounded border-1 border-danger shadow-sm">Delete</button></form>
                
        </div>
    </div>
</div>
</div>       
<!--AJAX Script for DELETE Task REST API-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script> 
$(document).ready(function(){
   
		$('#del_task').submit(function(event){
            $("#delete_model").modal("hide");
                
               event.preventDefault();

			   var formData=$(this).serialize();
         
           token ="<?=(isset($_SESSION["token"])?$_SESSION["token"]:"")?>";
         
             
        
			   $.ajax({

              
		          url: "http://127.0.0.1:8000/api/Task/destroy",
              headers :
                  { "Authorization" : "Bearer " +token,
                    "Accept" : "application/json", 
                  },
                    
						type: "DELETE",
						data: formData,
						success: function(data1)
						{
							var data2=JSON.stringify(data1);
							var obj = JSON.parse(data2);

                           alert(obj.message);



                window.location.href = "{{URL::to('/Task_Dashboard')}}"
               

						}
			
			
			       });

		});



	});

	</script>

    <!--AJAX Script for DELETE Task REST API-->

 
    