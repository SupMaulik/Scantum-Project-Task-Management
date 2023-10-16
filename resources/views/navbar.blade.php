<?php

//code to check session 
if (session_status() == PHP_SESSION_ACTIVE) {
    ;
  }
  else
  {
    
  
  session_start();
  }
  //code to check session 
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <!-- Navbar content -->
    <H1 style="display:inline" class="navbar-brand">Task Management</h1>
    <form id="logout" method="post" class="bg-dark">@csrf</form>
    <?php
    if(isset($_SESSION["name"]))
    {
       echo'
       
       <button form="logout"  class="nav-item nav-link text-light btn-dark topcorner" >Welcome!! '.$_SESSION["name"].  '     Logout</button>';
      }

    else
    { echo'<div class="topcorner"> <a href="/login" class="nav-item nav-link text-light " >Login</a></div>';

    }
    ?>
    
</nav><!-- Navbar content -->

<!--AJAX Script for Logout REST API-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
    $(document).ready(function(){
   
		$('#logout').submit(function(event){

     
               event.preventDefault();

			   var formData=$(this).serialize();
         
           token ="<?=(isset($_SESSION["token"])?$_SESSION["token"]:"")?>";
         

        
			   $.ajax({

              
		          url: "http://127.0.0.1:8000/api/logout",
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

              alert(obj.message);

              window.location.href = "{{URL::to('/login')}}"
               

						}
			
			
			       });

		});



	});

	</script>
  <!--AJAX Script for Logout REST API-->
  </div>