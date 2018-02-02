            <div class="row" id="tabel">
                <div class="col-md-12">
                    <div class="box box-primary">
                      <div class="box-header">
                          Bulan : <?php echo date($bulan); ?>
                      </div>
                        <div class="box-body">
                            <div class="" style=" height: 60% !important;
    overflow: scroll;" >

                            <table id="dt" class="table table-bordered table-hover table-condensed no-wrap " width="100%" cellspacing="0" style="white-space:nowrap; font-size: 12px;">
                            <?php
                            $month = $bulan;
                            $year = $tahun;
                            $number = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
                            $unit = $this->db->get('unit')->result_array();
                            $booking = $this->db->query("select id_booking, id_unit, warna, nama_penyewa, tujuan, id_marketing,
                            EXTRACT( DAY FROM tanggal ) tanggal,
                            (select MAX(status) from pembayaran byr where byr.id_booking = bk.id_booking) status
                             from booking bk join detail_booking using(id_booking)
                            left join marketing using(id_marketing)
                                                         where EXTRACT(MONTH FROM tanggal)  = $bulan and EXTRACT(YEAR FROM tanggal)  = $tahun ")->result_array();
                                                        // echo $this->db->last_query();
                                                        //  die;
                                                        // echo '<pre>';
                                                        //  print_r($booking);
                                                        //  die;
                            echo "  <thead><tr>";
                            for ($i=0; $i <= $number; $i++) {
                              Echo "<td width=50px>{$i}</td>";
                            }
                            echo "</tr></thead><tbody>";
                            foreach ($unit as $key => $value) {
                              $id_unit = $value['id_unit'];
                              $no_seri_unit = $value['seri'];
                              echo "<tr>";
                              echo "<td >{$no_seri_unit}</td>";
                              for ($i=1; $i <= $number; $i++) {
                                $tujuan = $class = '' ;
                                $val_booking = '';
                                $penyewa = $bgcolor = $id_marketing = $marketing = '';
                                foreach ($booking as $key => $value2) {
                                  if ($value2['tanggal'] == $i && $value2['id_unit'] == $id_unit ){
                                    $class = 'booked';
                                    $tujuan .= $value2['tujuan'];
                                    $val_booking = $value2['id_booking'];
                                    $penyewa .= $value2['nama_penyewa'];
                                    $id_marketing .= $value2['id_marketing'];
                                    if($value2['status'] == "LUNAS"){
                                       $bgcolor = 'bgcolor = "#66ff66"';
                                       $marketing = 'background-color:'.$value2['warna'];
                                    } else{
                                      $bgcolor = 'bgcolor = "#f45c42"';
                                      $marketing = 'background-color:'.$value2['warna'];
                                    }
                                  }
                                }
                                Echo "<td {$bgcolor} value='$val_booking' class='$class'>
                                <div style='font-size:10; color:#000; text-align: center; font-weight: bold;$marketing'>
                                   {$id_marketing}</div>{$penyewa}<br> {$tujuan} </td>";
                              }
                              echo "</tr>";
                            }
                            ?>
                          </tbody>
                            </table>

                        </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detail Booking</h4>
                  </div>
                  <div class="modal-body" style="padding:20">
                    <div class="row">
                      <div class="col-md-6">
                        <table id="modal_table" class="table" style="border: 0px">
                          <tr>
                            <td><strong>Marketing</strong></td>
                            <td>: </td>
                            <td><span id="detail_marketing" >-</span></td>
                          </tr>
                          <tr>
                            <td><strong>Status Pembayaran</strong></td>
                            <td>: </td>
                            <td><span id="detail_status" > - </span></td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-md-6 ">
                        <table id="modal_table" class="table" style="border: 0px">
                          <tr>
                            <td><strong>Nama</strong></td>
                            <td>: </td>
                            <td><span id="detail_nama" >-</span></td>
                          </tr>
                          <tr>
                            <td><strong>Telepon</strong></td>
                            <td>: </td>
                            <td><span id="modal_telepon" >-</span></td>
                          </tr>
                          <tr>
                            <td><strong>Tujuan</strong></td>
                            <td>: </td>
                            <td><span id="detail_tujuan" > - </span></td>
                          </tr>
                          <tr>
                            <td><strong>Alamat Jemput</strong></strong></td>
                            <td>: </td>
                              <td><span id="detail_alamat_jemput" > - </span></td>
                          </tr>

                          <tr>
                            <td><strong>Tanggal</strong></td>
                            <td>: </td>
                            <td><span id="detail_tanggal" > - </span></td>
                          </tr>
                          <tr>
                            <td><strong>Unit</strong></td>
                            <td>: </td>
                            <td><span id="modal_unit" > - </span></td>
                          </tr>
                        </table>
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  </div>
                </div>

              </div>
            </div>
            </div>
            <!-- /Modal -->

<script type="text/javascript">

 $('td').click( function() {


  var id = $(this).attr('value');
  var cid = $(this).attr('class');
  console.log(cid);
 if(cid != "booked"){
  //  $(this).toggleClass("selected");
 } else{
 request = $.get("<?php echo base_url('booking') ?>/detail_jadwal",{id : id});
 request.done(function(data){
 arr = JSON.parse(data);
 $.each(arr, function(key, value){
           var id_val = key;
           $("#"+id_val).text(value);
           $("#"+id_val).val(value);
         });
 })
   $("#myModal").modal();
 }
  });
</script>
