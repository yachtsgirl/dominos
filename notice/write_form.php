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

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/notice.css">
</head>
<script type="text/javascript">
function exit(href){
	if(confirm("지금 나가시면 글이 등록되지 않습니다.\n\n정말 목록으로 가시겠습니까?")) {
		document.location.href = href;
	}
}
function check_input()
 {
		if (!document.board_form.subject.value)
		{
				alert("제목을 입력하세요!");
				document.board_form.subject.focus();
				return;
		}

		if (!document.board_form.content.value)
		{
				alert("내용을 입력하세요!");
				document.board_form.content.focus();
				return;
		}
		document.board_form.submit();
 }
</script>
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
			<div class="notice_write">
				<?
				if($mode=="modify"){
				?>
				<h3>Modify Notice</h3>
				<?}else{?>
				<h3>New Notice</h3>
				<?}?>
				<?
				if($mode=="modify"){
				?>
				<form class="notice_write_form" name="board_form" method="post" action="insert.php?mode=modify&num=<?=$item_num?>">
				<?
				}else{
				?>
				<form class="notice_write_form" name="board_form" method="post" action="insert.php">
				<? } ?>
					<div class="write_form">
						<div class="write_row1">
							<div class="col1">제목</div>
							<?
							if($mode=="modify"){
							?>
							<div class="col2"><input type="text" name="subject" value="<?=$item_subject?>"></div>
							<?
							}else{
							?>
						  <div class="col2"><input type="text" name="subject"></div>
							<?}?>
						</div>
						<div class="write_row2">
							<div class="col1">내용</div>
							<?
							if($mode=="modify"){
							?>
							<div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
							<? }else{ ?>
						  <div class="col2"><textarea rows="15" cols="79" name="content"></textarea></div>
							<?}?>
						</div>
					</div>
					<div class="write_button">
						<?
						if($mode=="modify"){
						?>
						<input type="button" value="modify" onclick="javascript:check_input()">
						<?}else{?>
						<input type="submit" value="submit" onclick="javascript:check_input()">
						<?}?>
						<a href="javascript:exit('../sub_page/notice.html?page=<?=$page?>&notice_num=1')">list</a>
					</div>
				</form>
			</div> <!-- notice_write -->
  	</div> <!-- cs_wrapper -->
		<!-- footer -->
		<? include "../include/index_foot.html" ?>
		<!-- footer end -->
	</div><!-- wrap -->
</body>
</html>
