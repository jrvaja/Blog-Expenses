<div class="admin_form config_form">
   <h1>Configuration Options</h1>
   <?php echo form_open('admin/config'); ?>
	<p>
      <label for="budget">Budget: </label>
      <input type="number" name="budget" id="budget" value="<?php if ( isset($config_options->budget)) echo $config_options->budget; ?>" />
	</p>
	
	<p>
		<label for="tuts">Your Tuts+ Site?</label>
		<select name="logo">
			<?php foreach($tuts_site as $site => $image_path) : ?>
			<option <?php if ($config_options->logo === $image_path) echo 'selected ';?>value="<?php echo $image_path; ?>"><?php echo $site; ?></option>
			<?php endforeach; ?>
		</select>
   </p>

   <p>
      <?php echo form_label('Notify Author on Date of Posting?', 'notification_opt_in'); ?>
      <?php 
      echo form_checkbox(
         'notification_opt_in', //name
         '1',  // value
         ((int)$config_options->notification_opt_in === 1) ? true : false, // checked or not?
         'id="notification_opt_in"'); 
      ?>
   </p>

   <p<?php if ( (int)$config_options->notification_opt_in === 0 ) echo ' class="hidden"'; ?>>
      <?php echo form_label('Write Your Email Template:', 'notification_message'); ?>
      <?php echo form_textarea(
         'notification_message', 
         ( strlen($config_options->notification_message) < 1 ) 
            ? "Congratulations! Your tutorial, \"{title}\" has now been posted on {site_name}. Please invoice us for \${cost}. \r\n \r\n{invoicing_instructions}"
            : $config_options->notification_message,
         'id="notification_message"'
      ); ?>
      <span>Available template tags: <code>{title}, {cost}, {invoicing_instructions}, {site_name}, {link} </code></span>
   </p>

	<p>
		<?php echo form_submit('submit', 'Submit'); ?>
		<?php echo anchor(site_url(), 'Cancel', 'class="button"'); ?>
	</p>
	<?php echo form_close(); ?>
</div>
