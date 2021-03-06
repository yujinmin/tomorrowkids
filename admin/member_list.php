<?php

	// 설정파일
	include_once "../config.php";
	include "./head.php";

	if(isset($_REQUEST['search_type']) == false)
		$search_type = "search_by_name";
	else
		$search_type = $_REQUEST['search_type'];

	if(isset($_REQUEST['search_txt']) == false)
		$search_txt	= "";
	else
		$search_txt	= $_REQUEST['search_txt'];

	if(isset($_REQUEST['search_media']) == false)
		$search_media = "";   
	else
		$search_media = $_REQUEST['search_media'];

	if(isset($_REQUEST['search_share']) == false)
		$search_share = "";
	else
		$search_share = $_REQUEST['search_share'];

	if(isset($_REQUEST['sDate']) == false)
		$sDate = "";
	else
		$sDate = $_REQUEST['sDate'];
	
	if(isset($_REQUEST['eDate']) == false)
		$eDate = "";
	else
		$eDate = $_REQUEST['eDate'];

	if(isset($_REQUEST['pg']) == false)
		$pg = "1";
	else
		$pg = $_REQUEST['pg'];

	//if(isset($pg) == false) $pg = 1;	// $pg가 없으면 1로 생성
	$page_size = 20;	// 한 페이지에 나타날 개수
	$block_size = 10;	// 한 화면에 나타낼 페이지 번호 개수

	//if (isset($search_type) == false)
	//	$search_type = "search_by_name";
?>
<script type="text/javascript">
	$(function() {
		$( "#sDate" ).datepicker();
		$( "#eDate" ).datepicker();
	});

	function checkfrm()
	{
		if ($("#sDate").val() > $("#eDate").val())
		{
			alert("검색 시작일은 종료일보다 작아야 합니다.");
			return false;
		}
	}
</script>

<div id="page-wrapper">
  <div class="container-fluid">
  <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">테스트 참여자 목록</h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <ol class="breadcrumb">
            <form name="frm_execute" method="POST" onsubmit="return checkfrm()">
              <input type="hidden" name="pg">
              <select name="search_type">
                <option value="user_id" <?php if($search_type == "user_id"){?>selected<?php }?>>고유ID</option>
                <option value="ip_addr" <?php if($search_type == "ip_addr"){?>selected<?php }?>>사용자IP</option>
              </select>
              <input type="text" name="search_txt" value="<?php echo $search_txt?>">
              <select name="search_media">
                <option value="" <?php if($search_media == ""){?>selected<?php }?>>매체</option>
                <option value="facebook" <?php if($search_media == "facebook"){?>selected<?php }?>>facebook</option>
                <option value="kakao" <?php if($search_media == "kakao"){?>selected<?php }?>>kakao</option>
              </select>
              <input type="text" id="sDate" name="sDate" value="<?=$sDate?>"> - <input type="text" id="eDate" name="eDate" value="<?=$eDate?>">
              <input type="submit" value="검색">
            </form>
          </ol>
          <table id="coupon_used_applicant_list" class="table table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>사용자 고유ID</th>
                <th>IP주소</th>
                <th>매체</th>
                <th>참여 횟수</th>
                <th>공유여부</th>
                <th>공유 횟수</th>
                <th>참여한 날짜</th>
                <th>최근 참여 날짜</th>
              </tr>
            </thead>
            <tbody>
<?php 
	$where = "";

	if ($sDate != "")
		$where	.= " AND created_at >= '".$sDate."' AND created_at <= '".$eDate." 23:59:59'";
	
	if ($search_txt != "")
		$where	.= " AND ".$search_type." like '%".$search_txt."%'";
	
	if ($search_media != "")
		$where	.= " AND media = '".$search_media."'";

	$member_count_query = "SELECT count(*) FROM ".$_gl['tk_member_table']." WHERE 1".$where."";

	list($member_count) = @mysqli_fetch_array(mysqli_query($my_db, $member_count_query));

	$PAGE_CLASS = new Page($pg,$member_count,$page_size,$block_size);
	$BLOCK_LIST = $PAGE_CLASS->blockList();
	$PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;

	$member_list_query = "SELECT * FROM ".$_gl['tk_member_table']." WHERE 1".$where." Order by idx DESC LIMIT $PAGE_CLASS->page_start, $page_size";
	$res = mysqli_query($my_db, $member_list_query);

	while($member_data = @mysqli_fetch_array($res))
	{

		$test_result_query	= "SELECT * FROM ".$_gl['tk_test_result_table']." WHERE user_id='".$member_data['user_id']."' ".$where."";
		$test_count			= mysqli_num_rows(mysqli_query($my_db, $test_result_query));
		$share_result_query	= "SELECT * FROM ".$_gl['tk_test_result_table']." WHERE user_id='".$member_data['user_id']."' AND share='Y' ".$where."";
		$share_count		= mysqli_num_rows(mysqli_query($my_db, $share_result_query));

		if ($share_count == 0)
			$share_txt = "미공유";
		else
			$share_txt = "공유";
?>
              <tr>
                <td><?php echo $PAGE_UNCOUNT--?></td>	<!-- No. 하나씩 감소 -->
                <td><?php echo $member_data['user_id']?></td>
                <td><?php echo $member_data['ip_addr']?></td>
                <td><?php echo $member_data['media']?></td>
                <td><?php echo number_format($test_count)?></td>
                <td><?php echo $share_txt?></td>
                <td><?php echo number_format($share_count)?></td>
                <td><?php echo $member_data['created_at']?></td>
                <td><?php echo $member_data['updated_at']?></td>
              </tr>
<?php 
	}
?>
              <tr><td colspan="9"><div class="pageing"><?php echo $BLOCK_LIST?></div></td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
</body>

</html>



<script type="text/javascript">
 
	function pageRun(num)
	{
		f = document.frm_execute;
		f.pg.value = num;
		f.submit();
	}

	// 검색어 서칭 ajax 처리
	function search_query(val1,val2)
	{
		$.ajax({
			type	: "POST",
			url		: "ajax_coupon_used_applicant_list.php",
			data	: ({
						"search_txt"	: val1,
						"search_type"	: val2
					}),
			success	: function(msg) {
				$("#coupon_used_applicant_list").html(msg);
			}
		});
	}


</script>