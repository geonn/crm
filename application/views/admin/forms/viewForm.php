<script>
	var queryString  = "<?= $this->config->item('admin_url') ?>/<?= $this->name ?>/";
	$(function() { 
		var dateToday = todayDate();
		$( "#datepicker" ).val(dateToday);
		
 		$( "#customer" ).on('blur',function(){
 			if($( "#customer" ).val() ==  ""){
			      		$(".required").val("");
			      		$("input[name=c_id]").val("");
			      		$("textarea[name=mail_address]").html("");
			      		$("textarea[name=home_address]").html("");
			      		return false;
			    }
			      		
 		});
 		
 		$.getJSON( queryString+"getCustomerList", function( data ) {
			$( "#customer" ).autocomplete({
		     	source: data,
			    focus: function( event, ui ) { 
			        $( "#customer" ).val( ui.item.label );
			        return false;
			      },
			      select: function( event, ui ) {
			    
			      	
			      	$.get("<?= $this->config->item('admin_url') ?>/customer/getCustomerById?c_id="+ui.item.value, function(data) {
			      		var obj = jQuery.parseJSON(data);
			      		$("input[name=c_id]").val(obj.id);
			      		$("input[name=name]").val(obj.name);
			      		$("input[name=serial]").val(obj.serial);
			      		$("input[name=ic]").val(obj.ic);
			      		$("input[name=email]").val(obj.email);
			      		$("input[name=contact_home]").val(obj.contact_home);
			      		$("input[name=contact_mobile]").val(obj.contact_mobile);
			      		$("input[name=contact_office]").val(obj.contact_office);
			      		$("input[name=age]").val(obj.age);
			      		$("textarea[name=mail_address]").html(obj.mail_address);
			      		$("textarea[name=home_address]").html(obj.home_address);
			      	});
			        $( "#customer" ).val( ui.item.label );
			        $( "#customer" ).attr("data-value",ui.item.value);
			        return false;
			      }
			});
		});

	    
	});
	
	function submitForm(){
		var formdata = $('form').serialize();
		resetOutline(); 
		$.post(queryString+"submitAnswer/", formdata, function(datas) {  
			console.log(datas);
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
<div class="container_header">
	<div class="header_title"><a class="separator" href="<?= $this->config->item('admin_url') ?>">Home</a> 
		<a class="separator" href="<?= $this->config->item('admin_url').'/'.$this->name ?>"><?= ucwords($this->name) ?></a> <?= $result['data']['name'] ?></div>
	<div style="clear:both"></div>
</div>
<?= $template['partials']['message']; ?>
<div id="submenu">
	<ul>
        <li><a href="<?php echo $this->config->item('admin_url').'/'?><?= $this->name ?>/">Back</a></li>
    </ul>
</div>
<div id="the_list" style="background-color:<?= match($result['data']['background'],$this->config->item('template_background')) ?>;">
    <form>
    <?php  
    $submitButton = 1;
    if(!empty($result['data'])) {  
            echo form_hidden('isCustomerForm', set_value('isCustomerForm',$result['data']['isCustomerForm']));
            if($result['data']['isCustomerForm'] == "1"){
            	 echo form_hidden('c_id', '');
                 ?>
                <div style="font-size:16px;padding-left:10px;">Personal Details</div> 
                 <div style="font-size:14px;padding-left:10px;">Search Customer : <input id="customer" name="customer" placeholder="Customer name..."></div> 
                <div style="background-color:<?= $result['data']['background'] ?>;width:100%;margin-top:10px;margin-bottom:10px;">
                    <div style="padding:10px;font-size:14px;">Full Name</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('name', '','class="required" placeholder="Please fill in customer name" style="width:50%;"') ?>
                    </div>
                    
                     <div style="padding:10px;font-size:14px;">Silver card serial number</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('serial', '','class="required" placeholder="Please fill in silver card serial number" style="width:50%;"') ?>
                    </div>
                    
                    <div style="padding:10px;font-size:14px;">I/C</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('ic', '','class="required phone_number" placeholder="Please fill in identity card number"  maxlength="20" style="width:50%;"') ?>
                    </div>
                    
                    <div style="padding:10px;font-size:14px;">Email Address</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('email', '','class="required" placeholder="Please fill in email address" style="width:50%;"') ?>
                    </div>
                    
                    <div style="padding:10px;font-size:14px;">Contact Home</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('contact_home', '','class="required phone_number" placeholder="Please fill in home contact number" style="width:50%;"') ?>
                    </div>
                    
                    <div style="padding:10px;font-size:14px;">Contact Mobile</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('contact_mobile', '','class="required phone_number" placeholder="Please fill in mobile contact number" style="width:50%;"') ?>
                    </div>
                    
                    <div style="padding:10px;font-size:14px;">Contact Office</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('contact_office', '','class="required phone_number" placeholder="Please fill in office contact number" style="width:50%;"') ?>
                    </div>
                    
                    <div style="padding:10px;font-size:14px;">Age</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('age', '','class="required num_only" placeholder="Please fill in customer age" maxlength="3" style="width:50%;"') ?>
                    </div>
                    <div style="padding:10px;font-size:14px;">Address(Mail)</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <textarea name="mail_address" rows="4"  style="width:50%;" placeholder="Mailing address" ></textarea>
                    </div>
                    
                    <div style="padding:10px;font-size:14px;">Address(Home)</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <textarea name="home_address" rows="4"   style="width:50%;" placeholder="Home address"></textarea>
                    </div>
                </div>
                <hr/>
    <?php 		} ?>
            <div style="font-size:16px;padding-left:10px;padding-top:10px;"><?= $result['data']['name'] ?></div>
            <div style="font-size:10px;color: #A4A4A4;padding-left:10px;"><?= $result['data']['description'] ?></div>
            
            <div style="font-size:14px;padding-left:10px;padding-top:5px;">Date :  <input name="filled_date" type="text" id="datepicker"></div>
            <div class="error_message" style="display:none;"></div>
            <div style="width:100%;margin-top:10px;">
    <?php		
            echo form_hidden('t_id', set_value('t_id',$result['data']['id']));
            
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
                            echo   form_radio($radioValue) . "<span style='margin-right:20px;'>".$ans."</span><br/>"; 
                        }
                        
                       	if($val['hasOthers'] == "1"){
                       		 $radioOthersValue = array(
                                'name'    => 'q_'. $val['id'],
                                'id'          => 'q_'. $val['id'],
                                'value'       => 99,
                                'class'         => "required ".  $val['id'],
                                'checked'     => FALSE, 
                            );
							echo   form_radio($radioOthersValue) . "<span style='margin-right:20px;'>Others</span>".form_input( $val['id']."_99", '','class="required '.$val['id'].'" placeholder="Please fill in your answer" style="width:50%;"'); ; 
						}
                        
                    break;	
                    case 4: //CHECKBOX
                        echo	form_hidden('q_'. $val['id'], "");
                        foreach($val['answer'] as $sk => $ans){
                            $checkValue = array(
                                'name'    => 'q_'. $val['id']."[]",
                                'id'          => 'q_'. $val['id'],
                                'value'       => $sk,
                                 'class'         => "required ". $val['id'],
                                'checked'     => FALSE, 
                            );
                            echo   form_checkbox($checkValue) . "<span style='margin-right:20px;'>".$ans."</span><br/>"; 
                        }
                        
                        if($val['hasOthers'] == "1"){
                       		 $checkOthersValue = array(
                                'name'    => 'q_'. $val['id']."[]",
                                'id'          => 'q_'. $val['id'],
                                'value'       => 99,
                                'class'         => "required ".  $val['id'],
                                'checked'     => FALSE, 
                            );
							echo   form_checkbox($checkOthersValue	) . "<span style='margin-right:20px;'>Others</span>".form_input($val['id']."_99", '','class="required '.$val['id'].'" placeholder="Please fill in your answer" style="width:50%;"'); ; 
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
</div>
