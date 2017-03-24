<?
	session_start();
 	@extract($_GET);
  @extract($_POST);
  @extract($_SESSION);
	$table = "event";

	include "../include/dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);

	$row = mysql_fetch_array($result);
			// 하나의 레코드 가져오기

	$item_id = $row[id];
	$item_name = $row[fname];

	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);
	$item_content = $row[content];

	$item_file_0 = $row[file_name_0];
	$item_file_1 = $row[file_name_1];
	$item_file_2 = $row[file_name_2];

	$copied_file_0 = $row[file_copied_0];
	$copied_file_1 = $row[file_copied_1];
	$copied_file_2 = $row[file_copied_2];
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
				<form class="notice_write_form" name="board_form" method="post" action="insert_event.php?table=<?=$table?>&mode=modify&num=<?=$num?>" enctype="multipart/form-data">
				<? }else{ ?>
				<form class="notice_write_form" name="board_form" method="post" action="insert_event.php?table=<?=$table?>" enctype="multipart/form-data">
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
						<div class="write_row3">
							<div class="col1"> 이미지파일1</div>
						  <div class="col2"><input type="file" name="upfile[]"></div>
						</div>
						<? 	if ($mode=="modify" && $item_file_0){
						?>
						<div class="delete_ok"><?=$item_file_0?> 파일이 등록되어 있습니다.
							<input type="checkbox" name="del_file[]" value="0">삭제
						</div>
						<?}?>
						<div class="write_row4">
							<div class="col1"> 이미지파일2</div>
						  <div class="col2"><input type="file" name="upfile[]"></div>
						</div>
						<? 	if ($mode=="modify" && $item_file_1){?>
						<div class="delete_ok"><?=$item_file_1?> 파일이 등록되어 있습니다.
							<input type="checkbox" name="del_file[]" value="1"> 삭제
						</div>
						<?}?>
						<div class="write_row5">
							<div class="col1"> 이미지파일3</div>
							<div class="col2"><input type="file" name="upfile[]"></div>
						</div>
						<? 	if($mode=="modify" && $item_file_2){?>
						<div class="delete_ok"><?=$item_file_2?> 파일이 등록되어 있습니다.
							<input type="checkbox" name="del_file[]" value="2"> 삭제
						</div>
						<?}?>
					</div>
					<div class="write_button">
						<?
						if($mode=="modify"){
						?>
						<input type="submit" value="modify">
						<?}else{?>
						<input type="submit" value="submit">
						<?}?>
						<a href="javascript:exit('../sub_page/notice.html?page=<?=$page?>&notice_num=2')">list</a>
					</div>
				</form>
			</div> <!-- notice_write -->
  	</div> <!-- cs_wrapper -->
	</div> <!-- wrap -->

</body>
</html>
