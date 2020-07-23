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
                      echo "</i> Tambah Data loket</a>";
                    } else {
                      echo "</i> Edit Data loket</a>";
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
            <form class="form-horizontal" role="form" method="post" action="<?= base_url(); ?>administrasi/data_loket/save" enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="no_loket" value="<?= $no_loket ?>" />
              <input type="hidden" class="form-control" name="status" value="<?= $status ?>" />
              <div class="form-group">
                <label for="inputKK" class="col-sm-3 control-label">Nama Loket</label>
                <div class="col-sm-6">
                  <div class="left-inner-addon">
                    <i class="fa fa-building-o"></i>
                    <input type="text" name="nama_loket" value="<?php echo $nama_loket ?>" required class="form-control" id="inputKK" placeholder="Nama Loket" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputKK" class="col-sm-3 control-label">Jumlah Penumpang</label>
                <div class="col-sm-6">

                  <p>Data digenerate oleh data variable Jumlah Penumpang Per Loket</p>
                </div>

              </div>
              <div class="form-group">
                <label for="inputKK" class="col-sm-3 control-label">Ketersediaan Bus</label>
                <div class="col-sm-6">
                  <p>Data digenerate oleh data variable Jumlah Bus Per Loket</p>
                </div>
              </div>
              <div class="form-group">
                <label for="inputKK" class="col-sm-3 control-label">Jumlah Fasilitas</label>
                <div class="col-sm-6">

                  <p>Data digenerate oleh data variable Jumlah Fasilitas per Loket</p>
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
                  </button>&nbsp;&nbsp;<a href="<?php echo base_url() ?>administrasi/data_loket" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>