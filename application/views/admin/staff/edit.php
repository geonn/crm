<div class="container_header">
	<div class="header_title">
		<a class="separator" href="<?= $this->config->item('admin_url') ?>">Home</a> 
		<?php if($owner == "1") { ?>
			Edit My Account
		<?php }else{ ?>	
			<a class="separator" href="<?= $this->config->item('admin_url').'/'.$this->name ?>"><?= ucwords($this->name) ?></a> Edit <?= ucwords($this->name) ?> 
		<?php }  ?>
	</div>	
	<div style="clear:both"></div>
</div>

<div id="submenu">
	<ul>
    	<li><a href="javascript:void(0);" onclick="return $('#updateform').submit();">Update</a></li>
       
        <?php if($owner == "0") { ?>
			 <li><a href="<?php echo $this->config->item('admin_url')?>/<?= $this->name ?>/">Back</a></li>
		<?php }  ?>
    </ul>
</div>
<div id="the_list">
	<div class="error_message" style="display:none;"></div>
	<?= $template['partials']['message']; ?>
	<div class="header_title" style="border:0;"><?= ucwords($this->name) ?> Profile</div>
	<?= form_open_multipart($this->config->item('admin_url').'/'.$this->name.'/update/'.$this->uri->segment(4),'id="updateform"'); ?>
    <?= $template['partials']['content']; ?>
    <?php $roles = $this->user->get_memberrole(); ?>
    <br/>
    
    <div id="user_project"></div>
   	<br./>
	<div class="header_title" style="border:0;">Remark for updates</div>
    <table class="edit bordered">
		<tbody>	
			<tr>
				<td style="width: 140px;"  id='edit_title'>Remark <span class="red_dot">*</span></td>
				<td><textarea name="remark" id="remark" rows="4" style="width:50%;" placeholder="Remark of changes" ></textarea></td>			
			</tr>	
		</tbody>
	</table>
    </form>
    <br/>
    <div align='center'>
    <button id="backbutton"  >Back</button>
    <button type="submit" value="Submit"  class="green_button" id="submitformbutton">Update</button>  
    </div>
</div>
<script type="text/javascript" >	
	var queryString  = "<?= $this->config->item('admin_url') ?>/<?= $this->name ?>/";
	var role = "<?= $roles ?>";
	var owner = "<?= $owner ?>";
	$('#submitformbutton').click(function() {
		$('#remark').css('border','');
	 	var form_data = $('form').serialize();
	 	var remark = $('#remark').val(); 
	 	if(remark.length <= 3){
	 		alert("The 'Remark' should more than 3 words.");
	 		$('#remark').css('border','1px solid #ff0000');
	 		return false;
	 	}  
		resetError();
		$.get(queryString+"update/" , form_data+"&owner="+owner, function(data) { 
			console.log(data);
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
				if(role != "founder" && owner == "0"){
					noty({"text":"Your request will sent to founder for approval ","layout":"center","type":"success","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":2000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
				}else{
					noty({"text":"Staff successfully updated ","layout":"center","type":"success","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":2000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
				}
				
				if(owner == "0"){
					setTimeout(function() {location.href=window.location.href=queryString;},1500);	 
				}
				
			}		
					
		});
		return false;
	});
	
	function get_user_project(){ 
		$.get(queryString+"getUserProject/<?=  $form['u_id'] ?>", function(data) { 
		  	jQuery('#user_project').html(data);
		
		});
	}
	
	$('#backbutton').click(function(){
		location.href='<?=$this->config->item('admin_url')?>/<?= $this->name ?>/';
		return false;
	});
	
	$(function(){
			get_user_project();
	});
</script>