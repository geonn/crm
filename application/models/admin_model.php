<?php
class Admin_Model extends APP_Model{

	function __construct() {
		$this->_table      = "admin";
		$this->primary_key = 'admin_id';	
	}
	
	public function getAdminInfo($id){
		$filter = array($this->primary_key=> $id);
		$result = $this->get_data($filter);
		return $result;
	}
	
	public function checkGeneralPermission($module){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $module);
		if($res[0]['permission'] > 2){ 
			return 1;
		}else{
			return 0;
		}
	}
	
	public function generateAddButton($module){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $module);
		if($res[0]['permission'] > 2){ 
			echo '<button type="submit" class="green_button" value="Submit" >Add New </button>';
		}
	}
	
	public function generateUpdateButton($module,$id=""){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $module);
		if($res[0]['permission'] > 2){ 
			echo '<button type="submit"  class="green_button" id="submitformbutton">Update</button>';	
		}else if($module == "admin" && ($this->user->get_memberid() == $id)){				
			echo '<button type="submit"  class="green_button" id="submitformbutton">Update</button>';	

		}
	}
	

	public function generateEditButton($function,$id,$module){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $module);		
		if($res[0]['permission'] > 1){	
			echo '<button  class="blue_button" onclick="location.href=\''.$this->config->item('admin_url') .'/'.$function.'/edit/'.$id.'\';">Edit</button>';			
		}else if($module == "admin" && ($this->user->get_memberid() == $id)){				
				echo '<button  class="blue_button" onclick="location.href=\''.$this->config->item('admin_url') .'/'.$function.'/edit/'.$id.'\';">Edit</button>';	
		}
	}
	
	public function generateDetailsButton($function,$id,$module){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $module);		
		if($res[0]['permission'] > 1){	
			echo '<button class="green_button"  onclick="location.href=\''.$this->config->item('admin_url') .'/'.$function.'/details/'.$id.'\';">Details</button>';			
		}else if($module == "admin" && ($this->user->get_memberid() == $id)){				
				echo '<button   class="green_button" onclick="location.href=\''.$this->config->item('admin_url') .'/'.$function.'/details/'.$id.'\';">Details</button>';	
		}
	}
	
	public function generateEditImagesButton($function,$id,$module){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $module);		
		if($res[0]['permission'] > 1){
			echo '<button id="img'.$id.'" class="gallery_stalk" onclick="return clickIn(\''.$id.'\');"><span><span>'.$this->config->item("icon_edit") .'Edit</span></span></button>';						
		}
	}
	
	public function generateCustomButton($text, $module="", $function="", $id=""){
		echo ' <button onClick="location.href=\''.$this->config->item('admin_url').'/'.$module.'/'.$function.'/'.$id.'\'" ><span><span>' . $text .'</span></span></button>  ';
	
	}
	
	public function generateDeleteButton($function,$id,$module){
		$res = $this->permissions_model->checkExists($this->user->get_memberrole(), $module);
		
		if($res[0]['permission'] == 3){ 
			echo '<button  value="Delete" onclick="return confirmRemove(\''.$id.'\');" href="javascript:void(0)"><span><span>'.$this->config->item("icon_cross") .'Delete</span></span></button>';	;
		}
	}
		
	public function generateFilterButton(){
		echo ' <button type="submit" value="Submit "><span><span>' . $this->config->item("icon_search") .' Filter </span></span></button>  ';
	}
	
	public function generateGenerateButton(){
		echo ' <button type="submit" value="Submit "><span><span>' . $this->config->item("icon_search") .' Generate </span></span></button>  ';
	}
	
	public function generateLoading(){
		echo '<div id="loading" name="loading" align="center"><br/><br/><br/>' . $this->config->item("img_loading") . '<br/><br/></div>';
	}
	
	public function generateGoToTop(){
		echo '<div id="go_top" class="goToTop"><a id="scrollTop">' . $this->config->item('icon_gotop') . '</a></div>';
	}
}
 

?>
