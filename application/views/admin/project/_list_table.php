	<table class="bordered">
	<tbody>
		<tr> 
		
			<th style="width: 100px;"><a href="javascript:void(0)" onclick="sorting('name','<?= $new_sort ?>');">Project Name <span id="name_sortimg"></span></a></th>
			<th style="width: 100px;"><a href="javascript:void(0)" onclick="sorting('description','<?= $new_sort ?>');">Description <span id="description_sortimg"></span></a></th>
			<th style="width: 120px;"><a href="javascript:void(0)" onclick="sorting('created_by','<?= $new_sort ?>');">Created By  <span id="created_by_sortimg"></span></a></th>
			<th style="width: 150px;"><a href="javascript:void(0)" onclick="sorting('state','<?= $new_sort ?>');">State<span id="state_sortimg"></span></a></th>
			<th style="width: 100px;"><a href="javascript:void(0)" onclick="sorting('status','<?= $new_sort ?>');">Status<span id="status_sortimg"></span></a></th>			
			<th style="width: 40px;">Action</th>
		</tr>
		
	<?php if(!empty($results)){
		foreach ($results as $row):
		 ?>		
    	<tr>
    	
			<td><strong><font color="green"><?= $row['name'];?></font></strong></td>
			<td><?= $row['description'];?></td>	 
			<td><?= $row['creator'];?></td>	
			<td><?= $row['state'];?></td>	
			<td><?= match($row['status'],$this->config->item('project_status'));?></td>			
			<td><?= $this->admin_model->generateEditButton($this->name,$row['id'],$this->name); ?></td>																
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