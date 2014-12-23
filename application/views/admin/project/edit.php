<div class="headerTitle">Edit <?= ucwords($this->name) ?></div>
<?= $template['partials']['message']; ?>
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