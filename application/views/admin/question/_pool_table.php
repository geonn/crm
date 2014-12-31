
<script>
	var template_id = "<?= $template_id ?>"; 
	$('#q').val("<?= $q ?>");
	function addToTemplate(q_id){ 
		var formdata = "t_id="+template_id+"&q_id="+q_id;
		$.post(queryString+"/templates/addQuestionToTemplate/", formdata, function(data) {
			 getQuestionPools(template_id,"<?= $q ?>");
			 getTemplateQuestion(template_id)
		});	
	}
	
	function removeFromTemplate(q_id){ 
		var formdata = "t_id="+template_id+"&q_id="+q_id;
		$.post(queryString+"/templates/removeQuestionFromTemplate/", formdata, function(data) {
			 getQuestionPools(template_id,"<?= $q ?>");
			 getTemplateQuestion(template_id)
		});	
	}
	
	$("#searchBtn").click(function(){
		var q = $('#q').val();
		getQuestionPools(template_id, q);
	});
</script> 
<div style="padding-bottom:10px;">
	<input name="q" id="q" type="text" value="<?= set_value('q',''); ?>" class="mystyles_textbox" placeholder="Search questions or tags" style="width:85%;">
 	<button type="submit"  id="searchBtn"  value="Submit" >Filter</button>   
</div>
<table class="bordered" style="width:100%;">
	<tbody>
		<tr> 
			<th style="width: 60%;">Question <span id="question_sortimg"></th>
			<th style="width: 15%;">Tag <span id="tag_sortimg"></th>
			<th style="width: 15%;">Type  <span id="type_sortimg"></th>  
			<th style="width: 10%;">Action</th>
		</tr>
		
	<?php if(!empty($pools)){ 
		foreach ($pools['data'] as $k=> $row): ?>		
    	<tr>
			<td><strong><font color="green"><?= $row['question'];?></font></strong></td>
			<td><?= $row['tag'];?></td>	
			<td><?= match($row['type'], $this->config->item('question_type'))?></td>	  
			<td>
				<?php if(in_array($row['id'], $inTemplates)){  ?>
					<button type="submit" class="red_button" value="Submit " onClick="return removeFromTemplate('<?= $row['id'] ?>');">Remove Question</button>  
				<?php }else{ ?>
					<button type="submit" class="blue_button" value="Submit " onClick="return addToTemplate('<?= $row['id'] ?>');">Add Question</button>  
				<?php } ?>
				
			</td>																
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