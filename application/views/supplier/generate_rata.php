    <div class="container margin-b70">
      <div class="row">
        <div class="col-md-12">
          <h1>Data Nilai Rata-Rata</h1>

          <div id="body">
            <a class="btn btn-primary" href="<?php echo base_url(); ?>supplier/generate_centroid">Proses Data Akhir</a><br><br>
            <div class="table-responsive">
              <table id="table_data" class="table table-bordered table-striped table-admin">
                <tr>
                  <td>No Loket</td>
                  <td>Nama Loket</td>
                  <td>Jumlah Penumpang</td>
                  <td>Ketersediaan Bus</td>
                  <td>Jumlah Fasilitas</td>
                  <td>Rata-Rata</td>
                </tr>
                <?php foreach ($data_loket->result_array() as $s) { ?>
                  <tr>
                    <td><?php echo $s['no_loket']; ?></td>
                    <td><?php echo $s['nama_loket']; ?></td>
                    <?php
                    $jumlah_penumpang_total = $this->db->query('SELECT COUNT(no_jumlah_tujuan) as jumlah_penumpang FROM jumlah_tujuan_loket WHERE no_loket="' . $s['no_loket'] . '"');
                    $ketersediaan_bus_total = $this->db->query('SELECT SUM(jumlah_bus) as jumlah_bus FROM jumlah_bus_loket WHERE no_loket = ' . $s['no_loket']);
                    // $jumlah_fasilitas_total = $this->db->query('SELECT COUNT(no_jumlah_fasilitas) as jumlah_fasilitas FROM jumlah_fasilitas_loket WHERE no_loket="' . $p['no_loket'] . '"');
                    $jumlah_fasilitas_total = $this->db->query('SELECT SUM(jumlah_fasilitas) as jumlah_fasilitas FROM jumlah_fasilitas_loket WHERE no_loket = ' . $s['no_loket']);
                    ?>
                    <td><?= $jumlah_penumpang_total->row()->jumlah_penumpang ?></td>
                    <td><?= $ketersediaan_bus_total->row()->jumlah_bus ?></td>
                    <td><?= $jumlah_fasilitas_total->row()->jumlah_fasilitas ?></td>
                    <!-- <td><?php echo $s['jumlah_penumpang_total']; ?></td>
                    <td><?php echo $s['ketersediaan_bus_total']; ?></td>
                    <td><?php echo $s['jumlah_fasilitas_total']; ?></td> -->
                    <td><?php echo $s['rata_rata']; ?></td>
                  </tr>
                <?php } ?>
              </table>
            </div>
          </div>

          <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
        </div>
      </div>
    </div>