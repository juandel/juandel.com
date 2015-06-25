/*!
 * Start Bootstrap - Agency Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Highlight the top nav as scrolling occurs
$('body').scrollspy({
    target: '.navbar-fixed-top'
})

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});


$(document).ready(function(){
	wireEvents();
	function wireEvents(){
		$('#deleteButton').click(function(e){
			
			var er = confirm ('Are you sure you want to delete Work?');
			// alert(er);
			if (!er) {
				e.preventDefault();
			};
		});
	}
});


	if ($('.container-page').hasClass('web')) {
		$('.navbar-default').css('opacity', 0);
		$('.nav-fix-height').remove();
		$(document).on("scroll", function(){
			var position = $(document).scrollTop();
			$('.navbar-default').css('opacity', (position / 300));
		});
	};

	
		
