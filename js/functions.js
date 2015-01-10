/**
 * Functionality specific to Godsend.
 *
 */

jQuery(document).ready(function($) {

	var $hascomments = $('#comments').length;

	if($hascomments){
		
		$('#comments .comments-title').on("click", function() {

			$('#comments .comment-list, #comments .comment-respond, #comments > p').slideToggle();
			$('#comments .comments-title i').toggleClass('icon-up icon-down');

		});

	}

	$(document).keydown(function(e) {
		var url = false;

		if(document.querySelector('#comment:focus,#author:focus,#email:focus,#url:focus,#mcspvalue:focus')) return;

		if (e.which == 37) {  // Left arrow key code
			url = $('.comic-nav .previous a').attr('href');
		} else if (e.which == 39) {  // Right arrow key code
			url = jQuery('.comic-nav .next a').attr('href');
		}
		if (url) {
			window.location = url;
		}
	});


	$('.nav-toggle').on("click", function(e) {

		e.preventDefault();
		$('#menu-top-menu').slideToggle();

		return false;
	});

	$('.ancmnts .ancmnts-tog .icon-up').on("click", function() {
		
		var $ancmnts = $(this).closest('.ancmnts'),
			$animcomplete = 0;

		$ancmnts.find('.ancmnts-tog .tog-closed').show(0);

		$ancmnts.find('.post').slideUp( 'fast', function(){
			if($animcomplete){
				$ancmnts.removeClass('open').addClass('closed');
			}else{
				$animcomplete = 1;
			}

		});		

		$ancmnts.find('.ancmnts-tog .tog-open').slideUp('fast', function(){
			if($animcomplete){
				$ancmnts.removeClass('open').addClass('closed');
			}else{
				$animcomplete = 1;
			}
		});

	});

	$('.ancmnts .ancmnts-tog a').on("click", function(e) {

		e.preventDefault();
		
		var $ancmnts = $(this).closest('.ancmnts'),
			$animcomplete = 0;


		$ancmnts.find('.post').slideDown( 'fast', function(){
			if($animcomplete){
				$ancmnts.removeClass('closed').addClass('open');
				$ancmnts.find('.ancmnts-tog .tog-closed').hide(0);
			}else{
				$animcomplete = 1;
			}

		});		

		$ancmnts.find('.ancmnts-tog .tog-open').slideDown('fast', function(){
			if($animcomplete){
				$ancmnts.removeClass('closed').addClass('open');
				$ancmnts.find('.ancmnts-tog .tog-closed').hide(0);
			}else{
				$animcomplete = 1;
			}
		});

		return false;

	});

});