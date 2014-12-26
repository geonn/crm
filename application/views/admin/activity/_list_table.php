	<table class="edit bordered">
	<tbody>
		<tr> 
		
			<th style="width: 20%;"><a href="javascript:void(0)" onclick="sorting('name','<?= $new_sort ?>');">Staff <span id="name_sortimg"></span></a></th>
			<th style="width: 15%;"><a href="javascript:void(0)" onclick="sorting('action','<?= $new_sort ?>');">Action<span id="action_sortimg"></span></a></th>
			<th style="width: 15%;"><a href="javascript:void(0)" onclick="sorting('module','<?= $new_sort ?>');">Module  <span id="module_sortimg"></span></a></th>
			<th style="width: 30%;"><a href="javascript:void(0)" onclick="sorting('log','<?= $new_sort ?>');">Remark<span id="log_sortimg"></span></a></th>
			<th style="width: 20%;"><a href="javascript:void(0)" onclick="sorting('created','<?= $new_sort ?>');">Date<span id="created_sortimg"></span></a></th>
			  
		</tr>
		
	<?php if(!empty($results)){
		foreach ($results as $row):
		 ?>		
    	<tr>
    	
			<td><strong><font color="green"><?= $this->users_model->getUserFullNameById($row['u_id']);?></font></strong></td>
			<td><?= $row['action'];?></td>	
			<td><?= $row['module'];?></td>	
			<td><?= $row['log'];?></td>	
			<td><?= date_convert($row['created'], 'full');?></td> 												
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