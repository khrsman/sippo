        <section class="content">
          <div class="row" id="tabel">
              <div class="col-md-12">
                  <div class="box box-primary box-solid">
                      <div class="box-header">
                         Laporan Rekap Pendapatan
                      </div>
                      <div class="box-body">
                          <table id="dt" class="table table-hover table-bordered display nowrap" width="100%" cellspacing="0">
                              <thead>
                                  <tr>
                                     <th>Unit</th>
                                     <th>Jumlah Hari</th>
                                     <th>Total</th>
                                     <th>Kas Jalan</th>
                                     <th>Selisih</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                $total_pendapatan = $total_kas_jalan = $total_selisih = 0;
                                foreach ($data_rekap as $key => $value) {
                                  $total_pendapatan = $total_pendapatan + $value['total'];
                                  $total_kas_jalan = $total_kas_jalan + $value['kas_jalan'];
                                  $selisih = $value['total'] - $value['kas_jalan'];
                                  $total_selisih = $total_selisih +  $selisih;
                                  ?>
                                  <tr>
                                      <td><?php echo $value['seri'] ?></td>
                                      <td><?php echo $value['jumlah_hari'] ?> Hari</td>
                                      <td>Rp. <?php echo  number_format($value['total']) ?></td>
                                      <td>Rp. <?php echo  number_format($value['kas_jalan']) ?></td>
                                      <td>Rp. <?php echo  number_format($value['total'] - $value['kas_jalan']) ?></td>
                                  </tr>
                                  <?php   } ?>
                              </tbody>
                              <tfooter>
                                    <tr>
                                        <td>Total</td>
                                        <td></td>
                                        <td>Rp. <?php echo  number_format($total_pendapatan) ?></td>
                                        <td>Rp. <?php echo  number_format($total_kas_jalan) ?></td>
                                        <td>Rp. <?php echo  number_format($total_selisih) ?></td>
                                    </tr>
                              </tfooter>
                          </table>
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
<script src="<?php echo base_url() ?>js/jquery.multiselect.js"></script>
<script>
	 $(function(){
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
          placeholder: 'Pilih Kategori'
      });
	 });
</script>
