
;(function($) {

	$('.wpxon-tab-nav a').on('click',function (e) {
		e.preventDefault();
		$(this).addClass('active').siblings().removeClass('active');
	});

	$('.wpxon-tab-nav .begin').on('click',function (e) {		
		$('.wpxon-tab-wrapper .begin').addClass('show').siblings().removeClass('show');
	});	
	$('.wpxon-tab-nav .actions, .wpxon-tab .actions').on('click',function (e) {		
		e.preventDefault();
		$('.wpxon-tab-wrapper .actions').addClass('show').siblings().removeClass('show');

		$('.wpxon-tab-nav a.actions').addClass('active').siblings().removeClass('active');

	});	
	$('.wpxon-tab-nav .support').on('click',function (e) {		
		$('.wpxon-tab-wrapper .support').addClass('show').siblings().removeClass('show');
	});	
	$('.wpxon-tab-nav .changelog').on('click',function (e) {		
		$('.wpxon-tab-wrapper .changelog').addClass('show').siblings().removeClass('show');
	});	


	$('.wpxon-tab-wrapper .install-now').on('click',function (e) {	
		$(this).replaceWith('<p style="color:#23d423;font-style:italic;font-size:14px;">Plugin installed and active!</p>');
	});	
	$('.wpxon-tab-wrapper .install-now.importer-install').on('click',function (e) {	
		$('.importer-button').show();
	});	


})(jQuery);
