$(document).ready(function(){
    // FITUR DELETE CHECKBOX 
    $('#checkAll').on('click', function(e){
        if($(this).is(':checked', true)){
          $('.sub-check').prop('checked', true);
          $('#delAll').removeClass('d-none');
        }else{
          $('.sub-check').prop('checked', false);
          $('#delAll').addClass('d-none');
        }
      });
      
      let subCheck = $('.sub-check');
      subCheck.each(function(e){
        $(this).on('click', function(){
          $('#delAll').removeClass('d-none');
        });
      });

    //PPDB DATATABLE 
    $("#tbPpdb").DataTable({
        responsive:true,
        lengthMenu: [
            [10, 20, 50, 100, -1],
            [10, 20, 50, 100, "All"],
        ],
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']
    }).buttons().container().appendTo('#tbPpdb_wrapper .col-md-6:eq(0)');
});