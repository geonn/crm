<?php
//
// To get user information from object.
//
class User{
	private $CI;
	private $memberid;
	private $memberemail;
	private $memberusername;
	private $memberrole;

	
	function __construct(){
		$this->CI  =& get_instance();	
	}
	
	// Member ID
	function set_memberid($val){
		$this->CI->phpsession->save("userid", $val);	
		$this->memberid = $val;		
	}
	
	function get_memberid(){
		$suid = $this->CI->phpsession->get("userid");
		if(!isset($this->memberid)){	
			if(isset($suid)){
				$this->memberid = $this->CI->phpsession->get("userid");
			}				
		}
		return $this->memberid;		
	}
	
	// Member Email
	function set_memberemail($val){
		$this->CI->phpsession->save("email", $val);	
		$this->memberemail = $val;		
	}
	
	function get_memberemail(){
		$semail = $this->CI->phpsession->get("email");
		if(!isset($this->memberemail)){		
			if(isset($semail)){
				$this->memberemail = $this->CI->phpsession->get("email");
			}				
		}
		return $this->memberemail;		
	}	
	
	// Member Username
	function set_memberusername($val){
		$this->CI->phpsession->save("username", $val);	
		$this->memberusername = $val;		
	}
	
	function get_memberusername(){
		$sname = $this->CI->phpsession->get("username");
		if(!isset($this->get_memberusername)){		
			if(isset($sname)){
				$this->memberusername = $this->CI->phpsession->get("username");
			}				
		}
		return $this->memberusername;		
	}	
	
	// Member Role
	function set_memberrole($val){
		$this->CI->phpsession->save("role", $val);	
		$this->memberrole = $val;		
	}
	
	function get_memberrole(){
		$srole = $this->CI->phpsession->get("role");
		if(!isset($this->get_memberrole)){		
			if(isset($srole)){
				$this->memberrole = $this->CI->phpsession->get("role");
			}				
		}
		return $this->memberrole;		
	}	

	function logout_user(){
		return $this->CI->phpsession->clear();
	}
	
}
?>