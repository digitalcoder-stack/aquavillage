<style>
  @media print {
    .no-print {
      display: none !important;
    }

    .modal-open .modal {
      overflow: visible !important;
    }

    .printDiv {
      height: auto !important;
      min-height: 70vh !important;
      max-height: none !important;
      padding: 5px 10px !important;
    }

    .modal-dialog {
      max-width: 100% !important;
      min-width: 80% !important;
      width: 100% !important;
      min-height: 70vh !important;
      max-height: none !important;
      height: auto !important;
    }
  }
</style>

<!-- view Modal start -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-6">
            <h4 class="modal-title" id="modaltitle"></h4>
          </div>
          <div class="col-md-6" style="text-align: end;">
            <a onclick="printcustomdiv()" class="btn btn-success btn-sm">
              <i class="fa fa-printer me-2"></i>Print
            </a>
            <button type="button" class="btn-close btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
          </div>
        </div>
      </div>
      <div style="word-break: break-all; padding:10px;">

        <div class="printDiv">
          <div id="modalcontent" style="margin-bottom: 10px;">

          </div>
          <div style="margin-top: 10px;" id="modaltables">

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- view modal end -->


<script type="text/javascript">
  var cls_table = $(".dash_datatable").DataTable({

    'order': [
      [0, "asc"]
    ],

    'paging': true,

    'pageLength': 200,
    "lengthMenu": [150,200, 250, 300],
    'pagingType': "numbers",

    'language': {

      searchPlaceholder: 'Search...',

      sSearch: ''

    }

  });


  var cls_table = $(".my_custom_datatable").DataTable({

    'order': [
      [0, "asc"]
    ],

    'paging': true,

    'pageLength': 50,

    'pagingType': "numbers",

    'language': {

      searchPlaceholder: 'Search...',

      sSearch: ''

    }

  });

  $(".my_custom_datatable").each(function(i, element) {
    //    new $.fn.dataTable.Buttons(cls_table.eq(i), {
    //      buttons: [{
    //          extend: "excel",
    //          className: "datatable-btn btn-sm"
    //        },
    //        {
    //          extend: "pdf",
    //          className: "datatable-btn btn-sm"
    //        },
    //        {
    //          extend: "print",
    //          className: "datatable-btn btn-sm"
    //        }
    //      ]
    //    });



    cls_table.eq(i).buttons().container().appendTo(

      $('.col-sm-6:eq(0)',

        cls_table.eq(i).table().container())

    );



  });

  var cls_table = $(".mylong_datatable").DataTable({

    'order': [
      [0, "asc"]
    ],
    "lengthMenu": [2000,2500, 3000, 3500],
    'paging': true,

    'pageLength': 3000,

    'pagingType': "numbers",

    'language': {

      searchPlaceholder: 'Search...',

      sSearch: ''

    }

  });

  $(".mylong_datatable").each(function(i, element) {
  
    cls_table.eq(i).buttons().container().appendTo(

      $('.col-sm-6:eq(0)',

        cls_table.eq(i).table().container())

    );

  });


  var master_table = $(".my_master_datatable").DataTable({

    'order': [
      [0, "asc"]
    ],

    'paging': true,

    'pageLength': 50,

    'pagingType': "numbers",

    'language': {

      searchPlaceholder: 'Search...',

      sSearch: ''

    },
    'dom': 'lBfrtip',
    'buttons': [
      'print', 'excel', 'pdf'
    ]
  });


  function printcustomdiv() {
    printDiv = ".printDiv"; // id of the div you want to print
    $("*").addClass("no-print");
    $(printDiv + " *").removeClass("no-print");
    $(printDiv).removeClass("no-print");

    parent = $(printDiv).parent();
    while ($(parent).length) {
      $(parent).removeClass("no-print");
      parent = $(parent).parent();
    }
    window.print();

  }
</script>
