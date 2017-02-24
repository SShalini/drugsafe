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
function getFranchiseeListing(operationManagerId) {

    $.post(__BASE_URL__ + "/admin/getFranchiseeByOperationManager", {operationManagerId: operationManagerId}, function (result) {
        if (result != '') {
            $("#franchisee_container").html(result);   
        }
    });
}
function editFranchiseeDetails(idfranchisee,idOperationManager) {
    $.post(__BASE_URL__ + "/admin/editfranchiseedata", {idfranchisee: idfranchisee,idOperationManager: idOperationManager}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/admin/" + ar_result[1];

    });
}
function editProspectDetails(idProspect,flag) {
    $.post(__BASE_URL__ + "/prospect/editProspectData", {idProspect: idProspect,flag:flag}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/prospect/" + ar_result[1];

    });
}
function editOperationManagerDetails(idOperationManager,flag) {
    $.post(__BASE_URL__ + "/admin/editOperationManagerData", {idOperationManager: idOperationManager,flag: flag}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/admin/" + ar_result[1];

    });
}
function editForum(id) {
    $.post(__BASE_URL__ + "/forum/editForumData", {id: id}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/forum/" + ar_result[1];

    });
}
function addFranchiseeData(idOperationManager,flag) {

    $.post(__BASE_URL__ + "/admin/addFranchiseeData",{idOperationManager: idOperationManager,flag: flag}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/admin/" + ar_result[1];

    });
}
function addTopic(idForum) {

    $.post(__BASE_URL__ + "/forum/addTopicData",{idForum: idForum}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/forum/" + ar_result[1];

    });
}
function addForum(idCategory,flag) {

    $.post(__BASE_URL__ + "/forum/addForumData",{idCategory: idCategory,flag: flag}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/forum/" + ar_result[1];

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
function forumDeleteAlert(id) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/forumDeleteAlert", {id: id}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#forumStatus').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function deleteForumConfirmation(id) {

    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#forumStatus').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/deleteForumConfirmation", {id: id}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#forumStatusConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}
function operationManagerDelete(idOperationManager) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/admin/deleteOperationManagerAlert", {idOperationManager: idOperationManager}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#operationManagerStatus').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function deleteOperationManagerConfirmation(idOperationManager) {

    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#operationManagerStatus').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/admin/deleteOperationManagerConfirmation", {idOperationManager: idOperationManager}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#operationManagerStatusConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}
function viewFrStockAssignList(flag) {

    $.post(__BASE_URL__ + "/reporting/frstockassignlistData", {flag: flag}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/reporting/" + ar_result[1];

    });
}
function viewstockreqlistData(flag) {

    $.post(__BASE_URL__ + "/reporting/allstockreqlistData", {flag: flag}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/reporting/" + ar_result[1];

    });
}
function viewStockAssignList(flag) {

    $.post(__BASE_URL__ + "/reporting/stockassignlistData", {flag: flag}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/reporting/" + ar_result[1];

    });
}

function viewForm(flag) {

    $.post(__BASE_URL__ + "/formManagement/viewFormData", {flag: flag}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/formManagement/" + ar_result[1];

    });
}
function viewForum(idForum) {

    $.post(__BASE_URL__ + "/forum/viewForumListData", {idForum: idForum}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/forum/" + ar_result[1];

    });
}
function viewTopicDetails(idTopic,idForum) {

    $.post(__BASE_URL__ + "/forum/viewTopicData", {idTopic: idTopic,idForum:idForum}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/forum/" + ar_result[1];

    });
}
function viewForumDetails(idCategory) {

    $.post(__BASE_URL__ + "/forum/viewForumData", {idCategory: idCategory}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/forum/" + ar_result[1];

    });
}
function viewClient(idfranchisee) {

    $.post(__BASE_URL__ + "/franchisee/viewClientData", {idfranchisee: idfranchisee}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/franchisee/" + ar_result[1];

    });
}
function viewFranchisee(idOperationManager) {

    $.post(__BASE_URL__ + "/franchisee/viewFranchiseeData", {idOperationManager: idOperationManager}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/franchisee/" + ar_result[1];

    });
}


