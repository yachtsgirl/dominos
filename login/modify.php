<?
	session_start();
	@extract($_POST);
	@extract($_SESSION);
?>
<meta charset="utf-8">
<?
   include "../include/dbconn.php";
	 
	 echo"<script>alert('$s_username')</script>";
   $sql = "update member set password=password('$password'), fname='$fname', lname='$lname', email='$email' where username='$s_username'";

   mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행

   mysql_close();                // DB 연결 끊기
   echo "
	   <script>
	     window.alert('회원정보가 수정되었습니다.');
	    location.href = '/domino/index.html';
	   </script>
	";
?>
