$(document).ready(function() {

	$('.standard').hover(
		function(){
			$(this).find('.caption').show(400);
		},
		function(){
			$(this).find('.caption').hide();
		}
	);

	$('#popup-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
	});
	
	

});