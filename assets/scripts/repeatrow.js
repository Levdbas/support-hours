function repeatRow() {
    // Prepare new attributes for the repeating section
    var attrs = ['for', 'id', 'name'];
    function resetAttributeNames(section, num) {
        var tags = section.find('input, label');
        tags.each(function () {
            var $this = jQuery(this);
            jQuery.each(attrs, function (i, attr) {
                var attr_val = $this.attr(attr);
                if (attr_val) {
                    $this.attr(attr, attr_val.replace(/\[workFields\]\[\d+\]\[/, '[workFields][' + (num + 1) + ']['));
                }
            });
        });
    }

    // Clone the previous workField, and remove all of the values
    $('.repeat').on('click', function (e) {
        e.preventDefault();
        var lastRepeatingGroup = jQuery('.repeating:last-of-type');
        var num = parseInt(lastRepeatingGroup.attr('data-number'));
        var cloned = lastRepeatingGroup.clone(true);
        var timepicker = cloned.find('.sh-datepicker');

        cloned.find('input:not(:radio)').val('');
        cloned.find('select').val('');
        cloned.find('input:radio').attr('checked', false);
        cloned.hide();
        cloned.insertAfter(lastRepeatingGroup);
        cloned.fadeIn(500);
        cloned.attr('data-number', num + 1);
        resetAttributeNames(cloned, num);
        cloned.find('input.time-used').attr('checked', true); // sets new repeated time.used button to checked.


        M.Datepicker.init(timepicker[0], {
            format: 'dd-mm-yyyy',
            defaultDate: new Date(),
            setDefaultDate: true,
        });
    });
}
export default repeatRow;
