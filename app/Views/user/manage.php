<?= $this->extend('templates/sidebar'); ?>

<?= $this->section('page-content'); ?>


<h4>Manage Users</h4>
<br />
<?php if (session()->getFlashdata('berhasil')) : ?>

<div class="alert alert-info" role="alert">
        <?= session()->getFlashdata('berhasil') ?>
</div>

<?php endif; ?>
<!-- </?php if(isset($_GET['success'])){?>
<div class="alert alert-success">
    <p>Tambah Data Berhasil !</p>
</div>
</?php }?> -->
<!-- </?php if(isset($_GET['success-edit'])){?>
<div class="alert alert-success">
    <p>Update Data Berhasil !</p>
</div>
</?php }?> -->
<!-- </?php if(isset($_GET['remove'])){?>
<div class="alert alert-danger">
    <p>Hapus Data Berhasil !</p>
</div> -->
<!-- </?php }?> -->
<!-- </?php 
	if(!empty($_GET['uid'])){
	$sql = "SELECT * FROM kategori WHERE id_kategori = ?";
	$row = $config->prepare($sql);
	$row->execute(array($_GET['uid']));
	$edit = $row->fetch();
// ?> -->
<!-- <form method="POST" action="fungsi/edit/edit.php?kategori=edit">
    <table>
        <tr>
            <td style="width:25pc;"><input type="text" class="form-control" value="</?= $edit['nama_kategori'];?>"
                    required name="kategori" placeholder="Masukan Kategori Barang Baru">
                <input type="hidden" name="id" value="</?= $edit['id_kategori'];?>">
            </td>
            <td style="padding-left:10px;"><button id="tombol-simpan" class="btn btn-primary"><i class="fa fa-edit"></i>
                    Ubah Data</button></td>
        </tr>
    </table>
</form> -->
<!-- </?php }else{?> -->

    <table>
        <tr>
            <td style="padding-left:10px;"><a href="<?= url_to('register') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>
                    Insert Data</a></td>
        </tr>
    </table>

<!-- </?php }?> -->
<br />
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" id="example1">
            <thead>
                <tr style="background:#DFF0D8;color:#333;">
                    <th>No.</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- </?php 
				$hasil = $lihat -> kategori();
				$no=1;
				foreach($hasil as $isi){
			?> -->
            <?php $i = 1 ;?>
            <?php foreach($users as $user):?>
                <tr>

                    <th scope="row"><?= $i++ ;?></th>
                    <td><?= $user->username; ?></td> 
                    <td><?= $user->email; ?></td> 
                    <td><?= $user->name; ?></td> 
                    <td>
                        <!-- <a  href="/manage/edit/<?= $user->userid ;?>" class="btn btn-success mr-3" class="d-inline">Edit</a> -->

                    <form method="post" action="/manage/<?= $user->userid;?>" class="d-inline">

                        <input type="hidden" name="_method" value="DELETE">

                        <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus data <?= $user->username ;?>?');">Hapus</button>

                    </form></td> 
                    
                    
                </tr>
            <?php endforeach; ?>
                <!-- </?php $no++; }?> -->
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>