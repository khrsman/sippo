<link href="<?php echo base_url() ?>css/jquery.multiselect.css" rel="stylesheet" type="text/css">
<div id="page_custom" value="pengeluaran">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Laporan</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">pengeluaran</li>
            </ol>
        </section>
        <section class="content">
          <div class="row" id="form_tambah">
              <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                      <h3 class="box-title add_page">Pilih Jenis Laporan </h3>
                  </div>
                    <div class="box-body">
                <button type="button" class="btn btn-primary jenis_laporan" id="lap_pendapatan" name="button">Pendapatan </button>
                <button type="button" class="btn btn-primary jenis_laporan" id="lap_pengeluaran" name="button">Pengeluaran </button>
                <button type="button" class="btn btn-primary jenis_laporan" id="lap_rekap_pendapatan" name="button">Rekap Pendapatan </button>
                <button type="button" class="btn btn-primary jenis_laporan" id="lap_rekap_pengeluaran" name="button">Rekap Pengeluaran </button>
                <button type="button" class="btn btn-primary jenis_laporan" id="lap_rekap_total" name="button">Rekap Total </button>
                <button type="button" class="btn btn-primary jenis_laporan" id="lap_pemakaian_sparepart" name="button">pemakaian sparepart </button>
              </div>
              </div>
              </div>
              </div>
            <!-- <div class="row" id="form_tambah">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                            <form role="form" class="form-horizontal xform" action="lap_pengeluaran/proses" method="post">
                                <input type="hidden" id="id_pengeluaran" name="id_pengeluaran" >
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Jenis laporan</label>
                                  <div class="col-sm-8">
                                    <select name="jenis_laporan" id="jenis_laporan" class="form-control">
                                        <option value=''>--- PILIH ---</option>";
                                        <option value='pendapatan'>Pendapatan</option>";
                                        <option value='pengeluaran'>Pengeluaran</option>";
                                        <option value='rekap_pendapatan'>Rekap Pendapatan</option>";
                                        <option value='rekap_pengeluaran'>Rekap Pengeluaran</option>";
                                        <option value='rekap_total'>Rekap Total</option>";
                                        <option value='pemakaian_sparepart'>Pemakaian sparepart</option>";
                                    </select>

                                  </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div> -->
            <div class="row input_laporan"  style="display:none" id="pendapatan">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title add_page">Laporan Pendapatan</h3>
                        </div>
                        <div class="box-body">
                            <form role="form" id="pendapatan" class="form-horizontal form_pendapatan" action="laporan/pendapatan" method="post">
                                <div class="form-group">
                                        <label class="col-sm-4 control-label">Tanggal</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control datepicker" value="<?php echo date('d/m/Y') ?>" name="tanggal_dari" id="tanggal_dari" type="text">
                                            <div class="input-group-addon">
                                            S.d
                                            </div>
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control datepicker" value="<?php echo date('d/m/Y') ?>" name="tanggal_sampai" id="tanggal_sampai" type="text">
                                        </div>
                                        </div>
                                  </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Pilih bus</label>
                                  <div class="col-sm-8">
                                    <select name="id_unit[]" multiple id="langOpt" class="input_validation">
                                      <?php
                                      $query = $this->db->get('unit')->result_array();
                                      foreach ($query as $key => $value) {
                                        $nama = $value['seri'];
                                        $kategori = $value['id_unit'];
                                        echo "<option value='{$kategori}'>{$nama}</option>";
                                      }
                                      ?>
                                    </select>

                                  </div>
                            </div>
                        </div>
                        <div class="box-footer" style="float:right">
                            <button type="input" class="btn btn-primary edit_page"><span class="fa fa-check"></span> Lihat Laporan</button>
                            <!-- <btn type="input" class="btn btn-primary" id="btn_proses"><span class="fa fa-check"></span> Lihat Laporan</btn> -->
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row input_laporan"  style="display:none" id="pengeluaran">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title add_page">Laporan Pengeluaran</h3>
                        </div>
                        <div class="box-body">
                            <form role="form" class="form-horizontal form_pengeluaran" action="laporan/pengeluaran" method="post">
                                <div class="form-group">
                                        <label class="col-sm-4 control-label">Tanggal</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control datepicker" value="<?php echo date('d/m/Y') ?>" name="tanggal_dari" id="tanggal_dari" type="text">
                                            <div class="input-group-addon">
                                            S.d
                                            </div>
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control datepicker" value="<?php echo date('d/m/Y') ?>" name="tanggal_sampai" id="tanggal_sampai" type="text">

                                        </div>
                                        </div>
                                  </div>
																<div class="form-group">
                                  <label class="col-sm-4 control-label">Kategori</label>
                                  <div class="col-sm-8">
                                    <select name="id_kategori_pengeluaran[]" multiple id="langOpt2" class="input_validation">
                                      <?php
                                      $query = $this->db->get('kategori_pengeluaran')->result_array();
                                      foreach ($query as $key => $value) {
                                        $nama = $value['nama'];
                                        $kategori = $value['id_kategori_pengeluaran'];
                                        echo "<option value='{$kategori}'>{$nama}</option>";
                                      }
                                      ?>
                                    </select>

                                  </div>
                            </div>
                        </div>
                        <div class="box-footer" style="float:right">
                            <button type="input" class="btn btn-primary edit_page"><span class="fa fa-check"></span> Lihat Laporan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row input_laporan" style="display:none" id="rekap_pengeluaran">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title add_page">Rekap pengeluaran</h3>
                        </div>
                        <div class="box-body">
                            <form role="form" class="form-horizontal form_rekap_pengeluaran" action="laporan/rekap_pengeluaran" method="post">
                                <div class="form-group">
                                        <label class="col-sm-4 control-label">Tanggal</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control datepicker" value="<?php echo date('d/m/Y') ?>" name="tanggal_dari" id="tanggal_dari" type="text">
                                            <div class="input-group-addon">
                                            S.d
                                            </div>
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control datepicker" value="<?php echo date('d/m/Y') ?>" name="tanggal_sampai" id="tanggal_sampai" type="text">

                                        </div>
                                        </div>
                                  </div>
                        </div>
                        <div class="box-footer" style="float:right">
                            <button type="input" class="btn btn-primary edit_page"><span class="fa fa-check"></span> Lihat Laporan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row input_laporan" style="display:none" id="rekap_pendapatan">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title add_page">Rekap pendapatan</h3>
                        </div>
                        <div class="box-body">
                            <form role="form" class="form-horizontal form_rekap_pendapatan" action="laporan/rekap_pendapatan" method="post">
                                <div class="form-group">
                                        <label class="col-sm-4 control-label">Tanggal</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control datepicker" value="<?php echo date('d/m/Y') ?>" name="tanggal_dari" id="tanggal_dari" type="text">
                                            <div class="input-group-addon">
                                            S.d
                                            </div>
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control datepicker" value="<?php echo date('d/m/Y') ?>" name="tanggal_sampai" id="tanggal_sampai" type="text">

                                        </div>
                                        </div>
                                  </div>
                        </div>
                        <div class="box-footer" style="float:right">
                            <button type="input" class="btn btn-primary edit_page"><span class="fa fa-check"></span> Lihat Laporan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row input_laporan" style="display:none" id="rekap_total">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title add_page">Rekap Total</h3>
                        </div>
                        <div class="box-body">
                            <form role="form" class="form-horizontal form_rekap_total" action="laporan/rekap_total" method="post">
                                <div class="form-group">
                                        <label class="col-sm-4 control-label">Tanggal</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control datepicker" value="<?php echo date('d/m/Y') ?>" name="tanggal_dari" id="tanggal_dari" type="text">
                                            <div class="input-group-addon">
                                            S.d
                                            </div>
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control datepicker" value="<?php echo date('d/m/Y') ?>" name="tanggal_sampai" id="tanggal_sampai" type="text">

                                        </div>
                                        </div>
                                  </div>
                        </div>
                        <div class="box-footer" style="float:right">
                            <button type="input" class="btn btn-primary edit_page"><span class="fa fa-check"></span> Lihat Laporan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row input_laporan" style="display:none" id="pemakaian_sparepart">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title add_page">Pemakaian Sparepart</h3>
                        </div>
                        <div class="box-body">
                            <form role="form" id="pemakaian_sparepart" class="form-horizontal form_pemakaian_sparepart" action="laporan/pemakaian_sparepart" method="post">
                                  <!-- <div class="form-group">
                                      <label class="col-sm-4 control-label">Filter</label>
                                        <div class="col-sm-8">
                                  <label class="radio-inline">
                                    <input type="radio" name="optradio" checked>Semua
                                  </label>
                                  <label class="radio-inline">
                                    <input type="radio" name="optradio">Sparepart
                                  </label>
                                  <label class="radio-inline">
                                    <input type="radio" name="optradio">Bus
                                  </label>
                                </div>
                                </div> -->
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Filter sperepart</label>
                                  <div class="col-sm-8">
                                    <select name="id_sparepart[]" multiple id="opt_sparepart" class="input_validation">
                                      <?php
                                      $query = $this->db->order_by('nama')->get('sparepart')->result_array();
                                      foreach ($query as $key => $value) {
                                        $nama = $value['nama'];
                                        $kategori = $value['id_sparepart'];
                                        echo "<option value='{$kategori}'>{$nama}</option>";
                                      }
                                      ?>
                                    </select>

                                  </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Filter bus</label>
                              <div class="col-sm-8">
                                <select name="id_unit[]" multiple id="opt_bus2" class="input_validation">
                                  <?php
                                  $query = $this->db->order_by('seri')->get('unit')->result_array();
                                  foreach ($query as $key => $value) {
                                    $nama = $value['seri'];
                                    $kategori = $value['id_unit'];
                                    echo "<option value='{$kategori}'>{$nama}</option>";
                                  }
                                  ?>
                                </select>

                              </div>
                        </div>
                                <div class="form-group">
                                        <label class="col-sm-4 control-label">Tanggal</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control datepicker" value="<?php echo date('d/m/Y') ?>" name="tanggal_dari" id="tanggal_dari" type="text">
                                            <div class="input-group-addon">
                                            S.d
                                            </div>
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control datepicker" value="<?php echo date('d/m/Y') ?>" name="tanggal_sampai" id="tanggal_sampai" type="text">

                                        </div>
                                        </div>
                                  </div>
                        </div>
                        <div class="box-footer" style="float:right">
                            <button type="input" class="btn btn-primary"><span class="fa fa-check"></span> Lihat Laporan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div class="" id="page_content">
              <!-- kaharisman -->
            </div>
    </div>
