<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= $this->config->item('project_name') ?></title>
<link href="<?= $this->config->item('domain') ?>/public/stylesheets/web/style.css" rel="stylesheet" />
<link rel="shortcut icon" href="<?= $this->config->item('domain') ?>/public/images/favicon.ico" type="image/icon">
<link rel="icon" href="<?= $this->config->item('domain') ?>/public/images/favicon.ico" type="image/icon">
<meta name="keywords" content="<?= $this->config->item('meta_keywords') ?>">
<meta name="description" content="<?= $this->config->item('meta_description') ?>">
</head>

<body>
	<div class="pageBg">
		<div class="content" >
	      	  <?= $template['body']; ?>
	    	</div>
     	<a href="/privacy">Privacy Policy</a> | &copy; 2013 <?= $this->config->item('project_name') ?>. All rights reserved.
	 </div>	
	 </div>
</body>
</html>
