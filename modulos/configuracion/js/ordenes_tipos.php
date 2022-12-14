<?php
?>
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('#data-table2').DataTable({
      rowReorder: {
      selector: 'td:nth-child(2)'
      },
      responsive: true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
      },
      "paging": true,
      "processing": true,
      "bLengthChange" : false, //thought this line could hide the LengthMenu
      "bInfo":true,
      //"pageLength": 10,
      "stateSave": true,
      //"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "order": [[ 1, "asc" ]],
      "aProcessing": true,
      "aServerSide": true,
      
      dom: 'lBfrtip',
      buttons: [

        {
          extend: 'copyHtml5',
          text:   'Copiar <i class="far fa-copy"></i>',
          titleAttr:  'Copiar al Portapapeles',
          exportOptions: {
              "columns": [0,1,2],

          },
          "className": 'btn btn-secondary btn-sm'
        },
        {
          extend: 'excelHtml5',
          text:      'Excel <i class="far fa-file-excel"></i>',
          titleAttr: 'Exportar a Excel',
          title:  'Tipo Ordenes',
          exportOptions: {
              columns: [0,1,2],
          },
          "className": 'btn btn-secondary btn-sm'
        },
        {
          extend: 'pdfHtml5',
          text:      'PDF <i class="far fa-file-pdf"></i>',
          titleAttr: 'Exportar a PDF',
          title:  'Tipo Ordenes',
          orientation: 'portrait',
          pageSize: 'A4',
          exportOptions: {
              columns: [0,1,2],
          },
          "className": 'btn btn-secondary btn-sm',
          customize: function(doc) {
              doc.defaultStyle.fontSize = 8; //<-- set fontsize to 16 instead of 10
              doc.styles.tableHeader.fontSize = 10;
          }
        },
      ],                                  
    } );
  });
  document.title = "::Empresa:: - Tipo Ordenes"
</script>