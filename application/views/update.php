<div id="update_post_form">
	<h2>Update Record</h2>
	<?php echo form_open( 'tuts/update/' . $rows[0]->id ); ?>
	
	<p>
		<?php 
		echo form_label( 'Title of Post', 'title' ) . "\n";
		echo form_input( 'title', $rows[0]->title , 'id="title"' ) . "\n";
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
		echo form_dropdown(' post_type', $options, $rows[0]->post_type );
		?>
	</p>
	
	<p>	
		<?php
		echo form_label(' Link to Post', 'link' );
		echo form_input( 'link', $rows[0]->link, 'id="link"') . "\n";
		?>
   </p>

   <p>
		<?php
		echo form_label('Author\'s Email Address', 'author_email' );
		echo form_input( 'author_email', $rows[0]->author_email, 'id="author_email"') . "\n";
		?>
   </p>
	
	<p>	
		<?php
		echo form_label( 'Date', 'date' );
		echo form_input( 'date', preg_replace('/ .+/', '', $rows[0]->date), 'id="date"') . "\n";
		?>
	</p>
	
	<p>	
		<?php
		echo form_label(' Cost', 'cost' );
		echo form_input( 'cost', $rows[0]->cost, 'id="cost"') . "\n";
		?>
	</p>
	
	<p>
		<?php echo form_submit( 'submit', 'Update Post' ); ?>
	</p>
	 
	<?php echo form_close(); ?>
	
	<div class="errors">
		<?php echo validation_errors(); ?>
	</div>
</div>
