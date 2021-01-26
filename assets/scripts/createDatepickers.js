export default function createDatePickers() {
   var elems = document.querySelectorAll('.sh-datepicker');
   var instances = M.Datepicker.init(elems, {
      format: 'dd-mm-yyyy',
      defaultDate: new Date(),
   });
}