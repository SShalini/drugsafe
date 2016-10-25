function showMessege() {
    if ($('#remember-me').is(':checked')) {
        $('.login-info').show();
    } else {
        $('.login-info').hide();
    }
}


function closeClientStatusConfirmation() {
    $('#clientStatusConfirmation').modal("hide");
    $('.modal-backdrop').remove();
}
function open_me(h_rf) {
    window.open(h_rf, '_blank', 'width=400,height=350,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=0,left=0,top=0');

    return false;
}


function openTaxDetails(pageUrl) {
    $("#pageUrl").val(pageUrl);
    $("#taxYearPopUp").attr('style', 'display:block');
    $('#taxYearStatus').modal("show");
}


function redirect_url(page_url) {
    if (page_url != '') {
        window.location = page_url;
    }
    else {
        return false;
    }
}


function ajaxKeyUpLogin(selector, event) {
    if (event.keyCode == '13') {
        userLogin();
    }
}

function userLogin() {
    $("#loginUser").submit();
}

function remove_formError(fieldId, addOnFlag) {
//    alert(fieldId);
    if (addOnFlag == 'true') {
        $("#" + fieldId).parent('div').parent('div').parent('div').removeClass('has-error');
    }
    else {
        $("#" + fieldId).parent('div').parent('div').removeClass('has-error');

    }
    $("#" + fieldId).parent('div').parent('div').children('.help-block').addClass('hide');
    $("#" + fieldId).parent('div').children('.help-block').addClass('hide');
}

function remove_formFieldError(fieldId) {
//    alert(fieldId);
    $("#" + fieldId).parent('div').removeClass('has-error');
    $("#" + fieldId).parent('div').children('.help-block').addClass('hide');
}
function remove_typeaheadError(fieldId) {
//    alert($("#"+fieldId).parent('span').parent('div').parent('div').attr('class'));
    $("#" + fieldId).parent('span').parent('div').parent('div').parent('div').removeClass('has-error');
    $("#" + fieldId).parent('span').parent('div').parent('div').children('.help-block').addClass('hide');
}

function open_forgot_password_form() {
    $(".forget-form").show();

    $(".login-form").hide();
}

function open_login_form() {
    $(".forget-form").hide();

    $(".login-form").show();
}

function forgot_password() {
    var szForgotEmail = $("#szForgotEmail").val();

    if (szForgotEmail == '') {
        $("#forgot_email_error").html("Email address is required");
        $("#forgot_email_error").parent('span').removeClass("hide");
        $("#szForgotEmail").parent('div').parent('div').addClass("has-error");
    }
    if (szForgotEmail != '') {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(szForgotEmail)) {
            $("#forgot_email_error").html("Email address is not valid.");
            $("#forgot_email_error").parent('span').removeClass("hide");
            $("#szForgotEmail").parent('div').parent('div').addClass("has-error");
        }
        else {
            $.post(__SITE_JS_PATH__ + "/ajax_user.php", {
                mode: '__FORGOT_PASSWORD__',
                szForgotEmail: szForgotEmail
            }, function (result) {
                var result_ary = result.split("||||");
                if (result_ary[0] == 'SUCCESS') {
                    $("#szForgotEmail").val('');
                    open_login_form();
                    $("#forgot_success").removeClass("hide");
                }
                else if (result_ary[0] == 'ERROR') {
                    $("#forgot_email_error").html("The email address you entered is not registered with the system. Please try again.");
                    $("#forgot_email_error").parent('span').removeClass("hide");
                    $("#szForgotEmail").parent('div').parent('div').addClass("has-error");
                }

            });
        }
    }
}
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function getStateListingProfile(szCountry) {

    $.post(__BASE_URL__ + "/admin/getStatesByCountry", {szCountry: szCountry}, function (result) {
        if (result != '') {
            $("#state_container").html(result);
        }
    });
}
function viewUserDetails(idfranchisee) {
    $.post(__BASE_URL__ + "/admin/editfranchiseedata", {idfranchisee: idfranchisee}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/admin/" + ar_result[1];

    });
}
function franchiseeDelete(idfranchisee) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/admin/deleteFranchiseeAlert", {idfranchisee: idfranchisee}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#clientStatus').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function deleteFranchiseeConfirmation(idfranchisee) {

    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#clientStatus').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/admin/deleteFranchiseeConfirmation", {idfranchisee: idfranchisee}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#clientStatusConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function viewClient(idfranchisee) {

    $.post(__BASE_URL__ + "/franchisee/viewClientData", {idfranchisee: idfranchisee}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/franchisee/" + ar_result[1];

    });
}

function addClientData(idfranchisee) {
    $.post(__BASE_URL__ + "/franchisee/addClientData", {idfranchisee: idfranchisee}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/franchisee/" + ar_result[1];

    });
}
function clientDelete(idClient,flag) {

    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/franchisee/deleteClientAlert", {idClient: idClient},{flag: flag}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#clientStatus').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function deleteClientConfirmation(idClient,flag) {

    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#clientStatus').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/franchisee/deleteClientConfirmation", {idClient: idClient},{flag: flag}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#clientStatusConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}

function getParenDetails(franchiseeId, clientType) {

    $.post(__BASE_URL__ + "/franchisee/getParentClient", {
        franchiseeId: franchiseeId,
        clientType: clientType
    }, function (result) {
        if (result != '') {
            if (clientType == "1") {
                $("#parenitIdedit").remove();
                $(result).insertAfter("#clientType");

            }
        }
        else {
            $("#parentId").remove();
            $("#parenitIdedit").remove();
        }
    });
}
function getStateListingProfileclient(szCountry) {
    $.post(__BASE_URL__ + "/franchisee/getStatesByCountryClient", {szCountry: szCountry}, function (result) {
        if (result != '') {
            $("#state_container").html(result);
        }
    });
}
function viewClientDetails(idClient) {

    $.post(__BASE_URL__ + "/franchisee/viewClientDetailsData", {idClient: idClient}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/franchisee/" + ar_result[1];

    });
}
function editClient(idClient, idfranchisee,flag) {

    $.post(__BASE_URL__ + "/franchisee/editClientData", {
        idClient: idClient,
        idfranchisee: idfranchisee,
        flag: flag
    }, function (result) {

        ar_result = result.split('||||');

        window.location = __BASE_URL__ + "/franchisee/" + ar_result[1];

    });
}



