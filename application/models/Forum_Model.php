<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_Model extends Error_Model {
    
   public function viewCategoriesList($limit = __PAGINATION_RECORD_LIMIT__,$offset = 0,$searchAry ='')
        {
            $searchAry = trim($searchAry);
           
                    
            if(!empty($searchAry)){
                       
                
                 $this->db->where("(szName LIKE '%$searchAry%')");
                   
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
        
        
        public function viewCategoriesListByCatId($idCategory)
        {
           
               $whereAry = array('id='=> $idCategory);
            
                 $this->db->where($whereAry); 
           
            $this->db->select('szName');
        
            $this->db->limit($limit, $offset);
            $query = $this->db->get(__DBC_SCHEMATA_FORUM_CATEGORY__);
//      $sql = $this->db->last_query($query);
//    print_r($sql);die;
            if($query->num_rows() > 0)
            {
                $row = $query->result_array();
                return $row['0'];
            }
            else
            {
                    return array();
            }
        }   
          public function viewCmntListByCmntId($idCmnt)
        {
           
               $whereAry = array('id='=> $idCmnt);
            
                 $this->db->where($whereAry); 
           
            $this->db->select('szCmnt,idTopic');
        
           
            $query = $this->db->get(__DBC_SCHEMATA_FORUM_COMMENTS__);
//      $sql = $this->db->last_query($query);
//    print_r($sql);die;
            if($query->num_rows() > 0)
            {
                $row = $query->result_array();
                return $row['0'];
            }
            else
            {
                    return array();
            }
        }   
         public function viewTopicListByTopicId($idTopic)
        {
           
               $whereAry = array('id='=> $idTopic);
            
                 $this->db->where($whereAry); 
           
            $this->db->select('szTopicTitle');
        
           
            $query = $this->db->get(__DBC_SCHEMATA_FORUM_TOPIC__);
//      $sql = $this->db->last_query($query);
//    print_r($sql);die;
            if($query->num_rows() > 0)
            {
                $row = $query->result_array();
                return $row['0'];
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
                                 'idCategory' => $data['idCategory'],
                                'szForumDiscription' => $data['szForumDiscription'],
				'szForumLongDiscription' => $data['szForumLongDiscription'],
                                'szforumImage' => $data['szforumImage'],
                                 'isDeleted' => '0',
                
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
        
    public function getForumDetailsByForumId($idForum,$limit = __PAGINATION_RECORD_LIMIT__,$offset = 0,$searchAry ='')
    {
       $searchAry = trim($searchAry);
       if(!empty($searchAry)){
       $whereAry = array('szForumTitle' => $searchAry,'isDeleted'=>'0','id' => $idForum);
       $this->db->where($whereAry);      
         }
        else{
        $whereAry = array('id' => $idForum);
        $this->db->where($whereAry);
        }
         
        $this->db->select('*');
       
        $this->db->where($whereAry);
        $query = $this->db->get(__DBC_SCHEMATA_FORUM_DATA__);
//      $sql = $this->db->last_query();
//      print_r($sql);die;
        if ($query->num_rows() > 0) {
          return  $query->result_array();
             
        } else {
            return array();
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
         public function viewForumDataList($limit = __PAGINATION_RECORD_LIMIT__,$offset = 0,$searchAry ='',$idCategory='0')
        {
            $searchAry = trim($searchAry);
          
            if(!empty($searchAry)){
                   $whereAry = array('szForumTitle' => $searchAry,'idCategory' => $idCategory);
        $this->db->where($whereAry);      
               
                 
                   
                }
                else{
                    $whereAry = array('idCategory' => $idCategory);
        $this->db->where($whereAry);
                     
                }
                
            
            $this->db->select('*');
        
            $this->db->limit($limit, $offset);
            $query = $this->db->get(__DBC_SCHEMATA_FORUM_DATA__);
//      $sql = $this->db->last_query();
//      print_r($sql);die;
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
         public function deleteForum($id)
	{
		$dataAry = array(
			'isDeleted' => '1'
                );  
                $this->db->where('id', $id);
		if($query = $this->db->update(__DBC_SCHEMATA_FORUM_DATA__, $dataAry))
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
                                'isDeleted' => '0',
                 'idCategory' => $data['idCategory'],
                              
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
              
        function insertTopic($data,$idForum)
        {
            $date = date('Y-m-d');
            $dataAry = array(
                                'szTopicTitle' =>$data['szTopicTitle'],
                                'szTopicDescreption' =>$data['szTopicDiscription'],
				'dtCreatedOn' => $date,
                                'idUser'  => $_SESSION['drugsafe_user']['id'],
                                'idForum'  => $idForum,
                                'isClosed'  => '0', 
                            );
	    $this->db->insert(__DBC_SCHEMATA_FORUM_TOPIC__, $dataAry);
            
            if($this->db->affected_rows() > 0)
            {
	        return true;
            }
            else
            {
                return false;
             }
        } 
   public function viewTopicList($idForum,$idTopic='',$flag='0')
        {
           
            if($flag==1){
              $whereAry = array('idForum='=> $idForum,'id='=> $idTopic);   
            }
            else{
               $whereAry = array('idForum='=> $idForum);  
            }
            $this->db->where($whereAry); 
            $this->db->select('id,szTopicTitle,szTopicDescreption,idForum,idUser,dtCreatedOn,isClosed');
            $query = $this->db->get(__DBC_SCHEMATA_FORUM_TOPIC__);
//sss
            if($query->num_rows() > 0)
            {
                return $query->result_array();
               
            }
            else
            {
                    return array();
            }
        }   
   function insertComents($idTopic)
        {
        $date = date('Y-m-d H:i:s');
       $dataAry = array(
                                'szCmnt' => $_POST['replyData']['szForumLongDiscription'],
                                'idTopic' => $idTopic,
				'cmntDate' => $date,
                                'idCmnters' => $_SESSION['drugsafe_user']['id'],
                                'isApproved' => '0',
                
                            );
	    $this->db->insert(__DBC_SCHEMATA_FORUM_COMMENTS__, $dataAry);
            
            if($this->db->affected_rows() > 0)
            {
	        return true;
            }
            else
            {
                return false;
             }
        }   
         public function getAllCommentsByTopicId($idTopic)
        {
               $whereAry = array('idTopic='=> $idTopic);  
           
            $this->db->where($whereAry); 
            $this->db->select('id,idCmnters,szCmnt,cmntDate');
            $query = $this->db->get(__DBC_SCHEMATA_FORUM_COMMENTS__);

            if($query->num_rows() > 0)
            {
                return $query->result_array();
               
            }
            else
            {
                    return array();
            }
        }
            function insertReply($idCmnt,$Reply)
        {		
            $date = date('Y-m-d H:i:s');
            $dataAry = array(
                                'idCmnt' => $idCmnt,
                                'szReply' => $Reply,
                                'isApproved' => '0',
				'dtReplyOn' => $date,
                                'idReplier' =>$_SESSION['drugsafe_user']['id'],
                                'isAdminApproved' =>'0',
                            );
	    $this->db->insert(__DBC_SCHEMATA_FORUM_REPLY__, $dataAry);
            
            if($this->db->affected_rows() > 0)
            {
	        return true;
            }
            else
            {
                return false;
             }
            }   
             public function getAllReplyByCmntsId($idCmnt,$flag='0')
        {
                 if($flag==1){
                   $whereAry = array('idCmnt='=> $idCmnt);
                       
                 }else{
                      $whereAry = array('idCmnt='=> $idCmnt,'isAdminApproved='=> '1');
                      
                 }
               
           
            $this->db->where($whereAry); 
            $this->db->select('id,idCmnt,szReply,isApproved,dtReplyOn,idReplier');
            $query = $this->db->get(__DBC_SCHEMATA_FORUM_REPLY__);

            if($query->num_rows() > 0)
            {
                return $query->result_array();
               
            }
            else
            {
                    return array();
            }
        }
          public function deleteReply($idReply)
	{
		 
                $this->db->where('id', $idReply);
		if($query = $this->db->delete(__DBC_SCHEMATA_FORUM_REPLY__))
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
         public function deleteCmnt($idCmnt)
	{
          $replyDataArr = $this->Forum_Model->getAllReplyByCmntsId($idCmnt,1); 
         
        if (!empty($replyDataArr)) {
            foreach ($replyDataArr as $replyDatalist) {
                $this->deleteReply($replyDatalist['id']);
            }

        }
		 
                $this->db->where('id', $idCmnt);
		if($query = $this->db->delete(__DBC_SCHEMATA_FORUM_COMMENTS__))
                {
                    return true;
                }
                else
                {
                    return false;
                }	
	}
        public function getAllReply()
        {
               $whereAry = array('isApproved='=> '0');  
           
            $this->db->where($whereAry); 
            $this->db->select('id,idCmnt,szReply,isApproved,dtReplyOn,idReplier');
            $query = $this->db->get(__DBC_SCHEMATA_FORUM_REPLY__);

            if($query->num_rows() > 0)
            {
                return $query->result_array();
               
            }
            else
            {
                    return array();
            }
        }
        public function updateReplyApproval($idReply)
    {

        $dataAry = array(
            'isAdminApproved' => '1',
            'isApproved' => '1'
        );

        $whereAry = array('id ' => (int)$idReply);

        $this->db->where($whereAry);

        $this->db->update(__DBC_SCHEMATA_FORUM_REPLY__, $dataAry);


        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
    
    
      public function updateReplyUnapproval($idReply)
    {

        $dataAry = array(
            'isAdminApproved' => '0',
            'isApproved' => '1'
        );

        $whereAry = array('id ' => (int)$idReply);

        $this->db->where($whereAry);

        $this->db->update(__DBC_SCHEMATA_FORUM_REPLY__, $dataAry);


        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
     public function closeTopic($idTopic)
    {
        $dataAry = array(
            'isClosed' => '1'
        );

        $whereAry = array('id ' => (int)$idTopic);

        $this->db->where($whereAry);

        $this->db->update(__DBC_SCHEMATA_FORUM_TOPIC__, $dataAry);


        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
}
?>