<?
	// 설정파일
	include_once "../config.php";
	include_once "header.php";

	// 주소 바로 입력시 index로 이동
	//if ( !isset($_SERVER['HTTP_REFERER']) ) { 
	//	header('Location: index.php'); 
	//	exit; 
	//} 

	$t_count1 = substr($total_count,0,1);
	$t_count2 = substr($total_count,1,1);
	$t_count3 = substr($total_count,2,1);
	$t_count4 = substr($total_count,3,1);
	$t_count5 = substr($total_count,4,1);

	if (isset($_POST['test_idx']) == false)
		$_POST['test_idx'] = "1";
	// 질문 정보
	//$question_data	= TK_GetTestQuestionInfo($_POST['test_idx']);

	//$answer_data	= TK_GetTestAnswerInfo($_POST['test_idx']);

	$next_num		= $_POST['test_idx'] + 1;

?>
<script>
	// 테스트 결과 페이지에서 뒤로가기 버튼을 이용해 테스트 페이지로 이동 막기
	window.history.forward(0);
</script>

<body>
<!--Line1 start-->
  <input type="hidden" name="sel_value" id="sel_value">
  <input type="hidden" name="selected_value" id="selected_value" value="<?=$_POST['selected_val']?>">
  <input type="hidden" name="selected_answer" id="selected_answer" value="">
  <div class="main_top1">
    <div class="subtopinbg1">
      <h1><a href="http://www.dreamfull.or.kr" target="_blank"><img src="images/logo.png" alt="dreamfull"/></a></h1>
      <div class="fl_left tomrlogo"><a href="index.php"><img src="images/tomrr_logo.png"/></a></div>
      <div class="fl_right sub_toprite">
        <span class="toptext">10,000명의 내일이 모이면<br/>아이들의 내일을 위한<br/>특별 강연회가 열립니다!</span>
        <div class="number_sub">
          <ul>
            <li><?=$t_count1?></li>
            <li class="number2"><?=$t_count2?></li>
            <li class="number3"><?=$t_count3?></li>
            <li class="number4"><?=$t_count4?></li>
            <li class="number5"><?=$t_count5?></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
<!--Line1 end-->
<!--Line2 start-->
  <div class="sub_top2_step2">
    <div class="hidden">
      <div class="sub_top2in">
        <div class="hidden">
          <div class="fl_left">
            <p class="bluetext">STEP1</p>
            <p class="whitetext">내일 (Work) 테스트</p>
          </div>
          <div class="step_sumtext hidden">당신의 내일(work)을 확인하기 위한 10개의 질문에 답해주세요.
          직감에 의존하는 대답을 해 주실수록 상상 이상의 특별한 일들이 기다리고 있답니다!
          </div>
        </div>
        <div class="result_box2" id="test_div">
          <div class="hidden">
            <div class="fl_left hidden plicon"><img src="images/step1_icon.jpg"/></div>
            <div class="fl_left textinbox">
              <p style="font-size:20px; color:#33528d; font-family: 'NanumGothic-ExtraBold'; padding-bottom:20px;">1. 당신의 성격을 설명하자면?</p>
              <p><div id="answer_al_1" class="fl_left tag">A.</div><span class="anstextone fl_left" id="answer1" onmouseover="select_answer(this.id,'over');" onmouseout="select_answer(this.id,'out')" onclick="go_next_question2('11','<?=$next_num?>','')" style="cursor:pointer;padding-bottom:20px">계획하는 것을 좋아하고 차분한 편이다.</span></p>
              <p><div id="answer_al_2" class="fl_left tag">B.</div><span class="anstextone fl_left" id="answer2" onmouseover="select_answer(this.id,'over');" onmouseout="select_answer(this.id,'out')" onclick="go_next_question2('12','<?=$next_num?>','')" style="cursor:pointer;">마음이 가는 대로 선택하고, 활발한 편이다.</span></p>
            </div>
          </div>
          <!-- <div class="hidden nextbut"><a href="javascript:go_next_question('<?=$answer_data[0]['idx']?>','<?=$next_num?>','');"><img src="images/next_but.jpg" alt="다음 질문"/></a></div> -->
        </div>
      </div>
    </div>
  </div>
<!--Line2 end-->
<!--Line3 start-->
  <div class="main_top3">
<!--Footer start-->
<?
	include_once "footer.php";
?>
<!--Footer end-->
  </div>
<!--Line3 end-->
</body>
</html>
<script type="text/javascript">
	$(window).resize(function(){
        var width = $(window).width();
        var height = $(window).height();
        $(".backLayer").width(width).height(height);
    });

	function select_answer(answer_id, event_id)
	{
		var sel_answer = $("#selected_answer").val();
		if (event_id == "over"){
			$("#"+answer_id).attr('class','anstext fl_left');
		}else if (event_id == "click"){
			$("#"+answer_id).attr('class','anstext fl_left');
			$("#selected_answer").val(answer_id);
			if (answer_id == "answer1")
				$("#answer2").attr('class','anstextone fl_left');
			else
				$("#answer1").attr('class','anstextone fl_left');
		}else{
			if (sel_answer != answer_id){
				$("#"+answer_id).attr('class','anstextone fl_left');
			}
		}
	}

</script>