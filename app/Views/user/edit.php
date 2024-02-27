<?= $this->extend('templates/sidebar'); ?>

<?= $this->section('page-content'); ?>

        <h4 class="py-3">Ubah Data Barang</h4>

        <table>
        <tr>
            <td><a href="/manage"><button class="btn btn-primary my-3"><i class="fa fa-plus"></i>
                    Kembali</button></a></td>
        </tr>
        </table>


        <div class="card card-body">
                    
            <form action="/manage/update/<?= $pengguna['id'] ;?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="dummy" value="<?= $pengguna['id'] ;?>">
            <div class="row my-3">
                <label for="Username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                <input type="text" class="form-control shadow-sm <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="Username" name="Username" autofocus value="<?= $pengguna['username'] ;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="Email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                <input type="text" class="form-control shadow-sm <?= ($validation->hasError('')) ? 'is-invalid' : ''; ?>" id="Email" name="Email" value="<?= $pengguna['email'] ;?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

        </div>

<?= $this->endSection(); ?>