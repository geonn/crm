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
		$data['category'] = !empty($this->param['category']) ? $this->param['category'] : "";
		
		// 	Build it!
		$this->_render_form('index',$data);
	}
	
	function get_list( $page='1', $sortby=''){ 
		$this->param['validateRoles'] = 1;
		$data = $this->template_model->getList($sortby,$page);
		
		$table_row = $this->load->view('/admin/'.$this->name.'/_list_table',$data,true);
		echo $table_row;
	}
	
	function viewForm($t_id=""){
		$data['result'] = $this->template_model->retrieveForm($t_id);
		$customer_list = $this->customer_model->getList();
		$data['customer_list'] = $customer_list['data'];
		//print_pre(	$data['customer_list']);
		// 	Build it!
		$this->_render_form('viewForm',$data); 
	}
	
	function dynamicForm($t_id="",$rf_id=""){
		$data['result'] = $this->template_model->retrieveForm($t_id);
		$data['response'] = $this->response_model->retrieveResponse($rf_id); 
		$data['response_form'] = $this->response_form_model->find_by($rf_id); 
		$form_row = $this->load->view('/admin/'.$this->name.'/dynamicForm',$data,true);
		echo $form_row;
	}
	
	function getCustomerList(){
		$customer_list = $this->customer_model->getList();
		echo json_encode($customer_list['data']);
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