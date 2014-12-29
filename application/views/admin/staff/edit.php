<div class="container_header">
	<div class="header_title">
		<a class="separator" href="<?= $this->config->item('admin_url') ?>">Home</a> 
		<a class="separator" href="<?= $this->config->item('admin_url').'/'.$this->name ?>"><?= ucwords($this->name) ?></a> Edit <?= ucwords($this->name) ?></div>
	<div style="clear:both"></div>
</div>

<div id="submenu">
	<ul>
    	<li><a href="javascript:void(0);" onclick="return $('#updateform').submit();">Update</a></li>
        <li><a href="<?php echo $this->config->item('admin_url')?>/<?= $this->name ?>/">Back</a></li>
    </ul>
</div>
<div id="the_list">
	<div class="error_message" style="display:none;"></div>
	<?= $template['partials']['message']; ?>
	<div class="header_title"><?= ucwords($this->name) ?> Profile</div>
	<?= form_open_multipart($this->config->item('admin_url').'/'.$this->name.'/update/'.$this->uri->segment(4),'id="updateform"'); ?>
    <?= $template['partials']['content']; ?>
    <?php $roles = $this->user->get_memberrole(); ?>
    <br/>
    <div class="header_title">Project Assignment</div>
        <table class="edit bordered">
            <tbody>	
                <tr>
                    <td style="width: 140px;"  id='edit_title'>Project Handle</td>
                    <td>
                        <?php
                    if(in_array($roles, array('founder','director'))){
                        echo form_dropdown('project', array("" => "None") + $this->project_model->getListAsMenu(), set_value('project',isset($form) ? $form['project'] : ''), ' style="width:20%;"');
                    }else{
                        $proj = $this->project_model->find_by($form['project']); 
                          echo  set_value('project',isset($form) ? $proj['name']: '');
                         echo form_hidden('project', set_value('project',isset($form) ? $form['project'] : ''));
                    }
                     ?>
                            
                    </td>		
                </tr>
            </tbody>
        </table>
    </form>
    <br/>
    <div align='center'>
    <button class="gold_button" onclick="location.href='<?=$this->config->item('admin_url')?>/<?= $this->name ?>/';">Back</button>
    <button type="submit" value="Submit"  class="green_button" id="submitformbutton">Update</button>  
    </div>
</div>
<script type="text/javascript" >	
	var queryString  = "<?= $this->config->item('admin_url') ?>/<?= $this->name ?>/";
	$('#submitformbutton').click(function() {
	 	var form_data = $('form').serialize();
		resetError();
		$.get(queryString+"update/" , form_data, function(data) { 
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
				noty({"text":"Staff successfully created ","layout":"center","type":"success","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":2000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
				setTimeout(function() {location.href=window.location.href=queryString;},1500);	 
			}		
					
		});
		return false;
	});
</script>