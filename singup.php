<?php
 include('navbar.php');
 include('controllers/function.php');

 $user_data=new User();
?>
<html>
<head>
    <title>Register Yourself</title>
    <link rel="stylesheet" href="css/mystyle/register.css">

<!------ Include the above in your HEAD tag ---------->
</head>
<body>
<div class="container">
        <div class="row centered-form">
        <div class="col-xs-6 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Please sign up for Musically <small>It's free!</small></h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="post" name="register" enctype="multipart/form-data">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
			    					</div>
			    				</div>
			    			</div>
							<div class="form-group">
			    				<input type="file" name="image" id="image" class="form-control input-sm" >
			    			</div>
						
			    			<input type="submit" value="Register" class="btn btn-info btn-block" name="submit">
			    		
                        </form>
                        Already registered ..?<a href="signin.php">Sign In</a>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
</body>
<script>
   
</script>
</html>

<?php
//register user into backend
 if(isset($_POST['submit'])){
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $email=$_POST['email'];
	$password=$_POST['password'];
	
	$image=$_FILES['image']['name'];
	$image_tmp=$_FILES['image']['tmp_name'];
	move_uploaded_file($image_tmp,"images/".$image);

	// $registered=$user_data->register_user($first_name,$last_name,$email,$password,$image);
	// if($registered){
	//   session_start();
	//   $_SESSION['email']=$_POST['email'];
	//   echo "<script>location.href = 'home_page.php?search_text=null';</script>";
	// }
    
}
?>