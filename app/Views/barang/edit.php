<?= $this->extend('templates/sidebar'); ?>

<?= $this->section('page-content'); ?>

        <h4 class="py-3">Ubah Data Barang</h4>

        <table>
        <tr>
            <td><a href="/barang"><button class="btn btn-primary my-3"><i class="fa fa-plus"></i>
                    Kembali</button></a></td>
        </tr>
        </table>


        <div class="card card-body">
                    
            <form action="/barang/update/<?= $barang['ProdukID'] ;?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="dummy" value="<?= $barang['ProdukID'] ;?>">
            <div class="row my-3">
                <label for="namaProduk" class="col-sm-2 col-form-label">Nama Produk</label>
                <div class="col-sm-10">
                <input type="text" class="form-control shadow-sm <?= ($validation->hasError('NamaProduk')) ? 'is-invalid' : ''; ?>" id="namaProduk" name="namaProduk" autofocus value="<?= $barang['NamaProduk'] ;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="hargaBeli" class="col-sm-2 col-form-label">Harga Beli</label>
                <div class="col-sm-10">
                <input type="number" class="form-control shadow-sm <?= ($validation->hasError('')) ? 'is-invalid' : ''; ?>" id="hargaBeli" name="hargaBeli" value="<?= $barang['HargaBeli'] ;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="hargaJual" class="col-sm-2 col-form-label">Harga Jual</label>
                <div class="col-sm-10">
                <input type="number" class="form-control shadow-sm <?= ($validation->hasError('')) ? 'is-invalid' : ''; ?>" id="hargaJual" name="hargaJual" value="<?= $barang['HargaJual'] ;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="jml" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                <input type="number" class="form-control shadow-sm <?= ($validation->hasError('')) ? 'is-invalid' : ''; ?>" id="jml" name="jml" value="<?= $barang['Stok'] ;?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

        </div>

<?= $this->endSection(); ?>