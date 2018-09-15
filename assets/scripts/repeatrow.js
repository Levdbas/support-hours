function repeatRow() {

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

  // Clone the previous workField, and remove all of the values
  $('.repeat').click(function(e){
    e.preventDefault();
    var lastRepeatingGroup = jQuery('.repeating').last();
    var num = parseInt( lastRepeatingGroup.data("number"));
    var cloned = lastRepeatingGroup.clone(true);
    cloned.find("input:not(:radio)").val("");
    cloned.find("select").val("");
    cloned.find("input:radio").attr("checked", false);
    cloned.find("input.time-used").attr("checked", true);
    cloned.hide();
    cloned.insertAfter(lastRepeatingGroup);
    cloned.fadeIn(500);
    resetAttributeNames(cloned);
    $('.datepicker').datepicker({
      format: 'dd-mm-yyyy',
      defaultDate: new Date(),
      setDefaultDate: true
    });
    $('.timepicker').timepicker({
      twelveHour : false,
      defaultTime : '00:00'
    });
  });

}
export default repeatRow;
