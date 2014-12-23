	<table class="bordered">
	<tbody>
		<tr> 
		
			<th style="width: 100px;"><a href="javascript:void(0)" onclick="sorting('fullname','<?= $new_sort ?>');">Full Name <span id="fullname_sortimg"></span></a></th>
			<th style="width: 120px;"><a href="javascript:void(0)" onclick="sorting('email','<?= $new_sort ?>');">Email  <span id="email_sortimg"></span></a></th>
			<th style="width: 100px;"><a href="javascript:void(0)" onclick="sorting('mobile','<?= $new_sort ?>');">Mobile <span id="mobile_sortimg"></span></a></th>
			<th style="width: 150px;"><a href="javascript:void(0)" onclick="sorting('last_login','<?= $new_sort ?>');">Last Login <span id="last_login_sortimg"></span></a></th>
			<th style="width: 100px;"><a href="javascript:void(0)" onclick="sorting('status','<?= $new_sort ?>');">Status<span id="status_sortimg"></span></a></th>			
			<th style="width: 40px;">Action</th>
		</tr>
		
	<?php if(!empty($results)){
		foreach ($results as $row):
		 ?>		
    	<tr>
    	
			<td><strong><font color="green"><?= $row['fullname'];?></font></strong></td>
			<td><?= $row['email'];?></td>	
			<td><?= $row['mobile'];?></td>	
			<td><?= date_convert($row['last_login'],'full');?></td>	
			<td><?= match($row['status'],$this->account_status);?></td>			
			<td><?= $this->admin_model->generateEditButton($this->name,$row['u_id'],$this->name); ?></td>																
		</tr>
	<?php endforeach; ?>		
	
		<?php 	}else{ ?>
			<tr><td colspan="5" ><div align='center'>No result found</div><td></tr>
		<?php  } ?>		
	</tbody>	
</table>	

<div class='pagination'>
	<?= $this->pagination->create_links($this->uri->segment(4)); ?>	
</div>
<br/><br/><br/>