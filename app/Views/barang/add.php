<?= $this->extend('templates/sidebar'); ?>

<?= $this->section('page-content'); ?>

        <h4 class="py-3">Tambah Barang</h4>

        <table>
        <tr>
            <td><a href="/barang"><button class="btn btn-primary my-3"><i class="fa fa-plus"></i>
                    Kembali</button></a></td>
        </tr>
        </table>


        <div class="card card-body">
                    
            <form action="/barang/simpan" method="post">
                <?= csrf_field(); ?>
            <div class="row my-3">
                <label for="namaProduk" class="col-sm-2 col-form-label">Nama Produk</label>
                <div class="col-sm-10">
                <input type="text" class="form-control shadow-sm <?php if (session('errors.namaProduk')) : ?>is-invalid<?php endif ?>" id="namaProduk" name="namaProduk" autofocus value="<?= old('namaProduk')?>">
                    <div class="">
                        <?php if (session()->has('errors')) : ?>
                          <?php foreach (session('errors') as $field => $error) : ?>
                            <?php if ($field === 'namaProduk') : ?>
                              <span class="text-danger text-sm"><?= $error ?></span>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="hargaBeli" class="col-sm-2 col-form-label">Harga Beli</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control shadow-sm <?php if (session('errors.hargaBeli')) : ?>is-invalid<?php endif ?>" id="hargaBeli" name="hargaBeli" value="<?= old('hargaBeli') ?>">
                    <div class="">
                        <?php if (session()->has('errors')) : ?>
                          <?php foreach (session('errors') as $field => $error) : ?>
                            <?php if ($field === 'hargaBeli') : ?>
                              <span class="text-danger text-sm"><?= $error ?></span>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="hargaJual" class="col-sm-2 col-form-label">Harga Jual</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control shadow-sm <?php if (session('errors.hargaJual')) : ?>is-invalid<?php endif ?>" id="hargaJual" name="hargaJual" value="<?= old('hargaJual')?>">
                    <div class="">
                        <?php if (session()->has('errors')) : ?>
                          <?php foreach (session('errors') as $field => $error) : ?>
                            <?php if ($field === 'hargaJual') : ?>
                              <span class="text-danger text-sm"><?= $error ?></span>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jml" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control shadow-sm <?php if (session('errors.jml')) : ?>is-invalid<?php endif ?>" id="jml" name="jml" value="<?= old('jml')?>">
                    <div class="">
                        <?php if (session()->has('errors')) : ?>
                          <?php foreach (session('errors') as $field => $error) : ?>
                            <?php if ($field === 'jml') : ?>
                              <span class="text-danger text-sm"><?= $error ?></span>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>

    </div>
    
    <?= $this->endSection(); ?>