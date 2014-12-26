<table class="edit bordered">
	<tbody>	
	
		<tr>
			<td style="width: 140px;"  id='edit_title'>Project Name</td>
			<td><?= form_input('name', set_value('name',isset($form) ? $form['name'] : ''),'class="required" placeholder="Project Name" style="width:98%;"'); ?></td>			
		</tr>			
		<tr>
			<td style="width: 140px;"  id='edit_title'>Description</td>
			<td><?= form_input('description', set_value('description',isset($form) ? $form['description'] : ''),'class="required" placeholder="Description of project" style="width:98%;"'); ?></td>			
		</tr>	
		<tr>
			<td style="width: 140px;"  id='edit_title'>Address</td>
			<td><?= form_textarea('address', set_value('address',isset($form) ? $form['address'] : ''),'class="required" rows="3" placeholder="Address of project" style="width:98%;"'); ?></td>			
		</tr>	
		<tr>
			<td style="width: 140px;"  id='edit_title'>Postcode</td>
			<td><?= form_input('postcode', set_value('postcode',isset($form) ? $form['postcode'] : ''),'class="required" placeholder="Postcode of project" style="width:98%;"'); ?></td>			
		</tr>	
		<tr>
			<td style="width: 140px;"  id='edit_title'>State</td>
			<td><?= form_input('state', set_value('state',isset($form) ? $form['state'] : ''),'class="required" placeholder="State of project" style="width:98%;"'); ?></td>			
		</tr>	
		<tr>
			<td style="width: 140px;"  id='edit_title'>Status</td>
			<td><?= magic_radio_label('status', $this->config->item('project_status'), set_value('status',isset($form) ? $form['status'] : '')); ?></td>		
		</tr>
	</tbody>
</table>