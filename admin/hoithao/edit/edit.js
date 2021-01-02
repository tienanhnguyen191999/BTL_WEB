$(document).ready(function () {
  $("#main-table").DataTable({
    paging: true,
    lengthChange: false,
    searching: false,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
  });

  $("#thoigian").daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      timePicker: true,
      minYear: 2020,
      maxYear: 2021,
      locale: {
        format: 'yyyy-MM-DD HH:mm:ss'
      }
  }, function(start, end, label) {
    // Event here
  });
});
