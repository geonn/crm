	<table class="bordered">
	<tbody>
		<tr> 
		
			<th style="width: 20%;"><a href="javascript:void(0)" onclick="sorting('name','<?= $new_sort ?>');">Template Name <span id="name_sortimg"></span></a></th>
			<th style="width: 15%;"><a href="javascript:void(0)" onclick="sorting('description','<?= $new_sort ?>');">Description <span id="description_sortimg"></span></a></th>
			<th style="width: 20%;"><a href="javascript:void(0)" onclick="sorting('category','<?= $new_sort ?>');">Category  <span id="category_sortimg"></span></a></th>
			<th style="width: 15%;"><a href="javascript:void(0)" onclick="sorting('created_by','<?= $new_sort ?>');">Created By<span id="created_by_sortimg"></span></a></th>
			<th style="width: 15%;">Viewable</th>		
			<th style="width: 5%;">Status</th>			
			<th style="width: 10%;">Action</th>
		</tr>
		
	<?php if(!empty($results)){
		foreach ($results as $row):
		 ?>		
    	<tr>
    	
			<td><strong><font color="green"><?= $row['name'];?></font></strong></td>
			<td><?= $row['description'];?></td>	
			<td><?= $row['c_con'];?></td>	
			<td><?= $row['creator'];?></td>	
			<td><?= $row['v_con'];?></td>
			<td><?php 
				 
					echo "<div style='text-align:center;'>".$this->config->item('icon_status'.$row['status']) ." </div>";
				?>
			</td>	
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