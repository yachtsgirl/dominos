<?
  include "../include/dbconn.php";

	$sql = "select * from member where username=$s_username";
	$result = mysql_query($sql, $connect);

  $row = mysql_fetch_array($result);
	$email = $row[email];
	echo "<script>alert($email)</script>"
	?>
