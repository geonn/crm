<?php
class Question_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "question";
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
	
	public function getQuestionById($q_id){
		if(!empty($q_id)){
			 
			$res = $this->find_by($q_id);
			if(!empty($res)){
				$answers = $this->answer_model->getList($q_id);
				 
				if(!empty($answers)){
					foreach($answers['data'] as $a => $answer){ 
						$res['answer'][$answer['id']] = $answer['answer'];
					}
				}
			//	
			}
		}
		
		return $res;
	}
	
	public function addQuestion(){
		
		$check     = $this->validateParams(); 
		
		if($check === 1) { 
			
			$data = array(
				'question' => $this->param['question'],
				'created_by' 		=> $this->user->get_memberid(),
				'tag' 		=> $this->param['tag'],  
				'created'	=> localDate(),
				'updated'	=> localDate(),
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
	
	public function editQuestion(){
		$check     = $this->validateParams(); 
		
		if($check === 1) { 
			
			$data = array(
				'question' => $this->param['question'], 
				'tag' 		=> $this->param['tag'],  
				'type' 		=> $this->param['type'],   
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
	
	public function deleteQuestion(){
		$this->delete($this->param['id']);
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
				$search .= "(question like '%".$srh."%' OR tag like'%".$srh."%'  OR ".$this->primary_key."='".$srh."')  ";			
			}
		}
			 
	 
		$return   = convert_sort($this->sorted,$sortby,$this->primary_key);
		$new_sort = change_sort($return['sort']);	
	 	 $offset   = pageToOffset($this->config->item('per_page'),$page);
	  
		// Load Data
		$data['results'] = $this->get_data($search,$this->config->item('per_page'),$offset,$return['order'],$return['sorts']); 
		
		foreach($data['results'] as $k => $val){
			$creator = $this->users_model->checkUserById($val['created_by']);
			$data['results'][$k]['creator'] = $creator[0]['username'];
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
		$question     	= $this->param['question']; 
		
		if(!$question){
			return 110;
		}
		 
		return 1;
	}
}
?>
