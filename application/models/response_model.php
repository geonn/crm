<?php
class Response_Model extends APP_Model{
	public $_result = array();
	
	function __construct() {
		$this->_table      = "response";
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
	
	public function addResponse($return_customer=array()){ 
		
		$c_id = "";
		if(!empty($return_customer)){
			$c_id = $return_customer['data'];
		}
		
		$response = $this->convertResponse(); 
		$check     = $this->validateParams($response );  
		if(empty($check)) { 
			foreach($response as $q_id => $answer){
				
				if(is_array($answer)){
					foreach($answer as $aa => $aa_a ){
						$data = array(
							'u_id' => $this->user->get_memberid(),
							't_id' => $this->param['t_id'],
							'q_id' => $q_id,
							'c_id' => $c_id,
							'answer' 		=>  $aa_a,
							'additional' 	=>  !empty($this->param['additional']) ? $this->param['additional'] : "",    
							'created'	=> localDate(),
							'updated'	=> localDate(),
						);
						$id = $this->insert($data);
					}
				}else{
					$data = array(
						'u_id' => $this->user->get_memberid(),
						't_id' => $this->param['t_id'],
						'q_id' => $q_id,
						'c_id' => $c_id,
						'answer' 		=>  $answer,
						'additional' 	=>  !empty($this->param['additional']) ? $this->param['additional'] : "",    
						'created'	=> localDate(),
						'updated'	=> localDate(),
					);
					$id = $this->insert($data);
				} 
			}
			
			$this->_result['status']     = 'success'; 
			$this->_result['data']       = "";
		}else{
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = $check;	
		//	$this->_result['data'] = $this->code[$check];	
		}
		
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
	
	/** To validate if param is correct format  **/
	private function validateParams($response=array()){
		$return = array();
		$count  = 1;
		foreach($response as $k => $val){
			
			if(is_array($val)){
				foreach($val as $m => $mal){
					if(empty($val)){
						$return[$count]['question'] = $k;
						$return[$count]['code'] = 119;
					}
					
				}
			}else{
				if(empty($val)){
					$return[$count]['question'] = $k;
					$return[$count]['code'] = 119;
				}
			}
			$count++;
		}  
		return $return;
	}
	
	private function convertResponse(){
		$response = array();
		foreach($this->param as $k => $val){
			$question = explode('q_', $k);
			if(count($question) > 1){
				$response[$question[1]] = $this->param['q_'.$question[1]];
			}
		}
		
		return $response;
	}
	
	private function validateForm($t_id){
		if(empty($t_id)){
			return 116;
		}
		
		return $this->checkFormAuth($t_id);
		 
	}
	
}
?>
