function workTableHelpers(  ) {

  // remove workFields row.
  $('.remove-row').click(function(e){
    $(this).parents('.repeating').fadeOut(500, function(){
      $(this).remove();
    });
  });
  /* set date field to todays date.
  $('.today').click(function(e){
    var today = $('.currentDate').text();
    e.preventDefault();
    $(this).prev().val(today);
  });
  */

  $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    defaultDate: new Date()
  });

  $('.timepicker').timepicker({
    twelveHour : false,
    defaultTime : '00:00'
  });


}
export default workTableHelpers;
