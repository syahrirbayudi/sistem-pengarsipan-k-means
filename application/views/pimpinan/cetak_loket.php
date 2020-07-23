  <div class="container margin-b70">
    <div class="row">
      <div class="col-md-12">
        <nav class="navbar navbar-default navbar-utama nav-admin-data" role="navigation">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Data Loket</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
              <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url() ?>pimpinan/cetak_loket/view" target="_blank"><i class="fa fa-print"></i> CETAK DATA</a></li>
              </ul>

            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

      </div>
    </div>
    <div class="table-responsive">
      <table id="table_data" class="table table-bordered table-striped table-admin">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Loket</th>
            <th>Jumlah Penumpang</th>
            <th>Ketersediaan Bus</th>
            <th>Jumlah Fasilitas</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data_loket as $p) :
            $jumlah_penumpang_total = $this->db->query('SELECT COUNT(no_tujuan) as jumlah_penumpang FROM jumlah_tujuan_loket WHERE no_loket = ' . $p['no_loket']);
            $ketersediaan_bus_total = $this->db->query('SELECT SUM(jumlah_bus) as jumlah_bus FROM jumlah_bus_loket WHERE no_loket = ' . $p['no_loket']);
            $jumlah_fasilitas_total = $this->db->query('SELECT SUM(jumlah_fasilitas) as jumlah_fasilitas FROM jumlah_fasilitas_loket WHERE no_loket = ' . $p['no_loket']);
            // $jumlah_ = $this->db->query('SELECT SUM(no_tujuan) as jumlah_penumpang FROM jumlah_tujuan_loket WHERE no_loket = ' . $p['no_loket']);
          ?>
            <tr>
              <td><?= $p['no_loket'] ?></td>
              <td><?= $p['nama_loket'] ?></td>
              <td><?= $jumlah_penumpang_total->row()->jumlah_penumpang ?></td>
              <td><?= $ketersediaan_bus_total->row()->jumlah_bus ?></td>
              <td><?= $jumlah_fasilitas_total->row()->jumlah_fasilitas ?></td>

            </tr>
          <?php endforeach ?>
        </tbody>
      </table>

    </div>

  </div>