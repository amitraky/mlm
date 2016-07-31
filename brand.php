<?php
interface ledgers
{

}

class brand  extends CI_Controller implements ledgers
{

	public function levels()
	{
		 $store = '';
		echo "<pre>";
		 $data = $this->db->query("SELECT `or_m_reg_id` FROM `m06_user_detail` WHERE `or_m_intr_id` = 1")->result_array();
		 if (!empty($data))
		 {
			 foreach($data as $value){
				   $store[] = $value['or_m_reg_id']; 
			 }
		  $this->level_2($store);
		 }
		 else
		 {
			return $store;
		 
		 }
	}
	
	public function level_2($data)
	{
	   if (!empty($data))
	   { $i=0;
	       foreach($data as $value)
		   { 
			 $store[$value] = $this->chech_user_id($value);
			 arsort($store);
		   }
		  
		   if (!empty($store))
		   {   $color = array(1=>'green',2=>'red',3=>'voilet');
			   foreach($store as $key=>$value)
			   {
				 $i++;
				 echo $i;
				 
			     $ff[$key] = array($color[$i]=>$this->level_3($key));
				if($i == 3)break;
			   }
			   print_r($ff);;
		   }
		   else
		   {
		    return $store;
		   }
	   }
	   else
	   {
	     return $data;
	   }
	
	}
	
	public function level_3($user_id)
	{
	  if (!empty($user_id))
	  {
	      $data = $this->db->query("SELECT `or_m_reg_id` FROM `m06_user_detail` WHERE `or_m_intr_id`  = $user_id  limit 0 ,3")->result_array();
		   if(!empty($data)){
		      foreach($data as $v){
			   $datas[$v['or_m_reg_id']] = $v['or_m_reg_id'];
			  
			  }
			   return $datas;
		   }
	  }
	  else
	   {
	     return 0;
	   
	   }
	  
	  
	}
	
	
	
	public function chech_user_id($user_id)
	{
	 // $this->db->free_db_resource();
	  return $this->db->query("SELECT get_member_count($user_id,2) as num")->row()->num;
	
	}
	
	public function get_id()
	{
		
	 $data[1] = $this->get_use_id(1);
	 
	}
	
	

	


}