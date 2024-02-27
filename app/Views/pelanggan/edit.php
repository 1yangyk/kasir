<?= $this->extend('templates/sidebar'); ?>

<?= $this->section('page-content'); ?>

        <h4 class="py-3">Ubah Data Barang</h4>

        <table>
        <tr>
            <td><a href="/pelanggan"><button class="btn btn-primary my-3"><i class="fa fa-plus"></i>
                    Kembali</button></a></td>
        </tr>
        </table>


        <div class="card card-body">
                    
            <form action="/pelanggan/update/<?= $pelanggan['PelangganID'] ;?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="dummy" value="<?= $pelanggan['PelangganID'] ;?>">
            <div class="row my-3">
                <label for="namaPelanggan" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                <div class="col-sm-10">
                <input type="text" class="form-control shadow-sm <?= ($validation->hasError('NamaPelanggan')) ? 'is-invalid' : ''; ?>" id="namaPelanggan" name="namaPelanggan" autofocus value="<?= $pelanggan['NamaPelanggan'] ;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                <input type="text" class="form-control shadow-sm <?= ($validation->hasError('')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= $pelanggan['Alamat'] ;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="noHP" class="col-sm-2 col-form-label">No. Handphone</label>
                <div class="col-sm-10">
                <input type="number" class="form-control shadow-sm <?= ($validation->hasError('')) ? 'is-invalid' : ''; ?>" id="hargaJual" name="noHP" value="<?= $pelanggan['NomorTelephone'] ;?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

        </div>

<?= $this->endSection(); ?>