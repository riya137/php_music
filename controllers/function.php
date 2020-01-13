<?php 
include('db.php');
$db_connect=new DB_connection();
$connection=$db_connect->connect();

class User{
    public function login_user($email,$password){
       $db_connect=new DB_connection();
       $connection=$db_connect->connect();
       $login_query="select * from m_users where email='$email' and password='$password'";
       $login_user=mysqli_query($connection,$login_query);
       return $login_user;
   }

    public function register_user($first_name,$last_name,$email,$password,$image){
       $db_connect=new DB_connection();
       $connection=$db_connect->connect();
       $register_query="insert into m_users(first_name,last_name,email,password,user_image) values('$first_name','$last_name','$email','$password','$image')";
       $register_user=mysqli_query($connection,$register_query); 
       return $register_user;
   }

   public function forget_chk_email($email){
       $db_connect=new DB_connection();
       $connection=$db_connect->connect();
       $iExixts_query="select * from m_users where email='$email'";
       $chk_isExists=mysqli_query($connection,$iExixts_query);
       return $chk_isExists;
   }

   public function reset_pass($email,$password){
      $db_connect=new DB_connection();
      $connection=$db_connect->connect();
      $reset_query="update m_users set password ='$password' where email='$email'";
      $reset_result=mysqli_query($connection,$reset_query);
      return $reset_result;
   }

   public function maintain_username($email){
      $db_connect=new DB_connection();
      $connection=$db_connect->connect();
      $get_name_query="select * from m_users where email='$email'";
      $run_select=mysqli_query($connection,$get_name_query);
      $row=mysqli_fetch_array($run_select);
      return $row;
   }

}

class Movie{

    public function get_movie($searchTxt){
        $db_connect=new DB_connection();
        $connection=$db_connect->connect();
        $null="null";
        $chck=strcmp($searchTxt, $null);
        if($chck==0){
            $sct_user="select * from movie";
            $run_select=mysqli_query($connection,$sct_user);
            while($row=mysqli_fetch_array($run_select)){
                $movie_id=$row[0];
                $movie_name=$row[1];
                echo "
                   <a href='home_page.php?search_text=$searchTxt&movie_id=$movie_id' class='list-group-item'><font color=green size=5>$movie_name</font> </a>";
            }
            return $row;
        }
        else{
            $sct_user="select * from movie where movie_name like'$searchTxt%'";
            $run_select=mysqli_query($connection,$sct_user);
            $count = mysqli_num_rows($run_select);
            if($count==0){
                echo "<b><font color=red>No Record Found..!!</font></b>";
            }
            while($row=mysqli_fetch_array($run_select)){
                $movie_id=$row[0];
                $movie_name=$row[1];
                echo "
                   <a href='home_page.php?search_text=$searchTxt&movie_id=$movie_id' class='list-group-item'><font color=green size=5>$movie_name</font> </a>";
            }
            return $row;
        }
    }
}

class Song{

    public function  get_song($movie_id,$searchTxt){
        $db_connect=new DB_connection();
        $connection=$db_connect->connect(); 
        $get_song_query="select * from songs where movie_id='$movie_id'";
        $get_song=mysqli_query($connection,$get_song_query);
        while($row=mysqli_fetch_array($get_song)){
           $song_id=$row[0];
           $song_name=$row[1];
           echo "
             <a href='home_page.php?search_text=$searchTxt&movie_id=$movie_id&song_id=$song_id' class='list-group-item'><font color=green size=5>$song_name</font> </a>";
         }
         return $row;
    }

    public function play_song($play_song_id){
        $db_connect=new DB_connection();
        $connection=$db_connect->connect(); 
        $song_play_query="select * from songs where song_id='$play_song_id'";
        $play_song=mysqli_query($connection,$song_play_query);
        while($row=mysqli_fetch_array($play_song)){
          $song_id=$row[0];
          $song_name=$row[1];
          $song_url=$row[3];
    
          echo "
          <h3>Now Playing</h3>
          <h4>$song_name</h4>
          <audio controls>
             <source src='$song_url' type='audio/mp3'>
          </audio>
        ";
      }
      return $row;
    }