function addClientData(idfranchisee,idclient,url,flag) {
    if(idclient == undefined || idclient == null){
        idclient = 0;
    }
    $.post(__BASE_URL__ + "/franchisee/addClientData", {idfranchisee: idfranchisee,idclient:idclient,url:url,flag:flag}, function (result) {
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

function editClient(idClient, idfranchisee,url,flag) {

    $.post(__BASE_URL__ + "/franchisee/editClientData", {
        idClient: idClient,
        idfranchisee: idfranchisee,
        url: url,
        flag: flag,
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
    function deleteCategoryAlert(idCategory)
{
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/deleteCategoryAlert", {idCategory: idCategory}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#CategoryStatus').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
    function deleteCategoryConfirmation(idCategory) {

        $('.modal-backdrop').remove();
        $('#static').modal("hide");
        $('#CategoryStatus').modal("hide");
        jQuery('#loader').attr('style', 'display:block');
        $.post(__BASE_URL__ + "/forum/deleteCategoryConfirmation", {idCategory: idCategory}, function (result) {
            var result_ary = result.split("||||");
            var res = result_ary[0].trim(" ");
            if (res == 'SUCCESS') {
                $("#popup_box").html(result_ary[1]);
                $('#categoryStatusConfirmation').modal("show");
            }
            jQuery('#loader').attr('style', 'display:none');

        });
    }
  function replyToCmntsAlert(idCmnt)
{
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/replyToCmnt", {idCmnt: idCmnt}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#replyStatus').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function replyToCmntConfirmation(idCmnt) {
  var val=jQuery('#szReply').val();
 
        $('.modal-backdrop').remove();
        $('#static').modal("hide");
        $('#replyStatus').modal("hide");
        jQuery('#loader').attr('style', 'display:block');
        $.post(__BASE_URL__ + "/forum/replyToCmntConfirmation", {val:val,idCmnt: idCmnt}, function (result) {
            var result_ary = result.split("||||");
            var res = result_ary[0].trim(" ");
            if (res == 'SUCCESS') {
                $("#popup_box").html(result_ary[1]);
                $('#replyStatusConfirmation').modal("show");
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
function editCategory(idCategory) {
    $.post(__BASE_URL__ + "/forum/editCategoryData", {
        idCategory: idCategory
       
    }, function (result) {

        ar_result = result.split('||||');

        window.location = __BASE_URL__ + "/forum/" + ar_result[1];

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
    
    function ViewReqProductList(idfranchisee) {
    $.post(__BASE_URL__ + "/stock_management/viewproductlistData", {idfranchisee: idfranchisee}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/stock_management/" + ar_result[1];

    });
}
  function ViewSosFormPdf(idClient,idsite) {
    $.post(__BASE_URL__ + "/formManagement/ViewSosFormPdfData", {idClient: idClient,idsite:idsite}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/formManagement/" + ar_result[1];
        window.open(URL,'_blank');

    });
}
 function ViewDonorDetails(idsos) {
    $.post(__BASE_URL__ + "/formManagement/ViewDonorDetailsData", {idsos:idsos}, function (result) {
        ar_result = result.split('||||');
       window.location = __BASE_URL__ + "/formManagement/" + ar_result[1];
        

    });
}
   function viewCocForm(idcoc,idsos) {
    $.post(__BASE_URL__ + "/formManagement/ViewCocFormData", {idcoc:idcoc,idsos:idsos}, function (result) {
        ar_result = result.split('||||');
       window.location = __BASE_URL__ + "/formManagement/" + ar_result[1];
        

    });
}
 

function showHideTextbox(id){
  if(id==0){
     jQuery('#text').attr('style', 'display:none'); 
  }
  else if(id==1){
    jQuery('#text').attr('style', 'display:none');   
  }
  else if(id==2){
   jQuery('#text').attr('style', 'display:block');  
  }      
}
function showHideTextboxForCalc(){
    var val=jQuery('#travelType').val();
if(val==1||val==2){
     jQuery('#text').attr('style', 'display:block'); 
     }else{
          jQuery('#text').attr('style', 'display:none'); 
     }
}
 
function viewSosFormDetails(idClient,idsite) {
    $.post(__BASE_URL__ + "/formManagement/sosFormsdata", {idClient:idClient,idsite:idsite}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/formManagement/" + ar_result[1];

    });
}
function editConsumables(idProduct,flag) {
    $.post(__BASE_URL__ + "/inventory/editConsumablesData", {
        idProduct: idProduct,flag: flag
       
    }, function (result) {

        ar_result = result.split('||||');

        window.location = __BASE_URL__ + "/inventory/" + ar_result[1];

    });
}
function calcombinetotalprice(id1,id2,mintime,showlabid) {
    var baseprice = $('#'+id1).val();
    var totaltime = $('#'+id2).val();
    var finalprice = 0;
    if(totaltime >= mintime){
        finalprice = parseFloat(baseprice)*parseInt(totaltime);
    }else {
        finalprice = parseFloat(baseprice)*parseInt(mintime);
    }
    $('#'+showlabid).html('$'+parseFloat(finalprice).toFixed(2));
}
function calTotalFCO() {
 var Val1=jQuery('#FCOBasePrice').val();
 var Val2=jQuery('#FCOHr').val();
 var res= Val1*Val2;

jQuery('#FCOTotal').html(res);
}
function calTotal() {
 var Val1=jQuery('#mobileScreenBasePrice').val();
 var Val2=jQuery('#mobileScreenHr').val();
 var res= Val1*Val2;

jQuery('#mobileScreen').html(res);
}
function calTotalCallOut() {
 var Val1=jQuery('#CallOutBasePrice').val();
 var Val2=jQuery('#CallOutHr').val();
 var res= Val1*Val2;

jQuery('#CallOutTotal').html(res);
}
function calTotalDC() {
 var Val1=jQuery('#DCmobileScreenBasePrice').val();
 var Val2=jQuery('#DCmobileScreenHr').val();
 var res= Val1*Val2;

jQuery('#DCmobileScreenTotal').html(res);
}
function calTotalTravel() {
 
 var Val1=jQuery('#travelBasePrice').val();
 var Val2=jQuery('#travelHr').val();
 var res= Val1*Val2;
 
jQuery('#travel').html(res);
}
 function viewCalcform(idsite,Drugtestid,sosid) {

    $.post(__BASE_URL__ + "/ordering/viewcalform", {idsite: idsite,Drugtestid : Drugtestid,sosid:sosid}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/ordering/" + ar_result[1];

    });

}
function editCalcForm(idsite,Drugtestid,sosid,manualCalId) {

    $.post(__BASE_URL__ + "/ordering/editCalcForm", {idsite: idsite,Drugtestid : Drugtestid,sosid:sosid,manualCalId:manualCalId}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/ordering/" + ar_result[1];

    });

}
function viewCalcDetails(idsite,Drugtestid,sosid) {

    $.post(__BASE_URL__ + "/ordering/viewCalc", {idsite: idsite,Drugtestid : Drugtestid,sosid:sosid}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/ordering/" + ar_result[1];

    });

}
  function showComment(idComment)
{
    
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/showCommentData", {idComment: idComment,}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#showComment').modal("show");
             jQuery('#loader').attr('style', 'display:none');
        }
       

    });
}
function showReply(idReply)
{
    
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/showReplyData", {idReply: idReply,}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#showReply').modal("show");
             jQuery('#loader').attr('style', 'display:none');
        }
       

    });
}
function approveReply(idReply)
{
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/approveReplyAlert", {idReply:idReply,}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#approveReplyAlert').modal("show");
             jQuery('#loader').attr('style', 'display:none');
        }
       

    });
}
function approveReplyConfirmation(idReply) {

        $('.modal-backdrop').remove();
        $('#static').modal("hide");
        $('#approveReplyAlert').modal("hide");
        jQuery('#loader').attr('style', 'display:block');
        $.post(__BASE_URL__ + "/forum/approveReplyConfirmation", {idReply: idReply}, function (result) {
            var result_ary = result.split("||||");
            var res = result_ary[0].trim(" ");
            if (res == 'SUCCESS') {
                $("#popup_box").html(result_ary[1]);
                $('#approveReplyConfirmation').modal("show");
            }
            jQuery('#loader').attr('style', 'display:none');

        });
    }
