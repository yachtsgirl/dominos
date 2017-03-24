<?
   session_start();
   @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);
    if($notice_num=='1'){
  		$table = 'notice';
  	}else($notice_num=='2'){
  		$table = 'event';
  	}
   include "../include/dbconn.php";

   $sql = "delete from $table where num = $num";
   mysql_query($sql, $connect);

   mysql_close();

   echo "
	   <script>
	    location.href = '../sub_page/notice.html';
	   </script>
	";
?>
