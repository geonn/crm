<div class="container_header">
	<div class="header_title">
		<a class="separator" href="<?= $this->config->item('admin_url') ?>">Home</a> 
		<a class="separator" href="<?= $this->config->item('admin_url').'/'.$this->name ?>/approval">Approval List</a> Details</div>
	<div style="clear:both"></div>
</div>

<div id="submenu">
	<ul> 
        <li><a href="<?php echo $this->config->item('admin_url')?>/<?= $this->name ?>/">Back</a></li>
    </ul>
</div>
<div id="the_list">
<?= $template['partials']['message']; ?>
<?= form_open_multipart($this->config->item('admin_url').'/'.$this->name.'/update/'.$this->uri->segment(4),'id="updateform"'); ?>
<?= $template['partials']['content']; ?>
</form>
<br/>
<div align='center'>
<button   class="gold_button" onclick="location.href='<?=$this->config->item('admin_url')?>/<?= $this->name ?>/approval';">Back</button> 
</div>
<script type="text/javascript" >	
$('#submitformbutton').click(function() {
  $('#updateform').submit();
});
</script>