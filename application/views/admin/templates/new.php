<div class="container_header">
	<div class="header_title"><a class="separator" href="#">Home</a> <a class="separator" href="#"><?= ucwords($this->name) ?></a> New <?= ucwords($this->name) ?></div>
	<div style="clear:both"></div>
</div>
<?= $template['partials']['message']; ?>
<div id="submenu">
	<ul>
    	<li><a href="#" onclick="$('#newform').submit();">Create</a></li>
        <li><a href="<?php echo $this->config->item('admin_url')?>/<?= $this->name ?>/">Back</a></li>
    </ul>
</div>
<div id="the_list">
<?= form_open_multipart($this->config->item('admin_url').'/'.$this->name.'/create','id="newform"'); ?>
<?= $template['partials']['content']; ?>
    </form>
    <br/>
    <div align='center'>
    <button  class="gold_button" onclick="location.href='<?=$this->config->item('admin_url')?>/<?= $this->name ?>/';">Back</button>
    <button type="submit" class="green_button" value="Submit" class="submit" id="submitformbutton">Create</button>  
    </div>
    <script type="text/javascript" >	
    $('#submitformbutton').click(function() {
      $('#newform').submit();
    });
    </script>
</div>