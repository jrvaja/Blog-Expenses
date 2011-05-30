<div id="add_post_form">
	<h2>Add New Record</h2>
	<?php echo form_open( 'tuts/add' ); ?>
	
	<p>
		<?php 
		echo form_label( 'Title of Post', 'title' ) . "\n";
		echo form_input( 'title', '', 'id="title"' ) . "\n";
		?>	
	</p>
	
	<p>	
		<?php
		echo form_label(' Post Type', 'post_type' );
		$options = array(
			'regular'   => 'Regular',
			'premium'   => 'Premium',
         'quick_tip' => 'Quick Tip',
         'basix'     => 'Basix'
		);
		echo form_dropdown( 'post_type', $options, 'regular' );
		?>
	</p>
	
	<p>	
		<?php
		echo form_label('Link to Post', 'link' );
		echo form_input( 'link', '', 'id="link"') . "\n";
		?>
   </p>

   <p>
		<?php
		echo form_label('Author\'s Email Address', 'author_email' );
		echo form_input( 'author_email', '', 'id="author_email"') . "\n";
		?>
   </p>
	
	<p>	
		<?php
		echo form_label( 'Date', 'date' );
		?>
		<input type="date" name="date" value="<?php echo date('Y-m-d');?>" id="date" />
	</p>
		
	<p>	
		<?php
		echo form_label(' Cost', 'cost' );
		?>
		$<input type="number" name="cost" id="cost" />
	</p>
	
	<p>
		<?php echo form_submit( 'submit', 'Add Post' ); ?>
	</p>
	 
	<?php echo form_close(); ?>
	
	<div class="errors">
		<?php echo validation_errors(); ?>
	</div>
</div>
