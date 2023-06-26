$(document).ready(function () {
    //USERS DATATABLE
    $("#tbUser").DataTable({
        responsive: true,
        lengthMenu: [
            [10, 20, 50, 100, -1],
            [10, 20, 50, 100, "All"],
        ],
    });
    $("#tbUserSiswa").DataTable({
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
    // table post blog
    $("#tbPost").DataTable({
        paging: false,
        info: false,
    });
    // tabel pesan pengunjung
    $("#tbPesan").DataTable();

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
    // end form tentang

    // form posts
    let body = document.getElementById("body");
    if (body) {
        var quillBody = new Quill(body, {
            modules: {
                toolbar: toolbarOptions,
            },
            theme: "snow",
        });
        quillBody.on("text-change", function (delta, oldDelta, source) {
            document.querySelector("input[name='body']").value =
                quillBody.root.innerHTML;
        });
    }
    // end form posts

    // form kirim email
    let content = document.getElementById("content");
    if (content) {
        var quillContent = new Quill(content, {
            modules: {
                toolbar: toolbarOptions,
            },
            theme: "snow",
        });
        quillContent.on("text-change", function (delta, oldDelta, source) {
            document.querySelector("input[name='content']").value =
                quillContent.root.innerHTML;
        });
    }
    // end form posts

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
                    $("#_jurusan_id").val(response.jurusan_id).change();
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

    // Ubah Kategori dengan modal
    let btnEditCategory = $(".btn-edit-category");
    btnEditCategory.each(function (e) {
        $(this).on("click", function () {
            let id_category = $(this).data("id");
            $.ajax({
                url: "/dashboard/category/edit/" + id_category,
                cache: false,
                success: function (response) {
                    // fill input edit category
                    $("#_name").val(response.name);
                    $("#_slug").val(response.slug);
                    // set action form edit category
                    $("#editKategori").attr(
                        "action",
                        "/dashboard/category/" + response.slug
                    );
                    // open modal
                    $("#editCategory").modal("show");
                },
            });
        });
    });

    // FITUR DELETE CHECKBOX
    $("#checkAll").on("click", function (e) {
        if ($(this).is(":checked", true)) {
            $(".sub-check").prop("checked", true);
            $("#delAll").removeClass("d-none");
        } else {
            $(".sub-check").prop("checked", false);
            $("#delAll").addClass("d-none");
        }
    });

    let subCheck = $(".sub-check");
    subCheck.each(function (e) {
        $(this).on("click", function () {
            $("#delAll").removeClass("d-none");
        });
    });
});

// FUNGSI GET WILAYAH INDONESIA
let provinsi = document.querySelector("#provinsi");
provinsi.addEventListener("change", async () => {
    let code =
        provinsi.options[provinsi.selectedIndex].getAttribute("data-code");
    const idSelect = document.querySelector("#kabupaten");

    const wilayah = await getWilayah("/getKabupaten?code=", code);
    updateOption(wilayah, idSelect);
});

let kabupaten = document.querySelector("#kabupaten");
kabupaten.addEventListener("change", async () => {
    let code =
        kabupaten.options[kabupaten.selectedIndex].getAttribute("data-code");
    const idSelect = document.querySelector("#kecamatan");

    const wilayah = await getWilayah("/getKecamatan?code=", code);
    updateOption(wilayah, idSelect);
});

let kecamatan = document.querySelector("#kecamatan");
kecamatan.addEventListener("change", async () => {
    let code =
        kecamatan.options[kecamatan.selectedIndex].getAttribute("data-code");
    const idSelect = document.querySelector("#kelurahan");

    const wilayah = await getWilayah("/getKelurahan?code=", code);
    updateOption(wilayah, idSelect);
});

function getWilayah(url, code) {
    return fetch(url + code)
        .then((response) => response.json())
        .then((response) => response);
}

function updateOption(wilayah, idSelect) {
    let options = "";
    options += `<option value="">==Pilih==</option>`;
    wilayah.forEach(
        (i) =>
            (options += `<option value="${i.name}" data-code="${i.code}">${i.name}</option>`)
    );
    idSelect.innerHTML = options;
}
// END FUNC GET WILAYAH
