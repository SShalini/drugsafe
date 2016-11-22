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

function addClientData(idfranchisee,idclient,url) {
    if(idclient == undefined || idclient == null){
        idclient = 0;
    }
    $.post(__BASE_URL__ + "/franchisee/addClientData", {idfranchisee: idfranchisee,idclient:idclient,url:url}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/franchisee/" + ar_result[1];

    });
}
function clientDelete(idClient,url) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/franchisee/deleteClientAlert", {idClient: idClient,url:url}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#clientStatus').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function deleteClientConfirmation(idClient) {

    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#clientStatus').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/franchisee/deleteClientConfirmation", {idClient: idClient}, function (result) {
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

function editClient(idClient, idfranchisee,url) {

    $.post(__BASE_URL__ + "/franchisee/editClientData", {
        idClient: idClient,
        idfranchisee: idfranchisee,
        url: url
    }, function (result) {

        ar_result = result.split('||||');

        window.location = __BASE_URL__ + "/franchisee/" + ar_result[1];

    });
}
function productDeleteAlert(idProduct,flag)
{
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/inventory/deleteProductAlert", {idProduct: idProduct,flag: flag}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#productStatus').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
    function deleteProductConfirmation(idProduct,flag) {

        $('.modal-backdrop').remove();
        $('#static').modal("hide");
        $('#productStatus').modal("hide");
        jQuery('#loader').attr('style', 'display:block');
        $.post(__BASE_URL__ + "/inventory/deleteProductConfirmation", {idProduct: idProduct,flag: flag}, function (result) {
            var result_ary = result.split("||||");
            var res = result_ary[0].trim(" ");
            if (res == 'SUCCESS') {
                $("#popup_box").html(result_ary[1]);
                $('#productStatusConfirmation').modal("show");
            }
            jQuery('#loader').attr('style', 'display:none');

        });
    }
function editProduct(idProduct,flag) {

    $.post(__BASE_URL__ + "/inventory/editProductData", {
        idProduct: idProduct,flag: flag
       
    }, function (result) {

        ar_result = result.split('||||');

        window.location = __BASE_URL__ + "/inventory/" + ar_result[1];

    });
}

function editMarketingDetails(idProduct,flag) {


    $.post(__BASE_URL__ + "/inventory/editMarketingData", {
        idProduct: idProduct,flag: flag
       
    }, function (result) {

        ar_result = result.split('||||');

        window.location = __BASE_URL__ + "/inventory/" + ar_result[1];

    });
}


function viewModelStockValMgt(idfranchisee) {

    $.post(__BASE_URL__ + "/stock_management/ModelStock", {idfranchisee: idfranchisee}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/stock_management/" + ar_result[1];
    });
}


function addModelStockValue(idProduct) {

    $.post(__BASE_URL__ + "/stock_management/addModelStock", {idProduct: idProduct}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/stock_management/" + ar_result[1];
        

    });
}

function getProductListing(szProductCategory) {

    $.post(__BASE_URL__ + "/stock_management/getProductsByCategory", {szProductCategory: szProductCategory}, function (result) {
        if (result != '') {
            $("#product_container").html(result);
        }
    });
}
function editModelStockValue(idProduct) {

    $.post(__BASE_URL__ + "/stock_management/editModelStock", {idProduct: idProduct}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/stock_management/" + ar_result[1];
        

    });
}
function viewProductStockMgt(idfranchisee)
{
    $.post(__BASE_URL__+"/stock_management/productStock",{idfranchisee:idfranchisee},function(result){
        ar_result = result.split('||||');
        
        if($.trim(ar_result[0]) == "SUCCESS")
        {
                window.location = __BASE_URL__+"/stock_management/"+ar_result[1];
               
        }
    });
}
function addProductStockQuantity(idProduct) {

    $.post(__BASE_URL__ + "/stock_management/addProductStock", {idProduct: idProduct}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/stock_management/" + ar_result[1];
        

    });
}
function editProductStockQuantity(idProduct,flag) {
   
    $.post(__BASE_URL__ + "/stock_management/editProductStock", {idProduct: idProduct,flag:flag}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/stock_management/" + ar_result[1];
        

    });
}
function requestQuantityAlert(idProduct,flag)
{
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/stock_management/quantityRequestAlert", {idProduct: idProduct,flag: flag}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#requestQuantityStatus').modal("show");
            jQuery('#loader').attr('style', 'display:none');
        }
        

    });
}
    function requestQuantityConfirmation(idProduct,flag) {
        
     var value = jQuery("#requestQuantityForm").serialize(); 
      var newValue = value+"&idProduct="+idProduct+"&flag="+flag;
   
        $('.modal-backdrop').remove();
        $('#static').modal("hide");
        $('#requestQuantityStatus').modal("hide");
        jQuery('#loader').attr('style', 'display:block');
        $.post(__BASE_URL__ + "/stock_management/quantityRequestConfirmation",newValue, function (result) {
            var result_ary = result.split("||||");
            var res = result_ary[0].trim(" ");
            if (res == 'SUCCESS') {
                $("#popup_box").html(result_ary[1]);
                $('#requestQuantityStatusConfirmation').modal("show");
                 jQuery('#loader').attr('style', 'display:none');
           }else{
                $("#popup_box").html(result);
                $('#requestQuantityStatus').modal("show");
                jQuery('#loader').attr('style', 'display:block');
            }
           

        });
    }
    function allotReqQtyAlert(idProduct,szReqQuantity)
{
    
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/stock_management/allotReqQtyAlert", {idProduct: idProduct,szReqQuantity: szReqQuantity}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#allotQuantityStatus').modal("show");
             jQuery('#loader').attr('style', 'display:none');
        }
       

    });
}
    function allotQuantityConfirmation(idProduct) {
      var value = jQuery("#allotQuantityForm").serialize(); 
      var newValue = value+"&idProduct="+idProduct;
        $('.modal-backdrop').remove();
        $('#static').modal("hide");
        $('#allotQuantityStatus').modal("hide");
        jQuery('#loader').attr('style', 'display:block');
        $.post(__BASE_URL__ + "/stock_management/allotReqQtyConfirmation",newValue, function (result) {
            var result_ary = result.split("||||");
            var res = result_ary[0].trim(" ");
            if (res == 'SUCCESS') {  
                $("#popup_box").html(result_ary[1]);
                $('#allotQuantityStatusConfirmation').modal("show");
                jQuery('#loader').attr('style', 'display:none');
            }else{
                $("#popup_box").html(result);
                $('#allotQuantityStatus').modal("show");
                jQuery('#loader').attr('style', 'display:block');
            }
           
            

        });
    }
    function ViewReqProductList(idfranchisee) {
    $.post(__BASE_URL__ + "/stock_management/viewproductlistData", {idfranchisee: idfranchisee}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/stock_management/" + ar_result[1];

    });
}


 
