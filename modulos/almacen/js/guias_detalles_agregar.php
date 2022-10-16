<?php
?>
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('#data-table').DataTable({
      rowReorder: {
      selector: 'td:nth-child(2)'
      },
      responsive: true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
      },
      "paging": true,
      "processing": true,
      //"pageLength": 10,
      "stateSave": true,
      //"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      //"order": [[ 0, "asc" ]],
      "aProcessing": true,
      "aServerSide": true,
      
      //dom: 'lBfrtip',
      buttons: [

        {
          extend: 'copyHtml5',
          text:   'Copiar',
          titleAttr:  'Copiar al Portapapeles',
          exportOptions: {
              "columns": [0,1,2,3,4,5],
          },
        },
        {
          extend: 'excelHtml5',
          text:      'Excel <i class="far fa-file-excel"></i>',
          titleAttr: 'Exportar a Excel',
          title:  'Ordenes-<?=date('Y-m-d-His')?>',
          exportOptions: {
              columns: [0,1,2,3,4,5],
          },
        },
        {
          extend: 'pdfHtml5',
          text:      'PDF <i class="far fa-file-pdf"></i>',
          titleAttr: 'Exportar a PDF',
          title:  'Ordenes-<?=date('Y-m-d-His')?>',
          orientation: 'portrait',
          pageSize: 'A4',
          exportOptions: {
              columns: [0,1,2,3,4,5],
          },
          customize: function(doc) {
              doc.defaultStyle.fontSize = 8; //<-- set fontsize to 16 instead of 10
              doc.styles.tableHeader.fontSize = 10;
          }

        },
      ],
      "columnDefs": [
                          { className: "dt-left", "targets": [1] },
                          { className: "dt-center", "targets": [0,2] },
                          { className: "dt-right", "targets": [3,4,5] },
                          /*{ className: "dt-nowrap", "targets": [2] }*/
                      ],                                
    } );
  });
  document.title = "::Elicar:: - Detalle de Guia"
</script>