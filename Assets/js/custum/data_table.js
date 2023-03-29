$(document).ready(function() {
    var table = $('.dataTables-grd');
    table.DataTable({
      "columnDefs": [
        //{ "targets": [0], "visible": false, "searchable": false}
      ],
      "bAutoWidth": false,
      pageLength: 10,
      responsive: true,
      dom: '<"html5buttons"B>lTfgitp',
      buttons: [{
          extend: 'copy'
        },
        //{extend: 'csv'},
        {
          extend: 'excel',
          title: 'List-pdf'
        },
        {
          extend: 'pdf',
          title: 'List-pdf'
        },
        {
          extend: 'print',
          customize: function(win) {
            $(win.document.body).addClass('white-bg');
            $(win.document.body).css('font-size', '10px');
            $(win.document.body).find('dataTables-grd').addClass('compact').css('font-size', 'inherit');
          }
        }
      ]
    });
  });