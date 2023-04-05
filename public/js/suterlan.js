$(document).ready(function () {
    //USERS DATATABLE
    $("#tbUser").DataTable({
        responsive: true,
        lengthMenu: [
            [10, 20, 50, 100, -1],
            [10, 20, 50, 100, "All"],
        ],
    });

    // tabel jurusan
    $("#tbJurusan").DataTable();
    // tabel siswa
    $("#tbSiswa").DataTable();

    // MODUL TENTANG
    // JAVASCRIPT QUILL EDITOR
    // options quill toolbar
    var toolbarOptions = [
        // [
        //     {'font': []}
        // ],
        [{ header: [1, 2, 3, 4, 5, 6, false] }],
        ["bold", "italic", "underline", "strike"],
        ["blockquote", "code-block"],
        [{ header: 1 }, { header: 2 }],
        [{ list: "ordered" }, { list: "bullet" }],
        [{ script: "sub" }, { script: "super" }],
        [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
        [{ direction: "rtl" }], // text direction
        [{ color: [] }, { background: [] }], // dropdown with defaults from theme
        [{ align: [] }],
        ["clean"], // remove formatting button
    ];

    // form tentang
    let sambutan = document.getElementById("sambutan");
    if (sambutan) {
        var quillSambutan = new Quill(sambutan, {
            modules: {
                toolbar: toolbarOptions,
            },
            theme: "snow",
        });
        quillSambutan.on("text-change", function (delta, oldDelta, source) {
            document.querySelector("input[name='sambutan']").value =
                quillSambutan.root.innerHTML;
        });
    }

    let misi = document.getElementById("misi");
    if (misi) {
        var quillMisi = new Quill(misi, {
            modules: {
                toolbar: toolbarOptions,
            },
            theme: "snow",
        });
        quillMisi.on("text-change", function (delta, oldDelta, source) {
            document.querySelector("input[name='misi']").value =
                quillMisi.root.innerHTML;
        });
    }

    // Ubah Kelas with modal
    let btnEditKelas = $(".btn-edit-kelas");
    btnEditKelas.each(function () {
        $(this).on("click", function () {
            let id_kelas = $(this).data("id");
            $.ajax({
                url: "/dashboard/kelas/" + id_kelas + "/edit",
                cache: false,
                success: function (response) {
                    // fill the modal input
                    $("#_id").val(response.id);
                    $("#_nama").val(response.nama);
                    $("#_guru_id").val(response.guru_id).change();
                    // open modal edit
                    $("#ubahKelasModal").modal("show");
                    $("#formUbahKelas").attr(
                        "action",
                        "/dashboard/kelas/" + response.id
                    );
                },
            });
        });
    });
});
