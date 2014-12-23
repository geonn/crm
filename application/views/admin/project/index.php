<script>
	var page         = "<?= $page ?>";
	var searchstring = "<?= $search ?>";
	var sortby       = "<?= $sortby ?>";
	var astatus       = "<?= $status ?>";
	var queryString  = "<?= $this->config->item('admin_url') ?>/<?= $this->name ?>/get_list/";
	var queryParam   = page+"/"+sortby+"?q="+searchstring+"&status="+astatus;
  	get_list(queryParam);	 
  
	function get_list(queryParam){ 
		$.get(queryString+queryParam, function(data) {
			jQuery('#loading').hide();
			jQuery('#q').val(searchstring);
			jQuery('#status').val(astatus);
		  	jQuery('#the_list').html(data);
		  	
		  	if(sortby != ""){
		  		splitinfo = sortby.split("-");
		  		if(splitinfo[1] == '1'){
		  			jQuery('#'+splitinfo[0]+'_sortimg').html('<?= $this->config->item("icon_up") ?>');
		  		}else{
		  			jQuery('#'+splitinfo[0]+'_sortimg').html('<?= $this->config->item("icon_down") ?>');
		  		}	  		
		  	}
			});
	}
	
	function sorting(field,sort){
			sortby =field+"-"+sort;
			url= page+"/"+sortby+"?q="+searchstring+"&status="+astatus;
			get_list(url);
	}
</script>
<div class="headerTitle"><?= ucwords($this->name) ?> List </div>
<?= $template['partials']['message']; ?>
<div class='search_panel'>
	<div style="float:left;">
		<form action="<?= $this->config->item('admin_url') ?>/<?= $this->name ?>/index" method="get">	
			<?= form_dropdown('status', array(""=>"--All Status--")+$this->config->item('project_status'), set_value('status',isset($status) ? $status : '' ),' id="status"'); ?>					
							
		    <input name="q" id="q" type="text" value="<?= set_value('q',''); ?>" class="mystyles_textbox">
		   
		    <button type="submit" class="blue_button" value="Submit " >Filter</button>  
		</form>
	</div>
	<div style="float:right;">
		<?php 
			echo form_open($this->config->item('admin_url').'/'.$this->name.'/newd');
			$this->admin_model->generateAddButton($this->name);
		?> 
		</form>
	</div>
</div> 
<div id="loading" name="loading" align='center'><br/><br/><br/><?= $this->config->item("img_loading") ?><br/><br/></div>
<div id="the_list"></div> 