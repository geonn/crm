	<table class="bordered">
	<tbody>
		<tr> 
		
			<th style="width: 20%;"><a href="javascript:void(0)" onclick="sorting('name','<?= $new_sort ?>');">Customer Name <span id="name_sortimg"></span></a></th>
			<th style="width: 15%;"><a href="javascript:void(0)" onclick="sorting('ic','<?= $new_sort ?>');">I/C <span id="ic_sortimg"></span></a></th>
			<th style="width: 20%;"><a href="javascript:void(0)" onclick="sorting('contact_mobile','<?= $new_sort ?>');">Mobile Number  <span id="contact_mobile_sortimg"></span></a></th>
			<th style="width: 15%;"><a href="javascript:void(0)" onclick="sorting('email','<?= $new_sort ?>');">Email<span id="email_sortimg"></span></a></th>
			<th style="width: 15%;"><a href="javascript:void(0)" onclick="sorting('created','<?= $new_sort ?>');">Created<span id="created_sortimg"></span></a></th>
			
			<th style="width: 10%;">Action</th>
		</tr>
		
	<?php if(!empty($results)){
		foreach ($results as $row):
		 ?>		
    	<tr>
    	
			<td><strong><font color="green"><?= $row['name'];?></font></strong></td>
			<td><?= $row['ic'];?></td>	
			<td><?= $row['contact_mobile'];?></td>	
			<td><?= $row['email'];?></td>	
			<td><?= date_convert($row['created'], 'full');?></td>
			 
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