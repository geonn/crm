	<table class="bordered">
	<tbody>
		<tr> 
		
			<th style="width: 30%;"><a href="javascript:void(0)" onclick="sorting('question','<?= $new_sort ?>');">Question <span id="question_sortimg"></span></a></th>
			<th style="width: 15%;"><a href="javascript:void(0)" onclick="sorting('tag','<?= $new_sort ?>');">Tag <span id="tag_sortimg"></span></a></th>
			<th style="width: 15%;"><a href="javascript:void(0)" onclick="sorting('type','<?= $new_sort ?>');">Type  <span id="type_sortimg"></span></a></th>
			<th style="width: 15%;"><a href="javascript:void(0)" onclick="sorting('created_by','<?= $new_sort ?>');">Created By <span id="created_by_sortimg"></span></a></th> 
			<th style="width: 15%;">Used In</th>
			<th style="width: 10%;">Action</th>
		</tr>
		
	<?php if(!empty($results)){
		foreach ($results as $row):
		 ?>		
    	<tr>
    	
			<td><strong><font color="green"><?= $row['question'];?></font></strong></td>
			<td><?= $row['tag'];?></td>	
			<td><?= match($row['type'], $this->config->item('question_type'))?></td>	
			<td><?= $row['creator'] ?></td>	 	
			<td></td>	 	
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