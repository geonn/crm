<div class="header_title" style="border:0;">Project Assignment</div>
<table class="edit bordered">
    <tbody>	
        <tr>
            <td style="width: 140px;"  id='edit_title'>Project Handle</td>
            <td>
                <?php
		            if(in_array($this->user->get_memberrole(), array('founder','director'))){
		               // echo form_dropdown('project', array("" => "None") + $this->project_model->getListAsMenu(), set_value('project',isset($form) ? $form['project'] : ''), ' style="width:20%;"');
		            	$projectList = $this->project_model->getListAsMenu();
		            	$user_proj = array();
						if(!empty($form['project'])){
							$user_proj = explode(',', $form['project']);
						} 
		            	foreach($projectList as $k => $pl){
		            		$isCheck = FALSE;
							if(in_array($k, $user_proj)){
								$isCheck = TRUE;
							}
							
                            $checkValue = array(
                                'name'    => 'project[]', 
                                'value'       => $k, 
                                'checked'     => $isCheck, 
                            );
                            echo   form_checkbox($checkValue) . "<span style='margin-right:20px;'>".$pl."</span><br/>"; 
                        }
		            }else{
		                $proj = $this->project_model->find_by($form['project']); 
		                  echo  set_value('project',isset($form) ? $proj['name']: '');
		                 echo form_hidden('project', set_value('project',isset($form) ? $form['project'] : ''));
		            }
             	?>
                    
            </td>		
        </tr>
    </tbody>
</table>