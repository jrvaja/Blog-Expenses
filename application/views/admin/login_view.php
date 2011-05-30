<div class="admin_form">
	<img src="<?php echo site_url() . 'img/expenses_logo.png'; ?>" alt="Expenses" class="logo" />
	<?php echo form_open('admin/signin', 'class="login_form"'); ?>
	<h1>Sign In</h1>
	<p>
		<label for="username">Email Address: </label>
		<?php echo form_input('username', '', 'autofocus'); ?>
	</p>
	
	<p>
		<label for="password">Password: </label>
		<?php echo form_password('password'); ?>
	</p>
	
	<p>
		<?php echo form_submit('submit', 'Login'); ?>
	</p>
	
	
	<div class="errors"> <?php echo validation_errors(); ?> </div>
	
	<p> <?php echo anchor('admin/register', 'Create an account.'); ?> </p>
	<?php echo form_close(); ?>
</div>