<?php
class User_sessions_Model extends APP_Model{
	
	function __construct() {
		$this->_table      = "user_sessions";
		$this->primary_key = 'u_id';	
	}
	
	/** Retrieve user base on their info  **/
	public function addUserSession($u_id){
		if(!empty($u_id)){
			$key = GUID();
			$this->phpsession->save('',$u_id,'uid');
			$this->phpsession->save('',$key,'key');
			
			$chk = $this->checkUserID($u_id);
			if($chk){
				$data = array(
						'u_key'   => $key,
						'updated' => date('Y-m-d H:i:s'),
					);
				$this->update($u_id, $data);
			}else{
				$data = array(
						'u_id'    => $u_id,
						'u_key'   => $key,
						'created' => date('Y-m-d H:i:s'),
						'updated' => date('Y-m-d H:i:s'),
					);
				$this->insert($data);
			}
			
			return $key;
		}
	}
	
	public function populateTempKey(){
		$temp_user	= $this->phpsession->get(null,'temp_user');
		if($temp_user == ""){
			
			$key = GUID();
			$return = "TE".substr($key,1,9)."MP";
			$this->phpsession->save('',$return,'temp_user');
		}
		
	}
	
	/** Remove session from user **/
	public function removeUserSession(){
		$u_id = $this->checkUserSession();
		if($u_id > 0){
			$this->delete($u_id);
		}
		
		return $u_id;
	}
	
	/** Check if user id session is exists? **/
	public function checkUserID($u_id){
		$filter = array($this->primary_key => $u_id);
		$result = $this->get_data($filter);
		
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	/** Check if user session is valid? **/
	public function checkUserSession(){

		$filter = array('u_key' => $this->session);
		$result = $this->get_data($filter);
		if($result){
			return $result[0]['u_id'];
		}else{
			return 0;
		}
	}
	
}
?>
