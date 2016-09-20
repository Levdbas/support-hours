(function( $ ) {
	'use strict';
$( document ).ready(function() {
	 var fromHidden = -90;

	 // utility funciton to align 0 degrees with top
	 // takes degrees and returns degrees - 45
	 function topAlign(degrees) {
	     return degrees - 45
	 };

	 // utility function to rotate a jQuery element
	 // takes element and the degree of rotation (from the top)
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

	 // function to draw semi-circle
	 // takes a jQuery element and a value (between 0 and 1)
	 // element must contain four .arc_q elements
	 function circle(el, normalisedValue) {
	   var degrees = normalisedValue * 360;             // turn normalised value into degrees
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
})( jQuery );
