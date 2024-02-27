<?= $this->extend('templates/sidebar'); ?>

<?= $this->section('page-content'); ?>

        <h4 class="py-3">Tambah Pelanggan</h4>

        <table>
        <tr>
            <td><a href="/barang"><button class="btn btn-primary my-3"><i class="fa fa-plus"></i>
                    Kembali</button></a></td>
        </tr>
        </table>


        <div class="card card-body">
                    
            <form action="/pelanggan/simpan" method="post">
                <?= csrf_field(); ?>
            <div class="row my-3">
                <label for="namaPelanggan" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                <div class="col-sm-10">
                <input type="text" class="form-control shadow-sm <?php if (session('errors.namaProduk')) : ?>is-invalid<?php endif ?>" id="namaPelanggan" name="namaPelanggan" autofocus value="<?= old('namaPelanggan')?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                <input type="text" class="form-control shadow-sm <?= ($validation->hasError('')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= old('')?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="noHP" class="col-sm-2 col-form-label">No. Handphone</label>
                <div class="col-sm-10">
                <input type="number" class="form-control shadow-sm <?= ($validation->hasError('')) ? 'is-invalid' : ''; ?>" id="noHP" name="noHP" value="<?= old('')?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            </form>

        </div>

<?= $this->endSection(); ?>