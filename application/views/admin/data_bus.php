  <div class="container margin-b70">
    <div class="row">
      <div class="col-md-12">
        <?php
        if ($msg = $this->session->flashdata('sukses')) {
          echo $msg;
        }
        ?>
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
              <a class="navbar-brand" href="#">Daftar Data Bus</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
              <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url() ?>administrasi/data_bus/add"><i class="fa fa-plus-circle"></i> Tambah Data</a></li>
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
            <th>Merk Bus</th>
            <th>Kelas Bus</th>
            <th>Jumlah Tujuan</th>
            <th>Jumlah Kursi</th>
            <!-- <th>Persen Ketersediaan</th> -->
            <!-- <th>Total Ketersediaan</th> -->
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data_bus as $o) : ?>
            <tr>

              <td><?= $o['no'] ?></td>
              <td><?= $o['merk_bus'] ?></td>
              <td><?= $o['kelas_bus'] ?></td>
              <td><?= $o['jumlah_tujuan'] ?></td>
              <td><?= $o['jumlah_kursi'] ?></td>
              <!-- <td><?= $o['persen_ketersediaan'] ?></td>
              <td><?= $o['total_sedia'] ?></td> -->
              <td>
                <p><a href="<?= base_url(); ?>administrasi/data_bus/edit/<?= $o['no'] ?>" class="btn btn-success" rel="tooltip" data-original-title="Mengubah data pada baris ini" data-placement="top"><i class="fa fa-pencil"></i> Edit</a></p>

                <p><a href="<?= base_url(); ?>administrasi/data_bus/del/<?= $o['no'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')" class="btn btn-danger " rel="tooltip" data-original-title="Menghapus Data pada baris ini" data-placement="top"><i class="fa fa-trash-o"></i> Hapus</a></p>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>

    </div>

  </div>