  <?php
	    $roles = $this->user->get_memberrole();
	 
	  	if($this->nav){
	    	foreach($this->nav as $modul => $no){
	    		if($no > 0){
	    			echo "<div style='float:left;padding:10px; margin:10px;width:25%;border:1px black solid;' onClick='return goTo(\"". $this->menu[$modul]['url'] ."\")'><a href='".$this->menu[$modul]['url']."'>". $this->menu[$modul]['name'] ."</a></div>";
	    			//print_pre($this->sub_menu[$modul]);
	    	
	    		}
	    		
	  	 	}
	  	}else{
	  		
	  	}
?>

<script>
		function goTo(mod){
			window.location.href = mod;
		}
</script>