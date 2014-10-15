<?
	// 설정파일
	include_once "config.php";
?>
<html>
  <head>
    <title>Document</title>
    <script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
    <script type='text/javascript' src='../js/jquery-1.11.0.min.js'></script>
    <script type='text/javascript' src='../js/tk.js'></script>
  </head>
  <body>
    <div>
      <h1>'내일을 부탁해'</h1>
      <div>
        <p>약 100만 명의 우리 아이들이 빈곤한 환경 탓에</p>
        <p>기쁨과 성취를 얻을 수 있는 다양한 일이 있다는 것을 몰라</p>
        <p>내일을 꿈꾸지 못하고 있다는 사실, 알고 계셨나요?</p>
        <p>당신이 도전할만한 특별한 내일(work)을 확인하시면,</p>
        <p>내일(work)이 모여 아이들의 내일(Tomorrow)이 만들어집니다.</p>
      </div>
      <div>
          <div id="movie_box">
            <iframe id="ytplayer" width="100%"  src="//www.youtube.com/embed/aFTQ8gnKnFw?controls=0&showinfo=0&modestbranding=1&wmode=opaque&enablejsapi=1&autoplay=1&rel=0" frameborder="0" allowfullscreen></iframe>
          </div>
          <div id="count_box">
              <h1>15,069명</h1>
              <p>의 내일(work)이<p>
              <p>아이들의 내일(Tomorrow)이 되고 있습니다.</p>
          </div>
      </div>
      <div id="sns_login_box">
        <input type="button" value="페이스북으로 참여하기" onclick="facebook_login();">
        <input type="button" value="페이스북 로그인 확인" onclick="facebook_login_check();">
        <input type="button" value="페이스북 로그아웃" onclick="facebook_logout();">        
        <input type="button" value="카카오계정으로 참여하기" onclick="kakao_login();">
        <input type="button" value="카카오 로그인 확인" onclick="kakao_login_check();">        
        <p>*어떠한 정보도 무단으로 포스팅하지 않습니다.</p>          
      </div>
    </div>
  </body>
</html>

