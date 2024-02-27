<?= $this->extend('templates/sidebar'); ?>

<?= $this->section('page-content'); ?>

        <h4 class="py-3">Data Barang</h4>
        
        <div class="row">
            <div class="col">
            <form method='get' action="" id="searchForm">
                <div class="input-group mb-3">
                    <input placeholder="Masukan : ID / Nama Barang  [ENTER]" class="form-control mx-1" type='text' name='search' value='<?= $search ?>'>
                    <input class="btn btn-primary mx-1" type='button' id='btnsearch' value='Search' onclick='document.getElementById("searchForm").submit();'>
                 </div>
            </form>
            </div>
        </div>

        <table>
        <tr>
            <td><a href="/barang/tambah"><button class="btn btn-primary my-3"><i class="fa fa-plus"></i>
                    Insert Barang</button></a></td>
        </tr>
    </table>

        <div class="card card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" id="example1">
            <thead>
                <tr style="background:#DFF0D8;color:#333;">
                    <th>No.</th>
                    <th>Produk ID</th>
                    <th>Nama Produk</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
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
            <?php foreach ($barang as $brg) :?>

                <tr>

                    <th scope="row"><?= $i++ ;?></th>
                    <td><?= $brg['ProdukID'] ?></td> 
                    <td><?= $brg['NamaProduk'] ?></td> 
                    <td><?= $brg['HargaBeli'] ?></td> 
                    <td><?= $brg['HargaJual'] ?></td> 
                    <td><?= $brg['Stok'] ?></td> 
                    <td class=" size-absolute d-flex justify-content-center">
                        <a  href="/barang/edit/<?= $brg['ProdukID'] ;?>" class="btn btn-success mr-3" class="d-inline">Edit</a>

                        <form method="post" action="/barang/<?= $brg['ProdukID'];?>" class="d-inline">

                            <input type="hidden" name="_method" value="DELETE">

                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus data barang <?= $brg['NamaProduk'] ;?>?');">Hapus</button>
                        
                        </form></td> 
                    
                    
                </tr>

            <?php endforeach;?>    
                <!-- </?php $no++; }?> -->
            </tbody>
        </table>
        <div><?= $pager->links('produk', 'pagination')?></div>
    </div>
</div>

        <?= $this->endSection(); ?>