(function() {
	var wh = $(document).height(),
		 form = $('div.admin_form'),
		 fh = form.outerHeight();
		 
	form.css( 'top', wh / 2 - fh / 2 - form.find('img.logo').height() ).fadeIn(500);


   $('#notification_opt_in').click(function() { 
   if ( $(this).is(':checked') ) {
      $(this).parent('p').next().show().find('textarea').removeAttr('disabled');
   } else $(this).parent('p').next().hide();
   });

})();
