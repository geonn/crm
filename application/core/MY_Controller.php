<?php 
/** 
** The heart of controller 
** Initialize share param and object
** by GEO
**/
class APP_Controller extends CI_Controller{
	public	$path = '';
	public	$code  = '';	
	public  $param = "";
	public  $debug = "";
	
	function __construct() {
		parent::__construct();
		$this->CI           = & get_instance();
		$this->path      = '/'.$this->name.'/';
		$this->code      = $this->config->item('api_code');
		/***********************************************
		|  Load Model
		************************************************/ 
		$this->load
			 ->model(array(
				'admin_model','permissions_model','user_sessions_model','users_model',
				'question_model','template_model','project_model','answer_model',
				'template_details_model','response_model','customer_model','logger_model',
				'response_form_model'
			));
			
		/***********************************************
		|  Load Library
		************************************************/ 
		$this->load->library('form_validation');		
		$this->load->library('pagination');	
		$this->load->library('email');		
		
		/***********************************************
		|   Load partial files (includes file like js)
		************************************************/
		$this->template->set_partial('includes' , $this->config->item('template_dir').'/_includes');
		$this->template->set_partial('footer'   , $this->config->item('template_dir').'/_footer');   
		$this->template->set_partial('message'  , 'admin/_message');
	}
	
	public function _remap($method, $args) {
      // Call before action
      $this->before();      
      call_user_func_array(array($this, $method), $args);      
      // Call after action
      $this->after();
    }
    
    /** Action to do before launch controller function**/
	protected function before() {    	
		$this->convertParam();
    }
    
     /** Action to do after launch controller function**/
	protected function after() { 
    	if($this->debug){
    		print_pre($this->result); 
    	}
    	
    	if(!empty($this->result)){
	    	echo json_encode($this->result);
	    }
    }
    
    /** Convert all $_GET and $_POST to framework parameters**/
    public function convertParam(){
    	foreach($_REQUEST as $key => $val){
	    	$val = str_replace(array("\\\\\\"),array(""),$val); 
	    	$this->param[$key] = $val;
        }
    }
    
    /** Render and generate view(html) form**/ 
	public function _render_form($action,$data=array()){
		$this->template->set_partial('content',$this->path.'/_form');
		$this->template->build($this->path.$action, $data);		
	}
}

class Web_Controller extends APP_Controller {
	function __construct() {
		parent::__construct();
		$this->CI       = & get_instance();
		$this->path  = '/webs/'.$this->name.'/';
		
		/** Set HTML templates **/
		$this->template->set_layout('web');
		
	}
	
}

class General_Controller extends APP_Controller {
	
	public    $user  = "";
	public    $param = "";
	public    $debug = "";
	
	protected $api_param  = '';	
	public    $_result = array();
	function __construct() {
		parent::__construct();
		
		/** Set HTML templates **/
		$this->template->set_layout('html');
		$this->path  ='/'.$this->name.'/';
		
		/** Config code of Authenticate API **/
		
		$this->api_param = $this->config->item('api_param');
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
		/** FUNCTION END **/
	}
	
	public function _remap($method, $args) {
      // Call before action
      $this->before();      
      call_user_func_array(array($this, $method), $args);      
      // Call after action
      $this->after();
    }
        
	/**
     * These shouldn't be accessible from outside the controller
    **/
    protected function before() {    	
		//append_file('geo.log',$_REQUEST);
    	foreach($_REQUEST as $key => $val){
	    	$val = str_replace(array("\\\\\\"),array(""),$val); 
	    	$this->param[$key] = $val;
	    
        }

    	 /** Turn ON debug mode **/
	   	if(isset($_REQUEST['debug'])){
			$this->debug = true;	
		}
		
		/** CHECK AUTHENTICATE **/
		$result = $this->checkParam();	
		
		if($result == 1){

			// Safe to generate data to client	
			if(!isset($this->param['skipSession'] ) || empty($this->param['skipSession'])){
				$ses = $this->checkUserSession();	
				
				if($ses == 1 ){		
					
				}else{
					if(!$this->param['u_id'] ){		
						/** Called function without session authentication**/
						if(!in_array($this->uri->segments[2], $this->config->item('skip_auth'))){
							$this->_result['status']     = 'error';
							$this->_result['error_code'] = $ses;
							$this->_result['data']       = $this->code[$ses];	
							echo json_encode($this->_result);
							exit;
						}				
					}
				}
			
			}
		} else{
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = $result;
			$this->_result['data']       = $this->code[$result];	
			echo json_encode($this->_result);
			exit;
		}		    	 
   	}
   	
    protected function after() { 
    	if($this->debug){
    		print_pre($this->result); 
    	}
    	if(!empty($this->result)){
	    	echo json_encode($this->result);
	    }
    }
    
	protected function authenticateKey($user,$key){
		$keyList = $this->config->item('api_key');
		 
		if(!isset($keyList[$user])){
			return 190; //Invalid User
		}
		
		if($keyList[$user] == $key){
			$this->users = $user;
			return 1; //Success
		}else{
			return 192; //Wrong Key
		}
		
		return 180; //Unknown Error
	}
	
