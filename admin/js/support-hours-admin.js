(function( $ ) {
	console.log('test');
	$.fn.loading = function () {
		$(this).each(function () {
			var $target  = $(this);
			var opts = {
				percent: $target.data('percent'),
				duration: 2000
			};
			var innerWith = $('.inside').width();
			var circleWith = $('.progress-bar').width();
			$('.progress-bar').css({
				'width': innerWith +'px',
				'height': innerWith +'px'
			});
			$('.left, .right, .rotate').css({
				'clip': 'rect(0px, ' + circleWith/2 +'px, ' + circleWith +'px, 0px)'
			});

			var $rotate = $target.find('.rotate');
			setTimeout(function () {
				$rotate.css({
					'transition': 'transform ' + opts.duration + 'ms linear',
					'transform': 'rotate(' + opts.percent * 3.6 + 'deg)'
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
	});
	$(window).resize(function() {
		$(".progress-bar").loading();
	});
})(jQuery);
