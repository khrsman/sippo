              <div class="row" id="form_view">
                <div class="col-md-6">
                    <div class="box box-success box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title add_page">Tambah</h3>
                          <h3 class="box-title edit_page">Update</h3>
                        </div>
                        <div class="box-body">
                            <form role="form" class="form-horizontal xform">
                                <input type="hidden" id="id_pemakaian_sparepart" name="id_pemakaian_sparepart" >
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Nama</label>
                                  <div class="col-sm-8">
                                    <?php
                                    $this->cb_options->sparepart();
                                     ?>
                                  </div>
                                  </div>
													<div class="form-group">
                                  <label class="col-sm-4 control-label">Jumlah</label>
                                  <div class="col-sm-8">
                                      <input type = "text" name="jumlah" id="jumlah" class="form-control"  >
                                  </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-4 control-label">Id unit</label>
                                    <div class="col-sm-8">
                                      <?php
                                      $this->cb_options->unit();
                                       ?>
                                    </div>
                              </div>
                              <div class="form-group">
                                        <label class="col-sm-4 control-label">Tanggal</label>
                                        <div class="col-sm-8">
                                          <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                                          <input type = "text" name="tanggal" value="<?php echo date('d/m/Y') ?>" id="tanggal" class="form-control datepicker"  >
                                        </div>

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

            <script type="text/javascript" src="<?php echo base_url() ?>js/datepicker/js/bootstrap-datepicker.js"></script>
            <script type="text/javascript" src="<?php echo base_url() ?>js/datepicker/locales/bootstrap-datepicker.id.min.js"></script>
            <link rel="stylesheet" href="<?php echo base_url() ?>js/datepicker/css/bootstrap-datepicker.css">
            <script type="text/javascript">
            $('.datepicker').datepicker({
                  format: 'dd/mm/yyyy',
                  todayBtn: "linked",
                  language: "id",
                 calendarWeeks: true,
                  autoclose: true
             });
            </script>
