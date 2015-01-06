<script>
	var queryString  = "<?= $this->config->item('admin_url') ?>";
	var t_id ="<?= isset($form['id']) ? $form['id'] : "" ?>";
	$(function() {
		  
	});
	
	function changeStatus(sta, case_id,item_id){
		var form_data = "case_id="+case_id+"&id="+item_id+"&status="+sta;
		
		$.post(queryString+"/<?= $this->name ?>/changeCaseDetailsStatus/",form_data, function(data) { 
			if(sta == "2"){
				$("#statusPanel"+item_id).html("Approved");
			}else{
				$("#statusPanel"+item_id).html("Rejected");
			}
			$("#actionPanel"+item_id).html('<button onclick="return revert('+case_id+','+item_id+');">Revert</button>');
		});	
		
		return false;
	}

	function revert(case_id,item_id){
		var form_data = "case_id="+case_id+"&id="+item_id ;
		
		$.post(queryString+"/<?= $this->name ?>/revertCase/",form_data, function(data) { 
			$("#statusPanel"+item_id).html("Reverted");
			$("#actionPanel"+item_id).html('<button onclick="return changeStatus(2,'+case_id+','+item_id+');">Approve</button><button onclick="return changeStatus(3,'+case_id+','+item_id+');">Rejected</button>');
		});
		return false;
	}
</script> 
<div style="padding:10px;background-color:#ffffff;">
	<strong>Case ID : </strong>#<?= $case['id'] ?><br/>
	<strong>Record : </strong> <?= $case['name'] ?> <br/>
	<strong>Remark : </strong><?= $case['remark'] ?> <br/>
</div>
<table class="edit bordered">
	<tbody>
		<tr> 
			<th style="width: 20%;">Initial Data</th>
			<th style="width: 20%;">Change To</th> 
			<th style="width: 20%;">Status</th>
			<th style="width: 20%;">Last Updated</th>
			 <th style="width: 20%;">Action</th>
			    
		</tr>
		
	<?php if(!empty($details)){
		foreach ($details as $row):
		 ?>		
    	<tr>
    	
			<td><div style="color:#8A4B08;"><?= $row['old_data'] ?></div></td>
			<td><div style="color:#0B6138;"><?= $row['new_data'];?></div></td>	 
			<td><div id="statusPanel<?= $row['id'] ?>"><?= match($row['status'], $this->config->item('case_details_status'))?></div></td>		
			<td><?= date_convert($row['created'], 'full');?></td> 			
			<td>
				<div id="actionPanel<?= $row['id'] ?>">
					<?php if(in_array($row['status'],array(2,3))){ ?>
						<button onclick="return revert('<?= $case['id'] ?>','<?= $row['id'] ?>');">Revert</button>
					<?php }else{ ?>
						<button onclick="return changeStatus(2,'<?= $case['id'] ?>','<?= $row['id'] ?>');">Approve</button>
						<button onclick="return changeStatus(3,'<?= $case['id'] ?>','<?= $row['id'] ?>');">Reject</button>
					<?php } ?>
				</div>
			</td>										
		</tr>
	<?php endforeach; ?>		
	
		<?php 	}else{ ?>
			<tr><td colspan="5" ><div align='center'>No result found</div><td></tr>
		<?php  } ?>		
	</tbody>	
</table>	