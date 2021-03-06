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
                      echo "</i> Tambah Data Jumlah Fasilitas</a>";
                    } else {
                      echo "</i> Edit Data Jumlah Fasilitas</a>";
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
            <form class="form-horizontal" role="form" method="post" action="<?= base_url(); ?>administrasi/data_jumlah_fasilitas_loket/save" enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="no_jumlah_fasilitas" value="<?= $no_jumlah_fasilitas ?>" />
              <input type="hidden" class="form-control" name="status" value="<?= $status ?>" />

              <div class="form-group">
                <label for="inputth" class="col-sm-3 control-label">Pilih Loket</label>
                <div class="col-sm-6">
                  <select name="no_loket" class="select2" required>
                    <option value=""> -- Pilih Fasilitas -- </option>
                    <?php foreach ($no_loket as $pt) : ?>
                      <option value="<?= $pt['no_loket'] ?>"><?= $pt['no_loket'] ?> - <?= $pt['nama_loket'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputpp" class="col-sm-3 control-label">Pilih Fasilitas</label>
                <div class="col-sm-6">
                  <select name="no_fasilitas" class="select2" required>
                    <option value=""> -- Pilih Fasilitas -- </option>
                    <?php foreach ($no_fasilitas as $pp) : ?>
                      <option value="<?= $pp['no_fasilitas'] ?>"><?= $pp['no_fasilitas'] ?> - <?= $pp['nama_fasilitas'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputppp" class="col-sm-3 control-label">Jumlah Fasilitas</label>
                <div class="col-sm-6">
                  <div class="left-inner-addon">
                    <i class="fa fa-user"></i>
                    <input type="text" name="jumlah_fasilitas" value="<?php echo $jumlah_fasilitas ?>" required class="form-control" id="inputppp" placeholder="Jumlah Fasilitas" />
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
                  </button>&nbsp;&nbsp;<a href="<?php echo base_url() ?>administrasi/data_jumlah_fasilitas_loket" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>