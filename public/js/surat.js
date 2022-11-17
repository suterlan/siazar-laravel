// KLASIFIKASI
$("#tbKlasifikasi").DataTable({
    autoWidth: true,
    pagingType: "full_numbers",
});

// SURAT KELUAR
$("#tbSuratKeluar").DataTable({
    autoWidth: true,
    stateSave: true,
    lengthMenu: [
        [10, 20, 50, 100, -1],
        [10, 20, 50, 100, "All"],
    ],
});
$("#tbSuratPenerimaan").DataTable({
    autoWidth: true,
    stateSave: true,
    lengthMenu: [
        [10, 20, 50, 100, -1],
        [10, 20, 50, 100, "All"],
    ],
});
$("#tbSuratPanggilan").DataTable({
    autoWidth: true,
    stateSave: true,
    lengthMenu: [
        [10, 20, 50, 100, -1],
        [10, 20, 50, 100, "All"],
    ],
});

// SURAT MASUK
$("#tbSuratMasuk").DataTable({
    autoWidth: true,
    lengthMenu: [
        [10, 20, 50, 100, -1],
        [10, 20, 50, 100, "All"],
    ],
});
