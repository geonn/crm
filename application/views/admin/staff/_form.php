
<table class="edit bordered">
	<tbody>	
		<tr>
			<td style="width: 140px;"  id='edit_title'>User Name <span class="red_dot">*</span></td>
			<td>
				
				<?php 
					$roles = $this->user->get_memberrole();
					if($module == "edit") {
						 echo set_value('username',isset($form) ? $form['username'] : '');
						 echo form_hidden('u_id', set_value('u_id',isset($form) ? $form['u_id'] : ''));
						 echo form_hidden('username', set_value('username',isset($form) ? $form['username'] : ''),'class="required" placeholder="Username" style="width:98%;"');
						 echo form_hidden('password', set_value('password',isset($form) ? $form['password'] : ''));
				 	 	echo form_hidden('password2', set_value('password',isset($form) ? $form['password'] : ''));
				 	}else{
				 		echo form_input('username', set_value('username',isset($form) ? $form['username'] : ''),'class="required 103" placeholder="Username" style="width:98%;"'); 
				 	}
				  ?>
				
				</td>		
		</tr>
		<tr>
			<td style="width: 140px;"  id='edit_title'>Fullname <span class="red_dot">*</span></td>
			<td><?= form_input('fullname', set_value('fullname',isset($form) ? $form['fullname'] : ''),'class="required 104" placeholder="User Full Name" style="width:98%;"'); ?></td>			
		</tr>			
		<?php if($module != "edit") { ?>
			<tr>
				<td style="width: 140px;"  id='edit_title'>Password <span class="red_dot">*</span></td>
				<td><?= form_password('password', set_value('password2',isset($form) ? $form['password'] : ''),'class="required 106 107" placeholder="Password" style="width:98%;"'); ?></td>			
			</tr> 
		
			<tr>
				<td style="width: 140px;"  id='edit_title'>Confirm Password <span class="red_dot">*</span></td>
				<td><?= form_password('password2', set_value('password2',isset($form) ? $form['password2'] : ''),'class="required 106 107" placeholder="Confirm Password" style="width:98%;"'); ?></td>			
			</tr> 
		<?php } ?>
		<tr>
			<td style="width: 140px;"  id='edit_title'>Email <span class="red_dot">*</span></td>
			<td><?= form_input('email', set_value('email',isset($form) ? $form['email'] : ''),'class="required 105 108" placeholder="Email Address" style="width:98%;"'); ?></td>			
		</tr>			
		<tr>
			<td style="width: 140px;"  id='edit_title'>Mobile <span class="red_dot">*</span></td>
			<td><?= form_input('mobile', set_value('mobile',isset($form) ? $form['mobile'] : ''),'class="required 109" placeholder="Mobile No." style="width:98%;"'); ?></td>			
		</tr>	
	 	<tr>
			<td style="width: 140px;"  id='edit_title'>Position <span class="red_dot">*</span></td>
			<td>
				<?php 
				if(in_array($roles, array('founder','director'))){
					echo form_dropdown('roles', $this->config->item('roles'), set_value('roles',isset($form) ? $form['roles'] : ''), ' style="width:20%;"'); 
				}else{
					if($roles == "manager"){
						echo form_dropdown('roles', $this->config->item('manager_roles_access'), set_value('roles',isset($form) ? $form['roles'] : ''), ' style="width:20%;"'); 
					}else{
						echo  set_value('roles',isset($form) ? ucwords($form['roles']) : '');
					 	echo form_hidden('roles', set_value('roles',isset($form) ? $form['roles'] : ''));
					}
				}
				 ?>
				 </td>		
		</tr>
		<tr>
			<td style="width: 140px;"  id='edit_title'>Status  <span class="red_dot">*</span></td>
			<td>
				<?php
				if(in_array($roles, array('founder','director','manager'))){
					echo magic_radio_label('status', $this->config->item('account_status'), set_value('status',isset($form) ? $form['status'] : ''));
				}else{
					  echo  set_value('status',isset($form) ? match($form['status'], $this->config->item('account_status')) : '');
					 echo form_hidden('status', set_value('status',isset($form) ? $form['status'] : ''));
				}
				 ?> </td>		
		</tr>
			
		
	</tbody>
</table>
  