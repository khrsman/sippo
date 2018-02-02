<!doctype html>
<html>
<head>
      <style>
              @media print {
  .btn {
    display: none;
  }
}
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;

        color:#555;
    }

    .invoice-box .table_invoice{
        width:100%;
        line-height:inherit;
        text-align:left;
        font-family:"Lucida Console", Monaco, monospace;
        border: 5px double black;
    }

    .table_invoice th, td {
    padding-left: 10px;
    padding-right: 10px;
    /*text-align: left;*/
}
    .table_invoice .section{
      border-top: 1px solid black;
    }
    .table_invoice .section td{
      padding-top: 1em;
    }



      </style>
</head>
  <div class="content-wrapper">
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style="margin:10px">
    <i class="fa fa-pencil"></i> Ubah Harga
  </button>
  <button class="btn btn-primary btn-lg" onclick="window.print()" style="margin:10px"><i class="fa fa-print"></i> Cetak</button>

    <div class="invoice-box">
      <table border="0">
          <tr>
              <td class="title">
                    <img src="<?php echo base_url() ?>img/logo.png" style="height:70px;">
              </td>
              <td style="text-align:right">
                  <!-- No : <?php echo $inv['id_booking'] ?><br> -->
              </td>
          </tr>
      </table>
      <br>

        <table cellpadding="0" cellspacing="0" class="table_invoice">
            <tr class="top">
                <td colspan="2">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                  <center><strong><u><h3>INVOICE</h3></u></strong></center>
                </td>
            </tr>
            <tr>
              <td colspan="2" style="text-align:right">
                <?php
                  echo date('d');
                  echo " ".date('F');
                  echo " ".date('Y');
                     ?>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <strong>PT. NAMA PERUSAHAAN </strong><br>
                Jl. Raya  Bandung <br>
                Ph. 022-123 4567 <br>
                NPWP : 01.234.567.8-900.000
              </td>
            </tr>
            <tr class="section">
                <td>
                    Kepada:
                </td>
                <td>
                  <?php echo $inv['nama_penyewa'] ?>
                </td>
            </tr>
            <tr class="item">
                <td>
                    Alamat:
                </td>

                <td>
                <?php echo $inv['alamat_jemput'] ?>
                </td>
            </tr>


          <tr class="section">
                <td width="140px">
                    Untuk pembayaran
                </td>
                <td>
                </td>
            </tr>
            <tr>
                  <td>
                      Tanggal:
                  </td>
                  <td>
                    <?php echo $inv['tanggal_dari']."  s.d ".$inv['tanggal_sampai'] ?>
                  </td>
              </tr>
            <tr class="item">
                <td>
                    Tujuan
                </td>
                <td>
                    <?php echo $inv['tujuan'] ?>
                </td>
            </tr>

            <tr>
              <td colspan="2">
                <br>
                Keterangan: <br>
                Harga <strong>belum</strong> termasuk tol, parkir dan tip crew <br>
                Dp minimal 30% <br>
                Pelunanasan Maksimal H-1
              </td>
            </tr>
              <tr class="section">
                <td colspan=2>
                <strong>Rp. <?php echo $inv['total'] ?>, - </strong>
                <br>
                <br>
                </td>
            </tr>
            <tr>
              <td colspan="2">
                <strong><i><u>Transfer</u></i></strong><br>
                Bank: BCA <br>
                Atas Nama: Pemmilik Rekening <br>
                Nomer Rekening: 1234567890 <br>
              </td>
            </tr>

        </table>
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Ubah Harga</h4>
          </div>
          <div class="modal-body">
            <form role="form" class="form-horizontal xform">
                <input type="hidden" id="id_pegawai" name="id_pegawai" >
          <div class="form-group" >
                  <label class="col-sm-4 control-label">Jumlah bus x Harga</label>
                  <div class="col-sm-8">
                    <?php foreach ($harga_unit as $key => $value): ?>
                      <input type = "text" name="nama" value = "<?php echo $value['jumlah'] ?> unit x  Rp. <?php echo $value['harga'] ?>" class="form-control input_validation jumlah_bus_modal"  >
                  <?php endforeach; ?>
                      <!-- <input type = "text" name="nama" id="jumlah_bus_modal" value = "<?php echo $inv['jumlah_bus'] ?> bus x  Rp. <?php echo $inv['harga'] ?>" class="form-control input_validation "  > -->
                  </div>
            </div>
            <div class="form-group" >
                    <label class="col-sm-4 control-label">Harga total</label>
                    <div class="col-sm-8">
                        <input type = "text" id="harga_total_modal" value="<?php echo str_replace(',','',$inv['total']) ?>" class="form-control input_validation "  >
                    </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            <button type="button" class="btn btn-primary" id="update_harga" >Simpan</button>
          </div>
        </div>
      </div>
    </div>
</div>


<style type="text/css" media="print">
@page
  {
      size:  auto;   /* auto is the initial value */
      margin: 0mm;  /* this affects the margin in the printer settings */
  }
</style>

<script type="text/javascript">

Number.prototype.format = function(){
   return this.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
};


$("#update_harga").click(function(){

  harga_total = $("#harga_total_modal").val() || 0;
  harga_total = parseInt(harga_total);
  $("#jumlah_bus_kwitansi").html("");
  $('.jumlah_bus_modal').each(function(i, obj){
    val = obj.value;
   $("#jumlah_bus_kwitansi").append("<span>"+val+"</span><br>");
  })


  $("#harga_total_kwitansi").text("Rp. "+harga_total.format());
  $("#harga_total_kwitansi2").text("Rp. "+harga_total.format());
  //  $("#jumlah_bus_kwitansi").text($("#jumlah_bus_modal").val());

$('#myModal').modal('hide');

//
})

</script>
