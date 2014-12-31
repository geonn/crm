    <!-- Extra CSS and JS to load -->
    <script type="text/javascript" src="<?= $this->config->item('domain') ?>/public/javascripts/tab/organictabs.jquery.js"></script>
    <script type="text/javascript" src="<?= $this->config->item('domain') ?>/public/javascripts/jquery/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="<?= $this->config->item('domain') ?>/public/javascripts/tab/style.css">
    <link rel="stylesheet" type="text/css" href="<?= $this->config->item('domain') ?>/public/stylesheets/jquery.fancybox.css?v=2.1.5" media="screen" />
  <div class="container_header">
	<div class="header_title"><a class="separator" href="<?= $this->config->item('admin_url') ?>">Home</a> <a class="separator" href="<?= $this->config->item('admin_url').'/'.$this->name ?>"><?= ucwords($this->name) ?></a> New <?= ucwords($this->name) ?></div>
	<div style="clear:both"></div>
</div>

<div id="submenu">
	<ul>
    	<li><a href="#" onclick="$('#newform').submit();">Create</a></li>
        <li><a href="<?php echo $this->config->item('admin_url')?>/<?= $this->name ?>/">Back</a></li>
    </ul>
</div>
<div id="the_list">
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
</div>