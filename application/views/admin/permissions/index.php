<style>
	.content{
		padding-top:20px;	
	}
</style>

<div id="vasibletable">
			
    <ul class="nav">
		<li class="nav-one"><a href="#admin" class="current">Administrator</a></li>
		<li class="nav-two"><a href="#dispatcher">Dispatcher</a></li>
		<li class="nav-three"><a href="#dealer">Dealer</a></li>
		<li class="nav-four"><a href="#staff">Staff</a></li>
    </ul>
	
    <div class="list-wrap">
    	<form action="<?= $this->config->item('admin_url') ?>/<?= $this->name ?>/updatePermission" method="get">	
	
		<ul id="admin" style="-webkit-column-count:2;">
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
	 
		 <ul id="dispatcher" class="hide" style="-webkit-column-count:2;">
			<li>
				<?php 
				$rl = "dispatcher";
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
		 
		<ul id="dealer" class="hide" style="-webkit-column-count:2;">
			<li>
				<?php 
				$rl = "dealer";
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
		 
		  <ul id="staff" class="hide" style="-webkit-column-count:2;">
			<li>
				<?php 
				$rl = "staff";
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
 <?php $this->admin_model->generateUpdateButton('admin'); ?>   
  </form>
   <script>
        $(function() {
            $("#vasibletable").organicTabs();
        });
  </script>