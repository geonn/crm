<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/** System user and key**/
define('API_USER', 'webadmin');
define('API_KEY' , '981bce3f4b506c6eb5473debb3275c27');

/** User **/
define('NO_USER'       , 'no user');
define('EMPTY_USERID'  , 'no user ID');
define('EMPTY_USERNAME', 'empty username');
define('EMPTY_PASSWORD', 'empty password');
define('EMPTY_EMAIL'   , 'empty user email');
define('INVALID_EMAIL' , 'invalid email');
define('INVALID_DOB'   , 'invalid dob');
define('DUPLICATE'     , 'duplicate');
define('PWD_MUST_SAME' , 'both password must same');

/** Images **/
define('IMAGE'        , 'Image');
define('CAPTION'      , 'Caption');
define('IMG_CAPTION'  , 'Attachment caption');
define('IMAGE_PATH'   , 'Attachment Path');
define('NO_IMG_UPL'   , 'No attachment upload yet');
define('CAPTION_TITLE', 'Update Project Image Caption');
define('CAPTION_DESC' , 'Please fill in the caption of the images');

define('NO_RESULT'          , 'no result');
define('EMPTY_STATUS'       , 'empty status');
define('PERMISSION_DENIED'  , 'You don\'t have permission to view this page.');
/* End of file constants.php */
/* Location: ./application/config/constants.php */