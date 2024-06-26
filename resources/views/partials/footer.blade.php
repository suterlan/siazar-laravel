<script src="{{ asset('') }}js/jquery.min.js"></script>
<script src="{{ asset('') }}js/popper.min.js"></script>
<script src="{{ asset('') }}js/moment.min.js"></script>
<script src="{{ asset('') }}js/bootstrap.min.js"></script>
<script src="{{ asset('') }}js/simplebar.min.js"></script>
<script src='{{ asset('') }}js/daterangepicker.js'></script>
<script src='{{ asset('') }}js/jquery.stickOnScroll.js'></script>
<script src="{{ asset('') }}js/tinycolor-min.js"></script>
<script src="{{ asset('') }}js/config.js"></script>
<script src="{{ asset('') }}js/d3.min.js"></script>
<script src="{{ asset('') }}js/topojson.min.js"></script>
<script src="{{ asset('') }}js/Chart.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('package/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('package/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('package/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('package/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('package/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('package/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('package/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('package/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('package/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('package/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('package/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('package/pdfmake/vfs_fonts.js') }}"></script>
<script>
  /* defind global options */
  Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
  Chart.defaults.global.defaultFontColor = colors.mutedColor;
</script>
<script src="{{ asset('') }}js/jquery.sparkline.min.js"></script>
<script src='{{ asset('') }}js/jquery.mask.min.js'></script>
<script src='{{ asset('') }}js/select2.min.js'></script>
<script src='{{ asset('') }}js/jquery.validate.min.js'></script>
<script src='{{ asset('') }}js/jquery.timepicker.js'></script>
<script src='{{ asset('') }}js/uppy.min.js'></script>
<script src='{{ asset('') }}js/quill.min.js'></script>

<script src="{{ asset('') }}js/apps.js"></script>

<script src='{{ asset('') }}js/surat.js'></script>
<script src='{{ asset('') }}js/ppdb.js'></script>
<script src='{{ asset('') }}js/suterlan.js'></script>
<script>
  $('.custom-file-input').on('change', function(){
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass('selected').html(fileName);
  });

  $('.select2').select2(
  {
    theme: 'bootstrap4',
  });
  $('.select2-multi').select2(
    {
        multiple: true,
        theme: 'bootstrap4',
    });
    // $('#select2-multi').trigger('change');
  $('.input-tahun-ajaran').mask("0000/0000",
      {
        placeholder: "____/____"
    });

  $('.drgpicker').daterangepicker(
  {
    singleDatePicker: true,
    timePicker: false,
    showDropdowns: true,
    locale:
    {
      format: 'YYYY/MM/DD'
    }
  });

</script>
<script>
  $(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e){
      localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
      $('#myTab a[href="' + activeTab + '"]').tab('show');
    }

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

  });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
{{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script> --}}
