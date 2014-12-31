<script>
		function goToForm(t_id){
			window.location.href = "<?= $this->config->item('admin_url') ?>/<?= $this->name ?>/viewForm/"+t_id;
		}
	
</script>
<table class="bordered">
	<tbody>
		<tr> 
		
			<th style="width: 25%;">Template Name</th>
			<th style="width: 25%;">Description </th>
			<th style="width: 25%;">Category </th>
			
			<th style="width: 25%;">Action</th>
		</tr>
		
	<?php if(!empty($results)){
		foreach ($results as $row):
		 ?>		
    	<tr>
    	
			<td><strong><font color="green"><?= $row['name'];?></font></strong></td>
			<td><?= $row['description'];?></td>	
			<td><?= $row['c_con'];?></td>	
			
			<td><button type="button" class="blue_button" value="Submit " onClick="return goToForm(<?= $row['id'] ?>);" >Enter Form</button>   </td>																
		</tr>
	<?php endforeach; ?>		
	
		<?php 	}else{ ?>
			<tr><td colspan="4" ><div align='center'>No result found</div></td></tr>
		<?php  } ?>		
	</tbody>	
</table>	

<div class='pagination'>
	<?= $this->pagination->create_links($this->uri->segment(4)); ?>	
</div>
<br/><br/><br/>