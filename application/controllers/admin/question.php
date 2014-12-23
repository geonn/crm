<?php 
if (! defined('BASEPATH')) exit('No direct script access');

class Question extends Admin_Controller {
	public $denied   = false; 
	public $name  = 'question';
	      			
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
		$data = $this->question_model->admin_getList($sortby,$page);
		
		$table_row = $this->load->view('/admin/'.$this->name.'/_list_table',$data,true);
		echo $table_row;
	}
	
	function getQuestionPools($template_id=""){
		$data['template_id']  = $template_id;
		$data['pools'] = $this->question_model->getList(); 
		$data['inTemplates']  = $this->template_details_model->getQuestionList( $template_id);  
		$table_row = $this->load->view('/admin/'.$this->name.'/_pool_table',$data,true);
		echo $table_row;		
	}
	
	function getTemplateQuestion($template_id=""){
		$data['template_id']  = $template_id;
		$data['inTemplates']  = $this->template_details_model->getList($template_id);   
		$table_row = $this->load->view('/admin/'.$this->name.'/_question_table',$data,true);
		echo $table_row;		
	}
	
	function show_answer(){
		$data = $this->answer_model->getList($this->param['q_id']);
		$data['q_id'] = $this->param['q_id'];
		$data['question_type'] = $this->param['question_type']; 
		$table_row = $this->load->view('/admin/'.$this->name.'/_options',$data,true);
		echo $table_row;
	}
	
	public function updatePosition(){ 
		$this->answer_model->updatePosition();
	}
	
	function addAnswer(){ 
		$result = $this->answer_model->addAnswer();
		echo json_encode($result );
	}
	
	function editAnswer(){
		$result = $this->answer_model->editQuestion();
		echo json_encode($result );
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
			$data['form'] = $this->question_model->find_by($id);

			if (empty($data['form'])) {
				redirect($this->path.'index', 'refresh');												
			}
			//print_pre($data['form']);
			$this->_render_form('edit',$data);	
		}					
	}
			
	function create(){		
		$result = $this->question_model->addQuestion();
		
		if ($result['status'] == 'success') {
			$this->message->set('Question created!', 'success',TRUE);		
		    redirect($this->config->item('admin_url').'/'.$this->name.'/edit/'.$result['data']);
		}else{
			$data['form'] =$this->param;
			$this->message->set($this->code[$result['error_code']], 'error');		
			$this->_render_form('new',$data);
		}
	}
	
	function update(){  
		$this->param['id'] =  $this->uri->segment(4);
		$result = $this->question_model->editQuestion();
		if ($result['status'] == 'success') {
			$this->message->set('Question updated!', 'success',TRUE);		
			redirect($this->config->item('admin_url').'/'.$this->name.'/edit/'. $this->uri->segment(4));
		}else{
			$data['form'] =$this->param;
			$this->message->set($this->code[$result['error_code']], 'error');		
			$this->_render_form('edit',$data);
		}	
	}
	
	public function remove($user_id){
		
		$result = $this->question_model->removeUser($user_id);
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