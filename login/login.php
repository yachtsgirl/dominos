<? session_start() ?>
<meta charset="UTF-8">
<?
  @extract($_GET);
  @extract($_POST);

  if(!$username){
    echo("<script>
      window.alert('아이디를 입력하세요.');
      history.go(-1);
      </script>"
    );
    exit;
  }
  if(!$password){
    echo("<script>
      window.alert('비밀번호를 입력하세요.');
      history.go(-1);
      </script>"
    );
    exit;
  }

  include "../include/dbconn.php";

  $sql = "select * from member where username='$username'";
  $result = mysql_query($sql, $connect);
  $num_match = mysql_num_rows($result);

  if(!$num_match){
    echo("<script>
      window.alert('등록되지 않은 아이디입니다.');
      history.go(-1);
      </script>"
    );
  }else{
		$row = mysql_fetch_array($result);

    $sql ="select * from member where username='$username' and password=password('$password')";
    $result = mysql_query($sql, $connect);
    $num_match = mysql_num_rows($result);

    if(!$num_match){
      echo("<script>
        window.alert('비밀번호가 틀립니다.');
        history.go(-1);
        </script>"
      );
      exit;
    }else{
      $id = $row[username];
		  $fname = $row[fname];
      $lname = $row[lname];
      $level = $row[level];

      $_SESSION['s_username'] = $id;
      $_SESSION['s_fname'] = $fname;
      $_SESSION['s_lname'] = $lname;
      $_SESSION['s_level'] = $level;

      echo("<script>
			  alert('로그인이 되었습니다.');
        location.href = '../index.html';
        </script>"
      );
    }
  }
?>
