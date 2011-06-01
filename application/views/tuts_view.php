<div class="header">
	<header>
      <h1>
      <a href="<?php echo site_url(); ?>">
         <img src="<?php echo $config_options->logo; ?>" alt="Tuts" />
      </a>
      </h1>
		
		<dl>
			<dt>Expenditures</dt>
			<dd id="total_expenses"></dd>
			
			<dt>Budget</dt>
			<dd id="budget">$<?php echo $config_options->budget; ?></dd>
			
			<dt>Difference</dt>
			<dd id="difference">0</dd>
			
			<dt>Total Postings</dt>
         <dd id="post_count">0</dd>

         <dt>Avg. Cost</dt>
         <dd id="average_cost">0</dd>
		</dl>
	</header>
</div>
	
<div class="container">
	
	<h2>
      <?php if ( gettype( $rows ) === 'string' ) : ?>
      No expenditures or records for this month.
      <?php else : ?>
      Expenses in <?php echo $month; ?> 
      <?php endif; ?>

		<span>
			<a href="<?php echo site_url('tuts/add');?>" class="add_post icon"> 
				Add New Entry 
			</a>
		</span> 
	</h2>
	
	<div class="filter">
		<h4>Filter By:</h4>
		<select>
			<option value="all" selected="selected">All</option>
			<option value="regular">Regular Posts</option>
			<option value="basix">Basix</option>
			<option value="quick_tip">Quick Tips</option>
			<option value="premium">Premium</option>
			<option value="month">Month</option>
		</select>
		
		<select name="filter_month" id="filter_month">
			<option value="January">January</option>
			<option value="February">February</option>
			<option value="March">March</option>
			<option value="April">April</option>
			<option value="May">May</option>
			<option value="June">June</option>
			<option value="July">July</option>
			<option value="August">August</option>
			<option value="September">September</option>
			<option value="October">October</option>
			<option value="November">November</option>
			<option value="December">December</option>
		</select>
	</div>
	
	
	<table id="expenses">
		
      <?php if ( is_array($cols) ) : ?>
		<thead>
			<tr>
				<?php foreach($cols as $col) : ?>
					<?php if ( preg_match('/id|link|details|post_type/', $col) ) continue; ?>
					<th> <?php echo anchor( "tuts/index/$col/" . $this->uri->segment(4), ucwords($col) ); ?></th>
				<?php endforeach; ?>
				<th>Options</th>
			</tr>
		</thead>
		<?php endif; ?>
		
		<tbody>
		
		<?php if ( gettype($rows) !== 'string' ) :
			foreach( $rows as $row ) : ?>
				<?php
				$type = strtolower( $row->post_type );
				switch( $type ) {
					case 'premium' :
						echo '<tr class="premium">';
						break;
					case 'quick_tip' : 
						echo '<tr class="quick_tip">';
                  break;
               case 'basix' :
                  echo '<tr class="basix">';
                  break;
					default : 
						echo '<tr class="regular row">';
				}
				?>
				
				<?php foreach( $row as $name => $field ) : ?>
					
					<?php if ( preg_match( '/details|link|id|post_type/i', $name ) ) continue; ?>
					
					<?php
						switch( $name ) {
							case 'title' : ?>
								<td class="title">
									<a target="_blank" href="<?php echo $row->{'link'}; ?>">
										<?php echo $field; ?>
									</a>
								</td>
								<?php break;
							
							case 'date' : ?>
								<td class="date"> <?php $date = explode(' ', $field); echo $date[0]; ?></td>
								<?php break;
							
							default : ?>
								<td class="<?php echo $name; ?>"> <?php echo $field; ?></td>
								<?php break;
						} ?>
					<?php endforeach; ?> 
					
					<td class="options">
						<ul>
							<li><a class="update_row icon" href="<?php echo base_url();?>tuts/update/<?php echo $row->id;?>">U</a></li>
							<li><a class="delete_row icon" href="<?php echo base_url();?>tuts/delete/<?php echo $row->id;?>">D</a></li>
						</ul>
					</td>
			</tr>
			
			<?php endforeach;  ?>
			<?php endif; ?>
					
		</tbody>
		
		 <script id="rowTemplate" type="text/x-jquery-tmpl">
         <tr class="${postType}">
            <td class="title"> ${title} </td>
            <td class="cost"> ${cost} </td>
            <td class="date"> ${date} </td>
            <td class="options">
					<ul>
						<li><a class="update_row icon" href="<?php echo base_url();?>tuts/update/${id}">U</a></li>
						<li><a class="delete_row icon" href="<?php echo base_url();?>tuts/delete/${id}">D</a></li>
					</ul>
				</td>
         </div>
      </script>
	
	</table>
	
	<ul class="footer_options">
		<li><?php echo anchor('admin/config', 'Options');  ?></li>
		<li><?php echo anchor('admin/signout', 'Logout');  ?></li>
	</ul>
	

</div>
