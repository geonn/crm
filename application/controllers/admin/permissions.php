<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Permissions extends Admin_Controller {
	/** Module name **/
	public $name     = 'permissions';
	public $category = array();
	public $denied   = false;
	public $option = array();	      			
	function __construct() {
		parent::__construct();	
		
		$this->option = $this->config->item('admin_option');
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), 'admin');
		if($res[0]['permission'] < 1){ 
			$this->denied = TRUE;
		}
	}
	
	public function index() {
		//Initialize param
		$data = array();
		$data['menu'] = $this->permissions_model->getPermissionInfo();
		
		// 	Build it!
		$this->_render_form('index',$data);
	}
	
	public function updatePermission(){
		$result = $this->permissions_model->updatePermission();
		$data['menu'] = $this->permissions_model->getPermissionInfo();
		$this->message->set('Record created!', 'success',TRUE);		
		$this->_render_form('index',$data);
		//redirect($this->config->item('admin_url').'/'.$this->name.'/index');
	}
	
	

}