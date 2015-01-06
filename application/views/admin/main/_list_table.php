	<table class="edit bordered">
	<tbody>
		<tr> 
		
			<th style="width: 10%;"><a href="javascript:void(0)" onclick="sorting('id','<?= $new_sort ?>');">Case ID <span id="id_sortimg"></span></a></th>
			<th style="width: 10%;"><a href="javascript:void(0)" onclick="sorting('name','<?= $new_sort ?>');">Record to change<span id="name_sortimg"></span></a></th>
			<th style="width: 10%;"><a href="javascript:void(0)" onclick="sorting('module','<?= $new_sort ?>');">Module  <span id="module_sortimg"></span></a></th>
			<th style="width: 25%;"><a href="javascript:void(0)" onclick="sorting('remark','<?= $new_sort ?>');">Remark<span id="remark_sortimg"></span></a></th>
			<th style="width: 20%;"><a href="javascript:void(0)" onclick="sorting('created','<?= $new_sort ?>');">Date<span id="created_sortimg"></span></a></th>
			<th style="width: 10%;"><a href="javascript:void(0)" onclick="sorting('status','<?= $new_sort ?>');">Status<span id="status_sortimg"></span></a></th>
			 <th style="width: 15%;">Action</th>
			    
		</tr>
		
	<?php if(!empty($results)){
		foreach ($results as $row):
		 ?>		
    	<tr>
    	
			<td>#<?= $row['id'] ?></td>
			<td><?= $row['name'];?></td>	
			<td><?= $row['module'];?></td>	
			<td><?= $row['remark'];?></td>	
			<td><?= date_convert($row['created'], 'full');?></td> 			
			<td><?= match($row['status'], $this->config->item('case_status'))?></td>		
			<td><?= $this->admin_model->generateDetailsButton($this->name,$row['id'],'approval'); ?></td>										
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