function unapproveReply(idReply)
{
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/unapproveReplyAlert", {idReply:idReply,}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#unapproveReplyAlert').modal("show");
             jQuery('#loader').attr('style', 'display:none');
        }
       

    });
}
function unapproveReplyConfirmation(idReply) {

        $('.modal-backdrop').remove();
        $('#static').modal("hide");
        $('#approveReplyAlert').modal("hide");
        jQuery('#loader').attr('style', 'display:block');
        $.post(__BASE_URL__ + "/forum/unapproveReplyConfirmation", {idReply: idReply}, function (result) {
            var result_ary = result.split("||||");
            var res = result_ary[0].trim(" ");
            if (res == 'SUCCESS') {
                $("#popup_box").html(result_ary[1]);
                $('#unapproveReplyConfirmation').modal("show");
            }
            jQuery('#loader').attr('style', 'display:none');

        });
    }
    
    function replyDelete(idReply) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/replyDeleteAlert", {idReply: idReply}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#replyDelete').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function replyDeleteConfirmation(idReply) {

    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#replyDelete').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/replyDeleteConfirmation", {idReply: idReply}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#replyDeleteConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}
function cmntDelete(idCmnt) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/cmntDeleteAlert", {idCmnt: idCmnt}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#cmntDelete').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function cmntDeleteConfirmation(idCmnt) {

    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#cmntDelete').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/cmntDeleteConfirmation", {idCmnt: idCmnt}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#cmntDeleteConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}
function closeTopic(idTopic) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/closeTopicAlert", {idTopic: idTopic}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#closeTopic').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function closeTopicConfirmation(idTopic) {
    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#closeTopic').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/closeTopicConfirmationData", {idTopic: idTopic}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#closeTopicConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}
function replyEditAlert(idReply) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/replyEditData", {idReply: idReply}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#replyEdit').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function replyEditConfirmation(idReply) {
     var val=jQuery('#szReply').val();
    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#replyEdit').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/replyEditConfirmation", {idReply: idReply,val:val}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#replyEditConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}

  function assignReportingPdf(franchiseeName,productCode,flag) {
    $.post(__BASE_URL__ + "/reporting/ViewAssignReportingPdfData", {franchiseeName: franchiseeName,productCode:productCode,flag:flag}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');

    });
}
function ReqReportingPdf(franchiseeName,productCode) {
    $.post(__BASE_URL__ + "/reporting/ViewReqReportingPdfData", {franchiseeName: franchiseeName,productCode:productCode}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');

    });
}
function stockassignexcellist(franchiseeName,productCode) {
    $.post(__BASE_URL__ + "/reporting/excelstockassignlistData", {franchiseeName: franchiseeName,productCode:productCode}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
      window.open(URL,'_blank');
     
      
    });
}
function stockreqexcellist(franchiseeName,productCode) {
    $.post(__BASE_URL__ + "/reporting/excelstockreqlistData", {franchiseeName: franchiseeName,productCode:productCode}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
      window.open(URL,'_blank');
      
     

    });
}
  function view_pdf_fr_stockassignlist(productCode) {
    $.post(__BASE_URL__ + "/reporting/pdf_fr_stockassignlist_Data", {productCode:productCode}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');

    });
}
function view_excelfr_stockassignlist(productCode) {
    $.post(__BASE_URL__ + "/reporting/excelfr_stockassignlist_Data", {productCode:productCode}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
      window.open(URL,'_blank');
     
      
    });
}
 function Viewpdffrstockreqlist(productCode) {
    $.post(__BASE_URL__ + "/reporting/pdffrstockreqlistData", {productCode:productCode}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');

    });
}
function Viewexcelfrstockreqlist(productCode) {
    $.post(__BASE_URL__ + "/reporting/excelfrstockreqlistData", {productCode:productCode}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
      window.open(URL,'_blank');
     
      
    });
}
function calcDetailspdf(idsite,Drugtestid,sosid) {
     $.post(__BASE_URL__ + "/ordering/calcDetailspdf", {idsite: idsite,Drugtestid : Drugtestid,sosid:sosid}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/ordering/" + ar_result[1];
        window.open(URL,'_blank');

    });
}
function backSiteRecord(freanchId) {

    $.post(__BASE_URL__ + "/ordering/siteRecordpage", {freanchId: freanchId}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/ordering/" + ar_result[1];

    });

}
function commentEditAlert(idComment) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/commentEditData", {idComment: idComment}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#commentEdit').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function commentEditConfirmation(idComment) {
var val = CKEDITOR.instances.szComment.getData();

    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#commentEdit').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/commentEditConfirmation", {idComment: idComment,val:val}, function (result) {
       
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#commentEditConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');
    }); 
}


