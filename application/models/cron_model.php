<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron_model extends CI_Model {
	function get_todays_postings()
   {
      $sql = '
         SELECT DISTINCT expenses.user_id, title, link, cost, site_name, post_type, author_email, date(date) as date, notification_message 
         FROM expenses 
         INNER JOIN user_options
         ON user_options.user_id = expenses.user_id
         WHERE date = CURDATE() 
         AND author_email != ""
         AND notification_opt_in = 1
      ';

      $q = $this->db->query($sql);

      if ( $q->num_rows > 0 ) {
         return $q->result();
      }
      return false;      
	}
}

