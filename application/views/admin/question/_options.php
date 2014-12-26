<style>
  #sortable {font-size:12px;list-style-type: none; margin: 0; padding: 0; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em;  font-size: 12px; min-height: 40px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
</style>

<script>
	var queryString  = "<?= $this->config->item('admin_url') ?>/<?= $this->name ?>";
	
	function submitAnswer(){
		var answer = $("input[name=answer]").val();
		$.get(queryString+"/addAnswer?answer="+answer+"&q_id=<?= $q_id ?>", function(data) {
				answerOptions("<?= $q_id ?>", "<?= $question_type ?>");
		});
			
		return false;
	}
  	 
	  $(function() { 
	  
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
	            $.post(queryString+'/updatePosition',itemForm,function(data){ });
	        }
	    });
	    $( "#sortable" ).disableSelection();
	    
	    loadAddForm();
  		 
	});
	
	function editItem(a_id, answer){
		$( "input[name=id]" ).val(a_id);
		 $( "input[name=edit_answer]" ).val(answer);
		 $( "#dialog-form" ).dialog( "open" );
	}
	
	function checkForm(answer){
		var msg = "";
		var error = 0;
		
		if(answer == ""){
			error =1;
			msg  = "Answer option cannot be empty";
		}
		
		if(error == 1){
			$(".error_message").html(msg);
			$(".error_message").show();
		}
		return error;
	}
		
	function loadAddForm(){	
			$( "#dialog-form" ).dialog({
			      autoOpen: false,
			      height: 180,
			      width: 320,
			      modal: true,
			      buttons: {
		      	
			        "Update": function() {
			            var answer = $( "input[name=edit_answer]" ).val();
			            var a_id = $( "input[name=id]" ).val(); 
			          	validate = checkForm(answer);
			          	if(validate === 1){
			          		return;
			          	}
			    
			          	var formdata ="q_id=<?= $q_id ?>&id="+a_id+"&answer="+answer;
			          	 
			          	$.post(queryString+ "/editAnswer",formdata, function(data) { 
			    			$( "input[name=edit_answer]" ).val("");
			    			$(".error_message").hide();
			    			
			    			noty({"text":"Answer option has been updated!","layout":"bottomRight","type":"success","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":2000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
			    			answerOptions("<?= $q_id ?>", "<?= $question_type ?>");
			    		});
			         
			    		$( this ).dialog( "close" );
			          
			        },
			        Cancel: function() {
			          $( this ).dialog( "close" );
			       }
			     },
			      close: function() {
			       
			      }
			 });
			}
</script>
 <?= form_input('answer', '','class="required" placeholder="Add answer..." class="mystyles_textbox" style="width:50%"'); ?>
 <button type="button" onClick="return submitAnswer();" class="blue_button" value="Submit " >Add Answer</button>  
 <br/>
<?php
	$others_check = FALSE;
	if($question['hasOthers'] == "1"){
		$others_check = TRUE;
	}
	$radioValue = array(
        'name'    => 'hasOthers',
        'id'          => 'hasOthers',
        'value'       => 1,
         'class'         => "required ",
        'checked'     => $others_check, 
    );
    echo   form_checkbox($radioValue) . "<span style='margin-right:20px;'>'Others' option </span>"; 
                            
  ?>                    
 <br/> <br/>
  <div id="dialog-form" title="Edit Answer Options">
	<p class="validateTips"></p>
	<p class="error_message" style="display:none;font-size:12px;"></p>
	<form>
		
	  <fieldset>
	 	  <div for="name" style="clear:both;padding-bottom:5px;">Answer</div> 
	  	  <?= form_input('edit_answer', '', 'class="required" style="width:98%"'); ?>
	  	  <?= form_hidden('id', ''); ?>
	  </fieldset>
	</form>
 
</div>
 <form id="itemForm">
	<ul id="sortable">		
		<?php 
		if(!empty($data)){ 
			foreach ($data as $row){ ?>		
	    	
	    	<li class="ui-state-default">
	    		<input type="hidden" name="items[]" value="<?= $row['id'] ?>" />
				<div style="float:left;width: 70%"><strong><font color="green"><?= $row['answer'];?></font></strong></div>
				 
				<div style="float:right;">
					<input class="blue_button" type="button"  onClick='editItem("<?= $row['id'] ?>","<?= $row['answer'];?>");' value="Edit" />		</div>													
			 </li>
	
			<?php }
		} ?>		
	</ul>
</form>	
