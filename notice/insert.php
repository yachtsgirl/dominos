<? session_start();
    @extract($_GET);
    @extract($_POST);
    @extract($_SESSION);
?>
<meta charset="utf-8">
<?
	if(!$s_username){
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;
	}

	if(!$subject){
		echo("
	   <script>
	     window.alert('제목을 입력하세요.')
	     history.go(-1)
	   </script>
		");
	 exit;
	}

	if(!$content){
		echo("
	   <script>
	     window.alert('내용을 입력하세요.')
	     history.go(-1)
	   </script>
		");
	 exit;
	}

	include "../include/dbconn.php";       // dconn.php 파일을 불러옴
  $content = htmlspecialchars($content);
  $subject = htmlspecialchars($subject);

  $subject = str_replace("'","&#039;",$subject);
  $content = str_replace("'","&#039;",$content);
	if ($mode=="modify"){
		$sql = "update notice set subject='$subject', content='$content' where num=$num";
	}else{
		$sql = "insert into notice (id, fname, subject, content, regist_day, hit) ";
		$sql .= "values('$s_username', '$s_fname', '$subject', '$content', now(), 0)";
	}

	mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
	mysql_close();                // DB 연결 끊기

	echo "
	   <script>
	    location.href = '../sub_page/notice.html?page=$page&notice_num=1';
	   </script>
	";
?>
