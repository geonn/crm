
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
				<img src="<?= $this->config->item('domain') ?>/public/images/logo.png" alt="<?= $this->config->item('project_name') ?> admin" style='width:75%;'  title="Powered By GEONN SOLUTION">			
			</div>
			<div class="error" style="display:none;"></div>
		
			<div id="login-content">
				<form id=loginform>
					<p>
						<label>Username</label>
						<?= form_input('username', set_value('username',isset($form) ? $form['username'] : ''), 'class="text-input" id="username"'); ?>
					</p>
					<br style="clear: both;">
					<p>
						<label>Password</label>
						<?= form_password('password', set_value('password',isset($form) ? $form['password'] : ''), 'class="text-input"  id="password"'); ?>
					</p>
					<br style="clear: both;">
					<p>
						<input class="button" type="submit" value="Sign In" onclick="return validateLogin();">
					</p>
				</form>
			</div>
		</div>
		<div id="dummy"></div>
		<div id="dummy2"></div>
  
