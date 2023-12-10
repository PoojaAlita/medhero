$(function() {
  'use strict';
  
  if($('.datePickerExample').length) {
    // alert('h');
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $(".datePickerExample").datepicker( {
      format: "M-yyyy",
      startView: "months", 
      minViewMode: "months",
      endDate: "today"
    });
    $(".education_end_date_div").datepicker( {
        format: "M-yyyy",
        startView: "months", 
        minViewMode: "months",
    });
  }
});