	/**
	*	Validate the param sent from client
	**/
	protected function checkParam(){
		
		if(empty($this->param['user']) ||empty($this->param['key'])  ){
			$result = 188;
		}else{
			// If user and key provided
			$user = htmlspecialchars(trim($this->param['user']));
			$key  = htmlspecialchars(trim($this->param['key']));
			 
			//Check the result from provided key
			$result = $this->authenticateKey($user,$key);
			 
		}
		
		return $result;
	}
	
	protected function checkUserSession(){
		if(!empty($this->param['session']) && isset($this->param['session'])){			
			$res = $this->user_sessions_model->checkUserSession();
			if($res > 0){
				$this->param['u_id'] = $res;
				return 1;
			}else{
				return 162; //Havent login
			}			
		}else{
			return 160; //NO session
		}
	}
	
	public function _render_form($action,$data=array()){
		$this->template->build($this->path.$action, $data);		
	}
	
}

class API_Controller extends APP_Controller {
	public        $_result        = array();
	public        $user             = "";
	protected $api_param  = '';	
	
	function __construct() {
		parent::__construct();
		
		/** Set HTML templates **/
		$this->template->set_layout('html');
		$this->path  ='/'.$this->name.'/';
		
		/** Config code of Authenticate API **/
		$this->api_param = $this->config->item('api_param');
		
		$this->_result['status']     = '';
		$this->_result['error_code'] = '';
		$this->_result['data']       = array();	
	}
	
	public function _remap($method, $args) {
      // Call before action
      $this->before();      
      call_user_func_array(array($this, $method), $args);      
      // Call after action
      $this->after();
    }
        
	/**
     * These shouldn't be accessible from outside the controller
    **/
    protected function before() {    	
    	$this->convertParam();
    	
    	 /** Turn ON debug mode **/
	   	if(isset($_REQUEST['debug'])){
			$this->debug = true;	
		}
		
		/** CHECK AUTHENTICATE **/
		$result = $this->checkParam();	
		if($result == 1){
			// Safe to generate data to client	
			if(!isset($this->param['skipSession'] ) || empty($this->param['skipSession'])){
				$ses = $this->checkUserSession();	
				
				if($ses == 1 ){		
					
				}else{
					if(!$this->param['u_id'] ){		
						/** Called function without session authentication**/
						if(!in_array($this->uri->segments[2], $this->config->item('skip_auth'))){
							$this->_result['status']     = 'error';
							$this->_result['error_code'] = $ses;
							$this->_result['data']       = $this->code[$ses];	
							echo json_encode($this->_result);
							exit;
						}				
					}
				}
			
			}
		} else{
			$this->_result['status']     = 'error';
			$this->_result['error_code'] = $result;
			$this->_result['data']       = $this->code[$result];	
			echo json_encode($this->_result);
			exit;
		}		    	 
   	}
   	
	protected function authenticateKey($user,$key){
		$keyList = $this->config->item('api_key');
		 
		if(!isset($keyList[$user])){
			return 190; //Invalid User
		}
		
		if($keyList[$user] == $key){
			$this->users = $user;
			return 1; //Success
		}else{
			return 192; //Wrong Key
		}
		
		return 180; //Unknown Error
	}
	
	/**
	*	Validate the param sent from client
	**/
	protected function checkParam(){
		
		if(empty($this->param['user']) ||empty($this->param['key'])  ){
			$result = 188;
		}else{
			// If user and key provided
			$user = htmlspecialchars(trim($this->param['user']));
			$key  = htmlspecialchars(trim($this->param['key']));
			 
			//Check the result from provided key
			$result = $this->authenticateKey($user,$key);
		}
		
		return $result;
	}
	
	protected function checkUserSession(){
		if(!empty($this->param['session']) && isset($this->param['session'])){			
			$res = $this->user_sessions_model->checkUserSession();
			if($res > 0){
				$this->param['u_id'] = $res;
				return 1;
			}else{
				return 162; //Havent login
			}			
		}else{
			return 160; //NO session
		}
	}
	
}

class Admin_Controller extends APP_Controller {
	
	public $roles   			   = '';
	public $param		        = "";
	public $menu  			    = array();
	public $sub_menu		= array();
	public $nav                 	= array();
	public $sorted 				  = array();
	public $country 			 = array();
	protected $api_param  = '';	
	
	function __construct() {
		parent::__construct();		
		$this->CI =& get_instance();	
		$this->path ='/admin/'.$this->name.'/';
		
		/** Load layout template **/
		$this->template->set_layout('admin');
		$this->template->set_partial('message', 'admin/_message');		
		
		/** Load config **/
		$this->account_status = $this->config->item('account_status');	
		$this->sorted 		       = $this->config->item('sorted');	
		$this->roles 		         = $this->config->item('roles');
		$this->menu 		  	   = $this->config->item('menu');
		$this->sub_menu 	  = $this->config->item('sub_menu');		
		$this->api_param       = $this->config->item('api_param');
		$this->country            = $this->config->item('country');
		
		$keyList  = $this->config->item('api_key');
		$list        = $this->permissions_model->getPermissionInfo();
		
		$roles = $this->user->get_memberrole();  
		if($roles){
			$this->nav = $list[$this->user->get_memberrole()];
		}
		
		$this->authenticate->validate_admin_login();
		$this->param['user'] = API_USER;
		$this->param['key']  = API_KEY;
	}
	
	public function goHome(){
		redirect($this->config->item('admin_url').'/'.$this->name.'/index');
	}
	
}

