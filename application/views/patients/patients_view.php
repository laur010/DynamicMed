<script src='<?php echo base_url();?>theme/trirand/scripts/jquery-ui-custom.min.js'></script>
<script src='<?php echo base_url();?>theme/trirand/scripts/grid.locale-en.js'></script>
<script src='<?php echo base_url();?>theme/trirand/scripts/jquery.jqGrid.js'></script>
<style type="text/css">
  .ui-widget-content .ui-state-default {
    color: #20C6CD;
  }
  .ui-widget-content:hover{color: #20C6CD;}
  .ui-widget-content:checked{color: #20C6CD;}
  .ui-state-highlight { background: grey !important; }
  .ui-widget-header:hover{color: #20C6CD;}
  .ui-jqgrid .ui-jqgrid-pager {
    height: 30px;
  }
</style>
<script type="text/javascript">
  jQuery(document).ready(function () {

    var grid = jQuery("#list").jqGrid({
      url: "patients/get_grid",
      datatype: "json",
      mtype:      'POST',
      colNames: ["Cod Pacient", "Nume", "Prenume", "CNP", "Telefon", "Spitalizat", "Sectie",  "Salon"],
      colModel: [
        { name: "patient_id", align:"center", searchoptions: { sopt: ['cn','eq', 'ne','nc' ]}},
        { name: "first_name", align:"center", searchoptions: { sopt: ['cn','eq', 'ne','nc' ]}},
        { name: "last_name", align:"center", searchoptions: { sopt: ['cn','eq', 'ne','nc' ]}},
        { name: "cnp", align:"center", searchoptions: { sopt: ['cn','eq', 'ne','nc' ]}},
        { name: "phone", align:"center", searchoptions: { sopt: ['cn','eq', 'ne','nc' ]}},
        { name: "hospitalized", align:"center", searchoptions: { sopt: ['cn','eq', 'ne','nc' ]}},
        { name: "department_name", align:"center", searchoptions: { sopt: ['cn','eq', 'ne','nc' ]}},
        { name: "salon_name", align:"center", searchoptions: { sopt: ['cn','eq', 'ne','nc' ]}}
      ],
      pager: "#pager",
      rowList: [10],
      autowidth:      true,
      autoheight:     true,
      sortname: "patient_id",
      sortorder: "asc",
      multiselect: true,
      multiboxonly: true,
      loadonce: true,
      height: 'auto',
      viewrecords: true,
      gridview: true,
      caption: "Pacienti",
      ondblClickRow: function () {
        var checked_rows = jQuery('#list').jqGrid('getGridParam','selarrrow');
        if( checked_rows.length === 1) {
          var grid = jQuery("#list");
          var item_id = grid.jqGrid('getGridParam', 'selrow');
          var patient_id = grid.jqGrid('getCell',item_id,'patient_id');
          window.location.replace('<?php echo base_url();?>patients/details/'+patient_id);
        }
        else {
          alert("Trebuie selectat un singur pacient.");
        }
      }
    }).jqGrid('navGrid','#pager',
      {
        edit: <?php if($grid_permissions['edit']){echo 'true';}else{echo 'false';}?>,
        add: <?php if($grid_permissions['add']){echo 'true';}else{echo 'false';}?>,
        del: <?php if($grid_permissions['delete']){echo 'true';}else{echo 'false';}?>,
        addfunc: function () {
          //jQuery("#section").load("<?php //echo base_url();?>//patients/add");
          window.location.replace('<?php echo base_url();?>patients/add');
        },
        editfunc: function () {
          var checked_rows = jQuery('#list').jqGrid('getGridParam','selarrrow');
          if( checked_rows.length === 1) {
            var grid = jQuery("#list");
            var item_id = grid.jqGrid('getGridParam', 'selrow');
            var patient_id = grid.jqGrid('getCell',item_id,'patient_id');
            window.location.replace('<?php echo base_url();?>patients/edit/'+patient_id);
          }
          else {
            alert("Trebuie selectat un singur pacient.");
          }
        },
        delfunc: function () {
          var checked_rows = jQuery("#list").jqGrid('getGridParam','selarrrow');
          var item_id = grid.jqGrid('getGridParam', 'selrow');
          var patient_id = grid.jqGrid('getCell',item_id,'patient_id');
          if( checked_rows.length === 1) {
            jQuery.ajax({
              type: 'POST',
              data: {
                "operation": 'delete',
                "patient_id": patient_id
              },
              url: '<?php echo base_url();?>patients/process_request',
              dataType: 'json',
              success: function (data) {
                if (data.code == 1) {
                  showSuccessMessage(data.msg);
                }
                else {
                  showErrorMessage(data.msg);
                }

              }
            });
          }
          else {
            alert("Trebuie selectat un singur pacient.");
          }

        }

      }).jqGrid('navSeparatorAdd',
      "#pager",
      {sepclass : 'ui-separator',sepcontent: '',position:"last"}

    ).jqGrid('navButtonAdd','#pager',
      {
        buttonicon:"ui-icon-arrowthickstop-1-s",
        caption:"",
        title:"Adauga Foaie de Observatie",
        onClickButton: function(x){
          var checked_rows = jQuery('#list').jqGrid('getGridParam','selarrrow');
          if (checked_rows.length > 1) {
            alert("Trebuie selectat un singur pacient.");
            return false;
          }
          if (checked_rows.length == 0) {
            alert("Trebuie sa selectati un pacient.");
            return false;
          }
          var grid = jQuery("#list");
          var item_id = grid.jqGrid('getGridParam', 'selrow');
          var hospitalized = grid.jqGrid('getCell',item_id,'hospitalized');
          if (hospitalized != 1) {
            showErrorMessage("Pacientul trebuie sa fie spitalizat pentru a-i crea o fisa de observatie.");
            setTimeout(function(){
              location.reload();
            }, 1500);
            return false;
          }
          var patient_id = grid.jqGrid('getCell',item_id,'patient_id');
          window.location = "<?php echo base_url();?>observation_records/add/"+patient_id;
          return false;
        }
      });
    grid.jqGrid('filterToolbar',{stringResult: true, searchOnEnter: true,searchOperators:true});

  });
</script>


<section class="content home" id="section">
  <div class="block-header">
    <div class="row">
      <div class="col-lg-7 col-md-6 col-sm-12">
        <h2>Lista Pacienti
          <small class="text-muted"></small>
        </h2>
      </div>
    </div>
  </div>

  <div class="container-fluid">

    <div class="row clearfix">
      <div class="col-lg-12">
        <div class="card">
          <div class="header">
            <h2><strong>LISTA</strong> Pacienti </h2>
            <ul class="header-dropdown">
              <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                  <li><a href="javascript:void(0);">Action</a></li>
                  <li><a href="javascript:void(0);">Another action</a></li>
                  <li><a href="javascript:void(0);">Something else</a></li>
                </ul>
              </li>
              <li class="remove">
                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
              </li>
            </ul>
          </div>
          <div class="body">
            <table id="list"></table>
            <div id="pager"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