function approveComment(idComment)
{
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/approveCommentAlert", {idComment:idComment,}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#approveCommentAlert').modal("show");
             jQuery('#loader').attr('style', 'display:none');
        }
       

    });
}
function approveCommentConfirmation(idComment) {

        $('.modal-backdrop').remove();
        $('#static').modal("hide");
        $('#approveCommentAlert').modal("hide");
        jQuery('#loader').attr('style', 'display:block');
        $.post(__BASE_URL__ + "/forum/approveCommentConfirmation", {idComment: idComment}, function (result) {
            var result_ary = result.split("||||");
            var res = result_ary[0].trim(" ");
            if (res == 'SUCCESS') {
                $("#popup_box").html(result_ary[1]);
                $('#approveCommentConfirmation').modal("show");
            }
            jQuery('#loader').attr('style', 'display:none');

        });
    }
function unapproveComment(idComment)
{
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/unapproveCommentAlert", {idComment:idComment,}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#unapproveCommentAlert').modal("show");
             jQuery('#loader').attr('style', 'display:none');
        }
       

    });
}
function unapproveCommentConfirmation(idComment) {

        $('.modal-backdrop').remove();
        $('#static').modal("hide");
        $('#unapproveCommentAlert').modal("hide");
        jQuery('#loader').attr('style', 'display:block');
        $.post(__BASE_URL__ + "/forum/unapproveCommentConfirmation", {idComment: idComment}, function (result) {
            var result_ary = result.split("||||");
            var res = result_ary[0].trim(" ");
            if (res == 'SUCCESS') {
                $("#popup_box").html(result_ary[1]);
                $('#unapproveCommentConfirmation').modal("show");
            }
            jQuery('#loader').attr('style', 'display:none');

        });
    }
 
function deleteTopicDetails(idTopic) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/deleteTopicAlert", {idTopic: idTopic}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#deleteTopic').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function topicDeleteConfirmation(idTopic) {

    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/forum/topicDeleteConfirmation", {idTopic: idTopic}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#topicDeleteConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}

