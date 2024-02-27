<?= $this->extend('templates/sidebar'); ?>

<?= $this->section('page-content'); ?>

        <h4 class="py-3">Data Pelanggan</h4>

        <div class="row">
            <div class="col">
            <form method='get' action="" id="searchForm">
                <div class="input-group mb-3">
                    <input placeholder="Masukan : ID / Nama Pelanggan / Alamat / No.HP  [ENTER]" class="form-control mx-1" type='text' name='search' value='<?= $search ?>'>
                    <input class="btn btn-primary mx-1" type='button' id='btnsearch' value='Search' onclick='document.getElementById("searchForm").submit();'>
                 </div>
            </form>
            </div>
        </div>
        
        <?php if (session()->getFlashdata('berhasil')) : ?>

                <div class="alert alert-info" role="alert">
                        <?= session()->getFlashdata('berhasil') ?>
                </div>

        <?php endif; ?>

        <table>
        <tr>
            <td><a href="/pelanggan/tambah"><button class="btn btn-primary my-3"><i class="fa fa-plus"></i>
                    Insert Barang</button></a></td>
        </tr>
    </table>

        <div class="card card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="example1">
                    <thead>
                        <tr style="background:#DFF0D8;color:#333;">
                            <th>No.</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. Handphone</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- </?php 
                        $hasil = $lihat -> kategori();
                        $no=1;
                        foreach($hasil as $isi){
                    ?> -->
                    <?php $i = 1 + (6 * ($currentPage - 1));?>
                    <?php foreach ($pelanggan as $brg) :?>

                        <tr>

                            <th scope="row"><?= $i++ ;?></th>
                            <td><?= $brg['PelangganID'] ?></td> 
                            <td><?= $brg['NamaPelanggan'] ?></td> 
                            <td><?= $brg['Alamat'] ?></td> 
                            <td><?= $brg['NomorTelephone'] ?></td> 
                            <td class=" size-absolute d-flex justify-content-center">
                                <a  href="/pelanggan/edit/<?= $brg['PelangganID'] ;?>" class="btn btn-success mr-3" class="d-inline">Edit</a>

                                <form method="post" action="/pelanggan/<?= $brg['PelangganID'];?>" class="d-inline">

                                    <input type="hidden" name="_method" value="DELETE">

                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus data pelanggan <?= $brg['NamaPelanggan'] ;?>?');">Hapus</button>
                                
                                </form></td> 
                            
                            
                        </tr>

                    <?php endforeach;?>    
                        <!-- </?php $no++; }?> -->
                    </tbody>
                </table>
                <div><?= $pager->links('Pelanggan', 'pagination')?></div>
            </div>
</div>

        <?= $this->endSection(); ?>