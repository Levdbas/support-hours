(function( $ ) {
	'use strict';
	function sizeCircle(){
		var width = $('.outerCircle').width();
		var circle = $('#circle');

		circle.width(width);
		circle.height(width);
		console.log(width);
	}
	$( document ).ready(function() {
		sizeCircle();
		// regexpression for matching xx:xx (4 digits at max)
		var $regexname=/^\d{2}\:(([0-5]){1}.$([0-9]|){1}$)/;
		$('.time').on('keypress keydown keyup',function(){
			if (!$(this).val().match($regexname)) {
				// there is a mismatch, hence show the error message
				$(this).next().removeClass('hidden');
				$(this).next().show();
				$('input[type="submit"]').attr('disabled','disabled');
			}
			else{
				// else, do not display message
				$(this).next().addClass('hidden');
				$('input[type="submit"]').removeAttr('disabled');
			}
		});


		var fromHidden = -90;
		function topAlign(degrees) {
			return degrees - 45
		};
		function rotate(el, degrees) {
			var degrees = topAlign(degrees || 0);
			el.css(
				'transform', 'rotate('+degrees+'deg)',
				'-webkit-transform', 'rotate('+degrees+'deg)',
				'-moz-transform', 'rotate('+degrees+'deg)',
				'-ms-transform', 'rotate('+degrees+'deg)',
				'-o-transform', 'rotate('+degrees+'deg)'
			)
		}

		function circle(el, normalisedValue) {
			var degrees = normalisedValue * 360;
			var counter = 1;                                 // keeps track of which quarter we're working with
			el.find('.arc_q').each(function(){               // loop over quarters..
				var angle = Math.min(counter * 90, degrees); // limit angle to maximum allowed for this quarter
				rotate($(this), fromHidden + angle);         // rotate from the hiding place
				counter++; // track which quarter we'll be working with in next pass over loop
			});
			if (degrees > 90) {                              // hide the cover-up square soon as we can
				el.find('.cover').css('display', 'none');
			}
		}
		// uses the the circle function to 'animate' drawing of the semi-circle
		// incrementally increses the value passed by 0.01 up to the value required
		function animate(el, normalisedValue, current) {
			var current = current || 0;
			circle(el, current);
			if (current < normalisedValue) {
				current += 0.01;
				setTimeout(function () { animate(el, normalisedValue, current); }, 1);
			}
		}

		// kick things off ..
		var circleVar = $('#circle').attr("data-Circle");
		animate($('.circle'), circleVar);
	});
	$(window).resize(function() {
		sizeCircle()
	});
})( jQuery );