function placeOrder(idProduct,inc,flag) {
    var val = $("#order_quantity"+inc).val();
    $.post(__BASE_URL__ + "/order/placeOrderData", {idProduct: idProduct,val:val,flag:flag}, function (result) {
        ar_result = result.split('||||');
        if(ar_result[0] == 'SUCCESS'){
           placeOrderConfirmation(); 
        }
         if(ar_result[0] == 'ERROR'){
           placeOrderErrorConfirmation(); 
        }

    });
}
   function placeOrderConfirmation() {
        jQuery('#loader').attr('style', 'display:block');
        $.post(__BASE_URL__ + "/order/placeOrder", function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#orderplaceconfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}
 function placeOrderErrorConfirmation() {
        jQuery('#loader').attr('style', 'display:block');
        $.post(__BASE_URL__ + "/order/placeOrderErrorConfirmation", function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#placeOrderErrorConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}

function DeleteOrder(idOrder) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/order/DeleteOrderAlert", {idOrder:idOrder}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#DeleteOrder').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function DeleteOrderConfirmation(idOrder) {
    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#DeleteOrder').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/order/OrderDeleteConfirmation", {idOrder: idOrder}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#DeleteOrderConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}
function checkOutOrder(idfranchisee) {

    $.post(__BASE_URL__ + "/order/checkOutOrderData", {idfranchisee: idfranchisee}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/order/" + ar_result[1];

    });

}
 function view_order_details(idOrder)
{
    
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/order/viewOrderData", {idOrder: idOrder,}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#viewOrder').modal("show");
             jQuery('#loader').attr('style', 'display:none');
        }
       

    });
}
 function edit_order_details(idOrder)
{
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/order/editOrderData", {idOrder: idOrder,}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#editOrder').modal("show");
             jQuery('#loader').attr('style', 'display:none');
        }
     
    });
}
function CancelOrderConfirmation(idOrder) {
    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#editOrder').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/order/cancelOrderConfirmation", {idOrder: idOrder}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#cancelOrderConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}

function changeordstatus(ordid,prodcount,status) {
    var counter = 0;
    var check = 0;
    var nonchangeable = 0;
    if(status == '1'){
        calTotalPrice();
        $('.err').hide();
        for(var j=1;j<=prodcount;j++){
            if(!$('#order_quantity' + j).val()){
                $('#orddiperr'+j).html('Dispatch quantity must be greater than 0.');
                $('#orddiperr'+j).show();
                return false;
            }
        }
    }
    var proceedcounter = 0;
    for(var k=1;k<=prodcount;k++){
        if (validatedispprod(k)) {
            proceedcounter++;
        }else{
            return false;
        }
    }
    if(prodcount == proceedcounter){
        for(var i=1;i<=prodcount;i++){
            var isdispid = $('#isdispid'+i).val();
            if(isdispid == '0') {
                if($('#order_quantity' + i).val()>0) {
                    counter++;
                    var prodid = $('#ordprodid' + i).val();
                    var qty = $('#order_quantity' + i).val();
                    $.post(__BASE_URL__ + "/order/dispatchsingleprod", {
                        ordid: ordid,
                        prodid: prodid,
                        qty: qty
                    }, function (result) {
                        if (result == 'SUCCESS') {
                            check++;
                        } else {
                            alert('Something went wrong. Please try again.');
                            return false;
                        }
                    });
                }
            }else{
                nonchangeable++;
            }
        }
    }

    setTimeout(function () {
        if(status == '1'){
            if((check == counter)||(nonchangeable == prodcount)){
                var price = $('#totalprice').val();
                $.post(__BASE_URL__ + "/order/dispatchfinal", {
                    ordid: ordid,
                    price: price
                }, function (result) {
                    var result_ary = result.split("||||");
                    var res = result_ary[0].trim(" ");
                    if (res == 'SUCCESS') {
                        $("#popup_box").html(result_ary[1]);
                        $('#editOrder').modal("hide");
                        $('#dispatchprodsucess').modal("show");
                    }
                });
            }
        }else if(status == '0'){
            if((check == counter)||(nonchangeable == prodcount)){
                $.post(__BASE_URL__ + "/order/dispatchpending", {
                    ordid: ordid
                }, function (result) {
                    var result_ary = result.split("||||");
                    var res = result_ary[0].trim(" ");
                    if (res == 'SUCCESS') {
                        $("#popup_box").html(result_ary[1]);
                        $('#editOrder').modal("hide");
                        $('#orderstatchanged').modal("show");
                    }
                });
            }
        }
    },500);

}

function validatedispprod(id) {
    var ordqtyid = $('#ordqtyid'+id).val();
    var availqtyid = $('#availqtyid'+id).val();
    var dispatch_quantity = $('#order_quantity'+id).val();
    var isdispid = $('#isdispid'+id).val();
    if(dispatch_quantity > 0 && isdispid == '0'){
        if(parseInt(dispatch_quantity) > parseInt(ordqtyid)){
            $('#orddiperr'+id).html('Dispatch quantity must be less than or equal to ordered quantity.');
            $('#orddiperr'+id).show();
            return false;
        }else if(parseInt(dispatch_quantity) > parseInt(availqtyid)){
            $('#orddiperr'+id).html('Dispatch quantity must be less than or equal to available quantity.');
            $('#orddiperr'+id).show();
            return false;
        }else {
            $('#orddiperr'+id).hide();
            return true;
        }
    }else{
        return true;
    }
}

function deliverOrderConfirmation(idOrder) {
    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#editOrder').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/order/deliverOrderConfirmation", {idOrder: idOrder}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#deliverOrderConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}

 function view_order_details_pdf(idOrder) {
    $.post(__BASE_URL__ + "/order/view_order_details", {idOrder:idOrder}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/order/" + ar_result[1];
        window.open(URL,'_blank');

    });
}
function calTotalPrice() {
 
 var totalprodcount = $('#totalprodcount').val();
    var total = 0.00;
    for(var i=1;i<=totalprodcount;i++){
        var pertotal = 0.00;
        var ordqtyval = ($('#order_quantity'+i).val()?$('#order_quantity'+i).val():0);
        var ordprodprice = ($('#order_prod_price'+i).val()?$('#order_prod_price'+i).val():0.00);
        //if($('#order_quantity'+i).val()){
            var prodqty = parseInt(ordqtyval);
            var prodprice = parseFloat(ordprodprice).toFixed(2);
            pertotal = (prodprice*prodqty);
            total = total+(prodprice*prodqty);
            $('#total_price'+i).html('$'+parseFloat(pertotal).toFixed(2));
        //}
    }
    $('#finaltotal').html('$'+parseFloat(total).toFixed(2));
    $('#totalprice').val(parseFloat(total).toFixed(2));
}

function getProductCodeListByCategory(szCategory) {
    $.post(__BASE_URL__ + "/reporting/getProductCodeListByCategory", {szCategory: szCategory}, function (result) {
        if (result != '') {
            $("#szProductCode").empty();
            $("#szProductCode").html(result);
            $("#szSearch3").customselect();
        }
    });
}

function ViewpdfFrInventoryReport(prodCategory,productCode) {
    $.post(__BASE_URL__ + "/reporting/ViewpdfFrInventoryReportData", {prodCategory: prodCategory,productCode:productCode}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');

    });
}
function ViewexcelFrInventoryReport(prodCategory,productCode) {
    $.post(__BASE_URL__ + "/reporting/ViewexcelFrInventoryReportData", {prodCategory: prodCategory,productCode:productCode}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
      window.open(URL,'_blank');
     
      
    });
}

