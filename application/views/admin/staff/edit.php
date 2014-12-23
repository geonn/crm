<div class="container_header">
	<div class="header_title"><a class="separator" href="#">Home</a> <a class="separator" href="#"><?= ucwords($this->name) ?></a> Edit <?= ucwords($this->name) ?></div>
	<div style="clear:both"></div>
</div>
<?= $template['partials']['message']; ?>
<div id="submenu">
	<ul>
    	<li><a href="javascript:void(0);" onclick="return $('#updateform').submit();">Update</a></li>
        <li><a href="<?php echo $this->config->item('admin_url')?>/<?= $this->name ?>/">Back</a></li>
    </ul>
</div>
<div id="the_list">
	<div class="header_title">User Profile</div>
	<?= form_open_multipart($this->config->item('admin_url').'/'.$this->name.'/update/'.$this->uri->segment(4),'id="updateform"'); ?>
    <?= $template['partials']['content']; ?>
    <?php $roles = $this->user->get_memberrole(); ?>
    <br/>
    <div class="header_title">Project Assignment</div>
        <table class="edit bordered">
            <tbody>	
                <tr>
                    <td style="width: 140px;"  id='edit_title'>Project Handle</td>
                    <td>
                        <?php
                    if(in_array($roles, array('founder','director'))){
                        echo form_dropdown('project', array("" => "None") + $this->project_model->getListAsMenu(), set_value('project',isset($form) ? $form['project'] : ''), ' style="width:20%;"');
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
    </form>
    <br/>
    <div align='center'>
    <button class="gold_button" onclick="location.href='<?=$this->config->item('admin_url')?>/<?= $this->name ?>/';">Back</button>
    <button type="submit" value="Submit"  class="green_button" id="submitformbutton">Update</button>  
    </div>
</div>
<script type="text/javascript" >	
	$('#submitformbutton').click(function() {
	  $('#updateform').submit();
	});
</script>