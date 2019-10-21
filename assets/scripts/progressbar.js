function progressBar() {
    function clipSizer() {
        var circleWidth = $('.progress-bar').width();
        var halfCircleWidth = Math.round(circleWidth / 2);
        $('.progress-bar__left, .progress-bar__right, .progress-bar__rotate').css({
            clip: 'rect(0px, ' + halfCircleWidth + 'px, auto, 0px)',
        });
    }

    $('.progress-bar').each(function() {
        var $target = $(this);
        var opts = {
            percent: $target.data('percent'),
            duration: 2000,
        };

        clipSizer();
        $(window).resize(function() {
            clipSizer();
        });

        var $rotate = $target.find('.progress-bar__rotate');
        setTimeout(function() {
            $rotate.css({
                transition: 'transform ' + opts.duration + 'ms linear',
                transform: 'rotate(' + Math.round(opts.percent * 3.6) + 'deg)',
            });
        }, 1);

        if (opts.percent > 50) {
            var animationRight = 'circleAnim ' + (opts.duration / opts.percent) * 50 + 'ms step-end';
            var animationLeft = 'circleAnim ' + (opts.duration / opts.percent) * 50 + 'ms step-start';
            $target.find('.progress-bar__right').css({
                animation: animationRight,
                opacity: 1,
            });
            $target.find('.progress-bar__left').css({
                animation: animationLeft,
                opacity: 0,
            });
        }
    });
}
export default progressBar;
