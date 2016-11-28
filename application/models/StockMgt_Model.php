<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockMgt_Model extends Error_Model
{
    var $id;
    var $szName;
    var $szEmail;
    var $szPassword;
    var $data = array();


    function insertModelStockValue($idfranchisee, $data, $idProduct)
    {

        $dataAry = array(

            'iFranchiseeId' => $idfranchisee,
            'iProductId' => $idProduct,
            'szModelStockVal' => $data['szModelStockVal']

        );


        $this->db->insert(__DBC_SCHEMATA_MODEL_STOCK_VALUE__, $dataAry);

        if ($this->db->affected_rows() > 0) {

            return true;
        } else {
            return false;
        }

    }

    public function viewDrugTestKitList()
    {

        $whereAry = array('isDeleted=' => '0', 'szProductCategory' => '1');

        $this->db->select('*');
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_PRODUCT__);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function viewMarketingMaterialList()
    {

        $whereAry = array('isDeleted=' => '0', 'szProductCategory' => '2');

        $this->db->select('*');
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_PRODUCT__);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getStockValueDetailsById($idfranchisee, $id = 0)
    {
        $this->db->select('*');
        $whereAry = array('iProductId' => $id, 'iFranchiseeId' => $idfranchisee);
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_MODEL_STOCK_VALUE__);

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row[0];
        } else {
            return array();
        }
    }

    public function getProductsDetailsById($idproduct)
    {

        $this->db->select('*');
        $whereAry = array('id' => $idproduct);
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_PRODUCT__);

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row[0];
        } else {
            return array();
        }
    }

    public function getCategoryDetailsById($idCategory)
    {

        $this->db->select('szName');
        $whereAry = array('id' => $idCategory);
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_PRODUCT_CATEGORY__);

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row[0];
        } else {
            return array();
        }
    }

    public function updateModelStockVal($data_validate, $idProduct, $idfranchisee)
    {
        $szModelStockVal = $data_validate['szModelStockVal'];


        $dataAry = array(

            'szModelStockVal' => $szModelStockVal
        );
        $whereAry = array('iProductId' => (int)$idProduct, 'iFranchiseeId' => (int)$idfranchisee);

        $this->db->where($whereAry);

        $queryUpdate = $this->db->update(__DBC_SCHEMATA_MODEL_STOCK_VALUE__, $dataAry);

        if (!empty($queryUpdate)) {
            return true;
        } else {
            return false;
        }

    }

    public function getProductQtyDetailsById($idfranchisee, $id = 0)
    {
        $this->db->select('*');

        $whereAry = array('iProductId' => $id, 'iFranchiseeId' => $idfranchisee);

        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_PRODUCT_STOCK_QUANTITY__);

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row[0];
        } else {
            return array();
        }
    }

    function insertProductStockQuantity($idfranchisee, $data, $idProduct)
    {

        $dataAry = array(

            'iFranchiseeId' => $idfranchisee,
            'iProductId' => $idProduct,
            'szQuantity' => $data['szQuantity']

        );


        $this->db->insert(__DBC_SCHEMATA_PRODUCT_STOCK_QUANTITY__, $dataAry);

        if ($this->db->affected_rows() > 0) {

            return true;
        } else {
            return false;
        }

    }

    public function updateProductStockQty($data_validate, $idfranchisee, $idProduct, $flag)
    {

        $this->data['dtAssignedOn'] = date('Y-m-d H:i:s');
        if ($flag == 1) {
            $szQuantity = trim($data_validate['szQuantity'] - $data_validate['szAdjustQuantity']);
        } else {
            $szQuantity = trim($data_validate['szQuantity'] + $data_validate['szAddMoreQuantity']);
        }
        $dataAry = array(

            'szQuantity' => $szQuantity
        );
        $whereAry = array('iFranchiseeId' => (int)$idfranchisee, 'iProductId' => (int)$idProduct);

        $this->db->where($whereAry);

        $queryUpdate = $this->db->update(__DBC_SCHEMATA_PRODUCT_STOCK_QUANTITY__, $dataAry);

        if (!empty($queryUpdate)) {
            /* if($flag==3)
             {*/

            $dataAry = array(
                'isProcessed' => '1'
            );
            $whereAry = array('iFranchiseeId' => (int)$idfranchisee, 'iProductId' => (int)$idProduct);
            $this->db->where($whereAry);
            $ProcessUpdate = $this->db->update(__DBC_SCHEMATA_REQUEST_QUANTITY__, $dataAry);
            $QtyReqArr = $this->getQtyReqById($idProduct, $idfranchisee);
            $i = 0;
            $reqId = $QtyReqArr[$i]['id'];
            if ($flag == 1) {
                $szTotalAvailableQty = trim($data_validate['szQuantity'] - $data_validate['szAdjustQuantity']);
            } else {
                $szTotalAvailableQty = trim($data_validate['szQuantity'] + $data_validate['szAddMoreQuantity']);
            }


            if (!empty($ProcessUpdate)) {
                $QtyReqArr = $this->getQtyReqById($idProduct, $idfranchisee);

                $i = 0;
                $dataAry = array(

                    'iFranchiseeId' => ($QtyReqArr[$i]['iFranchiseeId'] ? $QtyReqArr[$i]['iFranchiseeId'] : $idfranchisee),
                    'iProductId' => ($QtyReqArr[$i]['iProductId'] ? $QtyReqArr[$i]['iProductId'] : $idProduct),
                    'szQuantityAssigned' => ($flag == 1 ? 0 : $data_validate['szAddMoreQuantity']),
                    'quantityDeducted' => ($flag == 1 ? $data_validate['szAdjustQuantity'] : 0),
                    'szTotalAvailableQty' => $szTotalAvailableQty,
                    'dtAssignedOn' => $this->data['dtAssignedOn'],
                    'iReqId' => (int)$QtyReqArr[$i]['id']
                );
//                $whereAry = array('iProductId' => (int)$idProduct);
//                $this->db->where($whereAry);
                $this->db->insert(__DBC_SCHEMATA_STOCK_REQ_TRACKING__, $dataAry);
                if ($this->db->affected_rows() > 0) {
                    $i = 0;
                    $QtyAssignArr = $this->getQtyAssignListById($idProduct, $idfranchisee, $reqId);

                    $total = 0;
                    if (!empty($QtyAssignArr)) {

                        foreach ($QtyAssignArr as $QtyAssigndata) {
                            $total += $QtyAssigndata['szQuantityAssigned'];
                        }
                    }

                    $i = 0;
                    if ($QtyReqArr[$i]['szQuantity'] > 0 && $total >= $QtyReqArr[$i]['szQuantity']) {
                        $dataAry = array(
                            'isCompleted' => '1'
                        );
                        $whereAry = array('iProductId' => (int)$idProduct, 'iFranchiseeId' => (int)$idfranchisee);
                        $this->db->where($whereAry);
                        $CompleteUpdate = $this->db->update(__DBC_SCHEMATA_REQUEST_QUANTITY__, $dataAry);
//               $sql = $this->db->last_query($CompleteUpdate);
//               print_r($sql);die;
                        if ($this->db->affected_rows() > 0) {
                            return true;

                        } else {
                            return false;
                        }
                    } else {
                        return true;
                    }
                } else {
                    return false;
                }

            } else {
                return false;
            }

            /*}
            else{
            return true;}*/
        } else {
            return false;
        }

    }

    public function getQtyReqById($idProduct, $idfranchisee)
    {
        if(!empty($idProduct) || !empty($idfranchisee)){
            $whereAry = array('iProductId=' => $idProduct, 'isCompleted=' => '0', 'iFranchiseeId' => (int)$idfranchisee,);
            $this->db->select('*');
            $this->db->where($whereAry);
            $query = $this->db->get(__DBC_SCHEMATA_REQUEST_QUANTITY__);


            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }
        }

    }

    public function getQtyAssignListById($idProduct, $idfranchisee, $reqId)
    {

        $whereAry = array('iFranchiseeId' => (int)$idfranchisee, 'iProductId' => (int)$idProduct, 'iReqId' => (int)$reqId);
        $this->db->select('*');
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_STOCK_REQ_TRACKING__);
//           $sql = $this->db->last_query($query);
//            print_r($sql);die;

        if ($query->num_rows() > 0) {
            return $query->result_array();
            return $row[0];
        } else {
            return array();
        }
    }

    function requestQuantity($idProduct, $data_validate, $idfranchisee)
    {
        $this->data['dtRequestedOn'] = date('Y-m-d H:i:s');
        $szQuantity = $data_validate['szQuantity'];

        $dataAry = array(

            'iFranchiseeId' => $idfranchisee,
            'iProductId' => $idProduct,
            'szQuantity' => $szQuantity,
            'isProcessed' => '0',
            'isCompleted' => '0',
            'dtRequestedOn' => $this->data['dtRequestedOn']

        );


        $this->db->insert(__DBC_SCHEMATA_REQUEST_QUANTITY__, $dataAry);
/*$qu = $this->db->last_query();
        print_r($qu);
        die;*/
        if ($this->db->affected_rows() > 0) {

            return true;
        } else {
            return false;
        }

    }

    public function getQtyRequestFrId($limit=0, $offset=0)
    {

            $whereAry = array('isCompleted=' => '0');
            $this->db->select('ds_user.id');
            $this->db->from(__DBC_SCHEMATA_REQUEST_QUANTITY__);
            $this->db->join('ds_user', 'tbl_stock_request.iFranchiseeId = ds_user.id');
            $this->db->where($whereAry);

            $subQuery = $this->db->_compile_select();

            $this->db->_reset_select();
            $this->db->select('id, szName, szEmail, szContactNumber, szCity');
            $this->db->from(__DBC_SCHEMATA_USERS__);
            $this->db->where("id IN (" . $subQuery . ")");
            $this->db->limit($limit, $offset);

            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }

    }

    public function getRequestQtyList($searchAry, $idfranchisee, $limit, $offset)
    {
        $searchAry = trim($searchAry);


        if (!empty($searchAry)) {
            $whereAry = array('isCompleted=' => '0', 'iFranchiseeId=' => $idfranchisee, 'szProductCode=' => $searchAry);
        } else {
            $whereAry = array('isCompleted=' => '0', 'iFranchiseeId=' => $idfranchisee);
        }

        $this->db->select('*');
        $this->db->from(__DBC_SCHEMATA_REQUEST_QUANTITY__);
        $this->db->join('tbl_product', 'tbl_stock_request.iProductId = tbl_product.id');
        $this->db->where($whereAry);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
//        function set_szQuantity($value,$flag=true)
//    {
//        $this->data['szQuantity'] = $this->validateInput($value, __VLD_CASE_WHOLE_NUM__, "szQuantity", "Quantity", false, false, $flag);
//    }
//        function validatereqData($data, $arExclude=array())
//    {
//      
//        if(!empty($data))
//        {
//           
//           
//            if(!in_array('szQuantity',$arExclude)) 
//            {
//                $this->set_szQuantity(sanitize_all_html_input(trim($data['szQuantity'])));
//            }
//          
//            
//            if($this->error == true)
//                    return false;
//            else
//                    return true;
//        }
//       
//         $this->addError("szQuantity", "Confirm password required.");
//    }
//        function set_szAddMoreQuantity($value,$flag=true)
//    {
//        $this->data['szAddMoreQuantity'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szAddMoreQuantity", "Add More Quantity", false, false, $flag);
//    }
//
//    function set_szReqQuantity($value,$flag=true)
//    {
//        $this->data['set_szReqQuantity'] = $this->validateInput($value, __VLD_CASE_ANYTHING__, "szReqQuantity", "Req Quantity", false, false, $flag);
//    }


    public function reqQtyFr_check($idfranchisee, $idProduct)
    {
if(!empty($idfranchisee) || !empty($idProduct)){
    $whereAry = array('isCompleted=' => '0', 'iFranchiseeId=' => $idfranchisee, 'iProductId=' => $idProduct);
    $this->db->select('*');
    $this->db->where($whereAry);
    $query = $this->db->get(__DBC_SCHEMATA_REQUEST_QUANTITY__);

    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return array();
    }
}


    }

}

?>
