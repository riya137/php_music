<?php
class DB_connection{
   function connect(){
       $db_hostname="localhost";
       $db_name="Music";
       $db_username="root";
       $db_password="";
       $con=mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
       $this->dbh=$con;
       if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
       }
       return $con;
   }
}
?>