(function( $ ) {
	console.log('test');
	$.fn.loading = function () {
		$(this).each(function () {
			var $target  = $(this);
			var opts = {
				percent: $target.data('percent'),
				duration: 2000
			};
			var innerWidth = $('.inside').width();
			var innerWidth = Math.round(innerWidth);
			$('.progress-bar').css({
				'width': innerWidth +'px',
				'height': innerWidth +'px'
			});

			var circleWidth = $('.progress-bar').width();
			var circleWidth = Math.round(circleWidth);
			var halfCircleWidth =  Math.round(circleWidth/2);

			$('.left, .right, .rotate').css({
				'clip': 'rect(0px, ' + halfCircleWidth +'px, ' + circleWidth +'px, 0px)'
			});


			var $rotate = $target.find('.rotate');
			setTimeout(function () {
				$rotate.css({
					'transition': 'transform ' + opts.duration + 'ms linear',
					'transform': 'rotate(' + Math.round(opts.percent * 3.6) + 'deg)'
				});
			},1);

			if (opts.percent > 50) {
				var animationRight = 'toggle ' + (opts.duration / opts.percent * 50) + 'ms step-end';
				var animationLeft = 'toggle ' + (opts.duration / opts.percent * 50) + 'ms step-start';
				$target.find('.right').css({
					animation: animationRight,
					opacity: 1
				});
				$target.find('.left').css({
					animation: animationLeft,
					opacity: 0
				});
			}
		});
	}
})(jQuery);
(function( $ ) {
	$( document ).ready(function() {
		$(".progress-bar").loading();

		// regexpression for matching xx:xx (4 digits at max)
		var $regexname=/^\d{2}\:(([0-5]){1}.$([0-9]|){1}$)/;
		$('.time').on('keypress keydown keyup',function(){
			if (!$(this).val().match($regexname)) {
				$(this).next().removeClass('hidden');
				$('input[type="submit"]').attr('disabled','disabled');
			} elseif((!$(this).val().match('')) {
				$(this).next().addClass('hidden');
				$('input[type="submit"]').removeAttr('disabled');
			} else{
				$(this).next().addClass('hidden');
				$('input[type="submit"]').removeAttr('disabled');
			}
		});
		});
		$(window).resize(function() {
			$(".progress-bar").loading();
		});
	})(jQuery);
