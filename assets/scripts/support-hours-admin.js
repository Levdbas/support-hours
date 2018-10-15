import "materialize-css";
import progressBar from "./progressbar.js";
import timeInput from "./timeInput.js";
import repeatRow from "./repeatrow.js";
import workTableHelpers from "./workTableHelpers.js";

(function($) {
  $(document).ready(function() {
    timeInput();
    repeatRow();
    workTableHelpers();
  });
  $(window).load(function() {
    progressBar();
  });
})(jQuery);
