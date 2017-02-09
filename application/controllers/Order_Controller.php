<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        
        $this->load->model('Order_Model');
        $this->load->model('StockMgt_Model');
        $this->load->library('pagination');
        $this->load->model('Ordering_Model');
        $this->load->model('Forum_Model');
        $this->load->model('Error_Model');
        $this->load->model('Admin_Model');
        $this->load->model('Franchisee_Model');
        $this->load->model('Inventory_Model');
        $this->load->model('Form_Management_Model');
        $this->load->model('StockMgt_Model');
        $this->load->model('Webservices_Model');
        $this->load->library('pagination');


    }

    function drugtestkit()
    {
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $searchAry = $_POST['szSearchProdCode'];

        $config['base_url'] = __BASE_URL__ . "/order/drugtestkit/";
        $config['total_rows'] = count($this->Inventory_Model->viewDrugTestKitList($limit, $offset, $searchAry, 2));
        $config['per_page'] = __PAGINATION_RECORD_LIMIT__;

        $this->pagination->initialize($config);

        $idfranchisee = $_SESSION['drugsafe_user']['id'];

        $drugTestKitAray = $this->Inventory_Model->viewDrugTestKitList($config['per_page'], $this->uri->segment(3), $searchAry, 2);
        $drugTestKitListAray = $this->Inventory_Model->viewDrugTestKitList(false, false, false, 2);
        $count = $this->Admin_Model->getnotification();

        $data['drugTestKitAray'] = $drugTestKitAray;
        $data['szMetaTagTitle'] = " Drug Test Kit ";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Orders";
        $data['subpageName'] = "Drug_Test_Kit";
        $data['notification'] = $count;
        $data['data'] = $data;
        $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
        $data['drugtestkitlist'] = $drugTestKitListAray;

        $this->load->view('layout/admin_header', $data);
        $this->load->view('order/orderDrugTestKit');
        $this->load->view('layout/admin_footer');
    }

    function marketingmaterial()
    {
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }

        $searchAry = $_POST['szSearchProductCode'];
        $config['base_url'] = __BASE_URL__ . "/order/marketingmaterial/";
        $config['total_rows'] = count($this->Inventory_Model->viewMarketingMaterialList($searchAry, $limit, $offset, 2));
        $config['per_page'] = __PAGINATION_RECORD_LIMIT__;

        $this->pagination->initialize($config);

        $idfranchisee = $_SESSION['drugsafe_user']['id'];
        $marketingMaterialAray = $this->Inventory_Model->viewMarketingMaterialList($searchAry, $config['per_page'], $this->uri->segment(3), 2);
        $marketingMaterialListAray = $this->Inventory_Model->viewMarketingMaterialList(false, false, false, 2);
        $count = $this->Admin_Model->getnotification();


        $data['marketingMaterialAray'] = $marketingMaterialAray;
        $data['szMetaTagTitle'] = "Marketing Material";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Orders";
        $data['subpageName'] = "Marketing_Material";
        $data['notification'] = $count;
        $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
        $data['data'] = $data;
        $data['marketingMaterialListAray'] = $marketingMaterialListAray;

        $this->load->view('layout/admin_header', $data);
        $this->load->view('order/orderMarketingMaterial');
        $this->load->view('layout/admin_footer');
    }


    function uploadProfileImage()
    {

        $output_dir = __APP_PATH_PRODUCT_IMAGES__;

        $ret = array();
        $RandomNum = time();
        $ImageName = str_replace(' ', '-', strtolower($_FILES['myfile']['name']));
        $ImageType = $_FILES['myfile']['type']; //"image/png", image/jpeg etc.
        $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
        $ImageExt = str_replace('.', '', $ImageExt);
        $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
        if ($ImageName > 10) {
            $ImageName = substr($ImageName, 0, 10);
        }
        if (strlen($ImageName) > 20) {
            $ImageName = substr_replace($ImageName, '', 20);
        }
        $NewImageName = 'Drug_product_' . $ImageName . '-' . $RandomNum . '.' . $ImageExt;
        move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . '/' . $NewImageName);
