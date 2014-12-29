<div class="container_header">
	<div class="header_title">
		<a class="separator" href="<?= $this->config->item('admin_url') ?>">Home</a> <a class="separator" href="<?= $this->config->item('admin_url').'/'.$this->name ?>"><?= ucwords($this->name) ?></a> New <?= ucwords($this->name) ?></div>
	<div style="clear:both"></div>
</div>

<div id="submenu">
	<ul>
    	<li><a href="#" onclick="$('#newform').submit();">Create</a></li>
        <li><a href="<?php echo $this->config->item('admin_url')?>/<?= $this->name ?>/">Back</a></li>
    </ul>
</div>
<div id="the_list">
	<div class="error_message" style="display:none;"></div>
	<?= $template['partials']['message']; ?>
	<?= form_open_multipart($this->config->item('admin_url').'/'.$this->name.'/create','id="newform"'); ?>
    <?= $template['partials']['content']; ?>
    </form>
    <br/>
    <div align='center'>
    <button  class="gold_button" onclick="location.href='<?=$this->config->item('admin_url')?>/<?= $this->name ?>/';">Back</button>
    <button type="submit" class="green_button" value="Submit" class="submit" id="submitformbutton">Create</button>  
    </div>
</div>
<script type="text/javascript" >	
var queryString  = "<?= $this->config->item('admin_url') ?>/<?= $this->name ?>/";
$('#submitformbutton').click(function() {
	var form_data = $('form').serialize();
	resetError();
	$.get(queryString+"create/" , form_data, function(data) { 
		
		var obj = jQuery.parseJSON(data);
		 
		if(obj.status == "error"){
			$(".error_message").show();
			var eCode = obj.error_code ;
			$.each(eCode, function( index ,code) {
			  $("."+code).css('border-color','red'); 
			});
			
			var eData = obj.data ;
			 $(".error_message").html("<p> Please check for following error(s):</p>");
			$.each(eData, function( index ,errData) {
			  $(".error_message").append('<p> - '+errData+'</p>');
			});
			
		}else{
			noty({"text":"Staff successfully created ","layout":"center","type":"success","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":2000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
			setTimeout(function() {location.href=window.location.href=queryString;},1500);	 
		}		
				
	});
	return false;
  //$('#newform').submit();
});



</script>