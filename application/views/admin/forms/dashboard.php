  <?php
	    $roles = $this->user->get_memberrole();
	 
	  	if($this->nav){
	    	foreach($this->nav as $modul => $no){
	    		if($no > 0){
	    			echo "<div class='dashboard_button'><a href='".$this->menu[$modul]['url']."'>". $this->menu[$modul]['name'] ."</a></div>";
	    			//print_pre($this->sub_menu[$modul]);
	    	
	    		}
	    		
	  	 	}
	  	}else{
	  		
	  	}
	    ?>