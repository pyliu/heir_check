<?php
/*
    登記案件繼承審查檢核表產出程式
    2018/07/19 pyliu
*/
date_default_timezone_set("ASIA/TAIPEI");
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="For tracking taoyuan land registration cases">
<meta name="author" content="LIU, PANG-YU">
<title>登記案件繼承審查檢核表產出程式</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<!-- Custom styles for this template -->
<link href="assets/css/starter-template.css" rel="stylesheet">
<link href="assets/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet">
<style type="text/css">
.hamburger {
	font-size: 24px;
	font-weight: bold;
}

.tooltip > .tooltip-inner {
  border: 1px solid white;
  padding: 5px;
  font-size: 16px;
}
</style>
</head>

<body>

  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <img src="assets/img/tao.png" style="vertical-align: middle;" />　
    <a class="navbar-brand" href="http://www.taoyuan-land.tycg.gov.tw/" target="_blank">桃園市桃園地政事務所</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <!--
        <li class="nav-item active">
          <a class="nav-link" href="/">登記案件追蹤 <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://www.taoyuan-land.tycg.gov.tw" target="_blank">地所首頁</a>
        </li>
        -->
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle hamburger" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">≡</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
			<a class="dropdown-item" href="http://www.taoyuan-land.tycg.gov.tw/" target="_blank">地所首頁</a>
            <a class="dropdown-item" href="inheritance_check.php" target="_blank">繼承檢核表產出程式(BETA) <span class="sr-only">(current)</span></a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <section>
    <div class="container-fluid text-center">
      <form id="inheritance_form" name="inheritance_form" action="" class="center-block">
        <fieldset>
          <label for="serial"><span class="text-danger">*</span>收件年期字號：</label>
          <input type="text" id="serial" name="serial" value="" />
          <label for="heir"><span class="text-danger">*</span>被繼承人姓名：</label>
          <input type="text" id="heir" name="heir" value="" />
        </fieldset>
        <fieldset>
        <legend>繼承登記類型</legend>
          <radiogroup>
            <label for="type_0_law_heri"><input type="radio" id="type_0_law_heri" name="heri_reg_type" value="type_0_law_heri" /> 法定繼承</label> <br/>
            <label for="type_1_split_heri"><input type="radio" id="type_1_split_heri" name="heri_reg_type" value="type_1_split_heri" /> 分割繼承</label> <br/>
            <label for="type_2_share_heri"><input type="radio" id="type_2_share_heri" name="heri_reg_type" value="type_2_share_heri" /> 共同共有繼承</label> <br/>
            <label for="type_3_modify"><input type="radio" id="type_3_modify" name="heri_reg_type" value="type_3_modify" /> 名義更正</label> <br/>
            <label for="type_4_will_heri"><input type="radio" id="type_4_will_heri" name="heri_reg_type" value="type_4_will_heri" /> 遺囑繼承</label> <br/>
            <label for="type_5_judge_heri"><input type="radio" id="type_5_judge_heri" name="heri_reg_type" value="type_5_judge_heri" /> 判決繼承</label> <br/>
            <label for="type_6_nobody_heri"><input type="radio" id="type_6_nobody_heri" name="heri_reg_type" value="type_6_nobody_heri" /> 無人承認繼承</label> <br/>
          </radiogroup>
        </fieldset>
        <fieldset>
          <legend>死亡日期</legend>
          <radiogroup>
            <label for="jp"><input type="radio" id="jp" name="death_period" value="jp" /> 日據時期(民國34年10月24日前死亡)</label> <br/>
            <label for="tw34_74"><input type="radio" id="tw34_74" name="death_period" value="tw34_74" /> 民法修正前(民國34年10月25日~74年6月4日前)</label> <br/>
            <label for="after_tw74"><input type="radio" id="after_tw74" name="death_period" value="after_tw74" /> 民法修正後(民國74年6月5日後)</label> <br/>
          </radiogroup>
        </fieldset>
        <div>
          <button id='prev_btn' class='btn btn-sm btn-default' title="←">上一步</button>
          <button id='next_btn' class='btn btn-sm btn-default' title="→">下一步</button>
        </div>
      </form>
    </div>
  </section><!-- /section -->
  <p id="copyright" class="text-center my-2"><strong>&copy; <a href="mailto:pangyu.liu@gmail.com">LIU, PANG-YU</a> ALL RIGHTS RESERVED.</strong></p>

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="assets/js/jquery-3.2.1.min.js"></script>
  <!-- <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script> -->
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  <script type="text/javascript">
    $("inheritance_form").on("submit", function(e) {
      e.stopPropagation();
    });
  </script>
</body>
</html>
