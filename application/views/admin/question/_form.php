  <script>
  	jQuery(document).ready(function() {
	  	$("#question_type").change(function(){ 
	  			if($(this).val() > 2){
	  			 	answerOptions("<?= $form['id'] ?>", $(this).val());
	  			}else{
	  				jQuery('#options').hide();
	  			}
				
		});
  	});
  	
  	function answerOptions(q_id, question_type){
  		$.get("<?= $this->config->item('admin_url') ?>/<?= $this->name ?>/show_answer/?question_type="+question_type+"&q_id="+ q_id, function(data) {
	  		jQuery('#options').show();
			jQuery('#loading').hide();
		  	jQuery('#the_list').html(data);
		  	
		});
  	}
  	
  </script> 
<table class="edit">
	<tbody>	
	
		<tr>
			<td style="width: 140px;"  id='edit_title'>Question</td>
			<td><?= form_input('question', set_value('question',isset($form) ? $form['question'] : ''),'class="required" placeholder="Question..." style="width:98%;"'); ?></td>			
		</tr>			
		<tr>
			<td style="width: 140px;"  id='edit_title'>Tag</td>
			<td><?= form_input('tag', set_value('tag',isset($form) ? $form['tag'] : ''),'class="required" placeholder="Question tags (eg. general, financial, inventory, property)" style="width:98%;"'); ?></td>			
		</tr>	
		<?php if($module == "edit") { ?>
		 	<tr>
				<td style="width: 140px;"  id='edit_title'>Question Type</td>
				<td><?= form_dropdown('type', $this->config->item('question_type'), set_value('type',isset($form) ? $form['type'] : ''), ' id="question_type" style="width:20%;height:34px;"'); ?></td>		
			</tr>	
			<tr id="options" style="display:none;">
				<td style="width: 140px;"  id='edit_title'>Answer Options</td>
				<td><div id="the_list"></div></td>		
			</tr>	
		 <?php } ?>
	</tbody>
</table>
<script>
	var q_type = "<?= $form['type'] ?>";
	if(q_type > 2){ 
		answerOptions("<?= $form['id'] ?>", q_type);
	}
</script>