var wizard_step = 0;
$(document).ready(function(e) {
    // step 0 ... start
    activateElement("#layer1_input_case");
    $("#no0_btn_next").on("click", function(e) {
        if (isEmpty($("#serial").val())) {
            alert("收件字號不能為空白！");
            $("#serial").focus();
            return;
        }
        if (isEmpty($("#heir").val())) {
            alert("繼承人姓名不能為空白！");
            $("#heir").focus();
            return;
        }
        // hide step0 panel
        deactivateElement("#layer1_input_case");
        deactivateElement("#no0_btn_grp");
        // bring up step1 panel
        activateElement("#no1_btn_grp");
        activateElement("#layer1_select_type");
    });

    // step 1 buttons events
    $("#no1_btn_prev").on("click", function(e) {
        // bring up step0 panel
        activateElement("#no0_btn_grp");
        activateElement("#layer1_input_case");
        // hide step1 panel
        deactivateElement("#no1_btn_grp");
        deactivateElement("#layer1_select_type");
    });
    $("#no1_btn_next").on("click", function(e) {
        // TODO ... 
        // collapse step 2 panel
        hideFieldsetsByElement("#layer1_target_check_items");
        // check if user selected a option
        if ($("input:radio[name=heir_reg_type]").is(":checked") === false) {
            alert("請選擇繼承登記類型！");
            activateElement("#layer1_select_type");
            scrollToElement("#layer1_select_type");
            return;
        }

        // hide step1 panel
        deactivateElement("#no1_btn_grp");
        deactivateElement("#layer1_select_type");
        // bring up step2 panel
        activateElement("#no2_btn_grp");
        activateElement("#layer1_target_check_items");
    });

    // step 2 buttons events
    $("#no2_btn_prev").on("click", function(e) {
        // bring up step1 panel
        activateElement("#no1_btn_grp");
        activateElement("#layer1_select_type");
        // hide step2 panel
        deactivateElement("#no2_btn_grp");
        deactivateElement("#layer1_target_check_items");
    });
    $("#no2_btn_next").on("click", function(e) {
        
        // TODO: Checking the necessary items

        // hide step2 panel
        deactivateElement("#no2_btn_grp");
        deactivateElement("#layer1_target_check_items");
        // bring up step3 panel
        activateElement("#no3_btn_grp");
        activateElement("#layer1_heir_check_items");
    });

    // step 3 buttons events
    $("#no3_btn_prev").on("click", function(e) {
        // bring up step2 panel
        activateElement("#no2_btn_grp");
        activateElement("#layer1_target_check_items");
        // hide step3 panel
        deactivateElement("#no3_btn_grp");
        deactivateElement("#layer1_heir_check_items");
    });
    $("#no3_btn_next").on("click", function(e) {
        
        // TODO: Checking the necessary items

        // hide step3 panel
        deactivateElement("#no3_btn_grp");
        deactivateElement("#layer1_heir_check_items");
        // bring up step4 panel
        activateElement("#no4_btn_grp");
        activateElement("#layer1_result");
    });

    // step 4 buttons events
    $("#no4_btn_prev").on("click", function(e) {
        // bring up step3 panel
        activateElement("#no3_btn_grp");
        activateElement("#layer1_heir_check_items");
        // hide step4 panel
        deactivateElement("#no4_btn_grp");
        deactivateElement("#layer1_result");
    });
});