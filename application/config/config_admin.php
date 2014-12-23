<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$CI =& get_instance();	
$CI->config->load('config');   
$this->domain = $CI->config->item('domain'); 
$config['roles'] = array(
	 'founder'      => "Founder",
	 'director' => "Director",	
	 'manager'     => "Manager",
	 'admin'       => "Admin",
	 'salesman'       => "Salesman",
);

$config['manager_roles_access'] = array(
	"admin" => "Admin", 
	"salesman" => "Salesman"
);

$config['menu'] = array(
	 'staff'     => array(
	 					"name" => "Staffs",	
	 					"url" => $this->domain."/admin/staff/index",	
	 				),
	 'forms'  => array(
	 					"name" => "Forms",	
	 					"url" => $this->domain."/admin/forms/index",	
	 					),
	  'customer'  => array(
	 					"name" => "Customers",	
	 					"url" => $this->domain."/admin/customer/index",	
	 					),
	  'inventory'  => array(
	 					"name" => "Inventory",	
	 					"url" => $this->domain."/admin/inventory/index",	
	 					),
	 'question'  => array(
	 					"name" => "Question Pool",	
	 					"url" => $this->domain."/admin/question/index",	
	 				),
	'templates'  => array(
	 					"name" => "Template",	
	 					"url" => $this->domain."/admin/templates/index",	
	 				),
	 'project'  => array(
	 					"name" => "Project",	
	 					"url" => $this->domain."/admin/project/index",	
	 					),
 	'settings'  => array(
	 					"name" => "Settings",	
	 					"url" => $this->domain."/admin/permissions/my",	
	 					),
);

$config['sub_menu'] = array(
	 'product'  => array(
	 					'Add Product' => $this->domain.'/admin/product/newd', 
	 					'Product List' => $this->domain.'/admin/product/index'
	 				),
	 'staff'     => array(
	 					'Staff List' => $this->domain.'/admin/staff/index'
	 				),	
	 'customer'     => array(),	
	'forms'     => array(),	
	'inventory'     => array(),	
	'templates'     => array(),	
	'project'     => array(),	
	 'question'    => array(
	 					'Add Question' => $this->domain.'/admin/question/newd', 
	 				),

	 'settings'    => array(
	 					'My Account' => $this->domain."/admin/users/index",	
	 					'Permission' => $this->domain.'/admin/permissions/index'
	 	),
);

$config['admin_option'] = array(
	 '0'  => "No Access",
	 '1'  => "View Listing",
	 '2'  => "View and Edit",	
	 '3'  => "ALL (Listing, Add, Edit, Delete)",
);

$config['account_status'] = array(
	1=> 'Hired',
	2 => 'Resign',
);							

$config['publish_status'] = array(
	1=> 'Publish',
	2 => 'Unpublish',
);					

$config['project_status'] = array(
	1=> 'Open',
	2 => 'Close',
);			

$config['question_type'] = array(
	1 => 'Text Input',
	2 => 'Text Area',
	3 => 'Radio Button',
	4 => 'Checkbox'
);

$config['template_category'] = array(
	1 => "Admin",
	2  => "Sales", 
	3  => "Support", 
	4  => "Customer service", 
	5  => "Finance", 
	6  => "Others"
);

$config['gender'] = array(
	'm' => 'Male',
	'f' => 'Female',
);	
$config['sorted']  = array(
        '1'=>'ASC',
        '2'=>'DESC'
);
 
/* End of file config_admin.php */
/* Location: ./application/config/config_admin.php */
