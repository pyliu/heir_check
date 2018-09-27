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

function clearBoxesByElement(element) {
    $(element).find("input[type='radio']").each(function(e) {
        if (!$(this).hasClass("skip")) {
            $(this).prop("checked", false);
        }
    });
    $(element).find("input[type='checkbox']").each(function(e) {
        if (!$(this).hasClass("skip")) {
            $(this).prop("checked", false);
        }
    });
}

function clearAll() {
    clearTextFields();
    clearAllRadioBoxes();
    clearAllCheckBoxes();
    hideAllFieldset();
    $("#NEXT_btn").addClass("hide");
}

function hideAllFieldset() {
    // hide all fieldset except .fix
    $("fieldset").each(function(e) {
        if (!$(this).hasClass("fix")) {
            deactivateElement(this);
        }
        $(this).removeClass("table-warning");
    });
}

function hideFieldsetsByElement(element) {
    $(element).find("fieldset").each(function(e) {
        deactivateElement(this);
    });
    // always hide result fieldset
    deactivateElement("#layer1_result");
}

function activateElement(element) {
    $(element).removeClass("hide");
    $(".table-warning").each(function(e) {
        $(this).removeClass("table-warning");
    });
    $(element).addClass("table-warning");
}

function deactivateElement(element) {
    $(element).addClass("hide");
    $(element).removeClass("table-warning");
}

function scrollToElement(element) {
    var pos = $(element).offset().top - 100;
    if (pos < 0) return;
    $("html, body").animate({
        scrollTop: pos
    }, 1000);
}

function disableAllButtons(flag) {
    $("button").each(function() {
        var ele = $(this);
        ele.prop("disabled", flag);
    });
}