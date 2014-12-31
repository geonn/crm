<?php
class Response_form_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "response_form";
		$this->primary_key = 'id';	
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function getList($c_id){
		$filter = array(
			'c_id' => $c_id
		);
		$res = $this->get_data($filter);
		
		foreach($res as $k => $val){
			$template = $this->template_model->find_by($val['t_id']);
			if(!empty($template)){
				$user = $this->users_model->find_by($val['u_id']);
				//$question = $this->template_details_model->find_with('t_id', $val['t_id']);
				$question = $this->response_model->find_with('rf_id', $val['id']);
				$res[$k]['name'] = $template['name'];
				$res[$k]['description'] = $template['description'];
				$res[$k]['filled_by'] = $user['fullname'];
		 
				$arr_question = array();
				foreach($question as $a => $b){
					$arr_question[$b['q_id']] = $b['id'];
				}
				$res[$k]['total_question'] = count($arr_question);
			}
			
		}
		
		$this->_result['status']     = 'success'; 
		$this->_result['data']       = $res;		
		
		return $this->_result;
	}
	
	public function addResponseForm($return_customer=array()){ 
	 
		$c_id = "";
		if(!empty($return_customer)){
			$c_id = $return_customer['data'];
		}
		
		$data = array(
				'u_id' => $this->user->get_memberid(),
				't_id' => $this->param['t_id'], 
				'c_id' => $c_id, 
				'filled_date' =>  !empty($this->param['filled_date']) ? convertToDBDate($this->param['filled_date']) : date('Y-m-d'),
				'created'	=> localDate(),
				'updated'	=> localDate(),
			);
			$id = $this->insert($data);
			$this->_result['status']     = 'success'; 
			$this->_result['data']       = $id;
		
		return $this->_result;
	}
	
	public function editResponse(){
		$check     = $this->validateParams(); 
		
		if($check === 1) { 
			$data = array(
				'u_id' => $this->user->get_memberid(),
				't_id' => $this->param['t_id'],
				'q_id' => $this->param['q_id'],
				'answer' 		=>  $this->param['answer'],
				'filled_date' =>  !empty($this->param['filled_date']) ? convertToDBDate($this->param['filled_date']) : date('Y-m-d'),
				'additional' 	=> !empty($this->param['additional']) ? $this->param['additional'] : "",    
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
 
	
}
?>
