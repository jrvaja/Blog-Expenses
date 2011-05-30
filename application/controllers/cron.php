<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function send_notifications()
   {
      // make sure that author_email exists!!
      $this->load->model('Cron_model');
      $q = $this->Cron_model->get_todays_postings();

      if ( $q !== false ) {
         $this->send_emails($q);
      }
   }

   public function send_emails($q)
   {
      global $email;
      foreach ( $q as $e ) {
         $email = $e;
         $site_email = preg_replace('/tuts/i', '', $email->site_name);
         $message = preg_replace_callback('/{([^}]+)}/i', function($m) {
            global $email;

            if ( $m[1] === 'invoicing_instructions' ) {
               $invoicing = file_get_contents(site_url() . 'copy/invoice_us.txt');
               return $invoicing;
            }

            if ( $m[1] === 'site_name' ) {
               return ucwords($email->$m[1]) . '+';
            }
            return $email->$m[1];
         }, $email->notification_message);

         $to      =  $email->author_email;
         $subject = 'Your Article Has Been Posted!';
         $message = nl2br($message);
         $headers = 
            'From:' . ucwords($site_email) . 'tuts+ <' . $site_email . '@tutsplus.com>' . "\r\n" .
            'Reply-To: ' . $site_email . '@tutsplus.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

         mail($to, $subject, $message, $headers);
         echo 'Sent to: ' . $email->author_email .'<br />';
      }
   }


}