function ViewpdfInventoryReport(franchiseeId,prodCategory,productCode) {
    $.post(__BASE_URL__ + "/reporting/ViewpdfInventoryReportData", {franchiseeId : franchiseeId,prodCategory: prodCategory,productCode:productCode}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');

    });
}
function ViewexcelInventoryReport(franchiseeId,prodCategory,productCode) {
    $.post(__BASE_URL__ + "/reporting/ViewexcelInventoryReportData", {franchiseeId : franchiseeId,prodCategory: prodCategory,productCode:productCode}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
      window.open(URL,'_blank');
     
      
    });
}
function addAgentEmployeeDetails(idclient,flag) {
   
    $.post(__BASE_URL__ + "/franchisee/addAgentEmployeeData", {idclient:idclient,flag:flag}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/franchisee/" + ar_result[1];

    });
}
function editAgentEmployeeDetails(idAgent) {

    $.post(__BASE_URL__ + "/franchisee/editAgentEmployeeData", {
        idAgent: idAgent
    }, function (result) {

        ar_result = result.split('||||');

        window.location = __BASE_URL__ + "/franchisee/" + ar_result[1];

    });
}
function viewClientAgentDetails(idClient,flag) {

    $.post(__BASE_URL__ + "/franchisee/viewClientAgentDetailsData", {
        idClient: idClient,
        flag: flag,
    }, function (result) {

        ar_result = result.split('||||');

        window.location = __BASE_URL__ + "/franchisee/" + ar_result[1];

    });
}
function agentDelete(id_agent) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/franchisee/agentDeleteAlert", {id_agent: id_agent}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#agentStatus').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function agentDeleteConfirmation(id_agent) {

    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#agentStatus').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/franchisee/agentDeleteConfirmation", {id_agent: id_agent}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#agentStatusConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function viewAgentEmployeeDetails(idAgent) {

    $.post(__BASE_URL__ + "/franchisee/viewAgentEmployeeDetailsData", {
        idAgent: idAgent,
    }, function (result) {

        ar_result = result.split('||||');

        window.location = __BASE_URL__ + "/franchisee/" + ar_result[1];

    });
}
function ViewpdfOrderReport(szSearch1,szSearch2,szSearch4,szSearch5) {
    $.post(__BASE_URL__ + "/reporting/ViewpdfOrderReportData", {szSearch1 : szSearch1,szSearch2: szSearch2,szSearch4:szSearch4,szSearch5:szSearch5}, function (result) {
        ar_result = result.split('||||');
        var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');

    });
}
function ViewexcelOrderReport(szSearch1,szSearch2,szSearch4,szSearch5) {
    $.post(__BASE_URL__ + "/reporting/ViewexcelOrderReportData", {szSearch1 : szSearch1,szSearch2: szSearch2,szSearch4:szSearch4,szSearch5:szSearch5}, function (result) {
        ar_result = result.split('||||');
        var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');


    });
}
function ViewpdfRevenueGenerate(dtStart,dtEnd,szFranchisee) {
    $.post(__BASE_URL__ + "/reporting/ViewpdfofRevenueGenerate", {dtStart : dtStart,dtEnd: dtEnd,szFranchisee: szFranchisee}, function (result) {
        ar_result = result.split('||||');
        var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');

    });
}
function ViewexcelRevenueGenerate(dtStart,dtEnd,szFranchisee) {
    $.post(__BASE_URL__ + "/reporting/ViewexcelofRevenueGenerate", {dtStart : dtStart,dtEnd: dtEnd,szFranchisee: szFranchisee}, function (result) {
        ar_result = result.split('||||');
        var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');


    });
}
function ViewpdfRevenueSummery(dtStart,dtEnd) {
    $.post(__BASE_URL__ + "/reporting/ViewpdfofRevenueSummery", {dtStart : dtStart,dtEnd: dtEnd}, function (result) {
        ar_result = result.split('||||');
        var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');

    });
}
function ViewexcelRevenueSummery(dtStart,dtEnd) {
    $.post(__BASE_URL__ + "/reporting/ViewexcelofRevenueSummery", {dtStart : dtStart,dtEnd: dtEnd}, function (result) {
        ar_result = result.split('||||');
        var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');


    });

}
function industryReportPdf(dtStart,dtEnd,szIndustry,szTestType) {
    
    $.post(__BASE_URL__ + "/reporting/industryReportPdf", {dtStart : dtStart,dtEnd: dtEnd,szIndustry : szIndustry,szTestType : szTestType}, function (result) {
        ar_result = result.split('||||');
        var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');

    });
}
function industryReportXls(dtStart,dtEnd,szIndustry,szTestType) {
    $.post(__BASE_URL__ + "/reporting/industryReportOfXls", {dtStart : dtStart,dtEnd: dtEnd,szIndustry : szIndustry,szTestType : szTestType}, function (result) {
        ar_result = result.split('||||');
        var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');
    });

}
function getClientListByFrIdData(idFranchisee) {
    if(idFranchisee>0){
        $.post(__BASE_URL__ + "/reporting/getClientListByFrId", {idFranchisee: idFranchisee}, function (result) {
            if (result != '') {
                $("#clientname").empty();
                $("#clientname").html(result);
                $("#sitename").empty();
                $("#sitename").html('<select class="form-control custom-select" name="szSearch3" id="szSearch3" onfocus="remove_formError(this.id,\'true\')"><option value="">Company Name/site</option></select>');
                $("#szSearch2").customselect();
                $("#szSearch3").customselect();
            }
        });
    }
}
function getSiteListByClientIdData(idClient) {
    if(idClient>0){
        $.post(__BASE_URL__ + "/reporting/getSiteListByClientId", {idClient: idClient}, function (result) {
            if (result != '') {
                $("#sitename").empty();
                $("#sitename").html(result);
                $("#szSearch3").customselect();
            }
        });
    }
}
function comparisonReportPdf(siteid,testtype,comparetype) {
    $.post(__BASE_URL__ + "/reporting/comparisonReportPdf", {siteid : siteid,testtype: testtype,comparetype : comparetype}, function (result) {
        ar_result = result.split('||||');
        var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');

    });
}
function comparisonReportXls(siteid,testtype,comparetype) {
    $.post(__BASE_URL__ + "/reporting/comparisonReportOfXls", {siteid : siteid,testtype: testtype,comparetype : comparetype}, function (result) {
        ar_result = result.split('||||');
        var URL = __BASE_URL__ + "/reporting/" + ar_result[1];
        window.open(URL,'_blank');
    });

}

