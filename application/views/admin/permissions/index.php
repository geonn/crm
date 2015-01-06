<style>
	.content{
		padding-top:20px;	
	}
</style>
<!-- Extra CSS and JS to load -->
<script type="text/javascript" src="<?= $this->config->item('domain') ?>/public/javascripts/tab/organictabs.jquery.js"></script>
<script type="text/javascript" src="<?= $this->config->item('domain') ?>/public/javascripts/jquery/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?= $this->config->item('domain') ?>/public/javascripts/tab/style.css">
<link rel="stylesheet" type="text/css" href="<?= $this->config->item('domain') ?>/public/stylesheets/jquery.fancybox.css?v=2.1.5" media="screen" />
<div class="container_header">
	<div class="header_title">
		<a class="separator" href="<?= $this->config->item('admin_url') ?>">Home</a> 
		<a class="separator" href="<?= $this->config->item('admin_url').'/'.$this->name ?>"><?= ucwords($this->name) ?></a> Edit <?= ucwords($this->name) ?></div>
	<div style="clear:both"></div>
</div>

<div id="submenu">
	<ul>
    	<li><a href="javascript:void(0);" onclick="return $('#updateform').submit();">Update</a></li> 
    </ul>
</div>
<div id="the_list">
	<?= $template['partials']['message']; ?> 
	<div id="vasibletable">
				
	    <ul class="nav">
			<li class="nav-one"><a href="#founder" class="current">Founder</a></li>
			<li class="nav-two"><a href="#manager">Manager</a></li>
			<li class="nav-three"><a href="#admin">Admin</a></li>
			<li class="nav-four"><a href="#salesman">Salesman</a></li>
	    </ul>
		
	    <div class="list-wrap">
	    	<form action="<?= $this->config->item('admin_url') ?>/<?= $this->name ?>/updatePermission" method="get" id="updateform">	
		
			<ul id="founder" style="-webkit-column-count:2;">
				<li>
					<?php 
					$rl = "founder";
					foreach($menu[$rl] as $item => $per){
						echo  "<div style='font-size:14px;color:green;margin:5px;'>".$item . "</div><ul>";	
						
			    			foreach($this->option as $n => $opt){
			    				if($n == $per){
									$sub = array(
									    'name'        => $rl .'opt'.$item,
									    'id'          => $item.'opt'.$n,
									    'value'       => $n,
									    'checked'     => TRUE,
									    'style'       => 'margin:5px',
					    			);
			    				}else{
			    					$sub = array(
									    'name'        => $rl .'opt'.$item,
									    'id'          => $item.'opt'.$n,
									    'value'       => $n,
									     'style'       => 'margin:5px',
				    				);
			    				}
			    			
				    			echo '<div style="padding-left:20px;">'.form_radio($sub) . $opt . "</div>";	
			    			}
			    			echo '</ul>';
					}?>
					
				</li>
			</ul>
		 
			 <ul id="manager" class="hide" style="-webkit-column-count:2;">
				<li>
					<?php 
					$rl = "manager";
					foreach($menu[$rl] as $item => $per){
						echo  "<div style='font-size:14px;color:green;margin:5px;'>".$item . "</div><ul>";	
						
			    			foreach($this->option as $n => $opt){
			    				if($n == $per){
									$sub = array(
									    'name'        => $rl .'opt'.$item,
									    'id'          => $item.'opt'.$n,
									    'value'       => $n,
									    'checked'     => TRUE,
									    'style'       => 'margin:5px',
					    			);
			    				}else{
			    					$sub = array(
									    'name'        => $rl .'opt'.$item,
									    'id'          => $item.'opt'.$n,
									    'value'       => $n,
									     'style'       => 'margin:5px',
				    				);
			    				}
			    			
				    			echo '<div style="padding-left:20px;">'.form_radio($sub) . $opt . "</div>";	
			    			}
			    			echo '</ul>';
					}?>
				</li>
			 </ul>
			 
			<ul id="admin" class="hide" style="-webkit-column-count:2;">
				<li>
					<?php 
					$rl = "admin";
					foreach($menu[$rl] as $item => $per){
						echo  "<div style='font-size:14px;color:green;margin:5px;'>".$item . "</div><ul>";	
						
			    			foreach($this->option as $n => $opt){
			    				if($n == $per){
									$sub = array(
									    'name'        => $rl .'opt'.$item,
									    'id'          => $item.'opt'.$n,
									    'value'       => $n,
									    'checked'     => TRUE,
									    'style'       => 'margin:5px',
					    			);
			    				}else{
			    					$sub = array(
									    'name'        => $rl .'opt'.$item,
									    'id'          => $item.'opt'.$n,
									    'value'       => $n,
									     'style'       => 'margin:5px',
				    				);
			    				}
			    			
				    			echo '<div style="padding-left:20px;">'.form_radio($sub) . $opt . "</div>";	
			    			}
			    			echo '</ul>';
					}?>
				</li>
			 </ul>
			 
			  <ul id="salesman" class="hide" style="-webkit-column-count:2;">
				<li>
					<?php 
					$rl = "salesman";
					foreach($menu[$rl] as $item => $per){
						echo  "<div style='font-size:14px;color:green;margin:5px;'>".$item . "</div><ul>";	
						
			    			foreach($this->option as $n => $opt){
			    				if($n == $per){
									$sub = array(
									    'name'        => $rl .'opt'.$item,
									    'id'          => $item.'opt'.$n,
									    'value'       => $n,
									    'checked'     => TRUE,
									    'style'       => 'margin:5px',
					    			);
			    				}else{
			    					$sub = array(
									    'name'        => $rl .'opt'.$item,
									    'id'          => $item.'opt'.$n,
									    'value'       => $n,
									     'style'       => 'margin:5px',
				    				);
			    				}
			    			
				    			echo '<div style="padding-left:20px;">'.form_radio($sub) . $opt . "</div>";	
			    			}
			    			echo '</ul>';
					}?>
				</li>
			 </ul>
			
	    </div> <!-- END List Wrap -->
	 
	 </div> <!-- END Organic Tabs (Example One) -->
	 <div style="text-align:center;">
		 <?php $this->admin_model->generateUpdateButton('settings'); ?>   
	</div>
	  </form>
	   <script>
	        $(function() {
	            $("#vasibletable").organicTabs();
	        });
	  </script>
</div>