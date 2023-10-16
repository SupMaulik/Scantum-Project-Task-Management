@extends('Layouts.content')
@section("content-header")
@include("navbar")

<div class="login-page bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                  <h3 class="mb-3">Sign Up Now</h3>
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form id="reg_form" method="post"  class="row g-4">
                                        @csrf
                                            <div class="col-12">
                                                <label>Username<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                    <input type="text" name="name" class="form-control" placeholder="Enter Username">
                                                    
                                                </div>
                                                <span id="name" class="text-danger ">*</span>
                                            </div>
                                            <div class="col-12">
                                                <label>Email<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                    <input type="text" name="email" class="form-control" placeholder="Enter Email">
                                                   
                                                </div>
                                                <span id="email" class="text-danger ">*</span>
                                            </div>

                                            <div class="col-12">
                                                <label>Password<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                                    
                                                </div>
                                                <span id="pass" class="text-danger">*</span>
                                            </div>
                                            <div class="col-12">
                                                <label>Confirmed Password<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Password">
                                                   
                                                </div>
                                                <span id="pass_con" class="text-danger">*</span>
                                            </div>

                                            

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary px-4 float-end mt-4">Register</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                    <i class="bi bi-bootstrap"></i>
                                    <h2 class="fs-1">Welcome Back!!!</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
    $(document).ready(function(){
   
		$('#reg_form').submit(function(event){

               event.preventDefault();

			   var formData=$(this).serialize();
			   $.ajax({

		                url: "http://127.0.0.1:8000/api/register",
						type: "POST",
						data: formData,
						success: function(data1)
						{
							var data2=JSON.stringify(data1);
							var obj = JSON.parse(data2);
                           
						   
                              if(obj.status=false)
                              {
                                
                                if(obj.message.name)
                                {
                                $("#name").html(obj.message.name);
                                }
                                else
                                {
                                    $("#name").html("");
                                }
                                if(obj.message.email)
                                {
                                $("#email").html(obj.message.email);
                                }
                                else
                                {
                                    $("#email").html("");    
                                }
                                if(obj.message.password)
                                {
                                $("#pass").html(obj.message.password);
                                }
                                else
                                {
                                    $("#pass").html("");  
                                }

                                if(obj.message.password_confirmation)
                                {
                                $("#pass_con").html(obj.message.password_confirmation);
                                }
                                else
                                {
                                    $("#pass_con").html(""); 
                                }
                              }
                              else
                              {
                                
                                window.location.href = "{{URL::to('/login')}}"
                              }

                              

						}
			
			
			       });

		});



	});

	</script>
    @endsection