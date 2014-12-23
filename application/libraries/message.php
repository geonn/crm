<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Message:: a library for giving feedback to the user
 *
 * @author  Adam Jackett
 * @url http://www.darkhousemedia.com/
 * @version 2.1
 */

class Message {
    
    var $CI;
    var $messages = array();
    var $wrapper = array('', '');
	var $prefix = '';
	var $suffix = '';	

	function __construct() {
        $this->CI =& get_instance();        
        $this->CI->load->library('session');       
        if($this->CI->session->flashdata('_messages')) $this->messages = $this->CI->session->flashdata('_messages');
        if(isset($config['wrapper'])) $this->wrapper = $config['wrapper'];
    }
    
    function set($message, $type, $flash=FALSE, $group=FALSE){
        if(!is_array($message)) $message = array($message);
        foreach($message as $msg){
            $obj = new stdClass();
            $obj->message = $msg;
            $obj->type = $type;
            $obj->flash = $flash;
            $obj->group = $group;
            $this->messages[] = $obj;
        }
        
        $flash_messages = array();
        foreach($this->messages as $msg){
            if($msg->flash) $flash_messages[] = $msg;
        }		
        if(count($flash_messages)) $this->CI->session->set_flashdata('_messages', $flash_messages);
    }
    
    function get($type=FALSE, $group=FALSE){
        $output = array();
        if(count($this->messages)){            
            foreach($this->messages as $msg){
                if($type !== FALSE){
                    $output[] = $msg->message;
                } else {
                    if(!isset($output[$msg->type])) $output[$msg->type] = array();
                    $output[$msg->type][] = $msg->message;
                }
            }
        }
        return $output;
    }
    
    function display($group=FALSE, $wrapper=FALSE){

        if(count($this->messages)){
            $output = $this->get(FALSE, $group);
            echo ($wrapper !== FALSE ? $wrapper[0] : $this->wrapper[0])."\r\n";
            foreach($output as $type => $messages){
                echo '<div class="'.$type.'_message">'."\r\n";
                foreach($messages as $msg){
                    echo '<p>'.$msg.'</p>'."\r\n";
                }
                echo '</div>'."\r\n";
            }
            echo ($wrapper !== FALSE ? $wrapper[1] : $this->wrapper[1])."\r\n";
        }        
				
		// Merge error message together
		if (($OBJ =& _get_validation_object()))
		{
			$error_string = $OBJ->error_string($this->prefix, $this->suffix);
			if (!empty($error_string)) {
				// <div style='float:right'><a href='#' onclick='jQuery('.error_message').hide();return false;'>Close</a></div>
				echo '<div class="error_message">'.$OBJ->error_string($this->prefix, $this->suffix)."</div>";
			}
		}		
    }

}
