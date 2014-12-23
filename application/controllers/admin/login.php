<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends General_Controller {

	public $name = 'login';
	
	function __construct() {
		parent::__construct();	
		$this->param['user'] = API_USER;
		$this->param['key']  = API_KEY;
		$this->param['skipSession']  = 1;
		$this->template->set_layout('login');
	}
	
	public function index() {
		
		$data = array(
					'username'=>$this->input->post('username'),
					'password'=>$this->input->post('password'),																											
				);
		
		$data['path'] = $this->path;
		$this->template->build('admin'.$this->path.'login', $data);		
	}
	
	public function authenticate(){
	
		$this->result = $this->users_model->loginUser();	
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */