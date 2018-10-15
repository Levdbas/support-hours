function workTableHelpers() {
  // remove workFields row.
  $(".remove-row").click(function(e) {
    $(this)
      .parents(".repeating")
      .fadeOut(500, function() {
        $(this).remove();
      });
  });

  $(".datepicker").datepicker({
    format: "dd-mm-yyyy",
    defaultDate: new Date()
  });
}
export default workTableHelpers;
