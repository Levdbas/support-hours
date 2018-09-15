function timeInput(  ) {
  // regexpression for matching xx:xx (4 digits at max)
  var $regexname=/^\d{2}\:(([0-5]){1}.$([0-9]|){1}$)/;

  $('.time').change(function () {
    if (!$(this).val().match($regexname)) {
      $(this).next().removeClass('hidden');
      $('input[type="submit"]').attr('disabled','disabled');
    } else if($(this).val().match('')) {
      //$(this).next().addClass('hidden');
      $('input[type="submit"]').removeAttr('disabled');
    } else{
      $(this).next().addClass('hidden');
      $('input[type="submit"]').removeAttr('disabled');
    }
  });

}
export default timeInput;