    public function add_favorite($user_id,$song_id){
        $db_connect=new DB_connection();
        $connection=$db_connect->connect(); 
        $check_fav_query="select * from favorite where id='$user_id' and song_id='$song_id'";
        $chk_fav=mysqli_query($connection,$check_fav_query);
        $count = mysqli_num_rows($chk_fav);
        if($count==1){
            echo "<br><br><b><font color=red>Already added in your favorites..!!</font></b>";
        }
        else{
            $query="insert into favorite(id,song_id) values('$user_id','$song_id')";
            $insert_query=mysqli_query($connection,$query); 
            if($insert_query){
                echo "<b><font color=green>Added to your Favorites</font></b>";
            }
        }
    }


    public function show_like_dislike($user_id,$play_song_id){
        $db_connect=new DB_connection();
        $connection=$db_connect->connect(); 
        $get_likes_query="select * from songs where song_id='$play_song_id'";
        $result = mysqli_query($connection,$get_likes_query);
        $row = mysqli_fetch_array($result);
        $n = $row[4];

        $get_post_like_query="select * from likes where id='$user_id' and song_id='$play_song_id'";
        $get_post_like_result=mysqli_query($connection,$get_post_like_query);
    
        if(mysqli_num_rows($get_post_like_result) == 1){ 
           return true;//user liked already
       }
       else{
             return false;//not yet liked
        } 
        echo "<h5><b>$n</b><h5>" . "<h5><b><Likes/b></h5>";
      } 
    
      public function click_like($user_id,$movie_id,$play_song_id){
        $db_connect=new DB_connection();
        $connection=$db_connect->connect(); 
        $get_likes_query="select * from songs where song_id='$play_song_id'";
        $result = mysqli_query($connection,$get_likes_query);
        $row = mysqli_fetch_array($result);
        $n = $row[4];
        $plus=$n+1;
        $insert_like_query="insert into likes(id,song_id) values ('$user_id','$play_song_id')";
        $insert_likes=mysqli_query($connection,$insert_like_query);
        $update_like_query="update songs set likes='$plus' where song_id='$play_song_id'";
        $update_like=mysqli_query($connection,$update_like_query);
        echo "<script>location.href = 'home_page.php?search_text=null&movie_id=$movie_id&song_id=$play_song_id';</script>";
      }

      public function click_dislike($user_id,$movie_id,$play_song_id){
        $db_connect=new DB_connection();
        $connection=$db_connect->connect(); 
        $get_likes_query="select * from songs where song_id='$play_song_id'";
        $result = mysqli_query($connection,$get_likes_query);
        $row = mysqli_fetch_array($result);
        $n = $row[4];
        $minus=$n-1;
        $delete_like_query="delete from likes where song_id='$play_song_id' and id='$user_id'" ;
        $delete_like=mysqli_query($connection,$delete_like_query);
        $update_like_query="update songs set likes='$minus' where song_id='$play_song_id'";
        $update_like=mysqli_query($connection,$update_like_query);
        echo "<script>location.href = 'home_page.php?search_text=null&movie_id=$movie_id&song_id=$play_song_id';</script>";
      }

      public function get_favorite($user_id){
        $db_connect=new DB_connection();
        $connection=$db_connect->connect(); 
        $get_fav_query="select * from songs join favorite
        on songs.song_id=favorite.song_id
        where favorite.id='$user_id'";
        $run_select=mysqli_query($connection,$get_fav_query);
        $count = mysqli_num_rows($run_select);
        if($count==0){
            echo "<b><font color=red>Your favorites list is empty..!!</font></b>";
        }
        echo "<br><a href='home_page.php?search_text=null'>Add Songs</a> "; 

        while($row=mysqli_fetch_array($run_select)){
            $song_id=$row[0];
            $song_name=$row[1];

            echo "
            <a href='favorite.php?song_id=$song_id' class='list-group-item'><font color=green size=5>$song_name</font> </a>
            <a href='favorite.php?del_fav=$song_id'>Remove</a>";
               
          }
      }
      public function del_favorite($user_id,$song_id_del){
        $db_connect=new DB_connection();
        $connection=$db_connect->connect(); 
        $del_fav_query="delete from favorite where id=$user_id and song_id=$song_id_del";
        $del_fav=mysqli_query($connection,$del_fav_query);
        echo "<script>location.href = 'favorite.php';</script>";
      }

      public function view_favorite($user_id){
        $db_connect=new DB_connection();
        $connection=$db_connect->connect(); 
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

        echo "<tr>
        <td><input type='checkbox' id='checkItem' name='check[]' value=' $song_id></td>
	    <td>$song_name</td>
        </tr>";;
        $i++;
      }
   }
}
?>
