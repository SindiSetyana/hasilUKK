<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>
Form Petugas
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-info">
        <h3>Form Input Petugas</h3>
        <!-- <button type="button" value="cancel"></button> -->
    </div>


    <form action="addPetugas" method="post">
        <div class="modal-body">
            <div class="form-group">
                <label for="nama_petugas">Nama</label>
                <input type="text" name="nama_petugas" id="nama_petugas" value="" class="form-control" placeholder="Enter Name...">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="" class="form-control" placeholder="Enter Name...">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="" class="form-control" placeholder="Enter Name...">
            </div>
            <div class="form-group">
                <label for="telp">Telephon</label>
                <input type="number" name="telp" id="telp" value="" class="form-control" placeholder="Enter Name...">
            </div>
            <div class="form-group">
                <label for="telp">Telephon</label>
                <input type="number" name="telp" id="telp" value="" class="form-control" placeholder="Enter Name...">
            </div>
            <div class="form-group">
                <label for="level">Level</label>
                <select name="level" id="level">
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                </select>
            </div>
            <div class="form-group">
                <input type="reset" value="Cancel" class="btn btn-warning">
                <input type="submit" value="Simpan" class="btn btn-secondary">
            </div>
        </div>
    </form>

</div>
<?= $this->endSection() ?>