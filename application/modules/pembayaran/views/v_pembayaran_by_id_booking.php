<div id="page" value="pembayaran">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>pembayaran</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">pembayaran</li>
            </ol>
        </section>
        <section class="content">
            <div class="row" id="form_tambah">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            Pembayaran untuk <strong><?php echo $data_booking[0]['jumlah_bus'] ?></strong> bus dengan tujuan <strong><?php echo $data_booking[0]['tujuan'] ?></strong> dari tanggal <strong><?php echo $data_booking[0]['tanggal_dari'] ?></strong> s.d <strong><?php echo $data_booking[0]['tanggal_sampai'] ?></strong>
                            <br>Dengan total:
                            <div id="jumlah_tagihan">
                              <strong><?php echo $data_booking[0]['total'] ?></strong>
                            </div>
                            <div id="jumlah_sisa" style="display:none">
                            <?php echo $sisa_bayar; ?>
                            </div>
                        </div>
                        <div class="box-body">
                            <form role="form" class="form-horizontal xform">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Kode pembayaran</label>
                                  <div class="col-sm-8">
                                      <input readonly value="<?php echo $data_booking[0]['id_marketing'].$kode_bayar ?>" type = "text"  class="form-control"  >
                                      <input  value="<?php echo $data_booking[0]['id_marketing'] ?>" type = "hidden" name="id_marketing" id="id_marketing" class="form-control"  >
                                      <input value="<?php echo $kode_bayar ?>" type = "hidden" name="id_pembayaran" id="id_pembayaran" class="form-control"  >
                                  </div>
                            </div>
													<div class="form-group">
                                  <label class="col-sm-4 control-label">Kode booking</label>
                                  <div class="col-sm-8">
                                      <input readonly="" value="<?php echo $data_booking[0]['id_booking'] ?>" type = "text" name="id_booking" id="id_booking" class="form-control"  >
                                  </div>
                            </div>
													<div class="form-group">
                                  <label class="col-sm-4 control-label">Terima dari</label>
                                  <div class="col-sm-8">
                                      <input type = "text" name="dari" id="dari" class="form-control"  >
                                  </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-4 control-label">Untuk pembayaran</label>
                                    <div class="col-sm-8">
                                        <input type = "text" name="untuk" id="untuk" class="form-control"  >
                                    </div>
                              </div>
													<!-- <div class="form-group">
                                  <label class="col-sm-4 control-label">Alamat</label>
                                  <div class="col-sm-8">
                                      <input type = "text" name="alamat" id="alamat" class="form-control"  >
                                  </div>
                            </div> -->
                            <div class="form-group">
                                    <label class="col-sm-4 control-label input_validation">Status pembayaran</label>
                                    <div class="col-sm-8">
                                      <label class="radio-inline">
                                            <input type="radio" name="status" value="LUNAS"> LUNAS
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="status" value="DP1"> DP1
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="status" value="DP2"> DP2
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="status" value="DP2"> DP3
                                          </label>
                                    </div>
                              </div>
													<div class="form-group">
                                  <label class="col-sm-4 control-label">Jumlah pembayaran</label>
                                  <div class="col-sm-8">
                                      <input type = "number" value="0" name="jumlah" id="jumlah" class="form-control hitung_sisa">
                                  </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-4 control-label">Sisa pembayaran</label>
                                    <div class="col-sm-8">
                                        <input readonly value="<?php echo $sisa_bayar ?>" name="sisa" id="sisa" class="form-control">
                                    </div>
                              </div>
													<div class="form-group">
                                  <label class="col-sm-4 control-label">Tanggal pembayaran</label>
                                  <div class="col-sm-8">
                                      <input type = "text" value="<?php echo date('d/m/Y') ?>" name="tanggal" id="tanggal" class="form-control datepicker"  >
                                  </div>
                            </div>
                            </form>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-danger" id="cancel_custom"><span class="fa fa-remove "></span> Cancel</a>
                            <a class="btn btn-primary add_page" id="simpan_custom"><span class="fa fa-check "></span> Simpan</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
</section>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>js/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/datepicker/locales/bootstrap-datepicker.id.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>js/datepicker/css/bootstrap-datepicker.css">
<script>
	 $(function(){
			$('.datepicker').datepicker({
						format: 'dd/mm/yyyy',
						todayBtn: "linked",
						language: "id",
					  calendarWeeks: true,
						autoclose: true
			 });
       $("#cancel_custom").click(function(){
         window.location.href = "<?php echo site_url() ?>/booking";
       });


       $('input[type=radio][name=status]').change(function() {
        //  alert(this.value);
        var status = $("#jumlah_sisa").text();
         if ($(this).val() == "LUNAS") {
           $("#jumlah").val(status.trim());
           $("#sisa").val(0);
         } else {
          //  alert(status);
           $("#jumlah").val('0');
           $("#sisa").val(parseInt(status));
         }
   });
   $( ".hitung_sisa" ).keyup(function() {
    //  var total = 0;
     var harga = $("#jumlah").val();
     var total = $("#jumlah_sisa").text().trim();
     var sisa = parseInt(total)-parseInt(harga);
    $("#sisa").val(sisa);
});


	 });
</script>


<script type="text/javascript">
$().ready(function(){
  var url_simpan = 'pembayaran/add';
$('#simpan_custom').click(function(){
  // kirim data form berdasarkan nama(property name) inputannya
  var data = $('form').serialize();
  $.ajax({
      type: "POST",
      url: url_simpan,
      data: {data: data},
      success: function (resdata) {
        $.notify({
          title: "Berhasil : ",
          message: "Data telah ditambahkan",
          icon: 'fa fa-check'
        },{
          type: "success"
        });
          $(".xform")[0].reset();
          var id_pembayaran = $("#id_pembayaran").val();
           window.location.href = "<?php echo site_url() ?>/pembayaran/kwitansi?id_pembayaran="+id_pembayaran;
      },
      error: function (jqXHR, exception) {
        // pesan error menggunakan notify.js
        $.notify({
          title: "Error :",
          message: "Telah terjadi kesalahan!",
          icon: 'fa fa-check'
        },{
          type: "danger"
        });
      }
  });
// window.location.href = "http://example.com/Registration/Success/";

});
});

</script>
