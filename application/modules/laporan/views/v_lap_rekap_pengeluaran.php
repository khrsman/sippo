        <section class="content">
          <div class="row" id="tabel">
              <div class="col-md-12">
                  <div class="box box-primary box-solid">
                    <div class="box-header">
                      Laporan Rekap Pengeluaran
                    </div>
                      <div class="box-body">
                          <table id="dt" class="table table-hover table-bordered display nowrap" width="100%" cellspacing="0">
                              <thead>
                                  <tr>
                                     <th>Kategori</th>
                                     <th>Jumlah</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                $total_pengeluaran = 0;
                                foreach ($data_rekap as $key => $value) {
                                  $total_pengeluaran = $total_pengeluaran + $value['jumlah'];
                                  ?>
                                  <tr>
                                      <td><?php echo $value['kategori'] ?></td>
                                      <td>Rp. <?php echo number_format($value['jumlah']) ?></td>
                                  </tr>
                                  <?php   } ?>
                              </tbody>
                              <tfooter>
                                  <tr>
                                      <td>Total</td>
                                      <td>Rp. <?php echo number_format($total_pengeluaran) ?></td>
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
