<div class="headerTitle">New <?= ucwords($this->name) ?></div>
<?= $template['partials']['message']; ?>
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