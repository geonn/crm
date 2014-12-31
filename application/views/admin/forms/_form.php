 <div style="width:100%;">
 <form>
    <?php   
    if($result['status'] == "success") {  
            echo form_hidden('isCustomerForm', set_value('isCustomerForm',$result['data']['isCustomerForm']));
            if($result['data']['isCustomerForm'] == "1"){
            	 echo form_hidden('c_id', '');
                 ?>
                <div style="font-size:16px;padding-left:10px;">Personal Details</div> 
                <?php if($preview !== "1"){ ?>
                 <div style="font-size:14px;padding-left:10px;">Search Customer : <input id="customer" name="customer" placeholder="Customer name..."></div> 
           	  <?php } ?>
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
                    echo "<div class='error_message'>".$result['data']."</div>";
                }
         }else{ 
                    echo "<div class='error_message'>".$result['data']."</div>";
                } ?> 
    </div>
    </form>
   </div>