<!DOCTYPE html>
<html>
<title>Login | <?= $this->config->item('project_name') ?> by MEG MOBILE</title>

<link rel="stylesheet" type="text/css" href="<?= $this->config->item('base_url') ?>/public/stylesheets/admin/login.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="<?= $this->config->item('base_url') ?>/public/javascripts/jquery/jquery-1.7.2.js"></script>
<link rel="shortcut icon" href="<?= $this->config->item('base_url') ?>/public/images/favicon.ico" type="image/icon">
<link rel="icon" href="<?= $this->config->item('base_url') ?>/public/images/favicon.ico" type="image/icon">	
<script type="text/javascript" >
	function validateLogin(){		
		var app_path = "<?= $this->config->item('admin_url') ?>";
		txt_name = $("#username").val(); 
		txt_password = $("#password").val(); 
		
		if(txt_name == "" || txt_password == ""){
			display_error("Username or password cannot be empty.");
		}else{
			var form_data = $("#loginform").serialize();
			console.log(app_path+'/login/authenticate/?'+form_data);
			$.post(app_path+'/login/authenticate/',form_data,function(data){
			
				var obj = jQuery.parseJSON(data);
				console.log(obj.data);
				if(obj.status == "error"){
					display_error(obj.data);
				}else{
					window.location.href=app_path;
				}				
			});			
		}		
		return false;		
	}
	
	
	function display_error(msg){
		$('.error').show();
		$('.error').html(msg);
	}
	
</script>	
</head>

<body id="login">
		
			<?= $template['body']; ?>

</body></html>