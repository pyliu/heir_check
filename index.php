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
.optgrp, #relative_law_result, .left {
  text-align: left;
}
fieldset {
  padding: 5px;
  border: 1px black solid;
}
legend {
  width:auto;
}
.layer1 {
  margin-bottom: 15px;
}
.layer2 {
  text-align: left;
  margin: 0 15px 15px 15px;
}
.layer3 {
  margin: 0 15px 15px 15px;
}
.layer4 {
  margin: 0 15px 15px 15px;
}
.layer5 {
  margin: 0 15px 15px 15px;
}
.layer6 {
  margin: 0 15px 15px 15px;
}
.buttons {

}
#inheritance_form {
  
}
.hide {
  display: none;
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
    <div class="container-fluid">
      <div class="row">
        <div class="col bg-info"></div>
        <div class="col-6 text-center">
          <form id="inheritance_form" name="inheritance_form" action="">

            <fieldset class="layer1 fix">
              <legend>收件資訊</legend>
              <label for="serial"><span class="text-danger">*</span>收件年期字號：</label>
              <input type="text" id="serial" name="serial" value="" />
              <label for="heir"><span class="text-danger">*</span>被繼承人姓名：</label>
              <input type="text" id="heir" name="heir" value="" />
            </fieldset>

            <fieldset class="layer1 fix" id="layer1_select_type">
              <legend>繼承登記類型</legend>
              <div class="">
                <label for="type_0_law_heir"><input type="radio" id="type_0_law_heir" name="heir_reg_type" value="type_0_law_heir" /> 法定繼承</label>
                <label for="type_1_split_heir"><input type="radio" id="type_1_split_heir" name="heir_reg_type" value="type_1_split_heir" /> 分割繼承</label>
                <label for="type_2_share_heir"><input type="radio" id="type_2_share_heir" name="heir_reg_type" value="type_2_share_heir" /> 共同共有繼承</label>
                <label for="type_3_modify"><input type="radio" id="type_3_modify" name="heir_reg_type" value="type_3_modify" /> 名義更正</label>
                <label for="type_4_will_heir"><input type="radio" id="type_4_will_heir" name="heir_reg_type" value="type_4_will_heir" /> 遺囑繼承</label>
                <label for="type_5_judge_heir"><input type="radio" id="type_5_judge_heir" name="heir_reg_type" value="type_5_judge_heir" /> 判決繼承</label>
                <label for="type_6_nobody_heir"><input type="radio" id="type_6_nobody_heir" name="heir_reg_type" value="type_6_nobody_heir" /> 無人承認繼承</label>
              </div>
            </fieldset>

            <fieldset class="layer1 hide" id="layer1_target_check_items">
              <legend>被繼承人審查項目</legend>
              <fieldset class="layer2">
                <legend>死亡日期</legend>
                <label for="jp"><input type="radio" id="jp" name="death_period" value="jp" /> 日據時期(民國34年10月24日前死亡)</label> <br/>
                  <fieldset class="layer3">
                    <legend>被繼承人身分</legend>
                    <label for="house_owner_yes"><input type="radio" id="house_owner_yes" name="house_owner" value="yes" /> 戶主</label> <br/>
                      <fieldset class="layer4">
                        <legend>繼承人順位(戶主)</legend>
                        <label for="house_owner_yes_heir_seq_1"><input type="radio" id="house_owner_yes_heir_seq_1" name="house_owner_yes_heir_seq" value="one" /> 1.法定戶主繼承人-同一戶內男子直系卑親屬(親等近者為先)</label> <br/>
                          <fieldset class="layer5">
                            <legend></legend>
                            <label for="house_owner_yes_heir_seq_1_children_1"><input type="radio" id="house_owner_yes_heir_seq_1_children_1" name="house_owner_yes_heir_seq_1_children" value="one" /> 婚、私生子</label> <br/>
                            <label for="house_owner_yes_heir_seq_1_children_2"><input type="radio" id="house_owner_yes_heir_seq_1_children_2" name="house_owner_yes_heir_seq_1_children" value="second" /> 養子</label> <br/>
                            <label for="house_owner_yes_heir_seq_1_children_3"><input type="radio" id="house_owner_yes_heir_seq_1_children_3" name="house_owner_yes_heir_seq_1_children" value="third" /> 過房子</label> <br/>
                            <label for="house_owner_yes_heir_seq_1_children_4"><input type="radio" id="house_owner_yes_heir_seq_1_children_4" name="house_owner_yes_heir_seq_1_children" value="fourth" /> 螟蛉子</label> <br/>
                            <fieldset class="layer6">
                              <legend>代位或再轉</legend>
                              <label for="house_owner_yes_heir_seq_method_subrogation"><input type="radio" id="house_owner_yes_heir_seq_method_subrogation" name="house_owner_yes_heir_seq_method" value="subrogation" /> 代位</label> <br/>
                              <label for="house_owner_yes_heir_seq_method_transfer"><input type="radio" id="house_owner_yes_heir_seq_method_transfer" name="house_owner_yes_heir_seq_method" value="transfer" /> 再轉</label> <br/>
                            </fieldset>
                          </fieldset>
                        <label for="house_owner_yes_heir_seq_2"><input type="radio" id="house_owner_yes_heir_seq_2" name="house_owner_yes_heir_seq" value="second" /> 2.指定戶主繼承人-依當時戶籍登記為準</label> <br/>
                        <label for="house_owner_yes_heir_seq_3"><input type="radio" id="house_owner_yes_heir_seq_3" name="house_owner_yes_heir_seq" value="third" /> 3.選定戶主繼承人-依當時戶籍登記為準</label> <br/>
                      </fieldset>
                    <label for="house_owner_no"><input type="radio" id="house_owner_no" name="house_owner" value="no" /> 非戶主</label> <br/>
                      <fieldset class="layer4">
                        <legend>繼承人順位(非戶主)</legend>
                        <label for="house_owner_no_heir_seq_1"><input type="radio" id="house_owner_no_heir_seq_1" name="house_owner_no_heir_seq" value="one" /> 1.直系卑親屬(親等近者為先)</label> <br/>
                          <fieldset class="layer5">
                            <legend></legend>
                            <label for="house_owner_no_heir_seq_1_children_1"><input type="radio" id="house_owner_no_heir_seq_1_children_1" name="house_owner_no_heir_seq_1_children" value="one" /> 婚、私生子</label> <br/>
                            <label for="house_owner_no_heir_seq_1_children_2"><input type="radio" id="house_owner_no_heir_seq_1_children_2" name="house_owner_no_heir_seq_1_children" value="second" /> 養子</label> <br/>
                            <label for="house_owner_no_heir_seq_1_children_3"><input type="radio" id="house_owner_no_heir_seq_1_children_3" name="house_owner_no_heir_seq_1_children" value="third" /> 過房子</label> <br/>
                            <label for="house_owner_no_heir_seq_1_children_4"><input type="radio" id="house_owner_no_heir_seq_1_children_4" name="house_owner_no_heir_seq_1_children" value="fourth" /> 螟蛉子</label> <br/>
                            <fieldset class="layer6">
                              <legend>代位或再轉</legend>
                              <label for="house_owner_no_heir_seq_method_subrogation"><input type="radio" id="house_owner_no_heir_seq_method_subrogation" name="house_owner_no_heir_seq_method" value="subrogation" /> 代位</label> <br/>
                              <label for="house_owner_no_heir_seq_method_transfer"><input type="radio" id="house_owner_no_heir_seq_method_transfer" name="house_owner_no_heir_seq_method" value="transfer" /> 再轉</label> <br/>
                            </fieldset>
                          </fieldset>
                        <label for="house_owner_no_heir_seq_2"><input type="radio" id="house_owner_no_heir_seq_2" name="house_owner_no_heir_seq" value="second" /> 2.配偶</label> <br/>
                        <label for="house_owner_no_heir_seq_3"><input type="radio" id="house_owner_no_heir_seq_3" name="house_owner_no_heir_seq" value="third" /> 3.直系尊親屬(親等近者為先)</label> <br/>
                        <label for="house_owner_no_heir_seq_4"><input type="radio" id="house_owner_no_heir_seq_4" name="house_owner_no_heir_seq" value="fourth" /> 4.戶主</label> <br/>
                      </fieldset>
                  </fieldset>
                <label for="tw"><input type="radio" id="tw" name="death_period" value="tw" /> 光復後(民國34年10月25日後死亡)</label> <br/>
                  <fieldset class="layer3">
                    <legend>確切時間</legend>
                    <label for="tw34_74"><input type="radio" id="tw34_74" name="tw_death_period" value="tw34_74" /> 民法修正前(民國34年10月25日~74年6月4日前)</label> <br/>
                    <label for="after_tw74"><input type="radio" id="after_tw74" name="tw_death_period" value="after_tw74" /> 民法修正後(民國74年6月5日後)</label> <br/>
                    <fieldset class="layer4">
                      <legend>繼承人順位</legend>
                      <label for="tw_death_period_heir_spouse"><input type="checkbox" id="tw_death_period_heir_spouse" name="tw_death_period_heir_spouse" value="yes" /> 配偶</label> <br/>
                      <fieldset class="layer5">
                        <legend></legend>
                        <label for="tw_death_period_heir_spouse_live_yes"><input type="radio" id="tw_death_period_heir_spouse_live_yes" name="tw_death_period_heir_spouse_live" value="yes" /> 生存</label> <br/>
                        <label for="tw_death_period_heir_spouse_live_no"><input type="radio" id="tw_death_period_heir_spouse_live_no" name="tw_death_period_heir_spouse_live" value="no" /> 亡歿</label> <br/>
                      </fieldset>
                      <label for="tw_death_period_heir_seq_1"><input type="radio" id="tw_death_period_heir_seq_1" name="tw_death_period_heir_seq" value="one" /> 1. 直系血親卑親屬(親等近者為先)</label> <br/>
                      <fieldset class="layer5">
                        <legend></legend>
                        <label for="tw_death_period_heir_seq_1_option1"><input type="radio" id="tw_death_period_heir_seq_1_option1" name="tw_death_period_heir_seq_1_option" value="one" /> 1. 婚生子女</label> <br/>
                        <label for="tw_death_period_heir_seq_1_option2"><input type="radio" id="tw_death_period_heir_seq_1_option2" name="tw_death_period_heir_seq_1_option" value="second" /> 2. 認領</label> <br/>
                        <label for="tw_death_period_heir_seq_1_option3"><input type="radio" id="tw_death_period_heir_seq_1_option3" name="tw_death_period_heir_seq_1_option" value="third" /> 3. 養子女</label> <br/>
                        <fieldset class="layer6">
                          <legend></legend>
                          <label for="tw_death_period_heir_seq_1_option_method_1"><input type="radio" id="tw_death_period_heir_seq_1_option_method_1" name="tw_death_period_heir_seq_1_option_method" value="one" /> 代位</label> <br/>
                          <label for="tw_death_period_heir_seq_1_option_method_2"><input type="radio" id="tw_death_period_heir_seq_1_option_method_2" name="tw_death_period_heir_seq_1_option_method" value="second" /> 再轉</label> <br/>
                        </fieldset>
                      </fieldset>
                      <label for="tw_death_period_heir_seq_2"><input type="radio" id="tw_death_period_heir_seq_2" name="tw_death_period_heir_seq" value="second" /> 2. 父母</label> <br/>
                      <label for="tw_death_period_heir_seq_3"><input type="radio" id="tw_death_period_heir_seq_3" name="tw_death_period_heir_seq" value="third" /> 3. 兄弟姊妹</label> <br/>
                      <fieldset class="layer5">
                        <legend></legend>
                        <label for="tw_death_period_heir_seq_3_method"><input type="radio" id="tw_death_period_heir_seq_3_method" name="tw_death_period_heir_seq_3_method" value="one" /> 再轉</label> <br/>
                      </fieldset>
                      <label for="tw_death_period_heir_seq_4"><input type="radio" id="tw_death_period_heir_seq_4" name="tw_death_period_heir_seq" value="fourth" /> 2. 祖父母</label> <br/>
                    </fieldset>
                  </fieldset>
              </fieldset>
            </fieldset>

            <fieldset class="layer1 left" id="layer1_heir_check_items">
              <legend>繼承人審查項目</legend>
              <label for="heir_method_abandon"><input type="radio" id="heir_method_abandon" name="heir_method" value="abandon" /> 繼承權拋棄</label> <br/>
              <fieldset class="layer2">
                <legend></legend>
                <label for="heir_method_abandon_yes"><input type="radio" id="heir_method_abandon_yes" name="heir_method_abandon" value="yes" /> 是</label> <br/>
                <label for="heir_method_abandon_no"><input type="radio" id="heir_method_abandon_no" name="heir_method_abandon" value="no" /> 否</label> <br/>
              </fieldset>
              <label for="heir_method_lost"><input type="radio" id="heir_method_lost" name="heir_method" value="lost" /> 繼承權拋棄</label> <br/>
              <fieldset class="layer2">
                <legend></legend>
                <label for="heir_method_lost_yes"><input type="radio" id="heir_method_lost_yes" name="heir_method_lost" value="yes" /> 是</label> <br/>
                <label for="heir_method_lost_no"><input type="radio" id="heir_method_lost_no" name="heir_method_lost" value="no" /> 否</label> <br/>
              </fieldset>
              <label for="heir_method_domestic"><input type="radio" id="heir_method_domestic" name="heir_method" value="domestic" /> 本國人繼承</label> <br/>
              <fieldset class="layer2">
                <legend></legend>
                <label for="heir_method_domestic_opt1"><input type="radio" id="heir_method_domestic_opt1" name="heir_method_domestic_opt" value="one" /> 有行為能力(滿20歲或未成年已結婚者)</label> <br/>
                <label for="heir_method_domestic_opt2"><input type="radio" id="heir_method_domestic_opt2" name="heir_method_domestic_opt" value="second" /> 限制行為能力(7-20歲)</label> <br/>
                <label for="heir_method_domestic_opt3"><input type="radio" id="heir_method_domestic_opt3" name="heir_method_domestic_opt" value="third" /> 無行為能力(7歲以下)</label> <br/>
                <label for="heir_method_domestic_opt4"><input type="radio" id="heir_method_domestic_opt4" name="heir_method_domestic_opt" value="fourth" /> 養子女</label> <br/>
                <label for="heir_method_domestic_opt5"><input type="radio" id="heir_method_domestic_opt5" name="heir_method_domestic_opt" value="fifth" /> 胎兒</label> <br/>
              </fieldset>
              <label for="heir_method_foreign"><input type="radio" id="heir_method_foreign" name="heir_method" value="foreign" /> 外國人繼承</label> <br/>
              <fieldset class="layer2">
                <legend></legend>
                <label for="heir_method_foreign_opt1"><input type="radio" id="heir_method_foreign_opt1" name="heir_method_foreign_opt" value="one" /> 平等互惠(土地法第18條)</label> <br/>
                <fieldset class="layer3">
                  <legend></legend>
                  <label for="heir_method_foreign_opt1_yes"><input type="radio" id="heir_method_foreign_opt1_yes" name="heir_method_foreign_opt1" value="yes" /> 是</label> <br/>
                  <label for="heir_method_foreign_opt1_no"><input type="radio" id="heir_method_foreign_opt1_no" name="heir_method_foreign_opt1" value="no" /> 否</label> <br/>
                </fieldset>
                <label for="heir_method_foreign_opt2"><input type="radio" id="heir_method_foreign_opt2" name="heir_method_foreign_opt" value="second" /> 繼承土地法第17條第1項土地</label> <br/>
                <fieldset class="layer3">
                  <legend></legend>
                  <label for="heir_method_foreign_opt2_yes"><input type="radio" id="heir_method_foreign_opt2_yes" name="heir_method_foreign_opt2" value="yes" /> 是</label> <br/>
                  <label for="heir_method_foreign_opt2_no"><input type="radio" id="heir_method_foreign_opt2_no" name="heir_method_foreign_opt2" value="no" /> 否</label> <br/>
                </fieldset>
                <label for="heir_method_foreign_opt3"><input type="radio" id="heir_method_foreign_opt3" name="heir_method_foreign_opt" value="third" /> 有行為能力(滿20歲或未成年已結婚者)</label> <br/>
                <label for="heir_method_foreign_opt4"><input type="radio" id="heir_method_foreign_opt4" name="heir_method_foreign_opt" value="fourth" /> 限制行為能力(7-20歲)</label> <br/>
                <label for="heir_method_foreign_opt5"><input type="radio" id="heir_method_foreign_opt5" name="heir_method_foreign_opt" value="fifth" /> 無行為能力(7歲以下)</label> <br/>
                <label for="heir_method_foreign_opt6"><input type="radio" id="heir_method_foreign_opt6" name="heir_method_foreign_opt" value="sixth" /> 養子女</label> <br/>
                <label for="heir_method_foreign_opt7"><input type="radio" id="heir_method_foreign_opt7" name="heir_method_foreign_opt" value="seventh" /> 胎兒</label> <br/>
              </fieldset>
              <label for="heir_method_china"><input type="radio" id="heir_method_china" name="heir_method" value="china" /> 大陸地區人民繼承</label> <br/>
              <fieldset class="layer2">
                <legend></legend>
                <label for="heir_method_china_opt1"><input type="radio" id="heir_method_china_opt1" name="heir_method_china_opt" value="one" /> 依兩岸人民關係條例-不得繼承不動產</label> <br/>
                <label for="heir_method_china_opt2"><input type="radio" id="heir_method_china_opt2" name="heir_method_china_opt" value="second" /> 配偶(長期居留許可者)</label> <br/>
                <label for="heir_method_china_opt3"><input type="radio" id="heir_method_china_opt3" name="heir_method_china_opt" value="third" /> 繼承土地法第17條第1項土地</label> <br/>
                <label for="heir_method_china_opt4"><input type="radio" id="heir_method_china_opt4" name="heir_method_china_opt" value="fourth" /> 台灣地區繼承人賴以居住</label> <br/>
              </fieldset>
            </fieldset>

            <fieldset class="layer1" id="layer1_result">
              <legend>相關法令與應附文件</legend>
              <p id="relative_law_result">
                相關法令：<a href="#">...HERE...</a>
              </p>
              <div class="optgrp">
                <label for="heir_death_remove_cert"><input type="checkbox" id="heir_death_remove_cert" name="heir_death_remove_cert" value="heir_death_remove_cert" /> 被繼承人死亡除戶戶籍謄本</label> <br/>
                <label for="heir_now_cert"><input type="checkbox" id="heir_now_cert" name="heir_now_cert" value="heir_now_cert" /> 繼承人現在戶籍謄本</label> <br/>
                <label for="heir_sys_table"><input type="checkbox" id="heir_sys_table" name="heir_sys_table" value="heir_sys_table" /> 繼承系統表</label> <br/>
                <label for="heir_drop_doc"><input type="checkbox" id="heir_drop_doc" name="heir_drop_doc" value="heir_drop_doc" /> 拋棄繼承權證明文件</label> <br/>
                <label for="heir_tax_doc"><input type="checkbox" id="heir_tax_doc" name="heir_tax_doc" value="heir_tax_doc" /> 遺產稅完免納證明文件</label> <br/>
                <label for="heir_affidavit_doc"><input type="checkbox" id="heir_affidavit_doc" name="heir_affidavit_doc" value="heir_affidavit_doc" /> 權利書狀或切結書</label> <br/>
                <label for="heir_split_doc"><input type="checkbox" id="heir_split_doc" name="heir_split_doc" value="heir_split_doc" /> 遺產分割協議書</label> <br/>
                <label for="heir_stamp_doc"><input type="checkbox" id="heir_stamp_doc" name="heir_stamp_doc" value="heir_stamp_doc" /> 繼承人之印鑑證明書</label> <br/>
                <label for="heir_check_id"><input type="checkbox" id="heir_check_id" name="heir_check_id" value="heir_check_id" /> 親自到場核對身分</label> <br/>
                <label for="heir_oversea_doc"><input type="checkbox" id="heir_oversea_doc" name="heir_oversea_doc" value="heir_oversea_doc" /> 海外授權書</label> <br/>
                <label for="heir_will_doc"><input type="checkbox" id="heir_will_doc" name="heir_will_doc" value="heir_will_doc" /> 遺囑</label> <br/>
                <label for="heir_court_doc"><input type="checkbox" id="heir_court_doc" name="heir_court_doc" value="heir_court_doc" /> 法院判決書及確定證明書</label> <br/>
                <label for="heir_other_doc"><input type="checkbox" id="heir_other_doc" name="heir_other_doc" value="heir_other_doc" /> 其他 <input type="text" value="" disabled/></label> <br/>
              </div>
            </fieldset>
            <div class="buttons">
              <button id='OK_btn' class='btn btn-sm btn-default' title="OK">確定</button>
              <button id='CANCEL_btn' class='btn btn-sm btn-default' title="CANCEL">清除</button>
            </div>
          </form>
        </div>
        <div class="col bg-info"></div>
      </div>
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
    function clearTextFields() {
      // find all input fields and clear their value
      $("input[type='text']").each(function(e) {
        $(this).val("");
      });
    }

    function clearAllRadioBoxes() {
      // find all radio boxes and clear their checked prop
      $("input[type='radio']").each(function(e) {
        $(this).prop("checked", false);
      });
    }

    function clearAllCheckBoxes() {
      // find all radio boxes and clear their checked prop
      $("input[type='checkbox']").each(function(e) {
        $(this).prop("checked", false);
      });
    }

    function clearAll() {
      clearTextFields();
      clearAllRadioBoxes();
      clearAllCheckBoxes();
      // hide all fieldset except .fix
      $("fieldset").each(function(){
        if (!$(this).hasClass("fix")) {
          $(this).addClass("hide");
        }
      });
    }

    function disableAllButtons(flag) {
      $("button").each(function(){
        var ele = $(this);
        ele.prop("disabled", flag);
      });
    }

    $("#inheritance_form").on("submit", function(e) {
      e.stopPropagation();
      return false;
    });
    $("#CANCEL_btn").on("click", function() {
      disableAllButtons(true);
      clearAll();
      disableAllButtons(false);
    });

    //var form_params = $("#inheritance_form").serializeArray();
    $(document).ready(function(e) {
      clearAll();
      $("#layer1_select_type input[type='radio']").on("click", function(e){
        clearAll();
        $(this).prop("checked", true);
        console.log($(this).val() + " checked!");
        // control the visibility of #layer1_target_check_items
        $("#layer1_target_check_items").removeClass("hide");
        $("#layer1_target_check_items > .layer2").removeClass("hide");
      });
    });
  </script>
</body>
</html>
