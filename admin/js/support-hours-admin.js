(function($) {
	$( document ).ready(function() {
		// for each .progress-bar element, start setting up the time circle. Manages the css transitions etc.
		$(".progress-bar").each(function () {
			var $target  = $(this);
			var opts = {
				percent: $target.data('percent'),
				duration: 2000
			};

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

		// regexpression for matching xx:xx (4 digits at max)
		var $regexname=/^\d{2}\:(([0-5]){1}.$([0-9]|){1}$)/;
		$('.time').on('keypress keydown keyup',function(){
			if (!$(this).val().match($regexname)) {
				$(this).next().removeClass('hidden');
				$('input[type="submit"]').attr('disabled','disabled');
			} else if($(this).val().match('')) {
				$(this).next().addClass('hidden');
				$('input[type="submit"]').removeAttr('disabled');
			} else{
				$(this).next().addClass('hidden');
				$('input[type="submit"]').removeAttr('disabled');
			}
		});

		// Prepare new attributes for the repeating section
		var attrs = ['for', 'id', 'name'];
		function resetAttributeNames(section) {
			var tags = section.find('input, label'), idx = section.index()-1;
			tags.each(function() {
				var $this = jQuery(this);
				jQuery.each(attrs, function(i, attr) {
					var attr_val = $this.attr(attr);
					if (attr_val) {
						$this.attr(attr, attr_val.replace(/\[workFields\]\[\d+\]\[/, '\[workFields\]\['+(idx + 1)+'\]\['))
					}
				})
			})
		}
		// remove workFields row.
		$('.remove-row').click(function(e){
			$(this).parents('.repeating').fadeOut(500, function(){
				$(this).remove();
			});
		});
		// set date field to todays date.
		$('.today').click(function(e){
			var today = $('.currentDate').text();
			e.preventDefault();
			$(this).prev().val(today);
		});
    $('.datepicker').datepicker({
			format: 'dd-mm-yyyy',
			defaultDate: new Date()
		});
    $('.timepicker').timepicker({
			twelveHour : false,
			defaultTime : '00:00'
		});
		// Clone the previous workField, and remove all of the values
		$('.repeat').click(function(e){
			e.preventDefault();
			var lastRepeatingGroup = jQuery('.repeating').last();
			var num = parseInt( lastRepeatingGroup.data("number"));
			var cloned = lastRepeatingGroup.clone(true);
			cloned.find("input:not(:radio)").val("");
			cloned.find("select").val("");
			cloned.find("input:radio").attr("checked", false);
			cloned.hide();
			cloned.insertAfter(lastRepeatingGroup);
			cloned.fadeIn(500);
			resetAttributeNames(cloned);
			$('.datepicker').datepicker({
				format: 'dd-mm-yyyy',
				defaultDate: new Date()
			});
			$('.timepicker').timepicker({
				twelveHour : false,
				defaultTime : '00:00'
			});
		});
	});
	})(jQuery);
