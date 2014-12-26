<?php 
if (! defined('BASEPATH')) exit('No direct script access');

class Staff extends Admin_Controller {
	public $denied   = false;
	public $validation = array();
	public $account_status = array();  
	public $day_list = array();
	public $month_list = array();
	public $year_list = array();
	public $name  = 'staff';
	      			
	function __construct() {
		parent::__construct();	
		$this->account_status = $this->config->item('account_status');
		$this->day_list = $this->config->item('day');
		$this->month_list = $this->config->item('month');
		$this->year_list = $this->config->item('yearRpt'); 
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $this->name);
		if($res[0]['permission'] < 1){ 
			$this->denied = TRUE;
		}
	}

	function index($sortby='',$page='1') {
		//Initialize param
	 
		$data['page']=$page;
		if(empty($page)) $data['page']="1";					
		$data['sortby']   = !empty($sortby) ? $sortby : "u_id-1";
		$data['roles']  =  !empty($this->param['roles']) ? $this->param['roles'] : "";
		$data['search'] =!empty($this->param['q']) ? $this->param['q'] : "";
		$data['status'] = !empty($this->param['status']) ? $this->param['status'] : "";
		
		// 	Build it!
		$this->_render_form('index',$data);
	}
	
	function get_list( $page='1', $sortby=''){ 
		$data = $this->users_model->admin_getListUsers($sortby,$page);
		
		$table_row = $this->load->view('/admin/'.$this->name.'/_list_table',$data,true);
		echo $table_row;
	}
	
	function newd(){
		$data['module'] = "add";
		$this->_render_form('new', $data);			
	}
	
	function edit(){		
		$data['module'] = "edit";
		if ($this->uri->segment(4) === FALSE){
			redirect($this->path.'index', 'refresh');
		}else{		
			$id = $this->uri->segment(4);
			$data['form'] = $this->users_model->find_by($id);
		
			$data['form']['password2'] = $data['form']['password'];

			if (empty($data['form'])) {
				redirect($this->path.'index', 'refresh');												
			}
			//print_pre($data['form']);
			$this->_render_form('edit',$data);	
		}					
	}

	function dashboard(){
		
		$this->_render_form('dashboard',$data);	
	}
	
	function myAccount(){
//		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), 'myaccount');
//		if($res[0]['permission'] < 1){ 
//			$this->denied = TRUE;
//		}
		$data['module'] = "edit";
		$id = $this->user->get_memberid();
		$data['form'] = $this->users_model->find_by($id); 
		$data['form']['password2'] = $data['form']['password'];

		if (empty($data['form'])) {
			redirect($this->path.'index', 'refresh');												
		}
		//print_pre($data['form']);
		$this->_render_form('edit',$data);	
	}
			
	function create(){		
		$data['module'] = "add";
		$result = $this->users_model->addUser(); 
		if ($result['status'] == 'success') { 
			$this->message->set(ucwords($this->name).' created!', 'success',TRUE);		
		    $this->goHome();
		}else{
			$data['form'] =$this->param;
			$this->message->set($this->code[$result['error_code']], 'error');		
			$this->_render_form('new',$data);
		}
	}
	
	function update(){
		$data['module'] = "edit"; 
		$u_id =  $this->param['u_id'];
		if(empty($u_id)){
			$this->param['u_id'] = $this->user->get_memberid();
		} 
		 
		$result = $this->users_model->editAccount();
		if ($result['status'] == 'success') {
			$this->message->set('User profile updated!', 'success',TRUE);		
		//	print_pre($this->param['u_id'] ."==". $this->user->get_memberid());
			if($this->param['u_id'] != $this->user->get_memberid()){
				 $this->goHome();
			}else{
				redirect($this->config->item('admin_url').'/'.$this->name.'/myAccount');
			}
		   
		}else{
			$data['form'] =$this->param;
			$this->message->set($this->code[$result['error_code']], 'error');		
			$this->_render_form('edit',$data);
		}	
	}
	
	public function remove($user_id){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $this->name);
		if($res[0]['permission'] < 1){ 
			$this->denied = TRUE;
		}
		$result = $this->users_model->removeUser($user_id);
		if($result == 1){
			 $this->goHome();
		}
	}
	  
	
	function logout() {
		$this->user->logout_user();
		redirect($this->config->item('admin_url').'/login');
	}
	
	function show(){
		$this->message->set('Record updated!', 'error',TRUE);	
		redirect($this->config->item('admin_url').'/main/index');
	}
	
	
}