<?
	session_start();
	@extract($_GET);
	@extract($_POST);
	@extract($_SESSION);

	include "../include/dbconn.php";

	$sql = "select * from notice where num=$num";
	$result = mysql_query($sql, $connect);

  $row = mysql_fetch_array($result);
      // 하나의 레코드 가져오기

	$item_num = $row[num];
	$item_id = $row[id];
	$item_name = $row[fname];
	$item_hit = $row[hit];
	$item_date = date("Y-m-d",strtotime($row[regist_day]));
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);
	$item_content = $row[content];
	$item_content = str_replace(" ", "&nbsp;", $item_content);
	$item_content = str_replace("\n", "<br>", $item_content);

	$new_hit = $item_hit + 1;

	$sql = "update notice set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/notice.css">
<script>
    function del(href)
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
    }
</script>
</head>

<body>
	<div class="skip_nav">
		<a href="#content_area">본문 바로가기</a>
		<a href="#gnb">네비게이션 바로가기</a>
		<a href="#order_menu">주문화면 바로가기</a>
	</div>
	<div id="wrap">
		<!-- header -->
		<? include "../include/index_head.html" ?>
		<!-- header end-->
		<div class="cs_wrapper">
			<!-- cs_nav -->
			<? include "../include/cs_nav.html" ?>
			<!-- cs_nav end-->
			<h2>Notice</h2>
			<div class="notice_view">
				<h3>새글쓰기</h3>
				<div class="view_form">
					<div class="view_row1">
						<div class="col1">제목 : <?= $item_subject ?></div>
						<div class="col2">조회 : <?= $new_hit ?></div>
						<div class="col3">| <?=$item_date?></div>
					</div>
					<div class="view_row2">
						<div class="col1">내용</div>
					  <div class="col2"><?= $item_content ?></div>
					</div>
				</div>
				<div class="view_button">
					<?
						if($s_username==$item_id||$s_level==1||$s_username=="admin"){
					?>
					<a href="write_form.php?num=<?=$num?>&page=<?=$page?>&mode=modify&notice_num=1">modify</a>
					<a href="javascript:del('delete.php?num=<?=$num?>')">delete</a>
					<?
						}
					?>
					<a href="../sub_page/notice.html?notice_num=1&page=<?=$page?>">list</a>
				</div>
			</div> <!-- notice_write -->
  	</div> <!-- cs_wrapper -->
		<!-- footer -->
		<? include "../include/index_foot.html" ?>
		<!-- footer end -->
	</div><!-- wrap -->
</body>
</html>
