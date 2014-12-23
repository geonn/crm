<?php
//
// To check authentication for admin page.
//
class Authenticate{
	private $CI;
	
	function __construct(){
		$this->CI =& get_instance();			
		$this->CI->load->library('user');
	}
	
	function validate_admin_login(){
		$login = $this->CI->user->get_memberusername();

		if (empty($login)) {		
			$this->_redirect_login();
		}				
	}
	
	function admin_id(){
		return $this->CI->user->get_memberid();
	}
	
	function admin_username(){
		return $this->CI->user->get_memberusername();
	}
	
	function admin_role(){
		return $this->CI->user->get_memberrole();
	}
	
	function admin_email(){
		return $this->CI->user->get_memberemail();
	}
	
	function allow_admin_role($role){
		$current_role = $this->admin_role();
		
		if(isset($current_role)&&!empty($current_role)){
			if (is_array($role))
			{
				foreach ($role as $key)
				{	
					if ($current_role == $key) {
						return;
					}					
				}
			}else{
				if ($current_role == $role) {
					return;
				}
			}		
		}		
		$this->_redirect_no_access();
	}
	
	function allow_admin_login($login){
		$current_login = $this->admin_login();
		
		if(isset($current_login)&&!empty($current_login)){
			if (is_array($login))
			{
				foreach ($login as $key)
				{	
					if ($current_login == $key) {
						return;
					}					
				}
			}else{
				if ($current_login == $login) {
					return;
				}
			}		
		}		
		$this->_redirect_no_access();		
	}
	
	function _redirect_login(){
		redirect($this->CI->config->item('admin_url')."/login");
	}
	
	
}
?>