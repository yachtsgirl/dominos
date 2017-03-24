<meta charset="utf-8">
<?
  @extract($_POST);
  @extract($_GET);

  //$ip = $REMOTE_ADDR;         // 방문자의 IP 주소를 저장

  include "../include/dbconn.php";

  $sql = "select * from member where username='$username'";
  $result = mysql_query($sql, $connect);
  $exist_id = mysql_num_rows($result);

  if($exist_id) {
?>
     <script>
       window.alert('This username is taken. Try again')
       history.go(-1)
     </script>
<?
    exit;
  }else if(strlen($password)<8 || strlen($password)>15){
    ?>
         <script>
           window.alert('Password should be 8~15 letters. Try again');
           history.go(-1)
         </script>
    <?
    exit;
  }else if($password != $confirm_password){
    ?>
         <script>
           window.alert('Password does not match. Try again')
           history.go(-1)
         </script>
    <?
    exit;
  }else if($email_check_js!='ok'){
    ?>
         <script>
           window.alert('email is not correct. Try again')
           history.go(-1)
         </script>
    <?
    exit;
  }else{
    $sql = "insert into member(username, password, fname, lname, email, regist_day) ";
    $sql .= "values('$username', password('$password'), '$fname', '$lname', '$email', now())";
    mysql_query($sql, $connect);
  }

  mysql_close();
  echo "
   <script>
    alert('회원가입이 완료되었습니다');
    location.href = '../sub_page/login.html';
   </script>
  ";
?>
