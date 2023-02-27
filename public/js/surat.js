$(document).ready(function(){
    // KLASIFIKASI
    $("#tbKlasifikasi").DataTable({
        autoWidth: true,
        pagingType: "full_numbers",
    });

    // SURAT KELUAR
    $("#tbSuratKeluar").DataTable({
        lengthChange: true, 
        autoWidth: true,
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']
      }).buttons().container().appendTo('#tbSuratKeluar_wrapper .col-md-6:eq(0)');

    $(".table-surat-keluar").DataTable({ 
        lengthChange: true, 
        autoWidth: true,
      });

    // SURAT MASUK
    $("#tbSuratMasuk").DataTable({
        autoWidth: true,
        lengthMenu: [
            [10, 20, 50, 100, -1],
            [10, 20, 50, 100, "All"],
        ],
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']
    }).buttons().container().appendTo('#tbSuratMasuk_wrapper .col-md-6:eq(0)');
    
});

