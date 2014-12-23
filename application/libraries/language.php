<?php
	//
	//Created by: Geo. All related to language function.
	//
	
	class Language{
		private $CI;
		private $locale;
			
			function __construct(){				
				$this->CI =& get_instance();	
				$this->CI->config->load('config');   
				$this->available = $this->CI->config->item('languages'); 
			}
			
			function getLanguage($language="",$define, $extra=array()){						
				//
				//	Check languague availability. Set language to default(en) if invalid language code.
				//
				if(!array_key_exists($language,$this->available)){		
					$language = "en";
				}
				
				//
				//	Get language file
				//
				require (APPPATH."/language/".$language.".php");
				
				if(isset($lang[$define])){
					if(!empty($extra)){
						foreach($extra as $term => $value){
							$lang[$define] = str_replace("{".$term."}", $value,$lang[$define]);
						}
					}

					return $lang[$define];
				}else{
					//
					// If variable didn't appear in language, then get from default language.
					//
					require (APPPATH."/language/en.php");
					return $lang[$define];						
				}	
			}	
			
}
?>