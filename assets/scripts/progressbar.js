function progressBar() {
    $('.progress-bar').each(function() {
        var target = $(this);

        // Cast `null` to 0
        const numericScore = Number(target.data('percent'));
        const gaugeArc = $('.sh-gauge__arc');
        // 352 is ~= 2 * Math.PI * gauge radius (56)
        // https://codepen.io/xgad/post/svg-radial-progress-meters
        // score of 50: `stroke-dasharray: 176 352`;
        /** @type {?SVGCircleElement} */

        if (gaugeArc) {
            var cssDash = (numericScore * 352) / 100;
            $(gaugeArc).css({
                strokeDasharray: cssDash + ' 352',
            });
        }
    });
}
export default progressBar;
