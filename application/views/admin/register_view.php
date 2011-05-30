<div class="admin_form">
	<h1>
		Register for an Account
		<span>
			<a href="<?php echo site_url('admin/signin');?>"> 
				...Or Login 
			</a>
		</span> 
	</h1>
	<?php echo form_open('admin/register'); ?>
	
	<p>
	<label for="first_name">First Name: </label>
	<?php echo form_input('first_name', set_value('first_name')); ?>
	</p>
	
	<p>
		<label for="last_name">Last Name: </label>
		<?php echo form_input('last_name', set_value('last_name')); ?>
	</p>
	
	<p>
		<label for="email_address">Email Address:</label>
		<?php echo form_input('email', set_value('email')); ?>
	</p>
	
	<fieldset>
	<p>
		<label for="password">Desired Password: </label>
		<?php echo form_password('password'); ?>
	</p>
	
	<p>
		<label for="password_verify">Verify Password:</label>
		<?php echo form_password('password_verify'); ?>
	</p>
	</fieldset>
	
	<p>
		<?php echo form_submit('submit', 'Create Account'); ?>
	</p>
	
	<div class="errors"> <?php echo validation_errors(); ?> </div>
	
	<?php echo form_close(); ?>
	
</div>