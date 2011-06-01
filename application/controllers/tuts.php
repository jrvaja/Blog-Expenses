<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tuts extends CI_Controller {
	
	public function __construct()
	{
		session_start();
		parent::__construct();
		if ( !isset($_SESSION['username']) ) redirect( 'admin' );
	}
	
	public function index( $sort_by = 'date', $month = null, $year = null )
	{
		if ( !isset( $month ) ) $month = date('F');
      if ( !isset( $year ) ) $year = date('Y');

		if ( !preg_match('/title|date|cost/i', $sort_by) ) $sort_by = 'date';
		$q = $this->tuts_model->get_all( 'expenses', $month, $year, $sort_by );
		
		$data = array(
			'rows' => (isset($q['rows'])) ? $q['rows'] : 'none',
			'cols' => $q['cols'],
			'view' => 'tuts_view',
			'month' => ucWords($month),
         'sort_by' => $sort_by,
         'page_title' => 'Tuts+ Expenditures',
			'config_options' => $this->tuts_model->get_config_options()
		);
		
		$this->load->view( 'template', $data );
   }

   public function date()
   {
      $year = $this->uri->segment(4);
      if ( strlen( $year < 4 ) ) {
         $year = date('Y');
      }
      $this->index(null, $this->uri->segment(3), $year);
   }
	
	public function add()
	{
		$data = array();
		
		$this->load->library( 'form_validation' );
		$this->form_validation->set_rules( 'title', 'Title', 'required' );
		$this->form_validation->set_rules( 'date', 'Date', 'required' );
		$this->form_validation->set_rules( 'cost', 'Cost', 'required|numeric' );
		$this->form_validation->set_rules( 'author_email', 'Author Email', 'valid_email' );
		
		if ( $this->form_validation->run() === FALSE ) {
			$data['view'] = 'add';
			$this->load->view( 'template', $data );
		}
		else {
			// AJAX request??	
			if ( !isset($_SERVER['HTTP_X_REQUESTED_WITH']) ) {
				$post = $_POST;
				array_pop($post);
				
				$this->tuts_model->insert( $post );
				
				redirect( 'tuts' );	
			} else {
				$insert_id = $this->tuts_model->insert( $_POST );
				echo $insert_id;
			}
		}
	}
	
	public function update( $id )
	{
		$data = array();
		
		$this->load->library( 'form_validation' );
		$this->form_validation->set_rules( 'title', 'Title', 'required' );
		$this->form_validation->set_rules( 'date', 'Date', 'required' );
		$this->form_validation->set_rules( 'cost', 'Cost', 'required|numeric' );
		
		if ( $this->form_validation->run() === FALSE ) {
			$data['rows'] = $this->db->where( 'id', (int)$id )->get( 'expenses' )->result();
			$data['view'] = 'update';
			$this->load->view( 'template', $data );
		}
		else {
			$this->tuts_model->update( $_POST, $id );
			
			if ( !isset($_SERVER['HTTP_X_REQUESTED_WITH']) ) {
				redirect( 'tuts' );				
			}
			echo 1; // for JS (bad boy, Jeffrey)
			
		}
	}
	
	public function delete( $id )
	{
		$this->db->where('id', (int)$id )->delete( 'expenses' );
		redirect( 'tuts' );
	}
}