function getClientListByFrId(idFranchisee) {
    $.post(__BASE_URL__ + "/franchisee/getClientListByFrIdData", {idFranchisee: idFranchisee}, function (result) {
        if (result != '') {
            $("#szClient").empty();
            $("#szClient").html(result);
            $("#szSearchClRecord1").customselect();
        }
    });
}
function assignClientAgent(agentId) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/franchisee/assignClientAgent", {agentId: agentId}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#assignClientPopupform').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}

function unassignclient(agentclientid) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/franchisee/unassignclient", {agentclientid: agentclientid}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box_level1").html(result_ary[1]);
            $('#unassignclient').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function confirmedUnassign(id) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/franchisee/confirmedUnassign", {id: id}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $('#unassignclient').modal('hide');
            $('.modal-backdrop').remove();
            $("#popup_box_level1").empty();
            $("#popup_box_level1").html(result_ary[1]);
            $('#confirmedUnassign').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function assignClientConfirmation(idAgent) {
      var value = jQuery("#assignClient").serialize(); 
      var newValue = value+"&idAgent="+idAgent;
        /*$('.modal-backdrop').remove();
        $('#static').modal("hide");
        $('#assignClientPopupform').modal("hide");*/
        jQuery('#loader').attr('style', 'display:block');
        $.post(__BASE_URL__ + "/franchisee/assignClientAgentConfirmation",newValue, function (result) {
            
            var result_ary = result.split("||||");
            var res = result_ary[0].trim(" ");
            if (res == 'SUCCESS') {  
                $("#popup_box_level1").html(result_ary[1]);
                $('#clientAgentStatusConfirmation').modal("show");
                jQuery('#loader').attr('style', 'display:none');
            }else{
                $("#popup_box").html(result);
                $('#assignClientPopupform').modal("show");
                jQuery('#loader').attr('style', 'display:block');
            }
           
            

        });
    }
    function agentEmployeeDelete(agentId) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/franchisee/deleteAgentEmployeeAlert", {agentId: agentId}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#agetDelete').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function agentEmployeeDeleteConfirmation(agentId) {

    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#agetDelete').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/franchisee/deleteAgentEmployeeConfirmation", {agentId: agentId}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#agetDeleteConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}
function getReginolCode(stateId,idfranchisee) {
    
    if(stateId>0){
        $.post(__BASE_URL__ + "/admin/getReginolCode", {stateId: stateId,idfranchisee:idfranchisee}, function (result) {
            if (result != '') {
                $("#reginolFiled").empty();
                $("#reginolFiled").html(result);
            }
        });
    }
    else
    {
         $("#reginolFiled").empty();
    }
   
}
function addRegionCode(stateId) {
    
    if(stateId>0){
        $.post(__BASE_URL__ + "/admin/addRegionCode", {stateId: stateId}, function (result) {
            if (result != '') {
                $("#Region").empty();
                $("#Region").html(result);
            }
        });
    }
    else
    {
         $("#Region").empty();
    }
   
}
function editRegionCode(stateId) {
    
    if(stateId>0){
        $.post(__BASE_URL__ + "/admin/editRegionCode", {stateId: stateId}, function (result) {
            if (result != '') {
                $("#Region").empty();
                $("#Region").html(result);
            }
        });
    }
    else
    {
         $("#Region").empty();
    }
   
}
function editRegionDetails(idRegion) {
    
    $.post(__BASE_URL__ + "/admin/editRegionDetails", {idRegion: idRegion}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/admin/" + ar_result[1];

    });
}
function regionDelete(regionId) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/admin/regionDeleteeAlert", {regionId: regionId}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#regionDelete').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function regionDeleteConfirmation(regionId) {

    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#regionDelete').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/admin/deleteRegionConfirmation", {regionId: regionId}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#regionDeleteConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}
