            <div class="row" id="data_view">
                <div class="col-md-12">
                  <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title ">Data</h3>
                    </div>
                        <div class="box-body">
                            <button class="btn bg-orange" id="btn_add" style="margin-bottom:10px"><span class="fa fa-plus"></span> Tambah unit</button>
                            <table id="table" class="table table-hover table-bordered display nowrap" width="100%" cellspacing="0">
                            </table>
                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
$(document).ready(function () {
pagination = $('#table').pagination({
    href:"<?php echo site_url() ?>/unit/page",
    // plus_column: ,
    hide: "id_unit",
    edit: "id_unit",
    delete: "id_unit",
    search: true,
  });
  pagination.init();
      });

</script>
