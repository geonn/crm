<?php
class Customer_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "customer";
		$this->primary_key = 'id';	
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function getList(){
		$filter = array(
		
		);
		$res = $this->get_data($filter);
		
		$this->_result['status']     = 'success'; 
		$this->_result['data']       = $res;		
		
		return $this->_result;
	}
	
	 
	public function addCustomer(){
		if($this->param['isCustomerForm'] != "1"){
			$this->_result['status']     = 'error'; 
			$this->_result['error_code'] = 121;	
			$this->_result['data'] = $this->code[121];	
			return $this->_result;
		}
		
		$check     = $this->validateParams(); 
		if($check === 1) { 
			
			$data = array(
				'name' 					 => $this->param['name'],
				'ic' 					 	  => $this->param['ic'],
				'contact_home'   => $this->param['contact_home'],
				'contact_mobile' => $this->param['contact_mobile'],
				'contact_office' 	=> $this->param['contact_office'],
				'age' 						=> $this->param['age'],
				'email' 				  => $this->param['email'],
				'mail_address' 	   => $this->param['mail_address'],
				'home_address'	=> $this->param['home_address'],
				'created'				=> localDate(),
				'updated'			  => localDate(),
			);
			$id = $this->insert($data);
			
			$this->_result['status']     = 'success'; 
			$this->_result['data']       = $id;
		}else{
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = $check;	
			$this->_result['data'] = $this->code[$check];	
		}
		
		return $this->_result;
	}
	
	public function editCustomer(){
		$check     = $this->validateParams(); 
		
		if($check === 1) { 
			
			$data = array(
				'name' 					 => $this->param['name'],
				'contact_home'   => $this->param['contact_home'],
				'contact_mobile' => $this->param['contact_mobile'],
				'contact_office' 	=> $this->param['contact_office'],
				'age' 						=> $this->param['age'],
				'email' 				  => $this->param['email'],
				'mail_address' 	   => $this->param['mail_address'],
				'home_address'	=> $this->param['home_address'],
				'updated'	=> localDate(),
			);
			$id = $this->update($this->param['id'], $data);
			
			$this->_result['status']     = 'success'; 
			$this->_result['data']       = $id;
		}else{
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = $check;	
			$this->_result['data'] = $this->code[$check];	
		}
		$this->_result['status']     = 'success'; 
		
		return $this->_result;
	}
	 
	
	/*********************************************
	******************* ADMIN ********************
	*********************************************/
	public function admin_getList($sortby,$page=""){
	
		// Search Param
		$search = '';						
		if ($this->input->get('q')) {				
			$srhs = explode(' ',$this->input->get('q'));
			foreach($srhs as $srh){
				$search .= (!empty($search) ? " and ": "");		
				$search .= "(name like '%".$srh."%' OR contact_mobile like'%".$srh."%'  OR ".$this->primary_key."='".$srh."')  ";			
			}
		}
			 
	 	if ($this->input->get('status')) {
			$search .= (!empty($search) ? " and ": "");					
			$search .= "status = '".$this->input->get('status')."' ";
		}
	
		$return   = convert_sort($this->sorted,$sortby,$this->primary_key);
		$new_sort = change_sort($return['sort']);	
	 	 $offset   = pageToOffset($this->config->item('per_page'),$page);
	  
		// Load Data
		$data['results'] = $this->get_data($search,$this->config->item('per_page'),$offset,$return['order'],$return['sorts']); 
		
		foreach($data['results'] as $k => $val){
	 
		} 		  
		$data['count']   = $this->total_count($search);
		$data['new_sort'] = $new_sort;
		
		// Pagination		
		$config['base_url'] = $this->config->item('admin_url').'/'.$this->name.'/index/';	
		$config['total_rows'] = $data['count'];
		$this->pagination->initialize($config);		
		
		return $data;
	}
	
	/** To validate if param is correct format  **/
	private function validateParams(){
		$name     	= $this->param['name']; 
		
		if(!$name){
			return 120;
		}
		 
		return 1;
	}
	
	private function validateForm($t_id){
		if(empty($t_id)){
			return 116;
		}
		
		return $this->checkFormAuth($t_id);
		 
	}
	
}
?>
