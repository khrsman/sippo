            <div class="row" id="data_view">
                <div class="col-md-12">
                  <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title ">Data</h3>
                    </div>
                        <div class="box-body">
                            <button class="btn bg-orange" id="btn_add" style="margin-bottom:10px"><span class="fa fa-plus"></span> Tambah Faktur Pembelian</button>
                            <table id="table" class="table table-hover table-bordered display nowrap" width="100%" cellspacing="0">
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script src="<?php echo base_url() ?>js/jquery.redirect.js"></script>

<script type="text/javascript">
$(document).ready(function () {
pagination = $('#table').pagination({
    href:"<?php echo site_url() ?>/faktur_pembelian/page",
    plus_column: [1,{'class':'detail','id':'id_faktur_pembelian','text':'Detail'}],
    hide: "id_faktur_pembelian",
    edit: "id_faktur_pembelian",
    delete: "id_faktur_pembelian",
    search: true,
  });
  pagination.init();
      });

      $('body').on('click', '.detail', function() {
        val = $(this).attr('value');
        // console.log(val);
          $.redirect('<?php echo base_url('detail_pembelian')?>',{data: val});
      //  window.location.replace("<?php echo base_url('detail_pembelian') ?>"+val);
      });

</script>