//       	 	 echo $output_dir. $NewImageName;
        $randomNum = rand() . time();
        $ret['name'] = $NewImageName;
        $ret['rand_num'] = $randomNum;
        $ret['img_div'] = '<div id="photoDiv_' . $randomNum . '"><img class="" src="' . __BASE_USER_PRODUCT_IMAGES_URL__ . '/' . $NewImageName . '" width="60" height="60" alt="Product  Image" />
                                   <a href="javascript:void(0);" id="remove_btn_' . $randomNum . '" class="btn red-intense btn-sm" onclick="removeIncidentPhoto();">Remove</a>
                           </div>';

        echo json_encode($ret);
    }

    function consumables()
    {
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $searchAry = $_POST['szSearchProdCode'];
        $config['base_url'] = __BASE_URL__ . "/order/consumables/";
        $config['total_rows'] = count($this->Inventory_Model->viewConsumablesList($limit, $offset, $searchAry, 3));
        $config['per_page'] = __PAGINATION_RECORD_LIMIT__;
        $this->pagination->initialize($config);
        $idfranchisee = $_SESSION['drugsafe_user']['id'];

        $consumablesAray = $this->Inventory_Model->viewConsumablesList($config['per_page'], $this->uri->segment(3), $searchAry, 3);
        $consumableslistAry = $this->Inventory_Model->viewConsumablesList(false, false, false, 3);
        $count = $this->Admin_Model->getnotification();

        $data['consumablesAray'] = $consumablesAray;
        $data['szMetaTagTitle'] = " Consumables";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Orders";
        $data['subpageName'] = "Consumables";
        $data['notification'] = $count;
        $data['data'] = $data;
        $data['consumableslist'] = $consumableslistAry;

        $this->load->view('layout/admin_header', $data);
        $this->load->view('order/orderConsumables');
        $this->load->view('layout/admin_footer');
    }

    function placeOrderData()
    {
        $idProduct = $this->input->post('idProduct');
        $quantity = $this->input->post('val');
        $flag = $this->input->post('flag');
        $this->session->set_userdata('flag', $flag);

        if (($quantity > 0) && ($quantity < 100)) {
            $this->Order_Model->InsertOrder($idProduct, $quantity);
            echo "SUCCESS||||";
            echo "placeOrderConfirmation";
        } else {
            echo "ERROR||||";
            echo "placeOrderErrorConfirmation";
        }
    }

    public function placeOrder()
    {
        $flag = $this->session->userdata('flag');
        $data['mode'] = '__PLACE_ORDER_POPUP_CONFIRM__';
        $this->load->view('admin/admin_ajax_functions', $data);


    }

    public function placeOrderErrorConfirmation()
    {
        $flag = $this->session->userdata('flag');
        $data['mode'] = '__PLACE_ORDER_POPUP_ERROR_CONFIRM__';
        $this->load->view('admin/admin_ajax_functions', $data);


    }

    function orderList()
    {
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $searchAry = $_POST['szSearchProdCode'];

        $config['base_url'] = __BASE_URL__ . "/order/orderList/";
        $config['total_rows'] = count($this->Order_Model->getOrdersList($limit, $offset, $searchAry));
        $config['per_page'] = __PAGINATION_RECORD_LIMIT__;

        $this->pagination->initialize($config);

        $idfranchisee = $_SESSION['drugsafe_user']['id'];


        $totalOrdersAray = $this->Order_Model->getOrdersList($config['per_page'], $this->uri->segment(3), $searchAry);
        $totalOrdersSearchAray = $this->Order_Model->getOrdersList();

        $count = $this->Admin_Model->getnotification();

        $data['totalOrdersSearchAray'] = $totalOrdersSearchAray;
        $data['totalOrdersAray'] = $totalOrdersAray;
        $data['szMetaTagTitle'] = " Order List";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Orders";
        $data['notification'] = $count;
        $data['data'] = $data;
        $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
        //$data['drugtestkitlist'] = $drugTestKitListAray;

        $this->load->view('layout/admin_header', $data);
        $this->load->view('order/cartOrderValuelist');
        $this->load->view('layout/admin_footer');
    }

    public function DeleteOrderAlert()
    {
        $data['mode'] = '__DELETE_ORDER_POPUP__';
        $data['idOrder'] = $this->input->post('idOrder');
        $this->load->view('admin/admin_ajax_functions', $data);
    }

    public function OrderDeleteConfirmation()
    {
        $data['mode'] = '__DELETE_ORDER_CONFIRM__';
        $data['idOrder'] = $this->input->post('idOrder');
        $this->Order_Model->deleteOrder($data['idOrder']);
        $this->load->view('admin/admin_ajax_functions', $data);
    }

    public function updateCartData()
    {

        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $count = $_POST['count'];

        for ($i = 1; $i <= $count; $i++) {
            $quantity = $_POST['order_quantity' . $i];
            $orderId = $_POST['order_id' . $i];
            $orderUpdate = $this->Order_Model->updateOrder($quantity, $orderId);
        }
        if ($orderUpdate) {
            $szMessage['type'] = "success";
            $szMessage['content'] = "<strong><h3>Your Cart has been successfully updated.</h3></strong> ";
            $this->session->set_userdata('drugsafe_user_message', $szMessage);
            ob_end_clean();
            redirect(base_url('/order/orderList'));
        }

    }

    function checkOutOrderData()
    {
        $idfranchisee = $this->input->post('idfranchisee');
        $this->session->set_userdata('idfranchisee', $idfranchisee);

        echo "SUCCESS||||";
        echo "checkOutOrder";

    }

    public function checkOutOrder()
    {

        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $this->session->unset_userdata('orderid');
        $franchiseeid = $this->session->userdata('idfranchisee');
        $totalOrdersAray = $this->Order_Model->getOrdersListByFranchisee($franchiseeid);

        $TotalPrice = 0;
        foreach ($totalOrdersAray as $totalOrdersData) {
            $productDataArr = $this->Inventory_Model->getProductDetailsById($totalOrdersData['productid']);
            $price = ($totalOrdersData['quantity']) * ($productDataArr['szProductCost']);
            $TotalPrice += $price;
        }
        if ($idorder = $this->Order_Model->InsertOrderSuccess($totalOrdersAray['0']['franchiseeid'], $TotalPrice)) {
            foreach ($totalOrdersAray as $totalOrdersData) {
                $queryInsert = $this->Order_Model->InsertOrderDetails($totalOrdersData, $idorder);
            }
            if ($queryInsert) {

                $szMessage['type'] = "success";
                $szMessage['content'] = "<strong><h3>Your Order has been successfully placed.</h3></strong> ";
                $this->session->set_userdata('drugsafe_user_message', $szMessage);
                ob_end_clean();
                $this->session->unset_userdata('idfranchisee');
                redirect(base_url('/order/ordersuccess'));
            }

        }

    }

    public function ordersuccess()
    {
        $count = $this->Admin_Model->getnotification();
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        $orderid = $this->session->userdata('orderid');
        $totalOrdersDetailsAray = $this->Order_Model->getOrderDetailsByOrderId($orderid);


        $data['totalOrdersDetailsAray'] = $totalOrdersDetailsAray;
        $data['orderid'] = $orderid;
        $data['szMetaTagTitle'] = "Order Details";
        $data['is_user_login'] = $is_user_login;
        $data['pageName'] = "Orders";
        $data['notification'] = $count;
        $data['data'] = $data;
        $data['arErrorMessages'] = $this->Admin_Model->arErrorMessages;
        //$data['drugtestkitlist'] = $drugTestKitListAray;

        $this->load->view('layout/admin_header', $data);
        $this->load->view('order/successOrder');
        $this->load->view('layout/admin_footer');

    }

    public function view_order_list()
    {
        $count = $this->Admin_Model->getnotification();
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }

        $searchAry = $_POST;

        $validOrdersDetailsAray = $this->Order_Model->getallValidOrderDetails($searchAry);
        $validOrdersDetailsSearchAray = $this->Order_Model->getallValidOrderDetails();
        $allFrDetailsSearchAray = $this->Order_Model->getallValidOrderFrId();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('szSearch4', 'Start Order date ', 'required');
        $this->form_validation->set_rules('szSearch5', 'End Order date', 'required');

        $this->form_validation->set_message('required', '{field} is required');
        if ($this->form_validation->run() == FALSE) {
            $data['validOrdersDetailsSearchAray'] = $validOrdersDetailsSearchAray;
            $data['allFrDetailsSearchAray'] = $allFrDetailsSearchAray;
            $data['szMetaTagTitle'] = "Order Details";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Orders";
            $data['notification'] = $count;
            $data['data'] = $data;
            $data['arErrorMessages'] = $this->Order_Model->arErrorMessages;
            //$data['drugtestkitlist'] = $drugTestKitListAray;

            $this->load->view('layout/admin_header', $data);
            $this->load->view('order/viewOrderDetails');
            $this->load->view('layout/admin_footer');

        } else {
            $data['validOrdersDetailsAray'] = $validOrdersDetailsAray;
            $data['validOrdersDetailsSearchAray'] = $validOrdersDetailsSearchAray;
            $data['allFrDetailsSearchAray'] = $allFrDetailsSearchAray;
            $data['szMetaTagTitle'] = "Order Details";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Orders";
            $data['notification'] = $count;
            $data['data'] = $data;
            $data['arErrorMessages'] = $this->Order_Model->arErrorMessages;
            //$data['drugtestkitlist'] = $drugTestKitListAray;

            $this->load->view('layout/admin_header', $data);
            $this->load->view('order/viewOrderDetails');
            $this->load->view('layout/admin_footer');


        }
    }

    public function viewOrderData()
    {
        $data['mode'] = '__VIEW_ORDER_DETAILS_POPUP__';
        $data['idOrder'] = $this->input->post('idOrder');
        $this->load->view('admin/admin_ajax_functions', $data);
    }

    public function editOrderData()
    {
        $data['mode'] = '__EDIT_ORDER_DETAILS_POPUP__';
        $data['idOrder'] = $this->input->post('idOrder');
        $this->load->view('admin/admin_ajax_functions', $data);
    }

    public function cancelOrderConfirmation()
    {
        $data['mode'] = '__CANCEL_ORDER_CONFIRM_DETAILS_POPUP__';
        $data['idOrder'] = $this->input->post('idOrder');
        $this->Order_Model->updateOrderByOrderId($data['idOrder'], 3);
        $this->load->view('admin/admin_ajax_functions', $data);
    }

    public function deliverOrderConfirmation()
    {
        $data['mode'] = '__DELIVER_ORDER_CONFIRM_DETAILS_POPUP__';
        $data['idOrder'] = $this->input->post('idOrder');
        $this->Order_Model->updateOrderByOrderId($data['idOrder'], 2);
        $this->load->view('admin/admin_ajax_functions', $data);
    }

    function view_order_details()
    {
        $idOrder = $this->input->post('idOrder');

        $this->session->set_userdata('idOrder', $idOrder);
        echo "SUCCESS||||";
        echo "pdforderdetails";
    }

    public function pdforderdetails()
    {
        ob_start();
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Drug-safe Order Details');
        $pdf->SetAuthor('Drug-safe');
        $pdf->SetSubject('Stock Request Report PDF');
        $pdf->SetMargins(PDF_MARGIN_LEFT - 10, PDF_MARGIN_TOP - 18, PDF_MARGIN_RIGHT - 10);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('times', '', 12);

        $pdf->AddPage();

        $idOrder = $this->session->userdata('idOrder');
        $OrdersDetailsAray = $this->Order_Model->getOrderByOrderId($idOrder);
        $franchiseeDetArr1 = $this->Admin_Model->getAdminDetailsByEmailOrId('', $OrdersDetailsAray['franchiseeid']);

        $splitTimeStamp = explode(" ", $OrdersDetailsAray['createdon']);
        $date1 = $splitTimeStamp[0];
        $time1 = $splitTimeStamp[1];

        $x = date("g:i a", strtotime($time1));

        $date = explode('-', $date1);


        $monthNum = $date['1'];

        $dateObj = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('M');
        if ($OrdersDetailsAray['status'] == 1) {

            $status = Ordered;
        }
        if ($OrdersDetailsAray['status'] == 2) {


            $status = Dispatched;
        }
        if ($OrdersDetailsAray['status'] == 3) {


            $status = Canceled;
        }

        if ($OrdersDetailsAray['status'] == 4) {

            $status = Pending;
        }


        $html = '<a style="text-align:center;  margin-bottom:15px;" href="' . __BASE_URL__ . '" ><img style="width:145px" src="' . __BASE_URL__ . '/images/logo.png" alt="logo" class="logo-default" /> </a>
<br />            
<div><label style="font-size:18px;color:red;margin-bottom:5px;"><b>Order Info
            </b></label></div>
            <div>
                <lable>Order# :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <lable>#0000' . $idOrder . '</lable>  
            </div>
            <div>
                <lable> Order Date & Time :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <lable>' . $date['2'] .' '. $monthName .' '. $date['0'] . ' at ' . $x . '</lable>  
            </div>
            <div>
                <lable>Order Status :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <lable class="label label-sm label-danger">' . $status . '</lable>  
            </div>
             <div>
                <lable>Franchisee :</lable>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <lable>' . $franchiseeDetArr1['szName'] . '</lable>  
            </div>
         
            <br />
            <div><label style="font-size:18px;color:red;margin-bottom:15px;"><b>Products Info   
            </b></label></div>
            <div>
         
            <div class= "table-responsive" >
                            <table border="1" cellpadding="5">
                                    <tr>
                                        <th style="width:250px"><b>Product Code</b> </th>
                                        <th style="width:100px"> <b>Product Cost</b> </th>
                                        <th style="width:80px"> <b>Quantity</b> </th>
                                        <th style="width:100px"><b>Total Price</b> </th>
                                        <th style="width:150px"> <b>Dispatched Quantity</b> </th>
                                    </tr>';
        $totalOrdersDetailsAray = $this->Order_Model->getOrderDetailsByOrderId($idOrder);
        if ($totalOrdersDetailsAray) {
            $i = 0;
            foreach ($totalOrdersDetailsAray as $totalOrdersDetailsData) {
                $productDataArr = $this->Inventory_Model->getProductDetailsById($totalOrdersDetailsData['productid']);

                $html .= '<tr>
                                            <td> ' . $productDataArr['szProductCode'] . ' </td>
                                            <td> $' . $productDataArr['szProductCost'] . '</td>
                                            <td> ' . $totalOrdersDetailsData['quantity'] . ' </td>
                                            <td> $' . number_format(($totalOrdersDetailsData['quantity']) * ($productDataArr['szProductCost']), 2, '.', ',') . ' </td>
                                             <td>' . $totalOrdersDetailsData['dispatched'] . ' </td>
                                
                                        </tr>';
            }
        }
        $i++;
        $html .= '
                            </table>
                        </div>
                      
                        ';

        $pdf->writeHTML($html, true, false, true, false, '');

        error_reporting(E_ALL);
        $this->session->unset_userdata('idOrder');

        ob_end_clean();
        $pdf->Output('view_order_details.pdf', 'I');
    }

    public function dispatchProductData()
    {
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }
        if ($_POST['pending'] == 1) {

            $count = $_POST['count'];
            $franchiseeId = $_POST['franchiseeId'];
            $total_price = 0;
            for ($i = 1; $i <= $count; $i++) {
                $quantity = $_POST['order_quantity' . $i];
                $total_price += $_POST['total_price' . $i];
                $orderId = $_POST['order_id' . $i];
                $productId = $_POST['product_id' . $i];
                $productDataArr = $this->Inventory_Model->getProductDetailsById($productId);
                $szAvailableQuantity = $productDataArr['szAvailableQuantity'];
                if ($szAvailableQuantity < $quantity) {
                    $szMessage['type'] = "error";
                    $szMessage['content'] = "<strong><h3>Dispatch Quantity must be less than available quantity.</h3></strong> ";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);
                    ob_end_clean();
                    redirect(base_url('/order/view_order_list'));
                } else {
                    $orderPending = $this->Order_Model->pendingOrder($quantity, $orderId, $productId, $szAvailableQuantity, $franchiseeId);
                }

            }

            $totalPrice = $_POST['total'];
            if ($this->Order_Model->orderPendingUpdate($_POST['order_id1'], $totalPrice)) {
                $szMessage['type'] = "success";
                $szMessage['content'] = "<strong><h3>Your Order has been in pending state.</h3></strong> ";
                $this->session->set_userdata('drugsafe_user_message', $szMessage);
                ob_end_clean();
                redirect(base_url('/order/view_order_list'));
            }

            $szMessage['type'] = "error";
            $szMessage['content'] = "<strong><h3>Dispatch Quantity field can't be empty.</h3></strong> ";
            $this->session->set_userdata('drugsafe_user_message', $szMessage);
            ob_end_clean();
            redirect(base_url('/order/view_order_list'));


        } else {

            $count = $_POST['count'];
            $franchiseeId = $_POST['franchiseeId'];
            $total_price = 0;
            $countOrderDispatch = 0;
            for ($i = 1; $i <= $count; $i++) {
                $quantity = $_POST['order_quantity' . $i];

                $total_price += $_POST['total_price' . $i];
                $orderId = $_POST['order_id' . $i];
                $productId = $_POST['product_id' . $i];
                $productDataArr = $this->Inventory_Model->getProductDetailsById($productId);
                $szAvailableQuantity = $productDataArr['szAvailableQuantity'];
                if ($szAvailableQuantity < $quantity) {
                    $szMessage['type'] = "error";
                    $szMessage['content'] = "<strong><h3>Dispatch Quantity must be less than available quantity.</h3></strong> ";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);
                    ob_end_clean();
                    redirect(base_url('/order/view_order_list'));
                } else {

                    if (!empty($quantity)) {

                        $orderDispatch = $this->Order_Model->dispatchOrder($quantity, $orderId, $productId, $szAvailableQuantity, $franchiseeId);
                        $countOrderDispatch = count($orderDispatch);
                    }
                }

            }
            if ($countOrderDispatch == $count) {
                $totalPrice = $_POST['total'];
                if ($this->Order_Model->orderFinalUpdate($_POST['order_id1'], $totalPrice)) {
                    $szMessage['type'] = "success";
                    $szMessage['content'] = "<strong><h3>Your Order has been successfully dispatched.</h3></strong> ";
                    $this->session->set_userdata('drugsafe_user_message', $szMessage);
                    ob_end_clean();
                    redirect(base_url('/order/view_order_list'));
                }
            } else {
                $szMessage['type'] = "error";
                $szMessage['content'] = "<strong><h3>Dispatch Quantity field can't be empty.</h3></strong> ";
                $this->session->set_userdata('drugsafe_user_message', $szMessage);
                ob_end_clean();
                redirect(base_url('/order/view_order_list'));
            }

        }
    }

    function dispatchsingleprod(){
        $ordid = $_POST['ordid'];
        $prodid = $_POST['prodid'];
        $qty = $_POST['qty'];
        $dispStat = $this->Order_Model->dispatchsingleprod($ordid,$prodid,$qty);
        if($dispStat){
            echo 'SUCCESS';
        }else{
            echo 'FAIL';
        }
    }

    function dispatchfinal(){
        $ordid = $_POST['ordid'];
        $price = $_POST['price'];
        $dispStat = $this->Order_Model->changesdispatchstatus($ordid,'2',$price);
        if($dispStat){
            $data['mode'] = '__PRODUCT_DISPATCHED_SUCCESSFULLY__';
            $this->load->view('admin/admin_ajax_functions', $data);
        }else{
            return false;
        }
    }
    function dispatchpending(){
        $ordid = $_POST['ordid'];
        $dispStat = $this->Order_Model->changesdispatchstatus($ordid,'4');
        if($dispStat){
            $data['mode'] = '__ORDER_STATUS_CHANGED__';
            $this->load->view('admin/admin_ajax_functions', $data);
        }else{
            return false;
        }
    }

    public function view_order_report()
    {
        $count = $this->Admin_Model->getnotification();
        $is_user_login = is_user_login($this);
        // redirect to dashboard if already logged in
        if (!$is_user_login) {
            ob_end_clean();
            redirect(base_url('/admin/admin_login'));
            die;
        }

        $searchAry = $_POST;

        $validOrdersDetailsAray = $this->Order_Model->getallValidOrderDetails($searchAry);
        $validOrdersDetailsSearchAray = $this->Order_Model->getallValidOrderDetails();
        $allFrDetailsSearchAray = $this->Order_Model->getallValidOrderFrId();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('szSearch4', 'Start Order date ', 'required');
        $this->form_validation->set_rules('szSearch5', 'End Order date', 'required');

        $this->form_validation->set_message('required', '{field} is required');
        if ($this->form_validation->run() == FALSE) {
            $data['validOrdersDetailsSearchAray'] = $validOrdersDetailsSearchAray;
            $data['allFrDetailsSearchAray'] = $allFrDetailsSearchAray;
            $data['szMetaTagTitle'] = "Order Details Report";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Reporting";
            $data['subpageName'] = "Orders_Report";
            $data['notification'] = $count;
            $data['data'] = $data;
            $data['arErrorMessages'] = $this->Order_Model->arErrorMessages;
            //$data['drugtestkitlist'] = $drugTestKitListAray;

            $this->load->view('layout/admin_header', $data);
            $this->load->view('order/viewOrderDetailsReport');
            $this->load->view('layout/admin_footer');

        } else {
            $data['validOrdersDetailsAray'] = $validOrdersDetailsAray;
            $data['validOrdersDetailsSearchAray'] = $validOrdersDetailsSearchAray;
            $data['allFrDetailsSearchAray'] = $allFrDetailsSearchAray;
            $data['szMetaTagTitle'] = "Order Details Report";
            $data['is_user_login'] = $is_user_login;
            $data['pageName'] = "Reporting";
            $data['subpageName'] = "Orders_Report";
            $data['notification'] = $count;
            $data['data'] = $data;
            $data['arErrorMessages'] = $this->Order_Model->arErrorMessages;
            //$data['drugtestkitlist'] = $drugTestKitListAray;

            $this->load->view('layout/admin_header', $data);
            $this->load->view('order/viewOrderDetailsReport');
            $this->load->view('layout/admin_footer');


        }
    }
    
    
	
	
    
}
?>