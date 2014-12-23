<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends Web_Controller {

	/** Module name **/
	public $name        = 'main';	
	function __construct() {
		parent::__construct();	
	}
	
	public function index(){
		$data = array();
		$data['result'] = $this->users_model->getUserById('1');
		print_pre($this->param);
		$this->_render_form('welcome',$data);
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */