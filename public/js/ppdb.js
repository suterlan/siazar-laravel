$(document).ready(function () {
    // FITUR DELETE CHECKBOX
    $("#checkAll").on("click", function (e) {
        if ($(this).is(":checked", true)) {
            $(".sub-check").prop("checked", true);
            $("#delAll").removeClass("d-none");
            $("#approve").removeClass("d-none");
        } else {
            $(".sub-check").prop("checked", false);
            $("#delAll").addClass("d-none");
            $("#approve").addClass("d-none");
        }
    });

    let subCheck = $(".sub-check");
    subCheck.each(function (e) {
        $(this).on("click", function () {
            $("#delAll").removeClass("d-none");
            $("#approve").removeClass("d-none");
        });
    });

    //PPDB DATATABLE
    $("#tbPpdb")
        .DataTable({
            stateSave: true,
            autoWidth: true,
            responsive: true,
            lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        })
        .buttons()
        .container()
        .appendTo("#tbPpdb_wrapper .col-md-6:eq(0)");
});

function selectChange(url, code, idSelect) {
    fetch(url + code)
        .then((response) => response.json())
        .then((response) => {
            let options = "";
            options += `<option value="">==Pilih==</option>`;
            response.forEach((i) => {
                options += `<option value="${i.name}" data-code="${i.code}">${i.name}</option>`;
            });

            idSelect.innerHTML = options;
        });
}

// fungsi untuk mengapprove dan menghapus data ppdb dengan menyeleksi
function selectFunction(aksi, url) {
    if (aksi == "approve") {
        let method = document.querySelector("input[name='_method']");
        method.value = "post";

        let text = "Yakin mau approve sekarang? Data PPDB akan diarsipkan!";
        if (!confirm(text)) {
            return false;
        }

        let formSelect = document.getElementById("formSelect");
        formSelect.setAttribute("action", url);

        this.form.submit();
    }

    if (aksi == "delete") {
        let method = document.querySelector("input[name='_method']");
        method.value = "delete";

        let text = "Yakin mau hapus data?";
        if (!confirm(text)) {
            return false;
        }

        let formSelect = document.getElementById("formSelect");
        formSelect.setAttribute("action", url);

        this.form.submit();
    }
}
