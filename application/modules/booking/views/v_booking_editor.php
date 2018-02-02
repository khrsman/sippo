<link rel="stylesheet" href="<?php echo base_url('css') ?>/jquery-ui.multidatespicker.css">
<link rel="stylesheet" href="<?php echo base_url('css') ?>/jquery-ui.min.css">
<link rel="stylesheet" href="<?php echo base_url('css') ?>/jquery.multiselect.css">
<div class="row"  id="form_tambah">
    <div class="col-md-5">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title add_page">Detail Booking</h3>
            </div>
            <div class="box-body">
                <form role="form" class="form-horizontal xform">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Kode booking</label>
                        <div class="col-sm-8">
                            <input readonly="" type="text" name="id_booking" id="id_booking" class="form-control" value="<?php echo $kode_booking ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Marketing</label>
                        <div class="col-sm-8">
                            <?php
                                $this->cb_options->marketing();
                                ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nama Penyewa</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama_penyewa" id="nama_penyewa" class="form-control input_validation">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">No Telepon</label>
                        <div class="col-sm-8">
                            <input type="text" name="no_telepon" id="no_telepon" class="form-control input_validation">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tujuan</label>
                        <div class="col-sm-8">
                            <input type="text" name="tujuan" id="tujuan" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Alamat Jemput</label>
                        <div class="col-sm-8">
                            <input type="text" name="alamat_jemput" id="alamat_jemput" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Total</label>
                        <div class="col-sm-8">
                            <input value="0" type="number" name="total" id="total" class="form-control">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="col-md-7">
        <div class="box box-success box-solid">
          <div class="box-header with-border">
              <h3 class="box-title add_page">Detail Booking</h3>
          </div>
            <div class="box-body">
                <form role="form" class="form-horizontal xform">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal</label>
                        <div class="col-sm-8">
                            <!-- <input type="text"  readonly="" name="tanggal" id="tanggal" class="form-control"> -->
                            <div id="mdp_tanggal_booking"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Unit</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="form_tanggal_unit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Harga</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="form_harga_unit">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
            <div class="box-footer" style="//float:right">
                <a class="btn btn-danger" id="cancel"><span class="fa fa-remove "></span> Cancel</a>
                <a class="btn btn-primary add_page" id="simpan_custom"><span class="fa fa-check "></span> Hanya simpan</a>
                <a class="btn btn-success add_page" id="bayar_custom"><span class="fa fa-check "></span> Lanjut ke pembayaran</a>
                <a class="btn btn-primary edit_page" id="update"><span class="fa fa-check "></span> update</a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?php echo base_url('js') ?>/jquery-ui.multidatespicker.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.multiselect.js"></script>

<script>
$(function() {
    //hitung harga
    function hitung_total() {
        harga = 0;

        $(".harga_unit").each(function() {
            harga_unit = $(this).val();
            harga = parseInt(harga) + parseInt(harga_unit);
        })

        $("#total").val(harga);
    }

    // hitung saat terjadi perubahan pada nilai harga
    $('body').on("keyup", ".hitung_total", function() {
        hitung_total();
    });

    // onclick tanggal booking
    $('#mdp_tanggal_booking').multiDatesPicker({
        dateFormat: "d-m-yy",
        onSelect: function(date) {
            val = date;
            text = date;

            if ($('#' + val).length === 0) {
                var request = $.get("<?php echo site_url(); ?>/booking/select_unit", {
                    date: date
                });
                request.done(function(data) {
                    add3 = '<div class="unit_dan_tanggal" id="' + val + '"><label class="col-sm-3 control-label">' + text + ' </label><div class="col-sm-9">' + data + '</div>'
                    $('.form_tanggal_unit').append(add3);

                    //hitung jumlah_hari
                    hitung_total();
                    $('select[multiple].tanggal_unit').multiselect({
                        columns: 3,
                        placeholder: 'Pilih Unit',
                        search: true,
                        searchOptions: {
                            'default': 'Cari Unit'
                        },

                        onOptionClick: function(element, option) {
                            var thisOpt = $(option);
                            var val = thisOpt.val();
                            var text = thisOpt.attr("title");
                            var count = $('#langOpt option:selected').length;
  console.log(thisOpt);
                            var units = [];
                            if (thisOpt.prop('checked')) {
                                $('.tanggal_unit option:selected').each(function() {
                                    units.push($(this).val());
                                });

                                if ($('.harga_per_unit').is('#' + val)) {} else {
                                    add3 = '<div class="harga_per_unit" id="' + val + '"><label class="col-sm-2 control-label">' + text + ' </label> <div class="col-sm-10"><input type = "text" name="harga_perunit[' + val + ']" id="" value="0" class="form-control hitung_total harga_unit" onkeydown="return (event.which >= 48 && event.which <= 57) || (event.which >= 96 && event.which <= 105) || event.which == 8 || event.which == 46 || event.which == 37 || event.which == 39"></div>';
                                    $('.form_harga_unit').append(add3);

                                }
                            } else {
                                $('.tanggal_unit option:selected').each(function() {
                                    units.push($(this).val());
                                });

                                if ($.inArray(val, units) !== -1) {

                                } else {
                                    $('#' + val).remove();
                                }

                            }
                        }
                    });
                });
            } else {
                $('#' + val).remove();
            }
        }
    });


    // aksi pada saat tombol simpan data di klik
    $('#simpan_custom').click(function() {
      var data = $('form').serialize();
      insert(data);
    });


    function halaman_pembayaran(){
      var id_booking = $("#id_booking").val();
      var redirect = "<?php echo site_url() ?>/pembayaran/by_id_booking?id_booking=" + id_booking;
      // console.log(id_booking);
       window.location.href = redirect;
    }
    // lanjutkan ke pembayaran
    $('#bayar_custom').click(function() {
    var data = $('form').serialize();
    insert(data,halaman_pembayaran);
});

});
</script>
