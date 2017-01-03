
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordering_Model extends Error_Model {
   
    function insertCalulatedData($data)
        {	
           $travel = $data['travelHr']*$data['travelBasePrice'];
           $mobileScreen = $data['mobileScreenBasePrice']*$data['mobileScreenHr'];
            
            $dataAry = array(
                                'urineNata' => $data['urineNata'],
                                'nataLabCnfrm' => $data['nataLabCnfrm'],
                                'oralFluidNata'=>$data['oralFluidNata'],
                                'SyntheticCannabinoids' => $data['SyntheticCannabinoids'],
                                'labScrenning' => $data['labScrenning'],
				'RtwScrenning' => $data['RtwScrenning'],
                                'mobileScreen' => $mobileScreen,
                                'travel ' => $travel,
                                'travelType' => $data['travelType']
          
                            );
	$query=    $this->db->insert(__DBC_SCHEMATA_MANUAL_CAL__, $dataAry);
//            $sql = $this->db->last_query($query);
//print_r($sql);die;
            if($this->db->affected_rows() > 0)
            {
//	         $orderingid= (int)$this->db->insert_id();
//                 $this->db->select('*');
//                 $this->db->from(__DBC_SCHEMATA_MANUAL_CAL__)
//                 ->where('id', $orderingid);
//                 $query = $this->db->get();
//                 if ($query->num_rows() > 0) {
//                 $row = $query->result_array();
//                 return $row[0];
//                } else {
//                  return array();
//               }
//           
                return true;
          }
          else
            {
                return false;
            }
        }
     public function getAllChClientDetails($limit = __PAGINATION_RECORD_LIMIT__,$offset = 0,$id=0)
        { 
            
            $whereAry = array('franchiseeId=' => $id,'clientType!='=>'0'); 
           
             $this->db->select('clientId,clientType');
            $this->db->from(__DBC_SCHEMATA_CLIENT__);
            
               $this->db->where($whereAry); 
        
           $this->db->order_by("franchiseeId","asc");
           $this->db->limit($limit, $offset);
           $query = $this->db->get();
                
       
        
       
            if($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                    return array();
            }
        } 
}
?>