            <div class="row" id="data_view">
                <div class="col-md-12">
                  <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title ">Data</h3>
                    </div>
                        <div class="box-body">
                            <button class="btn bg-orange" id="btn_add" style="margin-bottom:10px"><span class="fa fa-plus"></span> Tambah booking</button>
                            <style media="screen">
                              /*th .pagination_detail{
                                width: 240px;
                              }*/
                            </style>
                            <table id="table" class="table table-hover table-bordered display nowrap" width="100%" cellspacing="0">
                            </table>
                        </div>
                    </div>
                </div>
            </div>


<script type="text/javascript">
$(document).ready(function () {
pagination = $('#table').pagination({
    href:"<?php echo site_url() ?>/booking/page",
    plus_column: [2,{'class':'bayar','id':'id_booking','text':'Bayar'},{'class':'invoice','id':'id_booking','text':'Cetak Invoice'}],
    hide: "id_booking",
    edit: "id_booking",
    delete: "id_booking",
    search: true,
  });
  pagination.init();
      });

      $('body').on('click', '.bayar', function() {
        val = $(this).attr('value');
      window.location.replace("<?php echo base_url('pembayaran/by_id_booking?id_booking=') ?>"+val);
      });

      $('body').on('click', '.invoice', function() {
        val = $(this).attr('value');
      window.location.replace("<?php echo base_url('pembayaran/invoice?id_booking=') ?>"+val);
      });
</script>
