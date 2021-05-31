<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<!-- Defined css -->
<link href="<?php echo base_url();?>css/sign_up.css" rel="stylesheet" type="text/css">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">


<div class="container">
<div class="row justify-content-center">
<div class="col-5">
<article class="card-body mx-auto" style="min-width: 400px;">
	<h4 class="card-title mt-3 text-center">Welcome to YourFreelanceWeb</h4>
	<p class="text-center">Get started with a free account</p>

	<form class="registration" onkeyup="clearDiv();" onsubmit="checkPassword();" method="post" action="<?php echo base_url();?>User/signUp">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="name" class="form-control" placeholder="Name" required type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="email" class="form-control" placeholder="Email address" required type="email">
    </div> <!-- form-group// -->

    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="password" id="pswd" class="form-control" placeholder="Create password" required type="password">
    </div> <!-- form-group// -->
    <div id="mismatch" style="color:red; display: none"></div>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="password_repeat" id="pswd_rpt" class="form-control" placeholder="Repeat password" required type="password">
    </div> <!-- form-group// -->  
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		</div>

    	<input name="phone_number" class="form-control" placeholder="Phone number" required type="text">
    </div> <!-- form-group// -->                                    
    <div class="form-group">
        <button name="save" type="submit" class="btn btn-primary btn-block"> Create Account  </button>
    </div> <!-- form-group// -->      
    <p class="text-center">Have an account? <a href="<?php echo base_url();?>User/showForm">Log In</a> </p>    
                                                            
</form>
</article>
</div>
</div> 
</div>

<script type="text/javascript">
    function clearDiv() {
        document.getElementById("mismatch").style.display = "none";
    }

    function checkPassword() {
                var password1 = document.getElementById("pswd").value;
                var password2 = document.getElementById("pswd_rpt").value;
  
                // If password not entered
                if (password1 == '')
                    alert ("Please enter Password");
                      
                // If confirm password not entered
                else if (password2 == '')
                    alert ("Please enter confirm password");
                      
                // If Not same return False.    
                else if (password1 !== password2) {
                    document.getElementById("mismatch").style.display = "block";
                    document.getElementById("mismatch").innerHTML = "Passwords did not match!";
                    event.preventDefault();
                    // return false;
                }
            }
</script>
