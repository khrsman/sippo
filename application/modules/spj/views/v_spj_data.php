            <div class="row" id="data_view">
                <div class="col-md-12">
                  <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title ">Data</h3>
                    </div>
                        <div class="box-body">
                        
                            <table id="table" class="table table-hover table-bordered display nowrap" width="100%" cellspacing="0">
                            </table>
                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
$(document).ready(function () {
pagination = $('#table').pagination({
    href:"<?php echo site_url() ?>/spj/page",
    plus_column: [1,{'class':'cetak','id':'id_spj','text':'Cetak'}],
    hide: "id_spj",
    edit: "id_spj",
    delete: "id_spj",
    search: true,
  });
  pagination.init();
      });

      $('body').on('click', '.cetak', function() {
        val = $(this).attr('value');
      window.location.replace("<?php echo base_url('spj/cetak?id=') ?>"+val);
      });
</script>
