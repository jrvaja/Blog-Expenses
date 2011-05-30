<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct()
	{
		session_start();
		parent::__construct();
		$this->load->library( 'form_validation' );
	}

	public function index()
	{
		if ( isset($_SESSION['username']) ) redirect('tuts');
      $data['view'] = 'admin/login_view';
      $data['page_title'] = 'Login';
		$this->load->view('template', $data);
	}
	
	public function signin()
	{		
		$this->form_validation->set_rules( 'username', 'Username', 'required|valid_email' );
		$this->form_validation->set_rules( 'password', 'Password', 'required|min_length[4]' );
		
		if ( $this->form_validation->run() !== FALSE ) {
			$q = $this->db
				  ->where('email', $this->input->post('username'))
				  ->where('password', sha1($this->input->post('password')))
				  ->get('users');
				  				  
			if ( $q->num_rows > 0 ) {
				$_SESSION['username'] = $this->input->post('username');
				$_SESSION['user_id'] = $q->row()->id;
				
				redirect('tuts');
			}
		}
		
		$this->index();
	}

	public function register()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'required|min_length[2]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|min_length[2]');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
		$this->form_validation->set_rules('password_verify', 'Password Verification', 'matches[password]');
		
		if ( $this->form_validation->run() !== FALSE ) {
			$post = $_POST;
			# Get rid of Submit and password_verify inputs. 
			array_pop($post); array_pop($post);
			$post['password'] = sha1($post['password']);
			
			$this->db->insert('users', $post);
			if ( $this->db->insert_id() > 0 ) {
				$_SESSION['username'] = $this->input->post('email');
				$_SESSION['user_id'] = $this->db->insert_id();
				
				redirect('admin/config');
			}			
		}
		
      $data['view'] = 'admin/register_view';
      $data['page_title'] = 'Register for an Account';
		$this->load->view('template', $data);
	}
	
	public function signout()
	{
		session_destroy();
		$this->index();
	}
	
	public function config()
   {
		if ( strlen($this->input->post('budget')) > 0 ) {
			// slice off Submit button. 
			$data = $_POST;			
         array_pop($data);

         preg_match('/logos\/(.+)\.jpg$/i', $data['logo'], $site_name);
         $lookup = array(
            'nettuts' => '41a197',
            'psdtuts' => 'ff5b5b',
            'vectortuts' => '498fc3',
            'audiotuts' => '69a100',
            'aetuts' => '7e5c8f',
            'activetuts' => 'cecece',
            'cgtuts' => '934a57',
            'phototuts' => '309eb5',
            'mobiletuts' => 'e3b800',
            'webdesigntuts' => '29816e'
         );

         if ( !isset($data['notification_opt_in']) ) $data['notification_opt_in'] = 0;
         $data['site_color'] = $lookup[$site_name[1]];
         $data['user_id'] = $_SESSION['user_id'];
         $data['site_name'] = $site_name[1];

			// insert options into the database
			$this->db
				   ->where('user_id', $_SESSION['user_id'])
				   ->update('user_options', $data);
			
			redirect(site_url());

		} else {
			$config_options = $this->db->where('user_id', $_SESSION['user_id'])->get('user_options');
			// if the user has a record in the database...
			if ( $config_options->num_rows > 0 ) {
				$data['config_options'] = $config_options->row();
				$data['tuts_site'] = array(
					'Nettuts+' => site_url() . 'img/logos/nettuts.jpg', 
					'Psdtuts+' =>site_url() . 'img/logos/psdtuts.jpg',
					'Vectortuts+' =>site_url() . 'img/logos/vectortuts.jpg',
					'Phototuts+' =>site_url() . 'img/logos/phototuts.jpg',
					'Cgtuts+' =>site_url() . 'img/logos/cgtuts.jpg',
					'Aetuts+' =>site_url() . 'img/logos/aetuts.jpg',
					'Webdesigntuts+' =>site_url() . 'img/logos/webdesigntuts.jpg',
					'Mobiletuts+' =>site_url() . 'img/logos/mobiletuts.jpg',
					'Audiotuts+' => site_url() . 'img/logos/mobiletuts.jpg',
					'Activetuts+' => site_url() . 'img/logos/activetuts.jpg'
				);
				
				$data['view'] = 'admin/config';
            	$data['page_title'] = 'Configuration Options';

				$this->load->view( 'template', $data );
			} else {
				// otherwise, create one for them.
				$this->db->insert('user_options', array('user_id' => $_SESSION['user_id']));
				redirect('admin/config');
			}
		}
		
	}
}
