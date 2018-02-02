<head>
<style type="text/css" media="print">
@page
  {
      size:  auto;   /* auto is the initial value */
      margin: 0mm;  /* this affects the margin in the printer settings */
  }
  .btn{
              display:none;
          }
          .invoice-box{

              border:0px;
              box-shadow:0 0 0px;

          }
</style>

<style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:12px;
        /*line-height:24px;*/

        font-family: serif;
        color:#555;
    }

    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
          font-size:12px;
          font-family:"Lucida Console", Monaco, monospace
    }

    </style>
</head>

  <div class="content-wrapper">
      <button class="btn btn-primary btn-lg" onclick="window.print()" style="margin:10px"><i class="fa fa-print"></i> Cetak</button>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                  <img src="<?php echo base_url() ?>img/logo.png" style="height:70px;">
                            </td>
                            <td style="text-align:right">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                  <center><strong>SURAT PERINTAH JALAN</strong></center>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                              <span style="display:inline-block; width: 100px;"><strong>No unit </strong></span>: <?php echo $spj['unit'] ?><br>
                              <span style="display:inline-block; width: 100px;"><strong>Tanggal</strong></span>: <?php echo $spj['tanggal_dari']." - ".$spj['tanggal_sampai'] ?><br>
                            </td>
                            <td>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading" >
                  <td>
                <center><strong>Detail</strong></center>
                </td>
                <td >
              <center><strong>Pengeluaran</strong></center>
              </td>
            </tr>
            <tr class="heading" >
                  <td>
              <table>
                <tr class="item">
                    <td style="width:150px">
                    Alamat jemput
                    </td>
                    <td>
                      <?php echo $spj['alamat_jemput'] ?>
                    </td>
                </tr>
                <tr class="item">
                    <td>
                    Jam jemput
                    </td>
                    <td>
                      <?php echo $spj['jam_jemput'] ?>
                    </td>
                </tr>
                <tr class="item">
                    <td>
                        Tujuan
                    </td>
                    <td>
                      <?php echo $spj['tujuan']
                      ?>
                    </td>
                </tr>
                <tr class="item">
                    <td>
                        Penyewa
                    </td>
                    <td>
                        <?php echo $spj['nama_penyewa'] ?>
                    </td>
                </tr>
                <tr class="item">
                    <td>
                        No Telepon
                    </td>
                    <td>
                        <?php echo $spj['no_telepon'] ?>
                    </td>
                </tr>
                <tr class="item">
                <td>
                </td>
                <td>
                </td>
            </tr>
              </table>
                </td>
                <td >
                  <table>
                      <tr>
                          <td>
                            <!-- <span style="display:inline-block; width: 120px; text-align:center">Upah</span><br> -->
                            <span style="display:inline-block; width: 120px;">Sopir</span>: Rp. <?php echo $spj['biaya_sopir'] ?> <br>
                            <span style="display:inline-block; width: 120px;">Crew</span>: Rp. <?php echo $spj['biaya_crew'] ?><br>

                            <!-- <span style="display:inline-block; width: 120px; text-align:center">Operasional</span><br> -->
                            <span style="display:inline-block; width: 120px;">Solar</span>: Rp. <?php echo $spj['biaya_solar'] ?> <br>
                            <span style="display:inline-block; width: 120px;">Tol</span>: Rp. <?php echo $spj['biaya_tol'] ?> <br>
                            <span style="display:inline-block; width: 120px;">Parkir</span>: Rp. <?php echo $spj['biaya_parkir'] ?> <br>
                            <span style="display:inline-block; width: 120px;">Tips</span>: Rp. <?php echo $spj['biaya_tips'] ?> <br>
                            <span style="display:inline-block; width: 120px;">Penyebrangan</span>: Rp. <?php echo $spj['biaya_penyebrangan'] ?> <br>
                            <span style="display:inline-block; width: 120px;">Lain</span>: Rp. <?php echo $spj['biaya_lain'] ?> <br>
                            <span style="display:inline-block; width: 120px;">Total</span>: Rp. <?php echo $spj['biaya_total'] ?> <br>
                          </td>
                      </tr>
                  </table>

              </td>
            </tr>

            <tr class="heading">
            </tr>
            <tr class="">
                <td colspan="2">
                </td>
            </tr>
            <tr class="item">

            </tr>
        </table>
        <table>

        </table>
    </div>
</div>
