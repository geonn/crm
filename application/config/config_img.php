<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$CI =& get_instance();	
$CI->config->load('config');   
$this->domain = $CI->config->item('domain'); 
	
$config['img_logo']    = '<img src="'.$this->domain.'/public/images/logo.png" height="30px">';
$config['icon_up']     = '<img src="'.$this->domain.'/public/images/icon_up.png" width="20px" height="20px" />';
$config['icon_down']   = '<img src="'.$this->domain.'/public/images/icon_down.png" width="20px" height="20px" />';
$config['icon_edit']    = '<img src="'.$this->domain.'/public/images/icon_edit.png" />';
$config['icon_add']    = '<img src="'.$this->domain.'/public/images/ico_add.gif" />';
$config['icon_search'] = '<img src="'.$this->domain.'/public/images/icon-search.png" width="15px" height="15px" />';
$config['icon_back']   = '<img src="'.$this->domain.'/public/images/icon_back.gif" />';
$config['icon_next']   = '<img src="'.$this->domain.'/public/images/icon_next.gif" width="20px" height="20px" />';
$config['icon_gotop']  = '<img src="'.$this->domain.'/public/images/go-top.png" />';
$config['icon_prev']   = '<img src="'.$this->domain.'/public/images/icon_prev.gif" width="20px" height="20px" />';
$config['img_loading'] = '<img src="'.$this->domain.'/public/images/loading.gif">';
$config['icon_delete'] = '<img src="'.$this->domain.'/public/images/cross.png" />';
/* End of file config_img.php */
/* Location: ./application/config/config_img.php */
