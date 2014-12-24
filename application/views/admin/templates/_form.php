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
		<li class="nav-one"><a id="a_ads" href="#info" class="current">Templates Info</a></li>
		<?php if( $module == "edit"){ ?>
			<li class="nav-two"><a id="a_item" href="#structure">Structure</a></li>
		<?php } ?>
    </ul>
    
     <div class="list-wrap">
		<ul id="info">
			<li>
				<table class="edit bordered">
					<tbody>	
						<tr>
							<td style="width: 140px;"  id='edit_title'>Template Name</td>
							<td><?= form_input('name', set_value('name',isset($form) ? $form['name'] : ''),'class="required" placeholder="Template Name" style="width:98%;"'); ?></td>			
						</tr>	
						<tr>
							<td style="width: 140px;"  id='edit_title'>Project</td>
							<td><?= form_dropdown('p_id',array("" => "None"), set_value('p_id',isset($form) ? $form['p_id'] : ''),'class="required" placeholder="Project ID" style="width:30%;"'); ?></td>			
						</tr>		
						<tr>
							<td style="width: 140px;"  id='edit_title'>Description</td>
							<td><?= form_input('description', set_value('description',isset($form) ? $form['description'] : ''),'class="required" placeholder="Template short description" style="width:98%;"'); ?></td>			
						</tr>	
						<tr>
							<td style="width: 140px;"  id='edit_title'>Show Index In Form</td>
							<td><?= magic_radio_label('isIndex', $this->config->item('yesno'), set_value('isIndex',isset($form) ? $form['isIndex'] : '')); ?></td>			
						</tr>
						<tr>
							<td style="width: 140px;"  id='edit_title'>Show Customer Form</td>
							<td><?= magic_radio_label('isCustomerForm', $this->config->item('yesno'), set_value('isCustomerForm',isset($form) ? $form['isCustomerForm'] : '')); ?></td>			
						</tr>
						<tr>
							<td style="width: 140px;"  id='edit_title'>Category</td>
							<td><?php
												$t_cate = $this->config->item('template_category');
												$template_cate = array();
												if(!empty($form['category'])){
													$template_cate = explode(',', $form['category']);
												}
												
												foreach($t_cate as $t => $cate){
													$isCheck = FALSE;
													if(in_array($t, $template_cate)){
														$isCheck = TRUE;
													}
													
													$data = array(
													    'name'       => 'category[]',
													    'id'         	 => $t,
													    'value'       => $t,
													    'checked'  => $isCheck,
													    'style'        => 'margin:5px',
													    );
													
													echo "<div>".form_checkbox($data) . $cate."</div>"; 
												}
								?></td>			
						</tr>			
					
						<tr>
							<td style="width: 140px;"  id='edit_title'>Roles Viewable</td>
							<td><?php
												$t_roles = $this->config->item('roles');
												$template_roles = array();
												if(!empty($form['viewable'])){
													$template_roles = explode(',', $form['viewable']);
												}
												foreach($t_roles as $r => $roles){
													$isRolesCheck = FALSE;
													if(in_array($r, $template_roles)){
														$isRolesCheck = TRUE;
													}
													
													$dataRoles = array(
													    'name'       => 'viewable[]',
													    'id'         	 => $r,
													    'value'       => $r,
													    'checked'  => $isRolesCheck,
													    'style'        => 'margin:5px',
													    );
													
													echo "<div>".form_checkbox($dataRoles) . $roles."</div>"; 
												}
								?></td>			
						</tr>		
						
						<tr>
							<td style="width: 140px;"  id='edit_title'>Status</td>
							<td><?= magic_radio_label('status', $this->config->item('publish_status'), set_value('status',isset($form) ? $form['status'] : '')); ?></td>		
						</tr>
						
					</tbody>
				</table>
			</li>
    	</ul>
    	
    	 <ul id="structure" class="hide">
			<li>
				<button class="fancybox blue_button" href="#inline1" title="Select question from CRM question pool">Add Question</button>
				<div id="template_question" style="padding-top:10px;	"></div>
			</li>
    	</ul>
    	<div id="inline1" style="width:100%;display: none;">
			
		</div>
    </div>
  </div>	

 