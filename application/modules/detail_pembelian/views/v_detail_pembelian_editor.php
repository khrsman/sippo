              <div class="row" id="form_view">
                <div class="col-md-6">
                    <div class="box box-success box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title ">Editor</h3>
                        </div>
                        <div class="box-body">
                            <form role="form" class="form-horizontal xform">
                                <input type="hidden" id="id_pembelian_sparepart" name="id_pembelian_sparepart" >
                                <input type = "hidden" name="id_faktur_pembelian" id="id_faktur_pembelian" class="form-control"  >

                            <div class="form-group">
                                    <label class="col-sm-4 control-label">Sparepart</label>
                                    <div class="col-sm-8">
                                        <?php
                                        $this->cb_options->sparepart();
                                        ?>
                                    </div>
                              </div>
													<div class="form-group">
                                  <label class="col-sm-4 control-label">Jumlah</label>
                                  <div class="col-sm-8">
                                      <input type = "text" name="jumlah" id="jumlah" class="form-control hitung_harga"  >
                                  </div>
                            </div>
													<div class="form-group">
                                  <label class="col-sm-4 control-label">Harga satuan</label>
                                  <div class="col-sm-8">
                                      <input type = "text" name="harga_satuan" id="harga_satuan" class="form-control hitung_harga"  >
                                  </div>
                            </div>
													<div class="form-group">
                                  <label class="col-sm-4 control-label">Total</label>
                                  <div class="col-sm-8">
                                      <input type = "text" name="total" id="total" class="form-control hitung_harga"  >
                                  </div>
                            </div>

                            </form>
                        </div>
                        <div class="box-footer" style="text-align:right">
                            <a class="btn btn-danger" id="btn_cancel"><span class="fa fa-remove "></span> Cancel</a>
                            <a class="btn btn-primary add_page" id="btn_save"><span class="fa fa-check "></span> Simpan</a>
                            <a class="btn btn-primary edit_page" id="btn_update"><span class="fa fa-check "></span> update</a>
                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
$(document).ready(function () {
  id = $('#detail_id_faktur_pembelian').text();
  $("#id_faktur_pembelian").val(id);
});


$(".hitung_harga").keyup(function(){

    jumlah = $("#jumlah").val() || 0 ;
    harga_satuan = $("#harga_satuan").val() || 0 ;

    total = parseInt(jumlah)*parseInt(harga_satuan);
    $("#total").val(total);
  });


</script>
