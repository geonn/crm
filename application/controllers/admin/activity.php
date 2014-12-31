<?php 
if (! defined('BASEPATH')) exit('No direct script access');

class Activity extends Admin_Controller {
	public $denied   = false; 
	public $name  = 'activity';  			
	function __construct() {
		parent::__construct();	 
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $this->name);
		if($res[0]['permission'] < 1){ 
			$this->denied = TRUE;
		}
	}

	function index($page='1',$sortby="") {
		//Initialize param
	 
		$data['page']=$page;
		if(empty($page)) $data['page']="1";					
		$data['sortby']   = !empty($sortby) ? $sortby : "id-2"; 
		$data['search'] =!empty($this->param['q']) ? $this->param['q'] : ""; 
		
		// 	Build it!
		$this->_render_form('index',$data);
	}
	
	function get_list( $page='1', $sortby=''){ 
		$data = $this->logger_model->admin_getList($sortby,$page);
		$table_row = $this->load->view('/admin/'.$this->name.'/_list_table',$data,true);
		echo $table_row;
	}
	
	function edit(){		
		$data['module'] = "edit";
		if ($this->uri->segment(4) === FALSE){
			redirect($this->path.'index', 'refresh');
		}else{		
			$id = $this->uri->segment(4);
			$data['form'] = $this->project_model->find_by($id); 

			if (empty($data['form'])) {
				redirect($this->path.'index', 'refresh');												
			}
			//print_pre($data['form']);
			$this->_render_form('edit',$data);	
		}					
	}

	function update(){
		$this->param['id'] =  $this->uri->segment(4);
		$result = $this->project_model->editProject();
		if ($result['status'] == 'success') {
			$this->message->set('Activity updated!', 'success',TRUE);		
			redirect($this->config->item('admin_url').'/'.$this->name.'/edit/'. $this->uri->segment(4));
		}else{
			$data['form'] =$this->param;
			$this->message->set($this->code[$result['error_code']], 'error');		
			$this->_render_form('edit',$data);
		}	
	}
	
	public function remove($user_id){
		$result = $this->project_model->removeUser($user_id);
		if($result == 1){
			 $this->goHome();
		}
	}
	 
	function show(){
		$this->message->set('Record updated!', 'error',TRUE);	
		redirect($this->config->item('admin_url').'/main/index');
	}
	
	
}