<!DOCTYPE html>
<html>
	<head>
		<?= $template['metadata']; ?>
		<?= $template['partials']['includes']; ?>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		<title><?= $template['title']; ?> | <?= $this->config->item('project_name') ?></title>
	
		<script type="text/javascript">
			idleTime = 0;
			var logout_url= "<?= $this->config->item('admin_url'); ?>/main/logout";
			
			jQuery(document).ready(function() {
				$('ul.sf-menu').superfish(); 
				
				//Increment the idle time counter every minute.
			    var idleInterval = setInterval("timerIncrement()",60000); // 1 minute
			
			    //Zero the idle timer on mouse movement.
			    $(this).mousemove(function (e) {
			        idleTime = 0;
			    });
			    $(this).keypress(function (e) {
			        idleTime = 0;
			    });
    			
    			 $('#scrollTop').click(function(){
				    $("html, body").animate({ scrollTop: 0 },  600);	
				    return false;
				 });
			});
			function timerIncrement() {
			    idleTime = idleTime + 1;
			    active_time = "<?= $this->config->item('auto_logout'); ?>";
			    active_time = parseInt(active_time);
			    if (idleTime >= parseInt(active_time)) { // 10 minutes
			      window.location = logout_url;
			    }
			}
	
			function confirmLogout(){
				$.confirm({
					'title'		: 'Logout Confirmation',
					'message'	: 'Are you sure want to logout?',
					'buttons'	: {
						'Yes'	: {
							'class'	: 'blue',
							'action': function(){
								noty({"text":"You has been logout successfully","layout":"center","type":"success","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":2000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
								jQuery(".sf-menu").html("");
								jQuery(".content").html("");
								setTimeout(function() {location.href=logout_url},2000);	 
							}
						},
						'No'	: {
							'class'	: 'gray',
							'action': function(){}	// Doesn't do anything						
						}
					}
				});		
			}
		</script>		
		<style>
			html {overflow-y:auto; }
		</style>
	</head>
	<body>
		
		<div id="header" class="gradient">
	    	<table width="100%">
				<tr>
					<td width="76px" style=""><a style="height:30px; display:block;" href="<?= $this->config->item('admin_url') ?>"> <?= $this->config->item('img_logo') ?></a></td>
					<td>&nbsp; &nbsp; &nbsp;  </td>
					<td align='right' valign='bottom' style=''>	
                    	<a style="border:none;" class='logoutbutton' href="javascript:void(0);" onclick="confirmLogout();">Logout</a>
						<a href="#"><?= $this->authenticate->admin_username(); ?></a>
					</td>
		
				</tr>

			</table>
	    </div>
 <ul class="sf-menu" style="margin:0;">
	    <?php
	    $roles = $this->user->get_memberrole();
	 
	  	if($this->nav){
	    	foreach($this->nav as $modul => $no){
	    		if($no > 0){
	    			echo "<li><a href='".$this->menu[$modul]['url']."'>". $this->menu[$modul]['name'] ."</a>";
	    			//print_pre($this->sub_menu[$modul]);
	    			echo '<ul class="sf-menu">';
	    			foreach($this->sub_menu[$modul] as $i => $hn){
	    				if($roles == "dispatcher" && $i == "Courier"){
	    					
	    					continue;
	    				}
	    					echo "<li><a href='".$hn."'>". ucwords($i) ."</a></li>";
	    			
	    				
	    			}
	    			echo '</ul></li>';
	    		}
	    		
	  	 	}
	  	}else{
	  		
	  	}
	    ?> 
	    </ul>
		<div id="container">
		<?php
			if($this->denied){
				echo PERMISSION_DENIED;
			}else{
				echo $template['body'];
			}
		?>
		</div>
	</body>
	
	<script type="text/javascript">
		$('div.success_message').delay(5000).slideUp(400);
	</script>		
	<?= $template['partials']['footer']; ?>
</html>