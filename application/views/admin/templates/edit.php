<!-- Extra CSS and JS to load -->
<script type="text/javascript" src="<?= $this->config->item('domain') ?>/public/javascripts/tab/organictabs.jquery.js"></script>
<script type="text/javascript" src="<?= $this->config->item('domain') ?>/public/javascripts/jquery/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?= $this->config->item('domain') ?>/public/javascripts/tab/style.css">
<link rel="stylesheet" type="text/css" href="<?= $this->config->item('domain') ?>/public/stylesheets/jquery.fancybox.css?v=2.1.5" media="screen" />

<div class="headerTitle">Edit <?= ucwords($this->name) ?></div>
<?= $template['partials']['message']; ?>
<?= form_open_multipart($this->config->item('admin_url').'/'.$this->name.'/update/'.$this->uri->segment(4),'id="updateform"'); ?>
<?= $template['partials']['content']; ?>
</form>
<br/>
<div align='center'>
<button   class="gold_button" onclick="location.href='<?=$this->config->item('admin_url')?>/<?= $this->name ?>/';">Back</button>
<button type="submit" value="Submit"  class="green_button" id="submitformbutton">Update</button>  
</div>
<script type="text/javascript" >	
$('#submitformbutton').click(function() {
  $('#updateform').submit();
});
</script>