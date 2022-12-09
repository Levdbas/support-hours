import $ from 'jquery';
function workTableHelpers() {
    // remove workFields row.
    $('.remove-row').on('click', function () {
        $(this)
            .parents('.repeating')
            .fadeOut(300, function () {
                $(this).remove();
            });
    });
}
export default workTableHelpers;
