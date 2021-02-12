
import progressBar from './progressbar.js';
import timeInput from './timeInput.js';
import repeatRow from './repeatrow.js';
import workTableHelpers from './workTableHelpers.js';

(function ($) {
    var SupportHours = {
        common: {
            init: function () {
                timeInput();
                repeatRow();
                workTableHelpers();
                progressBar();
            },
            finalize: function () { },
        },
    };
    var UTIL = {
        fire: function (func, funcname, args) {
            var fire;
            var namespace = SupportHours;
            funcname = funcname === undefined ? 'init' : funcname;
            fire = func !== '';
            fire = fire && namespace[func];
            fire = fire && typeof namespace[func][funcname] === 'function';

            if (fire) {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function () {
            UTIL.fire('common');
            UTIL.fire('common', 'finalize');
        },
    };

    // Load Events
    $(document).ready(UTIL.loadEvents);
})(jQuery); // Fully reference jQuery after this point.
