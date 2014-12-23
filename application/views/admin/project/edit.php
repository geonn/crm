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
	<?= form_open_multipart($this->config->item('admin_url').'/'.$this->name.'/update/'.$this->uri->segment(4),'id="updateform"'); ?>
    <?= $template['partials']['content']; ?>
    </form>
    <br/>
    <div align='center'>
    <button  onclick="location.href='<?=$this->config->item('admin_url')?>/<?= $this->name ?>/';"><span><span><?= $this->config->item("icon_back") ?> Back</span></span></button>
    <button type="submit" value="Submit" class="submit" id="submitformbutton"><span><span>Update </span></span></button>  
    </div>
    <script type="text/javascript" >	
    $('#submitformbutton').click(function() {
      $('#updateform').submit();
    });
    </script>
</div>