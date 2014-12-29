<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//
//API AUTH Key
//
$config['api_key'] = array(
	'webadmin'   => '981bce3f4b506c6eb5473debb3275c27',
	'biomas'     => '06b53047cf294f7207789ff5293ad2dc',
);
//
//API AUTH Param
//
$config['api_param'] = array(
	'user' , 'key'
);
//
//API Return code message
//
$config['api_code'] = array(
	  1	  => 'Success',
	100	  => 'No Result',
	101   => 'Staff is banned. Please contact administrator for assistant.',
	102   => 'Duplicate',
	103   => 'Empty username',
	104   => 'Empty staff full name',
	105   => 'Invalid email',
	106   => 'Empty password',
	107   => 'Both password must same',
	108   => 'Empty staff email',
	109   => 'Invalid staff mobile',
	110   => 'Question cannot be empty',
	111   => 'Answer option cannot be empty',
	112   => 'Answer option must attached with question',
	113   => 'Template name cannot be empty',
	114   => 'No user',
	115   => 'Project name cannot be empty',
	116   => 'Empty template ID',
	117   => 'Empty question ID',
	118   => 'Not authorize to access the form',
	119   => 'Empty response',
	120   => 'Empty customer name',
	121   => 'No Customer Form',
	122   => 'Empty action',
	123   => 'Empty module',
	124   => 'No review id or photo id',
	125   => 'Empty favourite',
	126   => 'Already in favourites list',
	127   => 'Empty favourite id',
	128   => 'Missing latitude or longitude',
	129   => 'Wrong password',
	130   => 'Already activated',
	131   => 'Expired verification code',
	132   => 'Missing params email or code',
	135   => 'Login fail',
	136   => 'User is not active',
	137   => 'Empty sender name',
	138   => 'Empty sender contact number',
	139   => 'Empty sender address',
	140   => 'Empty sender city',
	141   => 'Empty sender postcode',
	142   => 'Empty sender state',
	143   => 'Empty receiver name',
	144   => 'Empty receiver contact number',
	145   => 'Empty receiver address',
	146   => 'Empty receiver city',
	147   => 'Empty receiver postcode',
	148   => 'Empty receiver state',
	160   => 'No session param passed.',	
	162	  => 'Can\'t retrieved user session. Please login again.',
	170   => 'User is banned for review',
	180   => 'Unknown error. Could be connection problem or server down.',
	188	  => 'User param or API key param is missing',
	190	  => 'Invalid user',
	192	  => 'Wrong user key provided',
	
);

$config['trackingKey'] = array(
	'addOrder'       => 'New order is created ',
	'updateOrder'	 => 'Order details is updated ',
	'pickOrder' 	 => 'Order has been picked ',
	'addPosOrder'	 => 'New POS order is created ',
	'releaseOrder'	 => 'Order has been released ',
	'completeOrder'	 => 'Order has been dispatched ',
	'cancelOrder'       => 'Order has been cancelled ',
	'updatePosOrder' => 'POS order details is updated ',
);


//
//YesNo
//
$config['yesno'] = array(
	1=> 'Yes',
	2 => 'No',
);

//
//Function that skip session authentication
//
$config['skip_auth'] = array(
	'loginUser', 'registerUser','sendCodeForgotPassword','validateCode','changeNewPassword'
);
/* End of file config_api.php */
/* Location: ./application/config/config_api.php */
