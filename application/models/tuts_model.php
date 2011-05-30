<?php

class Tuts_model extends CI_Model {
	function __construct()
	{
		
	}
	
	public function get_all( $table_name, $month, $year, $sort_by )
	{
		// TODO - WHERE method is a mess. Clean up.
		$cols = array('id','title', 'link', 'post_type', 'cost', 'date' );		
		$ret = array();
		
		$q = $this
				->db
				->select(implode(', ', $cols))
				->from($table_name)
				->where('user_id', $_SESSION['user_id'])
				->where('YEAR(date) = YEAR("' . $year . '-1-01") AND MONTH(date) = MONTH("' . $year . '-' . $this->month_lookup( $month ) . '-01")')
				->order_by( $sort_by, 'asc' )
				->get();

		$ret['cols'] = $cols;				
				
		if ( $q->num_rows() > 0 ) {
			$ret['rows'] = $q->result();
		}
		return $ret;
	}
	
	public function insert( $data )
	{
		$data['user_id'] = $_SESSION['user_id'];
		$this->db->insert( 'expenses', $data );
		return $this->db->insert_id();	
	}
	
	public function update( $data, $id ) 
	{
		if ( $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest' ) {
			array_pop( $data );
		}
		$this->db->where('id', (int)$id )->update( 'expenses', $data );
	}
	
	public function get_config_options()
	{
		$q = $this->db
					  ->select('budget, logo, site_color')
					  ->from('user_options')
					  ->where('user_id', $_SESSION['user_id'])
					  ->get();
					  
		if ( $q->num_rows > 0 ) {
			return $q->row();
		}		
	}
	
	protected function month_lookup( $month_name )
	{
		$month_name = ucWords($month_name);
		$lookup = array(
			'January' => 1,
			'February' => 2,
			'March' => 3,
			'April' => 4,
			'May' => 5,
			'June' => 6,
			'July' => 7,
			'August' => 8,
			'September' => 9,
			'October' => 10,
			'November' => 11,
			'December' => 12
		); 
		
		return $lookup[$month_name];
	}
	
}
