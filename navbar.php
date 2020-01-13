<!DOCTYPE html>
<html lang="en">
<head>
  <title>Music</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">MUsically</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact Us</a></li>
      <!-- <li><a href="signin.php">Sign In</a></li> -->
      <?php if (isset($_SESSION['email'])){ 
         
        ?>
          <li><a href="signin.php">Logout</a></li>
          <?php } 
          else{  ?>
          <li><a href="signin.php">Sign In</a></li>
            
        <?php  }  ?>
          
		
    </ul>
  </div>
</nav>


</body>
</html>