function franchiseeStatus(idfranchisee,status) {
    
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/admin/franchiseeStatus", {idfranchisee: idfranchisee,status:status}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#franchiseeStatus').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function franchiseeStatusConfirmation(idfranchisee,status) {

    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#franchiseeStatus').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/admin/franchiseeStatusConfirmation", {idfranchisee: idfranchisee,status:status}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#franchiseeStatusConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}
function editDiscountDetails(idDiscount) {
    
    $.post(__BASE_URL__ + "/ordering/editDiscountDetails", {idDiscount: idDiscount}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/ordering/" + ar_result[1];

    });
}
function discountDelete(idDiscount) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/ordering/discountDeleteeAlert", {idDiscount: idDiscount}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#discountDelete').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function discountDeleteConfirmation(idDiscount) {

    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#discountDelete').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/ordering/deletediscountConfirmation", {idDiscount: idDiscount}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#discountDeleteConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}

function prospectDelete(prospectId) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/prospect/deleteprospectAlert", {prospectId: prospectId}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#prospectStatus').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function deleteProspectConfirmation(prospectId) {

    $('.modal-backdrop').remove();
    $('#static').modal("hide");
    $('#prospectStatus').modal("hide");
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/prospect/deleteProspectConfirmation", {prospectId: prospectId}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#prospectStatusConfirmation').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    }); 
}
function viewProspect(idProspect) {

    $.post(__BASE_URL__ + "/prospect/viewProspectData", {idProspect: idProspect}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/prospect/" + ar_result[1];

    });
}
function addMeetingNotesData(idProspect,flag) {

    $.post(__BASE_URL__ + "/prospect/addMeetingNotesData",{idProspect: idProspect,flag:flag}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/prospect/" + ar_result[1];

    });
}
function viewMeetingNotes(idMeetingNotes) {

    $.post(__BASE_URL__ + "/prospect/viewMeetingNotesData", {idMeetingNotes: idMeetingNotes}, function (result) {
        ar_result = result.split('||||');
        window.location = __BASE_URL__ + "/prospect/" + ar_result[1];

    });
}
function editProspectStatus(idProspect) {
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/prospect/editProspectStatusData", {idProspect: idProspect}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#editProspectStatus').modal("show");
        }
        jQuery('#loader').attr('style', 'display:none');

    });
}
function editProspectStatusConfirmation(idProspect) {
      var value = jQuery("#changeStatus").serialize(); 
      var newValue = value+"&idProspect="+idProspect;
        $('.modal-backdrop').remove();
        $('#static').modal("hide");
        $('#editProspectStatus').modal("hide");
        jQuery('#loader').attr('style', 'display:block');
        $.post(__BASE_URL__ + "/prospect/editProspectStatusConfirm",newValue, function (result) {
            
            var result_ary = result.split("||||");
            var res = result_ary[0].trim(" ");
            if (res == 'SUCCESS') {  
                $("#popup_box").html(result_ary[1]);
                $('#editProspectStatusConfirmation').modal("show");
                jQuery('#loader').attr('style', 'display:none');
            }else{
                $("#popup_box").html(result);
                $('#editProspectStatus').modal("show");
                jQuery('#loader').attr('style', 'display:block');
            }
           
            

        });
    }
     function showDescription(idMeetingNote)
{
    
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/prospect/showDescriptionData", {idMeetingNote: idMeetingNote,}, function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
        if (res == 'SUCCESS') {
            $("#popup_box").html(result_ary[1]);
            $('#showDescription').modal("show");
             jQuery('#loader').attr('style', 'display:none');
        }
       

    });
}
function export_csv_report(prospectId,status) {
    $.post(__BASE_URL__ + "/prospect/exportProspectCsvData", {prospectId: prospectId,status:status}, function (result) {
        ar_result = result.split('||||');
     var URL = __BASE_URL__ + "/prospect/" + ar_result[1];
      window.open(URL,'_blank');
    });
}
function import_csv_popup() {
      
    jQuery('#loader').attr('style', 'display:block');
    $.post(__BASE_URL__ + "/prospect/import_csv_popup_alert", function (result) {
        var result_ary = result.split("||||");
        var res = result_ary[0].trim(" ");
         if (res == 'SUCCESS') {  
                $("#popup_box").html(result_ary[1]);
                $('#static').modal("show");
                jQuery('#loader').attr('style', 'display:none');
            }
        
    });
}

function import_csv_popup_confirmation() {
  var file =document.getElementById("impcustomers").value
  if(!file){
    $('#error').html('Please select a csv file.');
     $('#error').show();
     return false;    
  }
  else{
   var fileExtention = (/[.]/.exec(file)) ? /[^.]+$/.exec(file) : undefined;
  if(fileExtention=='csv'){
    $('.error').hide();
    $("#ProductimportForm").submit();   
  }
  else{   
     $('#error').html('Invalid file uploaded. Only .csv file is allowed. Please try again.');
     $('#error').show();
     return false; 
  }
     
  }

}
