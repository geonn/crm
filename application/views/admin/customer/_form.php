<script>
	var queryString  = "<?= $this->config->item('admin_url') ?>";
	var t_id ="<?= isset($form['id']) ? $form['id'] : "" ?>";
	$(function() {
		$("#vasibletable").organicTabs();
		$('.fancybox').fancybox();
		getQuestionPools(t_id);
		getTemplateQuestion(t_id);
	});
	
	function getTemplateQuestion(t_id){
		$.get(queryString+"/question/getTemplateQuestion/"+t_id, function(data) {
			jQuery('#template_question').html(data);
		});	
	}
	
	function getQuestionPools(t_id){
		

		$.get(queryString+"/question/getQuestionPools/"+t_id, function(data) { 
			jQuery('#inline1').html(data);
		});	
	}
</script>
<div id="vasibletable" >
	<input type='hidden' id="id" value="<?= isset($form['id']) ? $form['id'] : "" ?>"/>		
	
    <ul class="nav">
		<li class="nav-one"><a id="a_ads" href="#info" class="current">Customer Info</a></li>
		<?php if( $module == "edit"){ ?>
			<li class="nav-two"><a id="a_item" href="#structure">Survey History</a></li>
		<?php } ?>
    </ul>
    
     <div class="list-wrap">
		<ul id="info">
			<li> 
				<table class="edit">
					<tbody>	
						<tr>
							<td style="width: 140px;"  id='edit_title'>Full Name</td>
							<td>	<?=  form_input('name',set_value('name',isset($form) ? $form['name'] : ''),'class="required" placeholder="Please fill in customer name" style="width:50%;"') ?></td>			
						</tr>	
						<tr>
							<td style="width: 140px;"  id='edit_title'>I/C</td>
							<td><?=  form_input('ic', set_value('ic',isset($form) ? $form['ic'] : ''),'class="required" placeholder="Please fill in identity card number" style="width:50%;"') ?></td>			
						</tr>		
						<tr>
							<td style="width: 140px;"  id='edit_title'>Email</td>
							<td><?=  form_input('email',set_value('email',isset($form) ? $form['email'] : ''),'class="required" placeholder="Please fill in email address" style="width:50%;"') ?></td>			
						</tr>	
						<tr>
							<td style="width: 140px;"  id='edit_title'>Contact Home</td>
							<td><?=  form_input('contact_home', set_value('contact_home',isset($form) ? $form['contact_home'] : ''),'class="required" placeholder="Please fill in home contact number" style="width:50%;"') ?></td>			
						</tr>
						<tr>
							<td style="width: 140px;"  id='edit_title'>Contact Mobile</td>
							<td><?=  form_input('contact_mobile', set_value('contact_mobile',isset($form) ? $form['contact_mobile'] : ''),'class="required" placeholder="Please fill in mobile contact number" style="width:50%;"') ?></td>			
						</tr>
					 
						<tr>
							<td style="width: 140px;"  id='edit_title'>Contact Office</td>
							<td><?=  form_input('contact_office', set_value('contact_office',isset($form) ? $form['contact_office'] : ''),'class="required" placeholder="Please fill in office contact number" style="width:50%;"') ?></td>		
						</tr>
						
						<tr>
							<td style="width: 140px;"  id='edit_title'>Age</td>
							<td><?=  form_input('age',set_value('age',isset($form) ? $form['age'] : ''),'class="required" placeholder="Please fill in customer age" style="width:50%;"') ?></td>		
						</tr>
						
						<tr>
							<td style="width: 140px;"  id='edit_title'>Address(Mail)</td>
							<td><textarea name="mail_address" row="4" placeholder="Mailing address" ><?= set_value('mail_address',isset($form) ? $form['mail_address'] : '') ?></textarea></td>		
						</tr>
						
						<tr>
							<td style="width: 140px;"  id='edit_title'>Address(Home)</td>
							<td><textarea name="home_address" row="4" placeholder="Mailing address"><?= set_value('home_address',isset($form) ? $form['home_address'] : '') ?></textarea></td>		
						</tr>
					</tbody>
				</table>
			</li>
    	</ul>
    	
    	 <ul id="structure" class="hide">
			<li>
				This page is under construction
			</li>
    	</ul>
     
    </div>
  </div>	

 