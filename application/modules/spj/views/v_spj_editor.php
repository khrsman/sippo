<div class="row" id="form_tambah">
    <div class="col-md-6">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title add_page">Tambah</h3>
                <h3 class="box-title edit_page">Update</h3>
            </div>
            <div class="box-body">
                <form role="form" class="form-horizontal xform">
                    <input type="hidden" id="id_spj" name="id_spj" >
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Tanggal SPJ</label>
                      <div class="col-sm-8">
                          <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input class="form-control datepicker" name="tanggal_spj" value="<?php echo date('d/m/Y') ?>" id="tanggal_spj" type="text">
                        </div>
                      </div>
                </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Kode booking</label>
                      <div class="col-sm-8" id='kode_spj_dinamis'>
                        <?php
                        $this->load->library('Cb_options');
                        $this->cb_options->kode_booking();
                        ?>
                      </div>
                </div>
              <div class="form-group">
                      <label class="col-sm-4 control-label">Bus</label>
                      <div class="col-sm-8" id='cb_unit_ajax'>
                        <?php
                         $this->cb_options->unit();
                        ?>
                      </div>
                </div>
                <div class="form-group">
                      <label class="col-sm-4 control-label">Tanggal</label>
                      <div class="col-sm-8">
                          <input type = "text" value="-"  id="tanggal_berangkat" class="form-control"  >
                      </div>
                </div>

              <div class="form-group">
                      <label class="col-sm-4 control-label">Jam jemput</label>
                      <div class="col-sm-4">
                          <!-- <input type = "text" value="0"  class="form-control timepicker"  > -->
                          <div class="bootstrap-timepicker">
                          <div class="input-group">
        <input type="text" name="jam_jemput" id="jam_jemput" class="form-control timepicker">
        <div class="input-group-addon">
          <i class="fa fa-clock-o"></i>
        </div>
        </div>
        </div>
      </div>
                </div>

              <div class="form-group">
                      <label class="col-sm-4 control-label">Sopir</label>
                      <div class="col-sm-8">
                        <?php
                        $this->cb_options->sopir();
                        ?>
                      </div>
                </div>
              <div class="form-group">
                      <label class="col-sm-4 control-label">Kenek</label>
                      <div class="col-sm-8">
                        <?php
                        $this->cb_options->crew();
                        ?>
                      </div>
                </div>
              <div class="form-group">
                      <label class="col-sm-4 control-label">Tipe Bus</label>
                      <div class="col-sm-8">
                          <input type = "text" value="" name="tipe_bus" id="tipe_bus" class="form-control"  >
                      </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Solar perliter x jumlah</label>
                  <div class="col-sm-8">
                      <div class="input-group">
                      <input class="form-control input_number hitung_biaya" placeholder="harga per liter" id="solar_per_liter" type="text">
                      <div class="input-group-addon">
                      X
                      </div>
                      <input class="form-control input_number hitung_biaya" placeholder="solar dibutuhkan" id="solar_dibutuhkan" type="text">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Biaya Solar</label>
                  <div class="col-sm-8">
                      <input readonly="" type = "text" value="0" name="biaya_solar" id="biaya_solar" class="form-control"  >
                  </div>
                </div>

                </form>
            </div>

        </div>
    </div>
    <div class="col-md-6">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title add_page"></h3>
            </div>
            <div class="box-body">
                <form role="form" class="form-horizontal xform">
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Upah Sopir</label>
                      <div class="col-sm-8">
                          <input type = "text" value="0" name="biaya_sopir" id="biaya_sopir" class="form-control input_number hitung_biaya"  >
                      </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Upah Kenek</label>
                  <div class="col-sm-8">
                      <input type = "text" value="0" name="biaya_crew" id="biaya_crew" class="form-control input_number hitung_biaya"  >
                  </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-4 control-label">Tol</label>
                    <div class="col-sm-8">
                        <input type = "text" value="0" name="biaya_tol" id="biaya_tol" class="form-control input_number hitung_biaya"  >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Parkir</label>
                    <div class="col-sm-8">
                        <input type = "text" value="0" name="biaya_parkir" id="biaya_parkir" class="form-control input_number hitung_biaya"  >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Tips</label>
                    <div class="col-sm-8">
                        <input type = "text" value="0" name="biaya_tips" id="biaya_tips" class="form-control input_number hitung_biaya"  >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Penyebrangan</label>
                    <div class="col-sm-8">
                        <input type = "text" value="0" name="biaya_penyebrangan" id="biaya_penyebrangan" class="form-control input_number hitung_biaya"  >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Lain-lain</label>
                    <div class="col-sm-8">
                        <input type = "text" value="0" name="biaya_lain" id="biaya_lain" class="form-control input_number hitung_biaya"  >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Total</label>
                    <div class="col-sm-8">
                        <input type = "text" value="0" readonly name="biaya_total" id="biaya_total" class="form-control"  >
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

<link rel="stylesheet" href="<?php echo base_url('AdminLTE/plugins/timepicker') ?>/bootstrap-timepicker.min.css">
<script src="<?php echo base_url('AdminLTE/plugins/timepicker') ?>/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/datepicker/locales/bootstrap-datepicker.id.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>js/datepicker/css/bootstrap-datepicker.css">

<script type="text/javascript">
$('.timepicker').timepicker({
  showInputs: false,
  showMeridian: false,
  defaultTime: '00:00'
})
$('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: "linked",
        language: "id",
       calendarWeeks: true,
        autoclose: true
   });
   $('.datepicker').change(function(){
    tanggal = $(this).val();
      request = $.get("<?php echo site_url('spj/kode_booking_spj')?>", {tanggal: tanggal});
      request.done(function(data){
        $("#kode_spj_dinamis").html(data);
        $("#id_booking").change(function(){
           id = $(this).val();
          $.get( "<?php echo site_url('booking/get_unit_booking') ?>", { id: id })
            .done(function( data ) {
              obj = JSON.parse(data);
               $("#cb_unit_ajax").html(obj.select);
               $("#tanggal_berangkat").val(obj.tanggal);
        });
        });
      })
  })


   $("#solar_per_liter").keyup(function(){
       harga = $(this).val() || 0 ;
       liter = $("#solar_dibutuhkan").val() || 0 ;
       total = parseInt(liter)*parseInt(harga);
       $("#biaya_solar").val(total);
     });
     $("#solar_dibutuhkan").keyup(function(){
     liter = $(this).val();
     harga = $("#solar_per_liter").val() || 0 ;
     total = parseInt(liter)*parseInt(harga);
     $("#biaya_solar").val(total);
     });
     $(".hitung_biaya").keyup(function(){

       solar = $("#biaya_solar").val() || 0 ;
       sopir = $("#biaya_sopir").val() || 0 ;
       crew = $("#biaya_crew").val() || 0 ;
       tol = $("#biaya_tol").val() || 0 ;
       parkir = $("#biaya_parkir").val() || 0 ;
       tips = $("#biaya_tips").val() || 0 ;
       penyebrangan = $("#biaya_penyebrangan").val() || 0 ;
       lainnya = $("#biaya_lain").val() || 0 ;

       total = parseInt(solar)+parseInt(sopir)+parseInt(crew)+parseInt(tol)+parseInt(parkir)+parseInt(tips)+parseInt(penyebrangan)+parseInt(lainnya);
       $("#biaya_total").val(total);
     });
</script>
