$(document ).ready(function() {

  var _token = $('meta[name="_token"]').attr('content');

  function populate_tickets(){

    dataTable = $('#ticket_table').DataTable({
                    "serverSide": true,
                    "processing": false,
                    "pageLength": 50,
                    "ordering": false,
                    "ajax":
                        {
                            url: "http://"+window.location.hostname+"/ticket/get-tickets",
                            type: "POST",
                            data: {
                               'department_id':$("#department").val(),
                               'priority':$("#priority").val(),
                               'status': 1,
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

    }
    populate_tickets();

    $("#priority").on("change",function(){
      dataTable.destroy();
      populate_tickets();
    });
    $("#department").on("change",function(){
      dataTable.destroy();
      populate_tickets();
    });
    $("#creator").on("change",function(){
      dataTable.destroy();
      populate_tickets();
    });

});
