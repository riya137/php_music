<?php   
        include('navbar.php');
        include('controllers/function.php');

        $user_data=new User();
        session_start();
        if(!isset($_SESSION['email']))
        {
                header("location: signin.php");
        }
        else{
            $changing_email=$_SESSION['email'];
        }
?>

<html>
<head>
    <title>Reset your Password</title>
    <link rel="stylesheet" href="css/mystyle/login.css">

<!------ Include the above in your HEAD tag ---------->
</head>

<body>
<div class="container">
        <div class="row centered-form">
        <div class="col-xs-6 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Change Password</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="post">
			    			<div class="form-group">
			    				<input type="text" name="pass_1" id="pass_1" class="form-control input-sm" placeholder="Enter your new password">
                            </div>
                            <div class="form-group">
			    				<input type="password" name="pass_2" id="password" class="form-control input-sm" placeholder="Re-enter your password">
			    			</div>
			    			<input type="submit" value="Reset Password" class="btn btn-info btn-block" name="reset_pass">
			    		
                        </form>
                        <br>
                        <a href="signin.php">Login</a>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

</body>
<?php
if(isset($_POST['reset_pass'])){
    $password=$_POST['pass_2'];
    $sql=$user_data->reset_pass($changing_email,$password);
    if($sql){
        echo "<center><h5><b><font color=green>Your passrowrd has been changed..!</font></b></h5></center>";
    }
  
}

?>
