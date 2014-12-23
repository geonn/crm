<?php
class Answer_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "answer";
		$this->primary_key = 'id';	
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function getList($q_id = ""){
		
		$this->_result['status']     = 'success'; 
		if(!empty($q_id)){
			$filter = array(
				'q_id' => $q_id
			);
			$res = $this->get_data($filter,'','','position');
			
			$this->_result['data']       = $res;		
		}else{ 
			$this->_result['data']       = array();		
		}
		
		return $this->_result;
	}
	
	public function addAnswer(){
		$check     = $this->validateParams(); 
		
		if($check === 1) { 
			$data = array(
				'answer' => $this->param['answer'],
				'q_id' 		=> $this->param['q_id'],   
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
				'answer' => $this->param['answer'],  
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
	
	public function updatePosition(){
		$items = $this->param['items'];
		$position = 1;
		foreach($items as $k => $val){
			$data = array(
				'position' => $position
			);
			$this->update($val, $data);
			$position++;
		}
		
		$this->_result['status']     = 'success'; 
		
		return $this->_result;
	}
	
	public function deleteQuestion(){
		$this->delete($this->param['id']);
		$this->_result['status']     = 'success'; 
		
		return $this->_result;
	}
	
	/** To validate if param is correct format  **/
	private function validateParams(){
		$question     	= $this->param['q_id']; 
		$answer         = $this->param['answer']; 
		
		if(!$question){
			return 112;
		}
		
		if(!$answer){
			return 111;
		}
		 
		return 1;
	}
}
?>
