<meta charset="utf-8">
<?
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

   if(!$id){
      echo "Hello!";
   }else{
      include "../include/dbconn.php";

      mysql_select_db("sunpyo89",$connect);


      $sql = "select * from member where username='$id' ";

      $result = mysql_query($sql, $connect);
      $num_record = mysql_num_rows($result);

      if ($num_record){
         echo "This username is taken. Try again";
      }else{
         echo "Available username";
      }

      mysql_close();
   }
?>
