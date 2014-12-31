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
	
	public function retrieveResponse($rf_id=""){
		if(empty($rf_id)){
			return "Empty rf_id";
		}
		$filter = array(
			'rf_id' => $rf_id
		);
		$res = $this->get_data($filter);
		$list = array();
		
		foreach($res as $k => $val){
			$list[$val['q_id']] = $val['answer'];
			if(!empty($val['additional'])){
				$list[$val['q_id']."_99"] = $val['additional'];
			}
		}
		
		$this->_result['status']     = 'success'; 
		$this->_result['data']       = $list;		
		
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
			//If all success, then add data to 'response_form' table
			$res_form = $this->response_form_model->addResponseForm($return_customer);
			
			foreach($response as $q_id => $answer){
				if(is_array($answer)){
				
					foreach($answer as $aa => $aa_a ){
					  
							$data = array( 
								'rf_id' => $res_form['data'],
								'q_id' => $q_id, 
								'answer' 		=>  $aa_a,
								'additional' 	=>  !empty($response[$q_id.'_99']) ? $response[$q_id.'_99'] : "",     
								'created'	=> localDate(),
								'updated'	=> localDate(),
							);
							$id = $this->insert($data);
							
					}
				}else{
					$isSubAns = explode('_', $q_id);
					
					if(isset($isSubAns[1]) ){
						//Skip
					}else{
						$data = array( 
							'rf_id' => $res_form['data'],
							'q_id' => $q_id, 
							'answer' 		=>  $answer,
							'additional' 	=>  !empty($response[$q_id.'_99']) ? $response[$q_id.'_99'] : "",     
							'created'	=> localDate(),
							'updated'	=> localDate(),
						);
						$id = $this->insert($data);
					}
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
	 
	
	/** To validate if param is correct format  **/
	private function validateParams($response=array()){
		$return = array();
		$count  = 1;
		
		//Loop into form response
		foreach($response as $k => $val){
			//If answer have multiple options
			if(is_array($val)){
				
				foreach($val as $m => $mal){
					
					if($mal == "99"){
						 if(empty($response[$k."_".$mal])){
							$return[$count]['question'] = $k;
							$return[$count]['code'] = 119;
						}
					
					}else{
						
						//If response dont have 'Others'
						if(empty($val)){
							$return[$count]['question'] = $k;
							$return[$count]['code'] = 119;
						}
					}
				}
			}else{ //Single options
			 
				//If response dont have 'Others'
				if($val != "99"){ 
				 
				 	if(empty($val)){
						$return[$count]['question'] = $k;
						$return[$count]['code'] = 119;
					}
				 
				}else{
					if(empty($response[$k."_".$val])){
						$return[$count]['question'] = $k;
						$return[$count]['code'] = 119;
					}
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
				//	print_pre( $this->param['q_'.$question[1]]);
				if(is_array($this->param['q_'.$question[1]])){
					foreach($this->param['q_'.$question[1]] as $a => $jap){
						if( $jap == "99"){
							$response[$question[1]."_99"] = $this->param[$question[1].'_99'];
						}
					}
				}else{
					if($this->param['q_'.$question[1]] == "99"){
						$response[$question[1]."_99"] = $this->param[$question[1].'_99'];
					}
				}
				
				$response[$question[1]] = $this->param['q_'.$question[1]];
			}
		}
		  
		return $response;
	}
	 
	
}
?>
