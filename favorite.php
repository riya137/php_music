<?php   
        include('controllers/function.php');
        $db_connect=new DB_connection();
        $user_data=new User();
        $song_data=new Song();

      //  include('main_function.php');
        session_start();
        if(!isset($_SESSION['email']))
        {
                header("location: signin.php");
        }
        else{
            $email=$_SESSION['email'];
            $rows=$user_data->maintain_username($email);
            $first_name=$rows[1];
            $user_id=$rows[0];
        }
      
?>
<html>
<head>
    <title>Favorite -  <?php echo $first_name;?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>
<body>
  <?php
    include('navbar.php');
  ?>
 <center> <h1><b><font color=grey><i>Hello <?php echo $first_name ;?>..!!</i></font></b> </h1> </cemter>
 <div class="row">
    <div class="col-md-6">
      <form method="post" action="">
       <table class="table table-bordered">
         <thead>
          <tr>
            <th><input type="checkbox" id="checkAl"> Select All</th>
	         <th> Song Name</th>
          </tr>
         </thead>
<?php
  $i=0;
  $get_fav_query="select * from songs join favorite
  on songs.song_id=favorite.song_id
  where favorite.id='$user_id'";
  $run_select=mysqli_query($connection,$get_fav_query);
  $count = mysqli_num_rows($run_select);
  if($count==0){
     echo "<b><font color=red>Your favorites list is empty..!!</font></b>";
  }
  echo "<br><a href='home_page.php?search_text=null'>Add Songs</a> "; 
  while($row = mysqli_fetch_array($run_select)) {
     $song_id=$row[0];
     $song_name=$row[1];
  ?>
  <tr>
        <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $row[0]; ?>"></td>
	     <td><?php echo $song_name?></td>
   </tr>
  <?php
   $i++;
  }
?>
</table>
<p align="center"><button type="submit" class="btn btn-success" name="save">DELETE</button></p>
</form>
<script>
$("#checkAl").click(function () {
$('input:checkbox').not(this).prop('checked', this.checked);
});
</script>
    </div>
    <div class="col-md-6">
       <?php
             //playing the speicifc song
             if(isset($_GET['song_id'])){
                $song_id_play=$_GET['song_id'];
                $play_song=$song_data->play_song($song_id_play);

             }
                ?>
    </div>
 </div>
<?php
  if(isset($_POST['save'])){
	   $checkbox = $_POST['check'];
	   for($i=0;$i<count($checkbox);$i++){
         $del_id = $checkbox[$i]; 
         $del_fav_query="delete from favorite where id=$user_id and song_id=$del_id";
         $del_fav=mysqli_query($connection,$del_fav_query);
        echo "<script>location.href = 'favorite.php';</script>";

}
  }
?>