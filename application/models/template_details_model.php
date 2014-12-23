<?php
class Template_details_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "template_details";
		$this->primary_key = 'id';	
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function getQuestionList($t_id = ""){ 
		$details = $this->getList($t_id);
		$list = array();
		if(!empty($details)){
			foreach($details['data'] as $k => $val){
				$list[$k] = $val['q_id'];
			}
		}
		
		return $list;
	}
	
	public function getList($t_id = ""){
		
		$this->_result['status']     = 'success'; 
		if(!empty($t_id)){
			$filter = array(
				't_id' => $t_id
			);
			$res = $this->get_data($filter,'','','position');
			foreach($res as $k => $val){
				$info = $this->question_model->find_by($val['q_id']);
				$res[$k]['question'] = $info['question'];
				$res[$k]['tag'] = $info['tag']; 
			}
			
			$this->_result['data']       = $res;		
		}else{ 
			$this->_result['data']       = array();		
		}
		
		return $this->_result;
	}
	
	public function addTemplateItems(){
		
		$check     = $this->validateParams(); 
		
		if($check === 1) { 
			
			$data = array(
				't_id' => $this->param['t_id'],
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
	
	public function removeTemplateItems(){
		$filter = array(
			't_id' => $this->param['t_id'],
			'q_id' 		=> $this->param['q_id'],   
		);
		$res = $this->get_data($filter);
		print_pre($this->param);
		print_pre($res);
		if(!empty($res)){
			$this->delete($res[0]['id']);
		}
		
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
		$template     	= $this->param['t_id']; 
		$question         = $this->param['q_id']; 
		
		if(!$question){
			return 117;
		}
		
		if(!$template){
			return 116;
		}
		 
		return 1;
	}
}
?>
