<?php 
if (! defined('BASEPATH')) exit('No direct script access');

class Main extends Admin_Controller {
	public $denied   = false;
	public $validation = array();
	public $account_status = array();  
	public $name  = 'main';
	      			
	function __construct() {
		parent::__construct();	
		$this->account_status = array(1 => 'Active', 2 => 'Resign');
		
	}

	function index($page='',$sortby='') {
		//Initialize param
		
		$data['page']=$page;
		if(empty($page)) $data['page']="0";					
		$data['sortby']   = isset($sortby) ? $sortby : "u_id-1";
		$data['roles']  = $this->param['roles'];
		$data['search'] = $this->param['q'];
		$data['status'] = $this->param['status'];
		
		// 	Build it!
		$this->_render_form('index',$data);
	}
	
	function get_admin_list($page='0',$sortby=''){

		$data = $this->users_model->admin_getListUsers($sortby);
		$table_row = $this->load->view('/admin/main/_list_table',$data,true);
		echo $table_row;
	}
	
	function dashboard(){
		$data = array();
		$this->_render_form('index',$data);
	}
	
	
	function logout() {
		$this->user->logout_user();
		redirect($this->config->item('admin_url').'/login');
	}
	
	function show(){
		$this->message->set('Record updated!', 'error',TRUE);	
		redirect($this->config->item('admin_url').'/main/index');
	}
	
	function patchZeroCost(){
		$data= array('10787', '10786', '10861', '11008', '11046', '11049', '11223', '11376', '11375', '11581', '11670', '12079');
		$this->order_model->patchZeroCost($data);
	}

}