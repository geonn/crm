<?php 
if (! defined('BASEPATH')) exit('No direct script access');

class Forms extends Admin_Controller {
	public $denied   = false; 
	public $name  = 'forms';
	      			
	function __construct() {
		parent::__construct();	 
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $this->name);
		if($res[0]['permission'] < 1){ 
			$this->denied = TRUE;
		}
	}

	function index($sortby='',$page='1') {
		//Initialize param
	 
		$data['page']=$page;
		if(empty($page)) $data['page']="1";					
		$data['sortby']   = !empty($sortby) ? $sortby : "id-1"; 
		$data['search'] =!empty($this->param['q']) ? $this->param['q'] : "";
		$data['status'] = !empty($this->param['status']) ? $this->param['status'] : "";
		
		// 	Build it!
		$this->_render_form('index',$data);
	}
	
	function get_list( $page='1', $sortby=''){ 
		$this->param['validateRoles'] = 1;
		$data = $this->template_model->admin_getList($sortby,$page);
		
		$table_row = $this->load->view('/admin/'.$this->name.'/_list_table',$data,true);
		echo $table_row;
	}
	
	function viewForm($t_id=""){
		$data['result'] = $this->template_model->retrieveForm($t_id);
		// 	Build it!
		$this->_render_form('viewForm',$data); 
	}
	
	function submitAnswer(){
		$return_customer = $this->customer_model->addCustomer();  
		$return_form = $this->response_model->addResponse($return_customer);
		echo json_encode($return_form);
	}
	
	function dashboard(){
		$data = array();
		$this->_render_form('dashboard',$data);
	}
	
	
}