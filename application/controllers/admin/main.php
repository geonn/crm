<?php 
if (! defined('BASEPATH')) exit('No direct script access');

class Main extends Admin_Controller {
	public $denied   = false; 
	public $name  = 'main';
	      			
	function __construct() {
		parent::__construct();	
	}

	function index(){
		
	}
	 
	function dashboard(){
		$data = array();
		$this->_render_form('index',$data);
	}
	
	function approval($page='1',$sortby=""){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), 'approval');
		if($res[0]['permission'] < 1){ 
			$this->denied = TRUE;
		}
		
		//Initialize param
	 
		$data['page']=$page;
		if(empty($page)) $data['page']="1";					
		$data['sortby']   = !empty($sortby) ? $sortby : "id-2"; 
		$data['search'] =!empty($this->param['q']) ? $this->param['q'] : ""; 
		
		// 	Build it!
		$this->_render_form('index',$data);
	}
	
	function get_list( $page='1', $sortby=''){ 
		$data = $this->case_model->admin_getList($sortby,$page);
		$table_row = $this->load->view('/admin/'.$this->name.'/_list_table',$data,true);
		echo $table_row;
	}
	
	function details(){
		if ($this->uri->segment(4) === FALSE){
			redirect($this->path.'index', 'refresh');
		}else{		
			$id = $this->uri->segment(4);
			$data['details'] = $this->case_details_model->find_with('case_id', $id);
		 	$data['case'] = $this->case_model->find_by( $id); 
			if (empty($data)) {
				redirect($this->path.'index', 'refresh');												
			}
			//print_pre($data['form']);
			$this->_render_form('details',$data);	
		}					
	}
	
	function changeCaseDetailsStatus(){
		$this->case_details_model->changeStatus();
		$this->case_model->updateStatus();
	}
	
	function revertCase(){
		$this->case_details_model->revertCase();
		$this->case_model->updateStatus();
	}
	
	function changeCurrentProject(){
		$this->phpsession->save('',$this->param['project'],'curProj');
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