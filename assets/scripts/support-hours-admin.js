import 'materialize-css';
import progressBar from './progressbar.js';
import timeInput from './timeInput.js';
import repeatRow from './repeatrow.js';
import workTableHelpers from './workTableHelpers.js';

(function($) {
	$( document ).ready(function() {
		progressBar();
		timeInput();
		repeatRow();
		workTableHelpers();
	});
})(jQuery);
