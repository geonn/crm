<div style="width:100%;background-color:<?= match($result['data']['background'],$this->config->item('template_background')) ?>;">
	
	<?php  
	 if($result['status'] == "error" ){ 
		echo $result['data'];
		exit;	
	}?>
<div style="font-size:16px;padding-left:10px;padding-top:10px;"><?= $result['data']['name'] ?></div>
<div style="font-size:10px;color: #A4A4A4;padding-left:10px;"><?= $result['data']['description'] ?></div>

<div style="font-size:14px;padding-left:10px;padding-top:5px;">Date :  <input name="filled_date" value="<?= convertToDBDate($response_form['filled_date']) ?>" type="text" id="datepicker"></div>
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
                
                if(!isset($response['data'][$val['id']]) ){
                 	continue;
                 }
        ?>
            <div style="padding:10px;font-size:14px;"><?= !empty($showIndex) ? $index.".  " : "" ?><?= $val['question'] ?></div>
            <div style="padding-left:20px;padding-bottom:10px;">
                
            <?php
                switch($val['type']) {
                    case 1: // TEXT INPUT
                        echo   form_input('q_'. $val['id'], isset($response) ? $response['data'][$val['id']] : '','class="required '.$val['id'].'" placeholder="Please fill in '.$val['question'] .'" style="width:50%;"'); 
                    break;	
                    case 2: // TEXT AREA
                        echo   form_textarea('q_'. $val['id'], isset($response) ? $response['data'][$val['id']] : '','class="required '.$val['id'].'" placeholder="Please fill in '.$val['question'] .'" style="width:50%;"'); 
                    break;	
                    case 3: //RADIO BUTTON
                        echo	form_hidden('q_'. $val['id'], "");
                        foreach($val['answer'] as $sk => $ans){
                            $isRadioChk = FALSE;
                            if($response['data'][$val['id']] == $sk){
                            	$isRadioChk = TRUE;
                            }
                            
                            $radioValue = array(
                                'name'    => 'q_'. $val['id'],
                                'id'          => 'q_'. $val['id'],
                                'value'       => $sk,
                                'class'         => "required ".  $val['id'],
                                'checked'     => $isRadioChk, 
                            );
                            echo   form_radio($radioValue) . "<span style='margin-right:20px;'>".$ans."</span><br/>"; 
                        }
                        
                       	if($val['hasOthers'] == "1"){
                       		$isOtherRadioChk = FALSE;
                            if($response['data'][$val['id']] == 99){
                            	$isOtherRadioChk = TRUE;
                            }
                            
                       		 $radioOthersValue = array(
                                'name'    => 'q_'. $val['id'],
                                'id'          => 'q_'. $val['id'],
                                'value'       => 99,
                                'class'         => "required ".  $val['id'],
                                'checked'     => $isOtherRadioChk, 
                            );
							echo   form_radio($radioOthersValue) . "<span style='margin-right:20px;'>Others</span>".form_input( $val['id']."_99", isset($response['data'][$val['id']."_99"]) ? $response['data'][$val['id']."_99"] : '','class="required '.$val['id'].'" placeholder="Please fill in your answer" style="width:50%;"'); ; 
						}
                        
                    break;	
                    case 4: //CHECKBOX
                        echo	form_hidden('q_'. $val['id'], "");
                        
                        foreach($val['answer'] as $sk => $ans){
                        	 $isCheckChk = FALSE;
                             if($response['data'][$val['id']] == $sk){
                            	$isCheckChk = TRUE;
                             }
                             
                            $checkValue = array(
                                'name'    => 'q_'. $val['id']."[]",
                                'id'          => 'q_'. $val['id'],
                                'value'       => $sk,
                                 'class'         => "required ". $val['id'],
                                'checked'     => $isCheckChk, 
                            );
                            echo   form_checkbox($checkValue) . "<span style='margin-right:20px;'>".$ans."</span><br/>"; 
                        }
                        
                        if($val['hasOthers'] == "1"){
                        	$isOtherCheckChk = FALSE;
                             if($response['data'][$val['id']] == 99){
                            	$isOtherCheckChk = TRUE;
                             }
                             
                       		 $checkOthersValue = array(
                                'name'    => 'q_'. $val['id']."[]",
                                'id'          => 'q_'. $val['id'],
                                'value'       => 99,
                                'class'         => "required ".  $val['id'],
                                'checked'     => $isOtherCheckChk, 
                            );
							echo   form_checkbox($checkOthersValue	) . "<span style='margin-right:20px;'>Others</span>".form_input($val['id']."_99", isset($response['data'][$val['id']."_99"]) ? $response['data'][$val['id']."_99"] : '','class="required '.$val['id'].'" placeholder="Please fill in your answer" style="width:50%;"'); ; 
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
        
         ?> 
    </div>
</div>