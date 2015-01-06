<?php
class Case_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "case";
		$this->primary_key = 'id';	
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	 
	
	public function retrieveCase($case_id=""){
		$check = $this->validateCase($case_id);
		if($check === 1) { 
			
			$res = $this->find_by($case_id);
			
			if(!empty($res)){ 
				$questionList = $this->case_details_model->getCaseList($case_id);
			 
				//$questions = $this->question_model->getQuestionById($val['id']);
				
				//$res[$k]['questions'][] = $questions ;
			}
			 
			$this->_result['status']     = 'success'; 
			$this->_result['data']       = $res;
		}else{
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = $check;	
			$this->_result['data'] = $this->code[$check];	
		}
		
		return $this->_result;
	}
	
	public function addCase($module,$key, $name, $updates=array()){
		$roles = $this->user->get_memberrole();
		$status = "1";
		if(in_array($roles, $this->config->item('updates_access'))){
			$status = "2";
		}
		
		$data = array(
			'name' => $name,
			'module' => $module,
			'remark' => !empty($this->param['remark']) ? $this->param['remark'] : "", 
			'status' 		=> $status,  
			'created'	=> localDate(),
			'updated'	=> localDate(),
		);
		$id = $this->insert($data); 
		if(!empty($id)){ 
			$this->case_details_model->addCaseItems($id, $key, $updates);
		}
		
		$this->logger_model->addLogger('add', 'case', $name);
		$this->_result['status']     = 'success'; 
		$this->_result['data']       = $id;
		 
		
		return $this->_result;
	}
	
	public function updateStatus(){
		$data = array( 
			'status' 		=> 2,  
			'updated'	=> localDate(),
		);
		
		$this->update($this->param['case_id'], $data);
	}
	
	public function editTemplate(){
		$check     = $this->validateCase(); 
		
		if($check === 1) { 
		 
			$data = array(
				'name' => $this->param['name'],
				'module' => $this->param['module'],
				'remark' => $this->param['remark'], 
				'status' 		=> $this->param['status'],  
				'updated'	=> localDate(),
			);
		 
			$id = $this->update($this->param['id'], $data);
		//	$this->logger_model->addLogger('edit', $this->name, $this->param['name']);
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
	
	public function deleteCase(){
		$res = $this->find_by($this->param['id']);
		$this->delete($this->param['id']);
		$this->logger_model->addLogger('delete', $this->name, $res['name']);
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
				$search .= "(name like '%".$srh."%' OR remark like'%".$srh."%'  OR ".$this->primary_key."='".$srh."')  ";			
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
			return 113;
		}
		 
		return 1;
	}
	
	private function validateCase($case_id){
		if(empty($case_id)){
			return 124;
		}
		
		return 1;
		 
	}
	
}
?>
