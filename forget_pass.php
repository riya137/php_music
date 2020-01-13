<?php
 include('navbar.php');
 include('controllers/function.php');

 $user_data=new User(); 
?>

<html>
<head>
    <title>Forget Password</title>
    <link rel="stylesheet" href="css/mystyle/login.css">

<!------ Include the above in your HEAD tag ---------->
</head>

<body>
<div class="container">
        <div class="row centered-form">
        <div class="col-xs-6 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Forget Password</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="post">
			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Enter your registered email address">
                            </div>
			    			<input type="submit" value="Submit" class="btn btn-info btn-block" name="forget">
			    		
                        </form>
                       
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

</body>
<?php
if(isset($_POST['forget'])){
    $email=$_POST['email'];
    $sql=$user_data->forget_chk_email($email);
	$count = mysqli_num_rows($sql);
    if($count){
        session_start();
        $_SESSION['email']=$_POST['email'];
        echo "<script>location.href = 'reset_pass.php';</script>";
    }
    else{
        echo "<center><h5><b><font color=red>Email Address does not exists</font></b></h5></center>";
    }
}

//UPDATE `m_users` SET `password`='amit123' WHERE email = 'amit@gmail.com' 
?>





