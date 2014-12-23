<script>
	var queryString  = "<?= $this->config->item('admin_url') ?>/<?= $this->name ?>/";
	
	function submitForm(){
		var formdata = $('form').serialize();
		resetOutline();
		$.post(queryString+"submitAnswer/", formdata, function(datas) {  
				var obj = $.parseJSON(datas);
				
				if(obj.status == "error"){ 
					$(".error_message").show();
					$.each(obj.error_code, function(idx, objs) {    
						$("."+objs.question).css('outline','1px solid #ff0000');
					});
						$(".error_message").html("Please check the form below :");
				}else{
					//success and redirection
					noty({"text":"Form submitted successfully","layout":"center","type":"success","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":2000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
					setTimeout(function() {location.href=queryString},2000);	 		 
				}
		});
		
		return false;
	}
	
	function resetOutline(){
		$(".error_message").hide();
		$(".required").css('outline','');
	}
	
</script>

<form>
<?php  
$submitButton = 1;
if(!empty($result['data'])) {  ?>

		<div style="font-size:14px;"><?= $result['data']['name'] ?></div>
		<div style="font-size:10px;color: #A4A4A4;"><?= $result['data']['description'] ?></div>
		<div class="error_message" style="display:none;"></div>
		<div style="background-color:<?= $result['data']['background'] ?>;width:100%;margin-top:10px;">
<?php		
		echo	form_hidden('t_id', set_value('t_id',$result['data']['id']));
		if(!empty($result['data']['questions'])){
		$index = 1;
		foreach($result['data']['questions'] as $k => $val){
			$showIndex = "";
			if($result['data']['isIndex'] == "1"){
				$showIndex = "1";
			}
	?>
		<div style="padding:10px;font-size:14px;"><?= !empty($showIndex) ? $index.".  " : "" ?><?= $val['question'] ?></div>
		<div style="padding-left:20px;padding-bottom:10px;">
			
		<?php
			
			switch($val['type']) {
				case 1: // TEXT INPUT
					echo   form_input('q_'. $val['id'], '','class="required '.$val['id'].'" placeholder="Please fill in '.$val['question'] .'" style="width:50%;"'); 
				break;	
				case 2: // TEXT AREA
					echo   form_textarea('q_'. $val['id'], '','class="required '.$val['id'].'" placeholder="Please fill in '.$val['question'] .'" style="width:50%;"'); 
				break;	
				case 3: //RADIO BUTTON
					echo	form_hidden('q_'. $val['id'], "");
					foreach($val['answer'] as $sk => $ans){
						
						$radioValue = array(
						    'name'    => 'q_'. $val['id'],
						    'id'          => 'q_'. $val['id'],
						    'value'       => $sk,
						    'class'         => "required ".  $val['id'],
						    'checked'     => FALSE, 
					    );
						echo   form_radio($radioValue) . "<span style='margin-right:20px;'>".$ans."</span>"; 
					}
				break;	
				case 4: //CHECKBOX
					echo	form_hidden('q_'. $val['id'], "");
					foreach($val['answer'] as $sk => $ans){
						$radioValue = array(
						    'name'    => 'q_'. $val['id']."[]",
						    'id'          => 'q_'. $val['id'],
						    'value'       => $sk,
						     'class'         => "required ". $val['id'],
						    'checked'     => FALSE, 
					    );
						echo   form_checkbox($radioValue) . "<span style='margin-right:20px;'>".$ans."</span>"; 
					}
				break;	
			}
			$index++; 
			?>
			</div>
	<?php	}
			}else{
				$submitButton  = 0;
				echo "<div class='error_message'>No question available at the moment.</div>";
			}
	 } ?> 
</div>
</form>
<div style="width:100%;text-align:center;padding-top:10px;">
	<button class="gold_button" onclick="location.href='<?=$this->config->item('admin_url')?>/<?= $this->name ?>/';">Back</button>
	<?php if($submitButton  == 1){  ?>
		<button type="submit"  value="Submit" onClick="return submitForm();">Submit</button>  
	<?php }  ?>
</div>
