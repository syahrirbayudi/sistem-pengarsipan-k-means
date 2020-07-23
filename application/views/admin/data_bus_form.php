    <div class="container margin-b50 margin-t50">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <nav class="navbar navbar-default navbar-utama nav-admin-data" role="navigation">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <a class="navbar-brand" href="#"><i class="fa fa-plus-circle">
                    <?php
                    if ($status == 'baru') {
                      echo "</i> Tambah Data Bus</a>";
                    } else {
                      echo "</i> Edit Data Bus</a>";
                    }
                    ?>
              </div>

            </div><!-- /.container-fluid -->
          </nav>

        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="well">
            <form class="form-horizontal" role="form" method="post" action="<?= base_url(); ?>administrasi/data_bus/save" enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="no" value="<?= $no ?>" />
              <input type="hidden" class="form-control" name="status" value="<?= $status ?>" />
              <div class="form-group">
                <label for="inputKK" class="col-sm-3 control-label">Merk Bus</label>
                <div class="col-sm-6">
                  <div class="left-inner-addon">
                    <i class="fa fa-medkit"></i>
                    <input type="text" name="merk_bus" value="<?php echo $merk_bus ?>" required class="form-control" id="inputKK" placeholder="Merk Bus" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNama" class="col-sm-3 control-label">Kelas Bus</label>
                <div class="col-sm-6">
                  <div class="left-inner-addon">
                    <i class="fa fa-archive"></i>
                    <input type="text" name="kelas_bus" required class="form-control" value="<?php echo $kelas_bus ?>" id="inputNama" placeholder="Kelas Bus" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNama" class="col-sm-3 control-label">Jumlah Tujuan</label>
                <div class="col-sm-6">
                  <div class="left-inner-addon">
                    <i class="fa fa-exchange"></i>
                    <input type="text" name="jumlah_tujuan" required class="form-control" value="<?php echo $jumlah_tujuan ?>" id="inputNama" placeholder="Jumlah Tujuan" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNama" class="col-sm-3 control-label">Jumlah Kursi</label>
                <div class="col-sm-6">
                  <div class="left-inner-addon">
                    <i class="fa fa-stack-exchange"></i>
                    <input name="jumlah_kursi" required type="text" class="form-control" id="inputNama" value="<?php echo $jumlah_kursi ?>" placeholder="Jumlah kursi" />
                  </div>
                </div>
              </div>


              <hr class="hr1">
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" class="btn btn-primary bold"><i class="fa fa-save"></i>
                    <?php
                    if ($status == 'baru') {
                      echo "Simpan";
                    } else {
                      echo "Update";
                    }
                    ?>
                  </button>&nbsp;&nbsp;<a href="<?php echo base_url() ?>administrasi/data_bus" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>