<?php
class Logger_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "logger";
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
	
	public function addLogger($action, $module, $log=""){
		$check     = $this->validateParams($action, $module); 
		if($check === 1) { 
			
			$data = array(
				'u_id' 		 => $this->user->get_memberid(),
				'action' 	=> $action,
				'module' => $module,
				'log'		  => !empty($log) ? $log : "",
				'created'	=> localDate(), 
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
	
	public function deleteQuestion(){
		$this->delete($this->param['id']);
		$this->_result['status']     = 'success'; 
		
		return $this->_result;
	}
	
	public function checkFormAuth($t_id){
		$auth = 0 ;
		if(!empty($t_id)){
			$filter = "(".$this->primary_key."='".$t_id."' AND viewable LIKE '%".$this->user->get_memberrole()."%') ";
			$res = $this->get_data($filter);
			if(!empty($res)){
				$auth = 1;
			}else{
				$auth = 118;
			}
		}else{
			$auth = 116;	
		}
		
		return $auth;
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
				$search .= "(action like '%".$srh."%' OR module like'%".$srh."%'  OR log like '%".$srh."%')  ";			
			}
		}
		
		$return   = convert_sort($this->sorted,$sortby,$this->primary_key);
		$new_sort = change_sort($return['sort']);	
	 	 $offset   = pageToOffset($this->config->item('per_page'),$page); 
	 
		// Load Data
		$data['results'] = $this->get_data($search,$this->config->item('per_page'),$offset,$return['order'],$return['sorts']); 
		 	  
		$data['count']   = $this->total_count($search);
		$data['new_sort'] = $new_sort;
		
		// Pagination		
		$config['base_url'] = $this->config->item('admin_url').'/'.$this->name.'/index/';	
		$config['total_rows'] = $data['count'];
		$config['per_page'] = $this->config->item('per_page');
		$config['num_links'] = 10;
		$this->pagination->initialize($config);		
		
		return $data;
	}
	
	/** To validate if param is correct format  **/
	private function validateParams($action, $module){ 
		if(empty($action)){
			return 122;
		}
		
		if(empty($module)){
			return 123;
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