</div>
</section>

</div>

<script type="text/javascript" src="<?php echo base_url() ?>js/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/datepicker/locales/bootstrap-datepicker.id.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>js/datepicker/css/bootstrap-datepicker.css">
<script src="<?php echo base_url() ?>js/jquery.multiselect.js"></script>
<script>
	 $(function(){

     $( ".form_pendapatan" ).on( "submit", function( event ) {
      event.preventDefault();
      thiss = $(this);
      if(validate(thiss)){
        action = $(this).attr('action');
        get_laporan(action, thiss);
      };
     });
     $( ".form_pengeluaran" ).on( "submit", function( event ) {
       event.preventDefault();
       thiss = $(this);
       if(validate(thiss)){
         action = $(this).attr('action');
         get_laporan(action, thiss);
       };
     });
     $( ".form_rekap_pendapatan" ).on( "submit", function( event ) {
       event.preventDefault();
       thiss = $(this);
       if(validate(thiss)){
         action = $(this).attr('action');
         get_laporan(action, thiss);
       };
     });
     $( ".form_rekap_pengeluaran" ).on( "submit", function( event ) {
       event.preventDefault();
       thiss = $(this);
       if(validate(thiss)){
         action = $(this).attr('action');
         get_laporan(action, thiss);
       };
     });
     $( ".form_rekap_total" ).on( "submit", function( event ) {
       event.preventDefault();
       thiss = $(this);
       if(validate(thiss)){
         action = $(this).attr('action');
         get_laporan(action, thiss);
       };
     });
     $( ".form_pemakaian_sparepart" ).on( "submit", function( event ) {
       event.preventDefault();
       thiss = $(this);
       if(validate(thiss)){
         action = $(this).attr('action');
         get_laporan(action, thiss);
       };
     });

//           $( "form" ).on( "submit", function( event ) {
//             event.preventDefault();
//             action = $(this).attr('action');
//
//             // console.log(this);
//
// data = $(this).find(".input_validation").val();
//               if(!data){
//                 valid = false;
//                 $.notify({
//                   title: "Error :",
//                   message: "tidak boleh kosong!",
//                   icon: 'fa fa-check'
//                 },{
//                   type: "danger"
//                 });
//               $(this).addClass("focus");
//            } else{
//              var request = $.ajax({
//                  url: "<?php echo site_url(); ?>/"+action,
//                  data: {data:  $( this ).serialize()},
//                  type: "POST",
//                 //  dataType: "html"
//              });
//              request.done(function(data) {
//                $(".input_laporan").slideUp();
//                  $("#page_content").html(data);
//                  $("#page_content").show();
//              });
//            }
//
//
//           });

//
function validate(thiss){
  var valid = true;
  thiss.find('.input_validation').each(function() {
    if(!this.value){
      valid = false;
      $.notify({
        title: "Error :",
        message: "Data inputan tidak boleh kosong!",
        icon: 'fa fa-remove'
      },{
        type: "danger"
      });
    $(this).addClass("focus");
 }
});
return valid;
}

function get_laporan(action, thiss){
  var request = $.ajax({
                   url: "<?php echo site_url(); ?>/"+action,
                   data: {data:  thiss.serialize()},
                   type: "POST",
                  //  dataType: "html"
               });
               request.done(function(data) {
                 $(".input_laporan").slideUp();
                  $("#page_content").html(data);
                  $("#page_content").show();
               });
}

     $('.jenis_laporan').click(function(){
      //  alert(this.id);

      // $(".jenis_laporan").addClass("btn-primary" );

      if($( ".jenis_laporan" ).hasClass( "btn-danger" )){
      $(".jenis_laporan").removeClass("btn-danger" );
      }
      //  $(this).removeClass("btn-primary" );
       $(this).addClass( "btn-danger" );

       var jenis_laporan = this.id;

       $(".input_laporan").hide();
        $("#page_content").hide();

     switch(jenis_laporan) {
    case 'lap_pengeluaran':
        $("#pengeluaran").slideDown();
        break;
    case 'lap_pendapatan':
        $("#pendapatan").slideDown();
        break;
    case 'lap_rekap_pengeluaran':
            $("#rekap_pengeluaran").slideDown();
            break;
    case 'lap_rekap_pendapatan':
          $("#rekap_pendapatan").slideDown();
          break;
    case 'lap_rekap_total':
          $("#rekap_total").slideDown();
    break;
    case 'lap_pemakaian_sparepart':
          $("#pemakaian_sparepart").slideDown();
          break;
    default:
        //code block
}

     })

     $('.datepicker').datepicker({
           format: 'dd/mm/yyyy',
           todayBtn: "linked",
           language: "id",
           calendarWeeks: true,
           autoclose: true
      });
      $('#langOpt').multiselect({
          selectAll: true,
          columns: 2,
          placeholder: 'Pilih Bus'
      });
      $('#opt_bus2').multiselect({
          selectAll: true,
          columns: 2,
          placeholder: 'Pilih Bus'
      });
      $('#opt_sparepart').multiselect({
          selectAll: true,
          columns: 2,
          placeholder: 'Pilih Sparepart'
      });
      $('#langOpt2').multiselect({
          selectAll: true,
          columns: 2,
          placeholder: 'Pilih Kategori'
      });
	 });
</script>
