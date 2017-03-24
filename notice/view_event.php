<?
	session_start();
	@extract($_GET);
  @extract($_POST);
  @extract($_SESSION);

	include "../include/dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);

  $row = mysql_fetch_array($result);

	$item_num = $row[num];
	$item_id = $row[id];
	$item_name = $row[fname];
	$item_hit = $row[hit];
	$item_date = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);
	$item_content = $row[content];
	$item_content = str_replace(" ", "&nbsp;", $item_content);
	$item_content = str_replace("\n", "<br>", $item_content);

	$image_name[0]   = $row[file_name_0];
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];


	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];

	for ($i=0; $i<3; $i++){
		if ($image_copied[$i]){
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);

			$image_width[$i] = $imageinfo[0];  //이미지 너비
			$image_height[$i] = $imageinfo[1];  //이미지 높이
			$image_type[$i]  = $imageinfo[2];    //이미지 타입

			if ($image_width[$i] > 785)
				$image_width[$i] = 785;
		}else{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}

	$new_hit = $item_hit + 1;


	$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
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
			<h2>Event</h2>
			<div class="notice_view">
				<h3>Modify Event</h3>
				<div class="view_form">
					<div class="view_row1">
						<div class="col1">제목 : <?= $item_subject ?></div>
						<div class="col2">조회 : <?= $new_hit ?></div>
						<div class="col3">| <?=$item_date?></div>
					</div>
					<div class="view_row2">
						<div class="col1">내용</div>
					  <div class="col2">
							<?
								for ($i=0; $i<3; $i++){
									if ($image_copied[$i]){
										$img_name = $image_copied[$i];
										$img_name = "./data/event/".$img_name;
										$img_width = $image_width[$i];
										echo "<img class='event' src='$img_name'>"."<br><br>";
									}
								}
							?>
							<?= $item_content ?>
						</div>
					</div>
				</div>
				<div class="view_button">
					<?
						if($s_username==$item_id||$s_level==1||$s_username=="admin"){
					?>
					<a href="write_form_event.php?num=<?=$num?>&page=<?=$page?>&mode=modify&notice_num=2">modify</a>
					<a href="javascript:del('delete.php?num=<?=$num?>&notice_num=2')">delete</a>
					<?
						}
					?>
					<a href="../sub_page/notice.html?page=<?=$page?>&notice_num=2">list</a>
				</div>
			</div> <!-- notice_write -->
  	</div> <!-- cs_wrapper -->
	</div> <!-- wrap -->

</body>
</html>
