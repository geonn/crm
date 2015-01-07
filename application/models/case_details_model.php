<?php
class Case_details_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "case_details";
		$this->primary_key = 'id';	
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function getCaseList($t_id = ""){ 
		$details = $this->getList($t_id);
		$list = array();
		if(!empty($details)){
			foreach($details['data'] as $k => $val){
				$list[$k] = $val['q_id'];
			}
		}
		
		return $list;
	}
	 
	public function addCaseItems($case_id, $key, $updates){
		$roles = $this->user->get_memberrole();
		$status = "1";
		if(in_array($roles, $this->config->item('updates_access'))){
			$status = "2";
		} 
		foreach($updates as $k => $val){
			$n_data = $val['new_data'];
			if(is_array( $val['new_data'])){
				$n_data  = implode(',', $val['new_data']); 
			}
			
			$data = array(
				'case_id' => $case_id,
				'update_key' => $key,
				'field' 		=> $val['field'],   
				'old_data' 		=> $val['old_data'],   
				'new_data' 		=> $n_data,   
				'status' 		=>  $status,   
				'created'	=> localDate(),
				'updated'	=> localDate(),
			); 
			$id = $this->insert($data);
		} 
		$this->_result['status']     = 'success';  
		return $this->_result;
	}
	
	public function changeStatus(){
		//Do action base on status
		if( $this->param['status'] == "2"){
			//If approved and update data
			$case = $this->case_model->find_by($this->param['case_id']);
			$details = $this->case_details_model->find_by($this->param['id']); 
			if($case['module'] == "users"){
				$this->users_model->manualUpdates($details);	
			}
		}
		
		$updateStatus = array(
			'status' 			=> $this->param['status'],
			'updated' 		=> localDate(),   
		);
		$this->update($this->param['id'],$updateStatus);
  		
	}
	
 	public function revertCase(){
 		$case = $this->case_model->find_by($this->param['case_id']);
		$details = $this->case_details_model->find_by($this->param['id']); 
		if($case['module'] == "users"){
			$this->users_model->revertUpdates($details);	
		}
			
 		$updateStatus = array(
			'status' 			=> 4,
			'updated' 		=> localDate(),   
		);
		$this->update($this->param['id'],$updateStatus);
 	}
	
}
?>
