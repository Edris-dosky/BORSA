<script src="js/dataTables.js"></script>
<script src="js/dataTables.buttons.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>

<script>
  $('#dataTable1').DataTable(
  {
    layout: {
        topStart: {
            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
        }
    },
    responsive: true,
    paging: true,
    scrollCollapse: true,
    scrollX: true
  });
</script>