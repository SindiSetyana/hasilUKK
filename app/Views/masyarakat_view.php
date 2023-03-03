<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>
Form Masyarakat
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="text-xs font-weight-bold text-primary text-uppercase mb-1">Masyarakat</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-white bg-dark">
                    <h3>Data Masyarakat</h3>
                    <!-- <a href="" data-toggle="modal" data-target="#fMasyarakat" data-masyarakat="add" class="btn btn-secondary"><i class="fas fa-card"></i>Tambah Data</a> -->
                </div>


                <div class="card-body">
                    <table class="table table-striped">
                        <tr class="text-light bg-primary">
                            <th>NO</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Telephon</th>
                            <th>Aksi</th>

                        </tr>
                        <?php
                        $no=0;
                        foreach ($masyarakat as $row) {
                            $data=$row['id'].",".$row['nik'].",".$row['nama'].",".$row['username'].",".$row['password'].",".$row['telp'].",".base_url('/masyarakat/edit/'.$row['id']);
                            #code... 
                            $no++;
                            ?>
                          
                            <tr>
                                <td><?= $no?></td>
                                <td><?= $row['nik']?></td>
                                <td><?= $row['nama']?></td>
                                <td><?= $row['username']?></td>
                                <td><?= $row['telp']?></td>

                                <td>
                                    <a href="" data-toggle="modal" data-target="#fMasyarakat" data-masyarakat="<?= $data?>" class="btn btn-primary"><i class="fas fa-edit"></i>Edit</a>
                                    <a href="/masyarakat/delete/<?= $row['id']?>" onclick="return confirm('Yakin Mau Hapus Data??')" class="btn btn-danger"><i class="fas fa-trash"></i>Hapus</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
                <?php if(!empty(session()->getFlashdata("message"))) :?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata("message")?>
                    </div>
                    <?php endif?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fMasyarakat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel" >Form Edit Masyarakat</h5>
                    <button type="button" class="Close"></button>
                </div>

                <form action="" id="editMasyarakat" method="post" >
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="number" name="nik" id="nik" value="" class="form-control" placeholder="Enter NIK..." required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" value="" class="form-control" placeholder="Enter Nama..." required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" value="" class="form-control" placeholder="Enter Username..." required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" value="" class="form-control" placeholder="Enter Password..." required>
                        </div>
                        <div class="form-group">
                            <label for="telp">Telephon</label>
                            <input type="number" name="telp" id="telp" value="" class="form-control" placeholder="Enter Telephon..." required>
                        </div>
                        <div class="form-group" id="ubahpassword">
                            <label for="ubahpasword">Ubah Password</label>
                            <input type="checkbox" name="ubahpassword" id="ubahpassword" value="" class="form-control" require>

                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-secondary">Close</button>
                            <button type="submit"  class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script')?>
<script>
    $(document).ready(function(){
        $('#fMasyarakat').on('show.bs.modal',function(e){                                                                     
            var button = $(e.relatedTarget);
            var data = button.data('masyarakat');

            if (data != "add"){
            const barisdata = data.split(",");
                $('#nik').val(barisdata[1]);
                $('#nama').val(barisdata[2]);
                $('#username').val(barisdata[3]);
                $('#password').val(barisdata[4]);
                $('#telp').val(barisdata[5]);
                $('#editMasyarakat').attr('action',barisdata[6]);
                $('#ubahpassword').show();
            }
            else
            {
                $('#nik').val("");
                $('#nama').val("");
                $('#username').val("");
                $('#password').val("");
                $('#telp').val("");
                $('#editMasyarakat').attr('action',"masyarakat");
                $('#ubahpassword').hide();
            }
        });
    })
</script>

<?= $this->endSection() ?>
