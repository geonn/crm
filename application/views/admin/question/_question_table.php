<style>
  #sortable {font-size:12px;list-style-type: none; margin: 0; padding: 0; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em;  font-size: 12px; min-height: 40px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
</style>
<script>
	var template_id = "<?= $template_id ?>"; 
	 
	function removeFromTemplate(q_id){ 
		var formdata = "t_id="+template_id+"&q_id="+q_id;  
		$.post(queryString+"/templates/removeQuestionFromTemplate/", formdata, function(data) {
			 getQuestionPools(template_id); 
		});	 
		return false;
	}
	
	$(function(){
		$( "#sortable" ).sortable({
        start: function(event, ui) {
            var start_pos = ui.item.index();
         //   alert("start - " + start_pos);
        },
        change: function(event, ui) {
         //  alert("change - " );
        },
        update: function(event, ui) {
        	var itemForm = $("#itemForm").serialize();
            $.post(queryString+'/templates/updatePosition',itemForm,function(data){ });
        }
    });
    $( "#sortable" ).disableSelection();
	})
</script>

<table class="bordered" style="width:100%;">
	<tbody>
		<tr> 
			<th style="width: 65%;">Question <span id="question_sortimg"></th>
			<th style="width: 15%;">Tag <span id="tag_sortimg"></th> 
			<th style="width: 20%;">Action</th>
		</tr>
	</tbody>	
</table>	
<form id="itemForm">
<ul id="sortable">		
	<?php 
	if(!empty($inTemplates)){ 
		foreach ($inTemplates['data'] as $k=> $row): ?>		
    		<li class="ui-state-default">
    		<input type="hidden" name="items[]" value="<?= $row['id'] ?>" />
			<div style="float:left;width: 65%"><strong><font color="green"><?= $row['question'];?></font></strong></div>
			
			<div style="float:left;width: 15%"> <?= $row['tag'];?></td>	</div> 
			<div style="float:left;width: 20%">
				<button type="button" class="red_button" value="Submit " onClick="return removeFromTemplate('<?= $row['q_id'] ?>');">Remove Question</button> 
			</div>													
		 </li>

	<?php endforeach; ?>	
	<?php 	}else{ ?>
			<div align='center'>No result found</div>
	<?php  } ?>			
</ul>
</form>	
<div class='pagination'>
	<?= $this->pagination->create_links($this->uri->segment(4)); ?>	
</div>
<br/><br/><br/>