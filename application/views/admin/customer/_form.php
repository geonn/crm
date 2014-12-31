<script>
	var queryString  = "<?= $this->config->item('admin_url') ?>";
	var t_id ="<?= isset($form['id']) ? $form['id'] : "" ?>";
	$(function() {
		$("#vasibletable").organicTabs();
		$('.fancybox').fancybox({'width':400,'autoSize' : false});
	 
	});
	
	function viewForm(t_id,rf_id){ 
		$.get(queryString+"/forms/dynamicForm/"+t_id+"/"+rf_id, function(data) {
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
				<table class="edit bordered">
					<tbody>	
						<tr>
							<td style="width: 140px;"  id='edit_title'>Full Name</td>
							<td>	<?=  form_input('name',set_value('name',isset($form) ? $form['name'] : ''),'class="required" placeholder="Please fill in customer name" style="width:50%;"') ?></td>			
						</tr>	
						<tr>
							<td style="width: 140px;"  id='edit_title'>Silver card serial number</td>
							<td><?=  form_input('serial', set_value('serial',isset($form) ? $form['serial'] : ''),'class="required" placeholder="Please fill in silver card serial number" style="width:50%;"') ?></td>			
						</tr>
						<tr>
							<td style="width: 140px;"  id='edit_title'>I/C</td>
							<td><?=  form_input('ic', set_value('ic',isset($form) ? $form['ic'] : ''),'class="required phone_number" placeholder="Please fill in identity card number" style="width:50%;"') ?></td>			
						</tr>		
						<tr>
							<td style="width: 140px;"  id='edit_title'>Email</td>
							<td><?=  form_input('email',set_value('email',isset($form) ? $form['email'] : ''),'class="required" placeholder="Please fill in email address" style="width:50%;"') ?></td>			
						</tr>	
						<tr>
							<td style="width: 140px;"  id='edit_title'>Contact Home</td>
							<td><?=  form_input('contact_home', set_value('contact_home',isset($form) ? $form['contact_home'] : ''),'class="required phone_number" placeholder="Please fill in home contact number" style="width:50%;"') ?></td>			
						</tr>
						<tr>
							<td style="width: 140px;"  id='edit_title'>Contact Mobile</td>
							<td><?=  form_input('contact_mobile', set_value('contact_mobile',isset($form) ? $form['contact_mobile'] : ''),'class="required phone_number" placeholder="Please fill in mobile contact number" style="width:50%;"') ?></td>			
						</tr>
					 
						<tr>
							<td style="width: 140px;"  id='edit_title'>Contact Office</td>
							<td><?=  form_input('contact_office', set_value('contact_office',isset($form) ? $form['contact_office'] : ''),'class="required phone_number" placeholder="Please fill in office contact number" style="width:50%;"') ?></td>		
						</tr>
						
						<tr>
							<td style="width: 140px;"  id='edit_title'>Age</td>
							<td><?=  form_input('age',set_value('age',isset($form) ? $form['age'] : ''),'class="required num_only" placeholder="Please fill in customer age" style="width:50%;"') ?></td>		
						</tr>
						
						<tr>
							<td style="width: 140px;"  id='edit_title'>Address(Mail)</td>
							<td><textarea name="mail_address" rows="4" style="width:50%;" placeholder="Mailing address" ><?= set_value('mail_address',isset($form) ? $form['mail_address'] : '') ?></textarea></td>		
						</tr>
						
						<tr>
							<td style="width: 140px;"  id='edit_title'>Address(Home)</td>
							<td><textarea name="home_address" rows="4" style="width:50%;" placeholder="Home address"><?= set_value('home_address',isset($form) ? $form['home_address'] : '') ?></textarea></td>		
						</tr>
					</tbody>
				</table>
			</li>
    	</ul>
    	
    	 <ul id="structure" class="hide">
			<li>
				<table class="bordered">
					<tbody>
						<tr> 
						
							<th style="width: 20%;"> Form Name  </th>
							<th style="width: 20%;"> Filled By  </th>
							<th style="width: 20%;">  Filled Date   </th>
							<th style="width: 20%;"> Total Question  </th>
							<th style="width: 20%;">Action</th>
						</tr>
						
					<?php if(!empty($survey)){ 
						foreach ($survey['data'] as $k => $row):
						 ?>		
				    	<tr>
				    	
							<td><strong><font color="green"><?= $row['name'];?></font></strong></td>
							<td><?= $row['filled_by'];?></td>	
							
							<td><?= date_convert($row['filled_date'],'ori');?></td>
							<td><?= $row['total_question'];?></td>	
							<td><button class="fancybox blue_button" href="#inline1" onClick="viewForm('<?= $row['t_id'] ?>','<?= $row['id'] ?>')" title="View customer survey form"> View Survey</button>
								  </td>																
						</tr>
					<?php endforeach; ?>		
					
						<?php 	}else{ ?>
							<tr><td colspan="4" ><div align='center'>No result found</div></td></tr>
						<?php  } ?>		
					</tbody>	
				</table>	
				
			</li>
    	</ul>
     <div id="inline1" style="width:100%;display: none;">
					Loading...
				</div>
    </div>
  </div>	

 