<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_Model extends Error_Model {
    
   public function viewCategoriesList($limit = __PAGINATION_RECORD_LIMIT__,$offset = 0,$searchAry ='')
        {
            $searchAry = trim($searchAry);
           
                    
            if(!empty($searchAry)){
                       
                        $this->db->where('isDeleted','0');
                 $this->db->where("(szName LIKE '%$searchAry%')");
                   
                }
                else{
                 $whereAry = array('isDeleted=' => '0');
                 $this->db->where($whereAry); 
                }  
            
            $this->db->select('id,szName,szDiscription');
        
            $this->db->limit($limit, $offset);
            $query = $this->db->get(__DBC_SCHEMATA_FORUM_CATEGORY__);
     
            if($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                    return array();
            }
        }   
         public function getCategoryDetailsById($idCategory)
    {

        $this->db->select('id,szName,szDiscription');
        $whereAry = array('id' => $idCategory);
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_FORUM_CATEGORY__);

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row[0];
        } else {
            return array();
        }
    }
        
        function insertCategory()
        {		
            $date = date('Y-m-d');
            $dataAry = array(
                                'szName' => $_POST['forumData']['szCategoryName'],
                                'szDiscription' => $_POST['forumData']['szCategoryDiscription'],
				'dtCreatedOn' => $date,
                            );
	    $this->db->insert(__DBC_SCHEMATA_FORUM_CATEGORY__, $dataAry);
            
            if($this->db->affected_rows() > 0)
            {
	        return true;
            }
            else
            {
                return false;
             }
        } function insertForumData($data)
        {		
           
            $dataAry = array(
                                'szForumTitle' => $data['szForumTitle'],
                                'szForumDiscription' => $data['szForumDiscription'],
				'szForumLongDiscription' => $data['szForumLongDiscription'],
                                'szforumImage' => $data['szforumImage'],
                            );
	    $this->db->insert(__DBC_SCHEMATA_FORUM_DATA__, $dataAry);
            
            if($this->db->affected_rows() > 0)
            {
	        return true;
            }
            else
            {
                return false;
             }
        }
        
    public function getForumDetailsById($id)
    {

        $this->db->select('*');
        $whereAry = array('id' => $id);
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_FORUM_DATA__);

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row[0];
        } else {
            return array();
        }
    }
         public function viewForumDataList($limit = __PAGINATION_RECORD_LIMIT__,$offset = 0,$searchAry ='')
        {
            $searchAry = trim($searchAry);
           
              
            if(!empty($searchAry)){
                       
                 $this->db->where('szTitle=',$searchAry);
                 
                   
                }
                
            
            $this->db->select('*');
        
            $this->db->limit($limit, $offset);
            $query = $this->db->get(__DBC_SCHEMATA_FORUM_DATA__);
     
            if($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                    return array();
            }
        }   
        
         public function deleteCategory($idCategory)
	{
		$dataAry = array(
			'isDeleted' => '1'
                );  
                $this->db->where('id', $idCategory);
		if($query = $this->db->update(__DBC_SCHEMATA_FORUM_CATEGORY__, $dataAry))
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
        
      
    public function UpdateCategory($id)
        {
            $date = date('Y-m-d');
            $dataAry = array(                                  
                                'szName' => $_POST['forumData']['szName'],
                                'szDiscription' => $_POST['forumData']['szDiscription'],
                                'dtUpdatedOn'=>$date
                              
                            );
                $this->db->where('id',(int)$id);
                $queyUpdate=$this->db->update(__DBC_SCHEMATA_FORUM_CATEGORY__, $dataAry);
                if($queyUpdate)
                { 
                    return true;
                }
                else
                {
                    return false;
                }
            } 
             public function UpdateForum($data,$id)
        {
         
            $dataAry = array(                                  
                                 'szForumTitle' => $data['szForumTitle'],
                                'szForumDiscription' => $data['szForumDiscription'],
				'szForumLongDiscription' => $data['szForumLongDiscription'],
                                'szforumImage' => $data['szforumImage'],
                              
                            );
                $this->db->where('id',(int)$id);
                $queyUpdate=$this->db->update(__DBC_SCHEMATA_FORUM_DATA__, $dataAry);
                if($queyUpdate)
                { 
                    return true;
                }
                else
                {
                    return false;
                }
            }
}
?>
