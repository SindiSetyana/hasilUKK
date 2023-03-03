<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>
Form Pengaduan
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="col">
    <div class="card">
        <div class="card-header">
            <?php
            if (session()->get('level') == 'masyarakat') {
            ?>
                <a href="#" data-toggle="modal" data-target="#modalPengaduan" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Pengaduan</a>
                <!-- <button type="button" class="Close"></button> -->
            <?php
            }
            ?>
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>No</th>
                    <th>Tgl Pengaduan</th>
                    <th>Isi Laporan</th>
                    <th>foto</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $no = 0;
                foreach ($pengaduan as $row) {
                    $no++;
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['tgl_pengaduan'] ?></td>
                        <td><?= $row['isi_laporan'] ?></td>
                        <td>
                            <?php
                            if ($row['foto'] != '') {
                            ?>
                                <img src="/upload/berkas/<?= $row['foto'] ?>" alt="" width="50" height="50">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?= $row['status']?></td>
                        <td>
                            <?php
                            if (session('level') == 'masyarakat') {
                                if ($row['status'] == '0') {
                            ?>
                                    <a onclick="return confirm('Yakin Mau Hapus Data?')" href="/pengaduan/delete/<?= $row['id_pengaduan'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>

                                <?php

                                } else {
                                ?>
                                    <a href="#" data-target="#modalTanggapan" data-toggle="modal" data-pengaduan="<?= $row['id_pengaduan'] ?>" class="btn btn-primary" data-aduan="selesai">Lihat Tanggapan</a>
                                <?php

                                }
                            }
                            if (!empty(session('level')) && session('level') != 'masyarakat') {
                                if ($row['status'] == '0') {


                                ?>
                                    <a href="#" data-target="#modalTanggapan" data-toggle="modal" data-pengaduan="<?= $row['id_pengaduan'] ?>" class="btn btn-success">Tanggapi</a>
                                <?php
                                } else {
                                ?>
                                    <a href="#" data-target="#modalTanggapan" data-toggle="modal" data-pengaduan="<?= $row['id_pengaduan'] ?>" class="btn btn-primary" data-aduan="selesai" >Lihat Tanggapan</a>
                            <?php
                                }
                            }
                            ?>

                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalPengaduan" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-primary">
                    <h3>Tambah Pengaduan</h3>

                </div>

                <form action="/tambahpengaduan" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Isi Laporan</label>
                            <textarea name="isi_laporan" cols="30" rows="10" class="form-control" placeholder="Laporkan Disini..." required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto">foto</label>
                            <input type="file" name="foto" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTanggapan" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-primary"> </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <form action="/tanggapi" method="post">
                    <input type="hidden" name="id_pengaduan" id="id_pengaduan">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tanggapan</label>
                            <textarea name="tanggapan" id="tanggapans" cols="30" rows="10" class="form-control"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btsTanggapan">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>

    </div>


    <?= $this->endSection() ?>
    <?= $this->section('script') ?>
    <script>
        $(document).ready(function() {
            $('#modalTanggapan').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var data = button.data('pengaduan');
                var aduan = button.data('aduan');

                $('#id_pengaduan').val(data);
                if (aduan == "selesai") {
                    var query = "id_pengaduan=" + data;

                    $('#btsTanggapan').hide();
                    $.ajax({
                        url: '/getTanggapan',
                        type: 'GET',
                        data: query,
                        dataType: 'json',
                        success: function(data) {
                            $('#tanggapans').val(data[0].tanggapan);
                        },
                        error: function(error) {
                            console.log(error);
                        }


                    });
                    $('#tanggapans').val();

                } else {
                    $('#btsTanggapan').show;
                    $('#tanggapans').val("");
                }
            });
        })
    </script>

    <?= $this->endSection() ?>