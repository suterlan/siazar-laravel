$(document).ready(function(){
    //USERS DATATABLE 
    $("#tbUser").DataTable({
        responsive:true,
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
        paging:false,
        info:false,
    });

    // MODUL TENTANG
    // JAVASCRIPT QUILL EDITOR
        // options quill toolbar
        var toolbarOptions = [
          // [
          //     {'font': []}
          // ],
          [
              {'header': [1, 2, 3, 4, 5, 6, false]}
          ],
          ['bold', 'italic', 'underline', 'strike'],
          ['blockquote', 'code-block'],
          [
              {'header': 1},
              {'header': 2}
          ],
          [
              {'list': 'ordered'},
              {'list': 'bullet'}   
          ],
          [
              {'script': 'sub'},
              {'script': 'super'}
          ],
          [
              {'indent': '-1'},
              {'indent': '+1'}
          ], // outdent/indent
          [
              {'direction': 'rtl'}
          ], // text direction
          [
              {'color': []},
              {'background': []}
          ], // dropdown with defaults from theme
          [
              {'align': []}
          ],
          ['clean'] // remove formatting button
        ];      

    // form tentang
    let sambutan = document.getElementById('sambutan');
    if(sambutan){
        var quillSambutan = new Quill(sambutan, {
            modules:
            {
            toolbar: toolbarOptions
            },
            theme: 'snow'
        });
        quillSambutan.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='sambutan']").value = quillSambutan.root.innerHTML;
        });
    }

    let misi = document.getElementById('misi');
    if(misi){
        var quillMisi = new Quill(misi, {
            modules:
            {
            toolbar: toolbarOptions
            },
            theme: 'snow'
        });
        quillMisi.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='misi']").value = quillMisi.root.innerHTML;
        });
    }

    let body = document.getElementById('body');
    if(body){
        var quillBody = new Quill(body, {
            modules:
            {
            toolbar: toolbarOptions
            },
            theme: 'snow'
        });
        quillBody.on('text-change', function(delta, oldDelta, source) {
            document.querySelector("input[name='body']").value = quillBody.root.innerHTML;
        });
    }

    // Ubah Kategori dengan modal
    let btnEditCategory = $('.btn-edit-category');
    btnEditCategory.each(function(e){
        $(this).on('click', function(){
            let id_category = $(this).data('id');
            $.ajax({
                url : '/dashboard/category/edit/' + id_category,
                cache : false,
                success:function(response){
                    // fill input edit category
                    $('#_name').val(response.name);
                    $('#_slug').val(response.slug);
                    // set action form edit category
                    $('#editKategori').attr('action', '/dashboard/category/' + response.slug);
                    // open modal
                    $('#editCategory').modal('show');
                }
            });
        });
    });
});