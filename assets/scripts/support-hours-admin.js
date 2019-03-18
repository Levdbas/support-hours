import "materialize-css";
import progressBar from "./progressbar.js";
import timeInput from "./timeInput.js";
import repeatRow from "./repeatrow.js";
import workTableHelpers from "./workTableHelpers.js";

(function($) {

  var SupportHours = {
    init: function() {
      timeInput();
      repeatRow();
      workTableHelpers();
    },
    finalize: function() {
      progressBar();
    },
  };
  var UTIL = {
    fire: function(funcname, args) {
      var fire;
      var namespace = SupportHours;
      funcname = funcname === undefined ? 'init' : funcname;
      fire = fire && namespace;
      fire = fire && typeof namespace[funcname] === 'function';

      if (fire) {
        namespace[funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire();
      UTIL.fire('finalize');
    },
  };
  $(document).ready(UTIL.loadEvents);
})(jQuery);
