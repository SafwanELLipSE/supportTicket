$(document ).ready(function() {

var _token = $('meta[name="_token"]').attr('content');
  dataTable = $('#ticket_table').DataTable({
                  "serverSide": false,
                  "processing": false,
                  "pageLength": 50,
                  "order": [],
                  "ajax":
                      {
                          url: "http://127.0.0.1:8000/ticket/get-all-tickets",
                          type: "POST",
                          data: {

                              _token
                          },
                      },
                  "language": {
                      "paginate": {
                          "previous": "&#706",
                          "next": "&#707"
                      }
                  }
              });

});
