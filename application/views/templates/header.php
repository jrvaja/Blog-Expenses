<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

   <title><?php echo $page_title; ?></title>
   
   <script>document.documentElement.className = 'js'; </script>

   <link rel="icon" href="http://envato.com/wp-content/themes/envato/images/favicon.ico"/>
   <link href='http://fonts.googleapis.com/css?family=Maiden+Orange' rel='stylesheet'>
   <?php echo link_tag( 'css/screen.css' ); ?>
   <?php echo link_tag( 'css/south-street/jquery-ui-1.8.13.custom.css'); ?>
   
   <!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
   <![endif]-->

<?php if(isset($config_options)) : ?>
   <style>
      tr.quick_tip {
         background: #<?php echo $config_options->site_color; ?>;
      }
   </style>
<?php endif; ?>
</head>
<body>

	
