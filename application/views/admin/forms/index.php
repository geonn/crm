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
<div class="container_header">
	<div class="header_title"><a class="separator" href="<?= $this->config->item('domain') ?>">Home</a> <?= ucwords($this->name) ?> List</div>
        <div class='search_panel' style="float: left;">
            <div style="float:left; padding-left:10px;">
            <form action="<?= $this->config->item('admin_url') ?>/<?= $this->name ?>/index" method="get">	
                <?= form_dropdown('status', array(""=>"--All Status--")+$this->account_status, set_value('status',isset($status) ? $status : '' ),' id="status"'); ?>					
                                
                <input name="q" id="q" type="text" value="<?= set_value('q',''); ?>" class="mystyles_textbox">
               
                <button type="submit" class="blue_button" value="Submit " >Filter</button>  
            </form>
        </div>
        <div style="float:right;">
            <?php 
                //echo form_open($this->config->item('admin_url').'/'.$this->name.'/newd');
                //$this->admin_model->generateAddButton($this->name);
            ?> 
            </form>
        </div>
    	<div style="clear:both"></div>
    </div>
    <div style="clear:both"></div>
</div>
<?= $template['partials']['message']; ?>
<div id="submenu">
	<ul>
    	<!--<li><a href="<?php echo $this->config->item('admin_url').'/'.$this->name.'/newd'?>">Add New Forms</a></li>-->
        <li><a href="<?php echo $this->config->item('admin_url').'/'?>">Back</a></li>
    </ul>
<div id="loading" name="loading" align='center'><br/><br/><br/><?= $this->config->item("img_loading") ?><br/><br/></div>
<div id="the_list"></div>
<script>
		$('select#status').selectmenu({width: "160px"});
		
</script>


