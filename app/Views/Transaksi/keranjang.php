<!-- app/Views/transaksi/form_transaksi.php -->

<?= $this->extend('templates/sidebar'); ?>

<?= $this->section('page-content'); ?>

<h4 class="py-3">Transaksi</h4>

<div class="col-md-auto">
    <div class="card card-primary mb-3">
        <div class="card-header bg-primary text-white">
            <h5><i class=""></i>Pelanggan</h5>
        </div>
        <div class="card-body">
            <div class="">
                <form method="post" action="/transaksi" class="d-inline">
                    <select class="form-control" name="opt">
                        <option selected>Pilih Pelanggan</option>
                        <?php foreach ($pelanggan as $plg) : ?>
                            <option value="<?= $plg['PelangganID'] ?>"><?= $plg['NamaPelanggan'] ?></option>
                        <?php endforeach; ?>
                    </select>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-sm-8">
        <div class="card card-primary mb-3">
            <div class="card-header bg-primary text-white">
                <h5><i class="fa fa-list"></i> Hasil Pencarian

                    <input type="hidden" name="_method" value="">

                    <button type="submit" class="btn btn-warning float-right">KERANJANG</button>

                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm" id="example1">
                        <thead>
                            <tr style="background:#DFF0D8;color:#333;">
                                <th>No.</th>
                                <th>Produk ID</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (3 * ($currentPage - 1)); ?>
                            <?php foreach ($barang as $brg) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><input type="hidden" name="produkID" value="<?= $brg['ProdukID']; ?>"><?= $brg['ProdukID'] ?></td>
                                    <td><input placeholder="" class="form-control mx-1" type='hidden' name='namaProduk' value='<?= $brg['NamaProduk']; ?>'><?= $brg['NamaProduk'] ?></td>
                                    <td><input placeholder="" class="form-control mx-1" type='hidden' name='hargaJual' value='<?= $brg['HargaJual']; ?>'><?= $brg['HargaJual'] ?></td>
                                    <td><?= $brg['Stok'] ?></td>
                                    <td><input placeholder="" class="form-control mx-1" type='number' name='jumlahProduk'></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>   
					</form> 
                <!-- </?php $no++; }?> -->
            </tbody>
        </table>
        <div><?= $pager->links('produk', 'pagination')?></div>

					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="card card-primary mb-3">
				<div class="card-header bg-primary text-white">
					<h5><i class="fa fa-search"></i> Cari Barang</h5>
				</div>
				<div class="card-body">
				<form method='get' action="" id="searchForm">
                <div class="input-group mb-3">
                    <input placeholder="Masukan : ID / Nama Barang  [ENTER]" class="form-control mx-1" type='text' name='search' value='<?= $search ?>'>
                    <input class="btn btn-primary mx-1" type='Hidden' id='btnsearch' value='Search' onclick='document.getElementById("searchForm").submit();'>
                 </div>
            </form>				</div>
			</div>
		</div>
		

		<div class="col-sm-12">
			<div class="card card-primary">
				<div class="card-header bg-primary text-white">
					<h5><i class="fa fa-shopping-cart"></i> KASIR
					<a class="btn btn-danger float-right" 
						onclick="javascript:return confirm('Apakah anda ingin reset keranjang ?');" href="fungsi/hapus/hapus.php?penjualan=jual">
						<b>RESET KERANJANG</b></a>
					</h5>
				</div>

									<div class="card-body">
										<div class="table-responsive">
										<div class="table-responsive">
							<table class="table table-bordered table-striped table-sm" id="example1">
                            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal Penjualan</th>
                    <th>Total Harga</th>
                    <th>Nama Pelanggan</th>
                    <th>Detail Penjualan</th>
                </tr>
            </thead>
            <!-- ... -->
<tbody>
    <?php $i = 1; foreach ($jual as $row) : ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $row['TanggalPenjualan']; ?></td>
            <td>
                <?php
                // Hitung total harga berdasarkan detail penjualan
                $totalHarga = 0;
                foreach ($detailPenjualan as $detail) {
                    if ($detail['PenjualanID'] == $row['PenjualanID']) {
                        $totalHarga += $detail['Subtotal'];
                    }
                }
                echo $totalHarga;
                ?>
            </td>
            <td><?= $row['NamaPelanggan']; ?></td>
            <td>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produk ID</th>
                            <th>Nama Produk</th> <!-- Add this column -->
                            <th>Jumlah Produk</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($detailPenjualan as $detail) : ?>
                        <?php if ($detail['PenjualanID'] == $row['PenjualanID']) : ?>
                            <tr>
                                <td><?= $detail['ProdukID']; ?></td>
                                <!-- Add this part to display NamaProduk -->
                                <td>
                                    <?php
                                    foreach ($burung->getResultArray() as $product) {
                                        if ($product['IDproduk'] == $detail['ProdukID']) {
                                            echo $product['NamaProduk'];
                                        }
                                    }
                                    ?>
                                </td>
                                <!-- End of NamaProduk -->
                                <td><?= $detail['JumlahProduk']; ?></td>
                                <td><?= $detail['Subtotal']; ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php endforeach; ?>    
                    </tbody>


							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?= $this->endSection(); ?>