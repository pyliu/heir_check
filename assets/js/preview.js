$(document).ready(function(e) {
    $("#preview").on("click", function(e) {
        var current_opts = $("#inheritance_form").serializeArray();
        var json = {};
        $.each(current_opts, function() {
            json[$.trim(this.name)] = $.trim(this.value);
        });
        console.log(json);

        var html = "";
        // #0 收件資訊
        if (!isEmpty(json["serial"]) && !isEmpty(json["heir"])) {
            html += "<p><h4>#0 收件資訊</h4>";
            html += "<div>收件年期字號：" + json["serial"] + "</div>";
            html += "<div>被繼承人姓名：" + json["heir"] + "</div>";
            html += "</p>";
        }

        if (!isEmpty(json["heir_reg_type"])) {
            html += "<p><h4>#1 繼承登記類型</h4>";
            switch (json["heir_reg_type"]) {
                case "type_0_law_heir":
                    html += "<div>法定繼承</div>";
                    break;
                case "type_1_split_heir":
                    html += "<div>分割繼承</div>";
                    break;
                case "type_2_share_heir":
                    html += "<div>共同共有繼承</div>";
                    break;
                case "type_3_modify":
                    html += "<div>名義更正</div>";
                    break;
                case "type_4_will_heir":
                    html += "<div>遺囑繼承</div>";
                    break;
                case "type_5_judge_heir":
                    html += "<div>判決繼承</div>";
                    break;
                case "type_6_nobody_heir":
                    html += "<div>無人承認繼承</div>";
                    break;    
            }
            html += "</p>";
        }

        if (!isEmpty(json["death_period"])) {
            html += "<p><h4>#2 被繼承人審查項目</h4>";
        }

        $("#preview").html(html);
    });
});