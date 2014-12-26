<?php
class Template_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "template";
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
	
	public function retrieveForm($t_id=""){
		$check = $this->validateForm($t_id);
		if($check === 1) { 
			
			$res = $this->find_by($t_id);
			
			if(!empty($res)){ 
				$questionList = $this->template_details_model->getQuestionList($t_id);
				
				if(!empty($questionList)){
					foreach($questionList as $j => $q_id){
						$questions = $this->question_model->getQuestionById($q_id);
						$res['questions'][] = $questions;
					}
				}
				//$questions = $this->question_model->getQuestionById($val['id']);
				
				//$res[$k]['questions'][] = $questions ;
			}
			$this->logger_model->addLogger('view', $this->name, $res['name']);
			$this->_result['status']     = 'success'; 
			$this->_result['data']       = $res;
		}else{
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = $check;	
			$this->_result['data'] = $this->code[$check];	
		}
		
		return $this->_result;
	}
	
	public function addTemplate(){
		$check     = $this->validateParams(); 
		if($check === 1) { 
			
			$data = array(
				'name' => $this->param['name'],
				'p_id' => $this->param['p_id'],
				'description' => $this->param['description'],
				'created_by' 		=> $this->user->get_memberid(),
				'category' 		=> implode(',' , $this->param['category']),   
				'viewable' 		=> implode(',' , $this->param['viewable']),   
				'status' 		=> $this->param['status'], 
				'background' => !empty($this->param['background']) ? $this->param['background'] : "",
				'isIndex' => $this->param['isIndex'],
				'isCustomerForm' => $this->param['isCustomerForm'],
				'created'	=> localDate(),
				'updated'	=> localDate(),
			);
			$id = $this->insert($data);
			$this->logger_model->addLogger('add', $this->name, $this->param['name']);
			$this->_result['status']     = 'success'; 
			$this->_result['data']       = $id;
		}else{
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = $check;	
			$this->_result['data'] = $this->code[$check];	
		}
		
		return $this->_result;
	}
	
	public function editTemplate(){
		$check     = $this->validateParams(); 
		
		if($check === 1) { 
			
			$data = array(
				'name' => $this->param['name'], 
				'description' => $this->param['description'], 
				'category' 		=>  implode(',' , $this->param['category']),   
				'viewable' 		=> implode(',' , $this->param['viewable']),   
				'status' 		=> $this->param['status'], 
				'background' => !empty($this->param['background']) ? $this->param['background'] : "",
				'isIndex' => $this->param['isIndex'],
				'isCustomerForm' => $this->param['isCustomerForm'],
				'updated'	=> localDate(),
			);
			$id = $this->update($this->param['id'], $data);
			$this->logger_model->addLogger('edit', $this->name, $this->param['name']);
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
	
	public function deleteTemplate(){
		$res = $this->find_by($this->param['id']);
		$this->delete($this->param['id']);
		$this->logger_model->addLogger('delete', $this->name, $res['name']);
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
				$search .= "(name like '%".$srh."%' OR description like'%".$srh."%'  OR ".$this->primary_key."='".$srh."')  ";			
			}
		}
			 
	 	if ($this->input->get('status')) {
			$search .= (!empty($search) ? " and ": "");					
			$search .= "status = '".$this->input->get('status')."' ";
		}
		
		if(isset($this->param['validateRoles'])){
			$search .= (!empty($search) ? " and ": "");					
			$search .= "viewable LIKE '%".$this->user->get_memberrole()."%' ";
		}
		
		$return   = convert_sort($this->sorted,$sortby,$this->primary_key);
		$new_sort = change_sort($return['sort']);	
	 	 $offset   = pageToOffset($this->config->item('per_page'),$page);
	  
		// Load Data
		$data['results'] = $this->get_data($search,$this->config->item('per_page'),$offset,$return['order'],$return['sorts']); 
		
		foreach($data['results'] as $k => $val){
			$creator = $this->users_model->checkUserById($val['created_by']);
			$data['results'][$k]['creator'] = $creator[0]['username'];
			
			//Extract Category
			$categories = explode(',', $val['category']);
			$c_con = array();
			foreach($categories as $c){
				$c_con[] = match($c, $this->config->item('template_category'));
			}
			$data['results'][$k]['c_con'] = implode(', ', $c_con);
			
			//Extract Viewable
			$viewable = explode(',', $val['viewable']);
			$v_con = array();
			foreach($viewable as $v){
				$v_con[] = match($v, $this->config->item('roles'));
			}
			$data['results'][$k]['v_con'] = implode(', ', $v_con);
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
	
	private function validateForm($t_id){
		if(empty($t_id)){
			return 116;
		}
		
		return $this->checkFormAuth($t_id);
		 
	}
	
}
?>
