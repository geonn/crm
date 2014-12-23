<?php
class Permissions_Model extends APP_Model{

	function __construct() {
		$this->_table      = "user_permissions";
		$this->primary_key = 'pms_id';	
	}
	
	public function getPermissionInfo(){
		$list = array();
		foreach($this->roles as $r => $role){
			foreach($this->menu as $k => $item){
				$list[$r][$k] = 0;
				
				$result = $this->checkExists($r, $k);
				if($result){
					$list[$r][$k] = $result[0]['permission'];
				}
			}
		}
		return $list;
	}
	
	public function updatePermission(){
		foreach($_GET as $k=>$val){
			//masteroptdocument
			$g = explode('opt', $k);
			
			$result = $this->checkExists($g[0], $g[1]);
			
			if($result){
				//Update
				$data = array(
					'permission'=> $val 																																																											
				);				
			    $this->update($result[0]['pms_id'],$data);
			} else {
				$data = array(
					'role'	    => $g[0],
					'module'    => $g[1],
					'permission'=> $val 																																																											
				);				
			    $this->insert($data);
			}
			
		}
		return 1;
	}
	
	public function checkExists($role, $mod){
		$filter = array('role' => $role, 'module' => $mod);
		$result = $this->get_data($filter);
		return $result;
	}
}
?>
