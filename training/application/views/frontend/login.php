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
	<h4 class="card-title mt-3 text-center">Welcome Back!</h4>
	<p class="text-center">Login</p>

	<form class="registration" onkeyup="clearDiv();" method="post" action="<?php echo base_url();?>User/signIn">
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
        <input name="password" id="pswd" class="form-control" placeholder="Enter password" required type="password">
    </div> <!-- form-group// --> 
                                   
    <div class="form-group">
        <button name="save" type="submit" class="btn btn-primary btn-block"> Log In  </button>
    </div> <!-- form-group// -->      
    <p class="text-center">Don't have an account? <a href="<?php echo base_url();?>">Register here</a> </p>    
                                                            
</form>
</article>
</div>
</div> 
</div>
