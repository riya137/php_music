<?php
 include('navbar.php');
 include('controllers/function.php');

 $user_data=new User();
 if(isset($_SESSION['email']))
 {
     unset($_SESSION['email']);
     echo "unset";
     echo '<h5><center><font color=green><b>You have been successfully logout</b></font></center></h5>';
 }
 
?>

<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/mystyle/login.css">

<!------ Include the above in your HEAD tag ---------->
</head>

<body>
<div class="container">
        <div class="row centered-form">
        <div class="col-xs-6 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Login</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="post">
			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
                            </div>
                            <div class="form-group">
			    				<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
			    			</div>
			    			<input type="submit" value="Register" class="btn btn-info btn-block" name="login">
			    		
                        </form>
                        <a href="forget_pass.php">Forget Password..?</a>
                        New User..?<a href="singup.php">Sign Up</a>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

</body>
</html>
<?php
   if(isset($_POST['login'])){
	$email=$_POST['email'];
	$password=$_POST['password'];

	//Function Calling
	 $sql=$user_data->login_user($email,$password);
	 $count = mysqli_num_rows($sql);
	 if($count==1){
	   session_start();
	   $_SESSION['email']=$_POST['email'];
	       echo "<script>location.href = 'home_page.php?search_text=null';</script>";
	   }
	   else{
		 echo "<center><b><font color='red'>invalid username or password</font></b></center>";
	   }
  }
?>

?>