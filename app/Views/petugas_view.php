<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>
Form Petugas
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="text-xs font-weight-bold text-primary text-uppercase mb-1">PETUGAS</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-white bg-dark">
                    <h3>Form Petugas</h3>
                    <a href="#" data-toggle="modal" data-target="#fPetugas" data-petugas="add" class="btn btn-primary"><i class="fas fa-fw fa-folder"></i>Tambah Data</a>
                    
                </div>


                <div class="card-body">
                    <table class="table table-striped table-bordered" id="petugas">
                        <tr class="text-light bg-secondary mb-1">
                            <th>NO</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Telephon</th>
                            <th>Aksi</th>

                        </tr>
                        <?php
                        $no=0;
                        foreach ($petugas as $row) {
                            $data=$row['id_petugas'].",".$row['nama_petugas'].",".$row['username'].",".$row['password'].",".$row['telp'].",".$row['level'].",".base_url('/petugas/edit/'.$row['id_petugas']);
                            #code... 
                            $no++;
                            ?>
                          
                            <tr>
                                <td><?= $no?></td>
                                <td><?= $row['nama_petugas']?></td>
                                <td><?= $row['username']?></td>
                                <td><?= $row['telp']?></td>
                                <td><?= $row['level']?></td>

                                <td>
                                    <a href="" data-toggle="modal" data-target="#fPetugas" data-petugas="<?= $data?>" class="btn btn-primary"><i class="fas fa-edit"></i>Edit</a>
                                    <a href="/petugas/delete/<?= $row['id_petugas']?>" onclick="return confirm('Yakin Mau Hapus Data??')" class="btn btn-danger"><i class="fas fa-trash"></i>Hapus</a>
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

    <div class="modal fade" id="fPetugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Form Petugas</h5>
                    <button type="button" class="Close"></button>
                </div>

                <form action="" id="editPetugas" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_petugas"><b>Nama</label>
                            <input type="text" name="nama_petugas" id="nama_petugas" value="" class="form-control" placeholder="Enter Name..." >
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="telp">Telephon</label>
                            <input type="number" name="telp" id="telp" value="" class="form-control">
                        </div>
                        <div class="form-group">
                           <label for="level">Level</label> 
                           <select name="level" id="level" class="form-control">
                            <option value="">Pilih Level</option>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                           </select>
                        </div>
                        <div class="form-group" id="ubahpassword">
                            <label for="ubahpasword">Ubah Password</label>
                            <input type="checkbox" name="ubahpassword" id="ubahpassword" value="" class="form-control">

                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
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
        $('#fPetugas').on('show.bs.modal',function(e){                                                                     
            var button = $(e.relatedTarget);
            var data = button.data('petugas');

            if (data != "add"){
            const barisdata = data.split(",");
                $('#nama_petugas').val(barisdata[1]);
                $('#username').val(barisdata[2]);
                $('#password').val(barisdata[3]);
                $('#telp').val(barisdata[4]);
                $('#level').val(barisdata[5]);
                $('#editPetugas').attr('action',barisdata[6]);
                $('#ubahpassword').show();
            }
            else
            {
                $('#nik').val("");
                $('#nama_petugas').val("");
                $('#username').val("");
                $('#password').val("");
                $('#telp').val("");
                $('#level').val("");
                $('#editPetugas').attr('action',"petugas");
                $('#ubahpassword').hide();
            }
        });
    })
</script>

<?= $this->endSection() ?>
